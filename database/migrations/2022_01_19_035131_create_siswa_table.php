<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiswaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('siswa', function (Blueprint $table) {
            $table->id();
			$table->string('nama');
			$table->string('nis');
			$table->string('nisn');
			$table->text('foto');
			$table->text('alamat');
			$table->unsignedBigInteger('kelas_id');
            $table->timestamps();
			
			# Indexing
			$table->index('kelas_id');
			
			# Foreign
			$table->foreign('kelas_id')->references('id')->on('kelas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('siswa');
    }
}
