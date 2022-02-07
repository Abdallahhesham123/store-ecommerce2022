<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMainCatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('main_cats', function (Blueprint $table) {
            $table->id();
            $table->string('trans_lang',10);
            $table->bigInteger('trans_of')->unsigned();
            $table->string('name',100);
            $table->string('slug',100);
            $table->string('image',255)->default('cat.png');
            $table->boolean('active')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('main_cats');
    }
}