<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResidentParentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resident_parents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('resident_id')->index();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('patronimyc');
            $table->boolean('gender');
            $table->string('role');
            $table->date('birthday');
            $table->string('phone');
            $table->text('about');
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
        Schema::dropIfExists('resident_parents');
    }
}
