<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaskableTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('taskable', function (Blueprint $table) {
            $table->unsignedBigInteger('task_id')->index();
            $table->unsignedBigInteger('taskable_id');
            $table->unsignedBigInteger('taskable_type');
            $table->date('finished_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('taskable');
    }
}
