<?php

use App\Models\SiteSetting;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddColumnsToSiteSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->string('secondary_phone')->nullable();
            $table->string('primary_phone')->nullable();
            $table->string('email')->nullable();
            $table->string('portal_url')->nullable();
            $table->string('inquire')->nullable();
            $table->string('apply')->nullable();
            $table->string('visit_us')->nullable();
            $table->longText('address')->nullable();
            $table->longText('direction')->nullable();
            $table->longText('links')->nullable();
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->string('twitter')->nullable();
            $table->string('youtube')->nullable();
            $table->string('welcome_pic')->nullable();
        });

        $settings = SiteSetting::create([
            'secondary_phone'=>'(+234) 704 4424 923',
            'primary_phone'=>'(+234) 01 3426 109',
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
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
//        Schema::dropIfExists('site_settings');
        Schema::table('site_settings', function (Blueprint $table) {
            $setting = \App\Models\SiteSetting::orderBy('id')->first();
            if (isset($setting) && !is_null($setting))
                $setting->delete();
        });
    }
}
