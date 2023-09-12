<?php

namespace App\Models;

use App\traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kas extends Model
{
    use HasFactory,Uuid;

    protected $guarded = ["id"];

    public function Anggota () {
        return $this->belongsTo(Anggota::class);
    }
}
