<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\traits\Pesan;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class AnggotaController extends Controller
{
    use Pesan;

    public function index (Request $request){
        if($request->ajax()){
            if($request->query("id")){
                return response()->json(Anggota::find($request->query("id")));
            }

            if($request->query("show")){
                $anggota = Anggota::find($request->query("show")); 
                $data = [
                    [
                        "name" => "Nama",
                        "value" => $anggota->name,
                    ],
                    [
                        "name" => "Kas",
                        "value" => strval($anggota->Kas->sum("uang")),
                    ],
                    [
                        "name" => "Dibuat",
                        "value" => $anggota->created_at->format("d-m-Y"),
                    ],
                    [
                        "name" => "Diperbarui",
                        "value" => $anggota->updated_at->format("d-m-Y"),
                    ],
                    
                ];
                return response()->json($data);
            }

            return response()->json(Anggota::where("name","like","%".$request->query("cari")."%")->latest()->paginate(15));
        }

        return view("anggota");
    }

    public function store (Request $request){
        try{
            $validatedData = $request->validate([
                "name" => "required|unique:anggotas|max:20",
            ]);
        }catch (ValidationException $e) {
            return response()->json($this->pesanError($e));
        }

        $data = Anggota::create($validatedData);

        return response()->json($this->pesanSuccess($data));
    }

    public function update (Request $request,Anggota $Anggota){

        $rules = ["name" => "required|max:20"];

        if($Anggota->name !== $request->input("name")){
            $rules["name"] = "required|unique:anggotas|max:20";
        }

        try{
            $validatedData = $request->validate($rules);
        }catch (ValidationException $e) {
            return response()->json($this->pesanError($e));
        }

        Anggota::where("id",$Anggota->id)->update($validatedData);

        return response()->json($this->pesanSuccess($validatedData));
    }

    public function destroy (Anggota $Anggota){
        Anggota::destroy($Anggota->id);
        return response()->json($this->pesanSuccess());
    }



}
