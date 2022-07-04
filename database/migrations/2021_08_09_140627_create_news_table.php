<?php

use App\Models\News;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->string('ref_id')->unique();
            $table->string('title');
            $table->string('slug')->nullable();
            $table->string('banner')->nullable();
            $table->longText('content');
            $table->string('thumb')->nullable();
            $table->timestamps();
        });
        if(!empty($nws=News::all()))
        $nws->each(function ($news) {
            $news->slug = \Illuminate\Support\Str::of($news->title)->slug('-');
            $news->save();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('news');
    }
}
