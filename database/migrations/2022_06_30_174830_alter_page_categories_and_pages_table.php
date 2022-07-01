<?php

use App\Models\PageCategory;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterPageCategoriesAndPagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        PageCategory::create(['name' => 'parents']);
        PageCategory::where(['name'=>'admission'])->update(['name'=>'faith']);
        PageCategory::where(['name'=>'media'])->update(['name'=>'admission']);
        PageCategory::where(['name'=>'facilities'])->update(['name'=>'student_life']);

        Schema::dropIfExists('pages');

        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('page_category_id')->constrained();
            $table->string('title');
            $table->longText('content')->nullable();
            $table->string('path')->nullable();
            $table->string('slug')->nullable();
            $table->tinyInteger('completed')->default(\App\Models\Page::COMPLETED_TRUE);
            $table->string('banner')->nullable();
            $table->string('footer_image')->nullable();
            $table->string('other_images_1')->nullable();
            $table->string('other_images_2')->nullable();
            $table->string('other_images_3')->nullable();
            $table->string('other_images_4')->nullable();
            $table->string('other_images_5')->nullable();
            $table->string('other_titles_1')->nullable();
            $table->string('other_titles_2')->nullable();
            $table->string('other_titles_3')->nullable();
            $table->string('other_titles_4')->nullable();
            $table->string('other_titles_5')->nullable();
            $table->string('other_titles_6')->nullable();
            $table->longText('other_contents_1')->nullable();
            $table->longText('other_contents_2')->nullable();
            $table->longText('other_contents_3')->nullable();
            $table->longText('other_contents_4')->nullable();
            $table->longText('other_contents_5')->nullable();
            $table->longText('other_contents_6')->nullable();
            $table->timestamps();
        });

        $pageCategories = \App\Models\PageCategory::all()->pluck('id')->toArray();
        foreach ($pageCategories as $cat) {
            switch ($cat) {
                case 1:
                    $pageTitles = [
                        ["Welcome to the Lagoon school","/about/welcome-to-the-lagoon-school"],
                        ["meet the head","/about/message-from-the-principal"],
                        ["Educational phylosophy and model","/about/education"],
                        ["Virtual tour","/about/virtual-tour"],
                        ["faith","/about/opus-dei"],
                        ["partnership with parents","/about/partnership-with-parents"],
                    ];
                    foreach ($pageTitles as $title) {
                        \App\Models\Page::create([
                            'page_category_id' => 1,
                            'title' => strtolower($title[0]),
                            'path' => $title[1],
                            'slug' => \Illuminate\Support\Str::of(strtolower($title[0]))->slug('-'),
                        ]);
                    }
                    break;
                case 2:
                    $pageTitles = [
                        ["Academic facilities","/academics/academic-facilities"],
                        ["Primary school","/academics/primary-school"],
                        ["secondary school","/academics/secondary-school"],
                        ["courses","/academics/courses"],
                        ["academic calendar","/academics/full_calendar"],
                    ];
                    foreach ($pageTitles as $title) {
                        \App\Models\Page::create([
                            'page_category_id' => 2,
                            'title' => strtolower($title[0]),
                            'path' => $title[1],
                            'slug' => \Illuminate\Support\Str::of(strtolower($title[0]))->slug('-'),
                        ]);
                    }
                    break;
                case 3:
                    break;
                case 4:
                    $pageTitles = [
                        ["Admission Procedure","./admission/admission-proceedure"],
                        ["school tuition fees","./admission/tuition"],
                        ["scholarships","./admission/scholarship"],
                        ["Apply to lagoon school","https://lagoonweb.eschoolng.net/primary/application/start_application.php"],
                    ];
                    foreach ($pageTitles as $title) {
                        \App\Models\Page::create([
                            'page_category_id' => 4,
                            'title' => strtolower($title[0]),
                            'path' => $title[1],
                            'slug' => \Illuminate\Support\Str::of(strtolower($title[0]))->slug('-'),
                        ]);
                    }
                    break;
                case 5:
                    $pageTitles = [
                        ["Life in lagoon","/student_life/life_in_lagoon"],
                        ["lagoon traditions","/student_life/lagoon_traditions"],
                        ["service","/student_life/service"],
                        ["club & activities","/academics/club_&_activities"],
                        ["Mentoring & tutorials","/student_life/mentorship"]
                    ];
                    foreach ($pageTitles as $title) {
                        \App\Models\Page::create([
                            'page_category_id' => 4,
                            'title' => strtolower($title[0]),
                            'path' => $title[1],
                            'slug' => \Illuminate\Support\Str::of(strtolower($title[0]))->slug('-'),
                        ]);
                    }
                    break;
                case 6:
                    $pageTitles = [
                        ["NAFAD","https://nafad.org.ng/"],
                        ["digital safety","/student_life/Safety"],
                        ["lunch menu","/student_life/Lunch"],
                        ["Mentoring & tutorials","/student_life/mentorship"],
                        ["Uniform","/student_life/uniform"]
                    ];
                    foreach ($pageTitles as $title) {
                        \App\Models\Page::create([
                            'page_category_id' => 6,
                            'title' => strtolower($title[0]),
                            'path' => $title[1],
                            'slug' => \Illuminate\Support\Str::of(strtolower($title[0]))->slug('-'),
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
