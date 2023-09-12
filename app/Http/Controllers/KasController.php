<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Kas;
use App\traits\Pesan;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class KasController extends Controller
{
    use Pesan;

    public function index (Request $request){
        if($request->ajax()){
            if($request->query("id")){
                return response()->json(Kas::find($request->query("id")));
            }

            if($request->query("show")){
                $kas = Kas::with("Anggota")->find($request->query("show")); 
                $data = [
                    [
                        "name" => "Nama",
                        "value" => $kas->Anggota->name,
                    ],
                    [
                        "name" => "Dibuat",
                        "value" => $kas->created_at->format("d-m-Y"), 
                    ],
                    [
                        "name" => "Diperbarui",
                        "value" => $kas->updated_at->format("d-m-Y"),
                    ],
                    
                ];
                return response()->json($data);
            }

            $data = Kas::with("Anggota")->whereHas("anggota",function ($query) use ($request) {
                $query->where("name","like","%".$request->query("cari")."%");
            })->latest()->paginate(15);

            foreach($data as $dt){
                $dt["namaAnggota"] = $dt->Anggota->name;
                $dt["uang"] = $this->formatUang($dt->uang);
            }

            return response()->json($data);
        }

        return view("kas",[
            "anggotas" => Anggota::latest()->get(),
        ]);
    }

    public function store (Request $request){
        try{
            $validatedData = $request->validate([
                "anggota_id" => "required",
                "uang" => "required|numeric|min:0|max:1000000"
            ]);
        }catch (ValidationException $e) {
            return response()->json($this->pesanError($e));
        }

        $new = Kas::create($validatedData);

        $data = Kas::with("Anggota")->find($new->id);
        $data["namaAnggota"] = $data->Anggota->name;
        $data["uang"] = $this->formatUang($data->uang);

        return response()->json($this->pesanSuccess($data));
    }

    public function update (Request $request,Kas $Kas){
        try{
            $validatedData = $request->validate([
                "anggota_id" => "required",
                "uang" => "required|numeric|min:0|max:1000000"
            ]);
        }catch (ValidationException $e) {
            return response()->json($this->pesanError($e));
        }

        Kas::where("id",$Kas->id)->update($validatedData);

        $data = Kas::with("Anggota")->find($Kas->id);
        $data["namaAnggota"] = $data->Anggota->name;
        $data["uang"] = $this->formatUang($data->uang);
        $data["selectId"] = $data->anggota_id;

        return response()->json($this->pesanSuccess($data));
    }

    public function destroy (Kas $Kas){
        Kas::destroy($Kas->id);
        return response()->json($this->pesanSuccess());
    }
}
