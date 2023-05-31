<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $table = "mahasiswas";
    public $timestamps = false;
    public  $featured_image ='123';
    protected $primaryKey = "Nim";
    public $incrementing = false;

    protected $fillable = [
        'Nim',
        'Nama',
        'kelas_id',
        'Tanggal_Lahir',
        'Jurusan',
        'No_Handphone',
    ];
}