<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;
	
	/**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'kelas';
	
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
		'kelas'
	];
	
	/**
     * Get the siswa associated with the kelas.
     */
    public function siswa()
    {
        return $this->hasOne(Siswa::class);
    }
	
	/**
     * Get the mapel associated with the kelas.
     */
    public function mapel()
    {
        return $this->hasOne(Mapel::class);
    }
}
