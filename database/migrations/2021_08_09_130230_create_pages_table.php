<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('page_category_id')->constrained();
            $table->string('title');
            $table->longText('content')->nullable();
            $table->string('banner')->nullable();
            $table->string('footer_image')->nullable();
            $table->timestamps();
        });

        $pageCategories = \App\Models\PageCategory::all()->pluck('id')->toArray();
        foreach ($pageCategories as $cat) {
            switch ($cat) {
                case 1:
                    $pageTitles = [
                        'Brief History',
                        'Chairman\'s Message',
                        'Principal\'s Desk',
                        'Management Structure',
                        'Policies'
                    ];
                    foreach ($pageTitles as $title) {
                        \App\Models\Page::create([
                            'page_category_id' => 1,
                            'title' => strtolower($title)
                        ]);
                    }
                    break;
                case 2:
                    $pageTitles = [
                        'Curriculum',
                        'School Structure',
                        'Educational Tour',
                        'Result Analysis',
                        'Academic Calendar'
                    ];
                    foreach ($pageTitles as $title) {
                        \App\Models\Page::create([
                            'page_category_id' => 2,
                            'title' => strtolower($title)
                        ]);
                    }
                    break;
                case 3:
                    $pageTitles = [
                        'Admission Procedure',
                    ];
                    foreach ($pageTitles as $title) {
                        \App\Models\Page::create([
                            'page_category_id' => 3,
                            'title' => strtolower($title)
                        ]);
                    }
                    break;
                case 4:
                    $pageTitles = [
                        'News & Events',
                        'CFC Magazine',
                        'Blog',
                        'Picture Gallery',
                        'Video Gallery',
                        'Downloads'
                    ];
                    foreach ($pageTitles as $title) {
                        \App\Models\Page::create([
                            'page_category_id' => 4,
                            'title' => strtolower($title)
                        ]);
                    }
                    break;
                case 5:
                    $pageTitles = [
                        'Facilities',
                    ];
                    foreach ($pageTitles as $title) {
                        \App\Models\Page::create([
                            'page_category_id' => 5,
                            'title' => strtolower($title)
                        ]);
                    }
                    break;
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pages');
    }
}
