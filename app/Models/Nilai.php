<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    use HasFactory;
	
	/**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'nilai';
	
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
		'siswa_id',
		'mapel_id',
		'nilai'
	];
	
	/**
     * Get the siswa that owns the nilai.
     */
    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
	
	/**
     * Get the mapel that owns the nilai.
     */
    public function mapel()
    {
        return $this->belongsTo(Mapel::class);
    }
}
