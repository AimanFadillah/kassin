<?php

namespace App\traits;

trait Uuid {

    public function getIncrementing(){ // Mematikan auto increment
        return false;
     }
    
     public function getKeyType(){ // mengubah type primary
            return 'string';
     }
    
    protected static function boot () { // melakukan check apakah id kosong
            parent::boot();
            static::creating(function ($model) {
                if(empty(
                    $model->{
                        $model->getKeyName()
                    }
                )){
                    $model->{$model->getKeyName()} = $model->uid();
                }
            });
        }
    
    public function uid($limit = 10){ // mengatur uid
            return substr(base_convert(sha1(uniqid(mt_rand())),16,36),0,$limit);
        }
    

}