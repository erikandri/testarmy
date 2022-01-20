<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNilaiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nilai', function (Blueprint $table) {
            $table->id();
			$table->unsignedBigInteger('siswa_id');
			$table->unsignedBigInteger('mapel_id');
			$table->integer('nilai');
            $table->timestamps();
			
			# Indexing
			$table->index('siswa_id');
			$table->index('mapel_id');
			
			# Foreign
			$table->foreign('siswa_id')->references('id')->on('siswa');
			$table->foreign('mapel_id')->references('id')->on('mapel');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nilai');
    }
}
