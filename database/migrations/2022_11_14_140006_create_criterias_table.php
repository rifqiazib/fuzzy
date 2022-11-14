<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('criterias', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('variable_id');
            $table->foreign('variable_id')->references('id')->on('variables')->onDelete('cascade');
            $table->integer('start');
            $table->integer('end');
            $table->enum('keterangan', ['Sedikit','Sedang','Rendah','Banyak','Tinggi']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('criterias');
    }
};
