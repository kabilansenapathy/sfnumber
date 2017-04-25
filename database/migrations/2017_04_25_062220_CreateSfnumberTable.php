<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSfnumberTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('sfno', function (Blueprint $table){
               $table->int('id')->index();
               $table->text('taluk');
               $table->bigint('ddp'); 
               $table->text('village');
               $table->int('village_no');
               $table->text('type');
               $table->text('sfno');

        });
       
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sfno');
    }
}
