<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSurveysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surveys', function (Blueprint $table) {

            $table->bigIncrements('id');

            $table->bigInteger('id_user')->unsigned();//pke ->index() cari knpa?
            $table->foreign('id_user')->references('id')->on('users')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->bigInteger('id_tugas_survey')->unsigned();//pke ->index() cari knpa?
            $table->foreign('id_tugas_survey')->references('id')->on('tugas_surveys')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->integer('harga');
            $table->string('merek');
            $table->boolean('valid');
            $table->timestamp('counted_at')->nullable();
            $table->string('kenaikan');//naik,turun,stabil
            $table->string('komentar')->nullable();//naik,turun,stabil

            $table->timestamps();


            // $table->bigInteger('id_instansi')->unsigned();//pke ->index() cari knpa?
            // $table->bigInteger('id_komoditas')->unsigned();
            // $table->foreign('id_instansi')->references('id')->on('instansis')
            //     ->onDelete('cascade')->onUpdate('cascade');
            // $table->foreign('id_komoditas')->references('id')->on('komoditas')
            //     ->onDelete('cascade')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('surveys');
    }
}
