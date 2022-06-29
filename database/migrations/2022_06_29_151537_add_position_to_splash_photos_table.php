<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPositionToSplashPhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('splash_photos', function (Blueprint $table) {
            $table->integer('position')->nullable();
            $table->integer('status')->default(1);
        });

        $splash = \App\Models\SplashPhoto::orderBy('id', 'asc')->get();
        if (isset($splash)){
            $pos = 1;
            foreach ($splash as $spl){
                $spl->position = $pos++;
                $spl->save();
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
        Schema::table('splash_photos', function (Blueprint $table) {
            $table->dropColumn('position');
            $table->dropColumn('status');
        });
    }
}
