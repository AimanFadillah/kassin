<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Kas;
use App\traits\Pesan;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class KeluarController extends Controller
{
    use Pesan;

    public function index (Request $request){
        if($request->ajax()){
            if($request->query("id")){
                $data = Kas::find($request->query("id"));
                $data["uang"] = abs($data["uang"]);
                return response()->json($data);
            }

            if($request->query("show")){
                $kas = Kas::find($request->query("show")); 
                $data = [
                    [
                        "name" => "Catatan",
                        "value" => $kas->catatan,
                    ],
                    [
                        "name" => "Uang",
                        "value" => $this->formatUang(abs($kas->uang)),
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

            $data = Kas::where("uang","<",0)->where("catatan","like","%" . $request->query("cari") . "%")->latest()->paginate(15);

            foreach($data as $dt){
                $dt["uang"] = $this->formatUang(abs($dt->uang));
            }

            return response()->json($data);
        }

        return view("keluar");
    }

    public function store (Request $request){
        try{
            $validatedData = $request->validate([
                "uang" => "required|numeric|min:0|max:1000000",
                "catatan" => "required|max:20" 
            ]);
        }catch (ValidationException $e) {
            return response()->json($this->pesanError($e));
        }

        $validatedData["uang"] = -$validatedData["uang"];

        $new = Kas::create($validatedData);
        $new["uang"] = $this->formatUang(abs($new->uang));

        return response()->json($this->pesanSuccess($new));
    }

    public function update (Request $request,Kas $Kas){
        try{
            $validatedData = $request->validate([
                "uang" => "required|numeric|min:0|max:1000000",
                "catatan" => "required|max:20" 
            ]);
        }catch (ValidationException $e) {
            return response()->json($this->pesanError($e));
        }

        $validatedData["uang"] = -$validatedData["uang"];

        Kas::where("id",$Kas->id)->update($validatedData);

        $data = Kas::find($Kas->id);
        $data["uang"] = $this->formatUang(abs($data->uang));

        return response()->json($this->pesanSuccess($data));
    }

    public function destroy (Kas $Kas){
        Kas::destroy($Kas->id);
        return response()->json($this->pesanSuccess());
    }
}
