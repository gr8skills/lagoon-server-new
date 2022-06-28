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
        ];

        MainMenu::insert($data);

        $links = MainMenu::all();
        foreach ($links as $link){
            $link->slug = strtolower(str_replace(" ", "", $link->title));
            $link->label = strtoupper($link->title);
            $link->save();
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
