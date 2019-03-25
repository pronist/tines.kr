<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->timestamps();
            
            $table
                ->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade')
            ;

            /** 티스토리 API */
            $table->string('name')->unique();
            $table->string('url');
            $table->string('secondaryUrl');
            $table->string('nickname');
            $table->string('title');
            $table->text('description');
            $table->boolean('default');
            $table->string('blogIconUrl');
            $table->string('faviconUrl');
            $table->string('profileThumbnailImageUrl');
            $table->string('profileImageUrl');
            $table->string('role');
            $table->unsignedInteger('blogId');
            $table->text('statistics');
        });
        
        if(config('database.default') == 'mysql') {
            DB::statement('ALTER TABLE blogs ADD FULLTEXT search(nickname, title, url, name)');
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blogs');
    }
}
