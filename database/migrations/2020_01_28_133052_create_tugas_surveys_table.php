<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTugasSurveysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tugas_surveys', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unique(['id_instansi', 'id_komoditas','id_lokasi']);//komposit unique

            $table->bigInteger('id_instansi')->unsigned();//pke ->index() cari knpa?
            $table->foreign('id_instansi')->references('id')->on('instansis')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->bigInteger('id_komoditas')->unsigned();//pke ->index() cari knpa?
            $table->foreign('id_komoditas')->references('id')->on('komoditas')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->bigInteger('id_lokasi')->unsigned();//pke ->index() cari knpa?
            $table->foreign('id_lokasi')->references('id')->on('lokasis')
                ->onDelete('cascade')->onUpdate('cascade');


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
        Schema::dropIfExists('tugas_surveys');
    }
}
