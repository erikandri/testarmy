<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;
	
	/**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'siswa';
	
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
		'nama',
		'nis',
		'nisn',
		'foto',
		'alamat',
		'kelas_id'
	];
	
	/**
     * Get the kelas that owns the siswa.
     */
    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }
	
	/**
     * Get the nilai associated with the siswa.
     */
    public function nilai()
    {
        return $this->hasOne(Nilai::class);
    }
	
	public function setNamaAttribute($value)
	{
		$this->attributes['nama'] = ucfirst($value);
	}
}
