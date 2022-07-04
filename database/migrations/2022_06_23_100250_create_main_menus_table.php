<?php

use App\Models\MainMenu;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMainMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('main_menus', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('label')->nullable();
            $table->string('slug')->nullable();
            $table->longText('caption')->nullable();
            $table->string('image')->nullable();
            $table->string('link')->nullable();
            $table->integer('position')->nullable();
            $table->string('target')->default('_self');
            $table->integer('status')->default(1);
            $table->timestamps();
        });

        $data = [
            [
                'title'=>'About',
                'caption'=>'Lorem ipsum dolor sit amet consectetur adipisicing elit. Facilis deleniti beatae exercitationem illum labore officia ad placeat laboriosam nihil aliquid.',
            ],
            [
                'title'=>'Academics',
                'caption'=>'Lorem ipsum dolor sit amet consectetur adipisicing elit. Facilis deleniti beatae exercitationem illum labore officia ad placeat laboriosam nihil aliquid.',
            ],
            [
                'title'=>'Admission',
                'caption'=>'Lorem ipsum dolor sit amet consectetur adipisicing elit. Facilis deleniti beatae exercitationem illum labore officia ad placeat laboriosam nihil aliquid.',
            ],
            [
                'title'=>'Student Life',
                'caption'=>'Lorem ipsum dolor sit amet consectetur adipisicing elit. Facilis deleniti beatae exercitationem illum labore officia ad placeat laboriosam nihil aliquid.',
            ],
            [
                'title'=>'Parents',
                'caption'=>'Lorem ipsum dolor sit amet consectetur adipisicing elit. Facilis deleniti beatae exercitationem illum labore officia ad placeat laboriosam nihil aliquid.',
            ],
            [
                'title'=>'Portal',
                'target'=>'_blank',
            ],
            [
                'title'=>'Faith',
                'target'=>'_blank',
            ],
        ];

        MainMenu::insert($data);

        $links = MainMenu::all();
        foreach ($links as $link){
            $link->slug = strtolower(str_replace(" ", "", $link->title));
            $link->label = strtoupper($link->title);
            $link->save();
        }


        $menus = MainMenu::all();
        foreach ($menus as $menu){
            if ($menu->slug == 'about'){
                $menu->link = 'about';
                $menu->position = 1;
            }
            if ($menu->slug == 'academics'){
                $menu->link = 'academics';
                $menu->position = 2;
            }
            if ($menu->slug == 'faith'){
                $menu->link = 'about/opus-dei';
                $menu->position = 3;
            }
            if ($menu->slug == 'admission'){
                $menu->link = 'admission';
                $menu->position = 4;
            }
            if ($menu->slug == 'studentlife'){
                $menu->link = 'student_life';
                $menu->position = 5;
            }
            if ($menu->slug == 'parents'){
                $menu->link = 'parents';
                $menu->position = 6;
            }
            if ($menu->slug == 'portal'){
                $menu->link = 'https://lagoon.eschoolng.net';
                $menu->position = 7;
                $menu->target = '_blank';
            }
            $menu->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('main_menus');
    }
}
