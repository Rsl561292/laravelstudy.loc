<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCategoryIdToArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(Schema::hasTable('articles') && !Schema::hasColumn('articles', 'category_id') && !Schema::hasColumn('articles', 'published_at')) {

            Schema::table('articles', function (Blueprint $table) {
                //
                $table->integer('category_id', false, true)->after('id');
                $table->integer('user_id', false, true)->after('id');
                $table->dateTime('published_at')->nullable()->after('updated_at');
                $table->smallInteger('status', false, true)->default(4)->change();
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
        Schema::table('articles', function (Blueprint $table) {
            //
            $table->dropColumn('category_id');
            $table->dropColumn('user_id');
            $table->dropColumn('published_at');
            $table->smallInteger('status', false, true)->change();

        });
    }
}
