<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatQqGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qq_groups', function (Blueprint $table) {
            $table->increments('id');
            $table->string('hometown')->comment('生源地');
            $table->string('qq_group')->comment('QQ群号');
            $table->string('name')->comment('群名');
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
        Schema::dropIfExists('qq_groups');
    }
}
