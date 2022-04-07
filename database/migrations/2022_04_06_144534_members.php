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
        Schema::create('member', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('名前');
            $table->integer('age')->comment('年齢');
            $table->string('area')->comment('エリア');
            $table->boolean('leader')->default(false)->comment('リーダー');
            $table->string('comment')->nullable(true)->comment('コメンt');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
