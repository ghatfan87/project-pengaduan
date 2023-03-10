<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Response;

class Pengaduan extends Model
{
    use HasFactory;
    protected $fillable= [
        'nik',
        'nama_lengkap',
        'no_telp',
        'pengaduan',
        'foto',
    ];

    public function response()
{
    // hasOne: one to one 
    // table yg berperan sebagai PK
    // nama fungsi == nama model FK
	return $this->hasOne(Response::class);
}

}
