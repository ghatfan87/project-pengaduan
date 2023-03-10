<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Pengaduan;

class Response extends Model
{
    use HasFactory;
    protected $fillable = [
        'pengaduan_id',
        'status',
        'pesan',
    ];

    public function pengaduan()
{
    // belongsTo: disambukan dengan table mana (PK nya ada dimana)
    // table yg berperan sebagai FK
    // nama fungsi == nama model PK

	return $this->belongsTo(Pengaduan::class);
}


}
