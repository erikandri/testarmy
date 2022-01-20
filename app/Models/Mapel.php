<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mapel extends Model
{
    use HasFactory;
	
	/**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'mapel';
	
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
		'nama',
		'kelas_id'
	];
	
	/**
     * Get the kelas that owns the mapel.
     */
    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }
	
	/**
     * Get the nilai associated with the mapel.
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
