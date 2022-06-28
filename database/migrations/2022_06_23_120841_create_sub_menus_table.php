<?php

use App\Models\MainMenu;
use App\Models\SubMenu;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateSubMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_menus', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('slug')->nullable();
            $table->integer('menu_id')->nullable();
            $table->integer('position')->nullable();
            $table->string('label')->nullable();
            $table->string('path')->nullable();
            $table->string('cName')->nullable();
            $table->string('target')->nullable();
            $table->string('description')->nullable();
            $table->integer('status')->default(1);
            $table->timestamps();
        });
        $menus = MainMenu::all();
        if (isset($menus) && !is_null($menus)){
            foreach ($menus as $menu){
                if ($menu->slug == 'about'){
                    $about = [
                        [
                            'title'=> "Welcome to the Lagoon school",
                            'path'=> "/about/welcome-to-the-lagoon-school",
                            'target'=> "_self",
                            'cName'=> "dropdown-link",
                            'label'=> $menu->label,
                            'menu_id'=> $menu->id,
                            'position'=> 1,
                            'created_at'=>DB::raw('CURRENT_TIMESTAMP'),
                            'updated_at'=>DB::raw('CURRENT_TIMESTAMP'),
                        ],
                        [
                            'title'=> "meet the head",
                            'path'=> "/about/message-from-the-principal",
                            'target'=> "_self",
                            'cName'=> "dropdown-link",
                            'label'=> $menu->label,
                            'menu_id'=> $menu->id,
                            'position'=> 2,
                            'created_at'=>DB::raw('CURRENT_TIMESTAMP'),
                            'updated_at'=>DB::raw('CURRENT_TIMESTAMP'),
                        ],
                        [
                            'title'=> "Educational phylosophy and model",
                            'path'=> "/about/education",
                            'target'=> "_self",
                            'cName'=> "dropdown-link",
                            'label'=> $menu->label,
                            'menu_id'=> $menu->id,
                            'position'=> 3,
                            'created_at'=>DB::raw('CURRENT_TIMESTAMP'),
                            'updated_at'=>DB::raw('CURRENT_TIMESTAMP'),
                        ],
                        [
                            'title'=> "Virtual tour",
                            'path'=> "/about/virtual-tour",
                            'target'=> "_self",
                            'cName'=> "dropdown-link",
                            'label'=> $menu->label,
                            'menu_id'=> $menu->id,
                            'position'=> 4,
                            'created_at'=>DB::raw('CURRENT_TIMESTAMP'),
                            'updated_at'=>DB::raw('CURRENT_TIMESTAMP'),
                        ],
                        [
                            'title'=> "faith",
                            'path'=> "/about/opus-dei",
                            'target'=> "_self",
                            'cName'=> "dropdown-link",
                            'label'=> $menu->label,
                            'menu_id'=> $menu->id,
                            'position'=> 5,
                            'created_at'=>DB::raw('CURRENT_TIMESTAMP'),
                            'updated_at'=>DB::raw('CURRENT_TIMESTAMP'),
                        ],
                        [
                            'title'=> "partnership with parents",
                            'path'=> "/about/partnership-with-parents",
                            'target'=> "_self",
                            'cName'=> "dropdown-link",
                            'label'=> $menu->label,
                            'menu_id'=> $menu->id,
                            'position'=> 6,
                            'created_at'=>DB::raw('CURRENT_TIMESTAMP'),
                            'updated_at'=>DB::raw('CURRENT_TIMESTAMP'),
                        ],
                    ];
                    SubMenu::insert($about);
                }

                if ($menu->slug == 'academics'){
                    $academics = [
                        [
                            'title'=> "Academic facilities",
                            'path'=> "/academics/academic-facilities",
                            'target'=> "_self",
                            'cName'=> "dropdown-link",
                            'label'=> $menu->label,
                            'menu_id'=> $menu->id,
                            'position'=> 1,
                            'created_at'=>DB::raw('CURRENT_TIMESTAMP'),
                            'updated_at'=>DB::raw('CURRENT_TIMESTAMP'),
                        ],
                        [
                            'title'=> "Primary school",
                            'path'=> "/academics/primary-school",
                            'target'=> "_self",
                            'cName'=> "dropdown-link",
                            'label'=> $menu->label,
                            'menu_id'=> $menu->id,
                            'position'=> 2,
                            'created_at'=>DB::raw('CURRENT_TIMESTAMP'),
                            'updated_at'=>DB::raw('CURRENT_TIMESTAMP'),
                        ],
                        [
                            'title'=> "Secondary school",
                            'path'=> "/academics/secondary-school",
                            'target'=> "_self",
                            'cName'=> "dropdown-link",
                            'label'=> $menu->label,
                            'menu_id'=> $menu->id,
                            'position'=> 3,
                            'created_at'=>DB::raw('CURRENT_TIMESTAMP'),
                            'updated_at'=>DB::raw('CURRENT_TIMESTAMP'),
                        ],
                        [
                            'title'=> "Courses",
                            'path'=> "/academics/courses",
                            'target'=> "_self",
                            'cName'=> "dropdown-link",
                            'label'=> $menu->label,
                            'menu_id'=> $menu->id,
                            'position'=> 4,
                            'created_at'=>DB::raw('CURRENT_TIMESTAMP'),
                            'updated_at'=>DB::raw('CURRENT_TIMESTAMP'),
                        ],
                        [
                            'title'=> "Academic calendar",
                            'path'=> "/academics/full_calendar",
                            'target'=> "_self",
                            'cName'=> "dropdown-link",
                            'label'=> $menu->label,
                            'menu_id'=> $menu->id,
                            'position'=> 5,
                            'created_at'=>DB::raw('CURRENT_TIMESTAMP'),
                            'updated_at'=>DB::raw('CURRENT_TIMESTAMP'),
                        ],
                    ];
                    SubMenu::insert($academics);
                }

                if ($menu->slug == 'admission'){
                    $admission = [
                        [
                            'title'=> "Admission Procedure",
                            'path'=> "./admission/admission-proceedure",
                            'target'=> "_self",
                            'cName'=> "dropdown-link",
                            'label'=> $menu->label,
                            'menu_id'=> $menu->id,
                            'position'=> 1,
                            'created_at'=>DB::raw('CURRENT_TIMESTAMP'),
                            'updated_at'=>DB::raw('CURRENT_TIMESTAMP'),
                        ],
                        [
                            'title'=> "School tuition fees",
                            'path'=> "./admission/tuition",
                            'target'=> "_self",
                            'cName'=> "dropdown-link",
                            'label'=> $menu->label,
                            'menu_id'=> $menu->id,
                            'position'=> 2,
                            'created_at'=>DB::raw('CURRENT_TIMESTAMP'),
                            'updated_at'=>DB::raw('CURRENT_TIMESTAMP'),
                        ],
                        [
                            'title'=> "Scholarships",
                            'path'=> "./admission/scholarship",
                            'target'=> "_self",
                            'cName'=> "dropdown-link",
                            'label'=> $menu->label,
                            'menu_id'=> $menu->id,
                            'position'=> 3,
                            'created_at'=>DB::raw('CURRENT_TIMESTAMP'),
                            'updated_at'=>DB::raw('CURRENT_TIMESTAMP'),
                        ],
                        [
                            'title'=> "FAQs",
                            'path'=> "./admission/f-a-q",
                            'target'=> "_self",
                            'cName'=> "dropdown-link",
                            'label'=> $menu->label,
                            'menu_id'=> $menu->id,
                            'position'=> 4,
                            'created_at'=>DB::raw('CURRENT_TIMESTAMP'),
                            'updated_at'=>DB::raw('CURRENT_TIMESTAMP'),
                        ],
                        [
                            'title'=> "Apply to lagoon school",
                            'path'=> "https://lagoonweb.eschoolng.net/primary/application/start_application.php",
                            'target'=> "_blank",
                            'cName'=> "dropdown-link",
                            'label'=> $menu->label,
                            'menu_id'=> $menu->id,
                            'position'=> 5,
                            'created_at'=>DB::raw('CURRENT_TIMESTAMP'),
                            'updated_at'=>DB::raw('CURRENT_TIMESTAMP'),
                        ],
                    ];
                    SubMenu::insert($admission);
                }

                if ($menu->slug == 'studentlife'){
                    $studentlife = [
                        [
                            'title'=> "Life in lagoon",
                            'path'=> "/student_life/life_in_lagoon",
                            'target'=> "_self",
                            'cName'=> "dropdown-link",
                            'label'=> $menu->label,
                            'menu_id'=> $menu->id,
                            'position'=> 1,
                            'created_at'=>DB::raw('CURRENT_TIMESTAMP'),
                            'updated_at'=>DB::raw('CURRENT_TIMESTAMP'),
                        ],
                        [
                            'title'=> "Lagoon traditions",
                            'path'=> "/student_life/lagoon_traditions",
                            'target'=> "_self",
                            'cName'=> "dropdown-link",
                            'label'=> $menu->label,
                            'menu_id'=> $menu->id,
                            'position'=> 2,
                            'created_at'=>DB::raw('CURRENT_TIMESTAMP'),
                            'updated_at'=>DB::raw('CURRENT_TIMESTAMP'),
                        ],
                        [
                            'title'=> "Service",
                            'path'=> "/student_life/service",
                            'target'=> "_self",
                            'cName'=> "dropdown-link",
                            'label'=> $menu->label,
                            'menu_id'=> $menu->id,
                            'position'=> 3,
                            'created_at'=>DB::raw('CURRENT_TIMESTAMP'),
                            'updated_at'=>DB::raw('CURRENT_TIMESTAMP'),
                        ],
                        [
                            'title'=> "Club & activities",
                            'path'=> "/academics/club_&_activities",
                            'target'=> "_self",
                            'cName'=> "dropdown-link",
                            'label'=> $menu->label,
                            'menu_id'=> $menu->id,
                            'position'=> 4,
                            'created_at'=>DB::raw('CURRENT_TIMESTAMP'),
                            'updated_at'=>DB::raw('CURRENT_TIMESTAMP'),
                        ],
                        [
                            'title'=> "Mentoring & tutorials",
                            'path'=> "/student_life/mentorship",
                            'target'=> "_self",
                            'cName'=> "dropdown-link",
                            'label'=> $menu->label,
                            'menu_id'=> $menu->id,
                            'position'=> 5,
                            'created_at'=>DB::raw('CURRENT_TIMESTAMP'),
                            'updated_at'=>DB::raw('CURRENT_TIMESTAMP'),
                        ],
                    ];
                    SubMenu::insert($studentlife);
                }

                if ($menu->slug == 'parents'){
                    $parents = [
                        [
                            'title'=> "NAFAD",
                            'path'=> "https://nafad.org.ng/",
                            'cName'=> "dropdown-link",
                            'target'=> "_blank",
                            'label'=> $menu->label,
                            'menu_id'=> $menu->id,
                            'position'=> 1,
                            'created_at'=>DB::raw('CURRENT_TIMESTAMP'),
                            'updated_at'=>DB::raw('CURRENT_TIMESTAMP'),
                        ],
                        [
                            'title'=> "Digital safety",
                            'path'=> "/student_life/Safety",
                            'target'=> "_self",
                            'cName'=> "dropdown-link",
                            'label'=> $menu->label,
                            'menu_id'=> $menu->id,
                            'position'=> 2,
                            'created_at'=>DB::raw('CURRENT_TIMESTAMP'),
                            'updated_at'=>DB::raw('CURRENT_TIMESTAMP'),
                        ],
                        [
                            'title'=> "Lunch menu",
                            'path'=> "/student_life/Lunch",
                            'target'=> "_self",
                            'cName'=> "dropdown-link",
                            'label'=> $menu->label,
                            'menu_id'=> $menu->id,
                            'position'=> 3,
                            'created_at'=>DB::raw('CURRENT_TIMESTAMP'),
                            'updated_at'=>DB::raw('CURRENT_TIMESTAMP'),
                        ],
                        [
                            'title'=> "Mentoring & tutorials",
                            'path'=> "/student_life/mentorship",
                            'target'=> "_self",
                            'cName'=> "dropdown-link",
                            'label'=> $menu->label,
                            'menu_id'=> $menu->id,
                            'position'=> 4,
                            'created_at'=>DB::raw('CURRENT_TIMESTAMP'),
                            'updated_at'=>DB::raw('CURRENT_TIMESTAMP'),
                        ],
                        [
                            'title'=> "Uniform",
                            'path'=> "/student_life/uniform",
                            'target'=> "_self",
                            'cName'=> "dropdown-link",
                            'label'=> $menu->label,
                            'menu_id'=> $menu->id,
                            'position'=> 5,
                            'created_at'=>DB::raw('CURRENT_TIMESTAMP'),
                            'updated_at'=>DB::raw('CURRENT_TIMESTAMP'),
                        ],

                    ];
                    SubMenu::insert($parents);
                }
            }
        }

        $sub_menus = SubMenu::all();
        foreach ($sub_menus as $sub_menu){
            if ($sub_menu->title == "NAFAD"){
                $sub_menu->description = "Association";
            }
            $sub_menu->slug = strtolower(str_replace(" ","",$sub_menu->title));
            $sub_menu->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sub_menus');
    }
}
