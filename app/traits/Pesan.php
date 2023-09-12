<?php

namespace App\traits;

Trait Pesan {

    public function pesanError ($msg) {
        $pesan["status"] = "danger";
        $pesan["msg"] = isset($msg->validator) ? $msg->validator->errors()->first() : $msg;
        return $pesan;
    }
    
    public function pesanSuccess ($msg = "Not Massage"){
        $pesan["status"] = "success";
        $pesan["msg"] = $msg;
        return $pesan;
    }

    public function formatUang ($data){
        $new = "Rp" . number_format($data,0,",",".");
        return $new;
    }

}