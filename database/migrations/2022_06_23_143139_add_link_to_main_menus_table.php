<?php

use App\Models\MainMenu;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLinkToMainMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('main_menus', 'link')) {
            Schema::table('main_menus', function (Blueprint $table) {
                $table->string('link')->nullable()->after('image');
                $table->integer('position')->nullable()->after('link');
            });
        }

        (new MainMenu)->updateOrCreate(['slug'=>'faith'],[
            'title'=>'Faith',
            'target'=>'_blank',
            'label'=> 'FAITH',
        ]);

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
        if (Schema::hasColumn('main_menus', 'link')) {
            Schema::table('main_menus', function (Blueprint $table) {
                $table->dropColumn('link');
                $table->dropColumn('position');
            });

            $faiths = MainMenu::where(['slug'=>'faith'])->get();
            foreach ($faiths as $faith){
                if (isset($faith) && !is_null($faith)){
                    $faith->delete();
                }
            }

        }
    }
}
