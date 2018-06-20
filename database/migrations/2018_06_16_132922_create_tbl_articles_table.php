<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('articles')) {

            Schema::create('articles', function (Blueprint $table) {

                $table->increments('id');
                $table->string('title', 140);
                $table->text('content');
                $table->string('preview_img', 255)->nullable();
                $table->string('preview_text', 255)->nullable();
                $table->integer('view_count', false, true);
                $table->integer('like_count', false, true);
                $table->timestamps();
                $table->smallInteger('status', false, true);

                $table->unique('title');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
    }
}
