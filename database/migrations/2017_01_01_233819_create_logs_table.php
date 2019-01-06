<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            env('DB_LOG_TABLE', 'logs'),
            function (Blueprint $table) {
                $table->engine = 'InnoDB';
                
                $table->uuid('id');
                $table->string('instance');
                $table->string('channel');
                $table->string('level');
                $table->string('level_name');
                $table->text('message');
                $table->text('context');
                $table->uuid('request_id')->nullable();

                $table->dateTime('created_at');
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop(env('DB_LOG_TABLE', 'logs'));
    }
}
