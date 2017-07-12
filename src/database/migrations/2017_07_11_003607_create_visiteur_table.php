<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVisiteurTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visiteur', function (Blueprint $table) {
            $table->increments('id');
            $table->text('ip')->nullable();
            $table->text('browser')->nullable();
            $table->text('url')->nullable();
            $table->text('ref')->nullable();
            $table->text('user')->nullable();
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
        Schema::dropIfExists('visiteur');
    }
}
