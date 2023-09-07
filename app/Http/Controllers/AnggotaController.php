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

            return response()->json(Anggota::latest()->get());
        }

        return view("anggota");
    }

    public function store (Request $request){
        try{
            $validatedData = $request->validate([
                "name" => "required|unique:anggotas",
            ]);
        }catch (ValidationException $e) {
            return response()->json($this->pesanError($e));
        }

        $data = Anggota::create($validatedData);

        return response()->json($this->pesanSuccess($data));
    }

    public function update (Request $request,Anggota $Anggota){
        try{
            $validatedData = $request->validate([
                "name" => "required|unique:anggotas",
            ]);
        }catch (ValidationException $e) {
            return response()->json($this->pesanError($e));
        }

        Anggota::where("id",$Anggota->id)->update($validatedData);

        return response()->json($this->pesanSuccess($validatedData["name"]));
    }

    public function destroy (Anggota $Anggota){
        Anggota::destroy($Anggota->id);
        return response()->json($this->pesanSuccess());
    }



}
