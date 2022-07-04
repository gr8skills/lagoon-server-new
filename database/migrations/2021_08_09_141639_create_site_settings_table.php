<?php

use App\Models\SiteSetting;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiteSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();
            $table->string('display_name')->nullable();
            $table->string('logo')->nullable();
            $table->string('secondary_phone')->nullable();
            $table->string('primary_phone')->nullable();
            $table->string('email')->nullable();
            $table->string('portal_url')->nullable();
            $table->string('inquire')->nullable();
            $table->string('apply')->nullable();
            $table->string('virtual_tour')->nullable();
            $table->integer('autoplay')->default(1);
            $table->string('visit_us')->nullable();
            $table->longText('address')->nullable();
            $table->longText('direction')->nullable();
            $table->longText('links')->nullable();
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->string('twitter')->nullable();
            $table->string('youtube')->nullable();
            $table->string('welcome_pic')->nullable();
            $table->string('splash_screen_image')->nullable();
            $table->string('menu_pic')->nullable();
            $table->string('menu_text')->nullable();
            $table->tinyInteger('display_sponsors')->default(\App\Models\SiteSetting::DISPLAY_SPONSOR_ON);
            $table->timestamps();
        });

        $settings = SiteSetting::create([
            'secondary_phone'=>'(+234) 704 4424 923',
            'primary_phone'=>'(+234) 01 3426 109',
            'display_name'=>'LAGOON SCHOOL',
            'email'=>'info@lagoonschool.com.ng',
            'portal_url'=>'https://lagoon.eschoolng.net/',
            'inquire'=>env('FRONT_URL').'about',
            'apply'=>'https://lagoonweb.eschoolng.net/primary/application/start_application.php',
            'visit_us'=>env('FRONT_URL').'contact',
            'address'=>'Ladipo Omotesho Cole Street, Off Adewunmi Adebimpe Drive, Lekki Phase1, Lekki-Epe Expressway, P.O.Box 71166, Victoria Island Nigeria',
            'direction'=>'#',
            'facebook'=>'#',
            'instagram'=>'#',
            'twitter'=>'#',
            'youtube'=>'#',
            'virtual_tour'=>'https://kuula.co/share/collection/7Yb3n?logo=1&info=1&fs=1&vr=0&zoom=1&sd=1&thumbs=1'
        ]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('site_settings');
    }
}
