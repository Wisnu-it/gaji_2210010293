<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'karyawan';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nik',
        'nama_lengkap',
        'handphone',
        'email',
        'tanggal_masuk',
        'pengguna_id',
    ];

    /**
     * Get all jabatan karyawan records for this karyawan.
     */
    public function jabatanKaryawan()
    {
        return $this->hasMany(JabatanKaryawan::class, 'karyawan_id');
    }
}

