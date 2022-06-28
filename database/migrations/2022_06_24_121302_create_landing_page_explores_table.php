<?php

use App\Models\LandingPageExplore;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLandingPageExploresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('landing_page_explores', function (Blueprint $table) {
            $table->id();
            $table->integer('landing_id')->default(1);
            $table->string('image')->nullable();
            $table->string('section')->nullable();
            $table->string('receipt')->nullable();
            $table->string('link')->nullable();
            $table->integer('status')->default(1);
            $table->integer('position')->nullable();
            $table->timestamps();
        });

        $explore = [
            [
                'image'=>'',
                'section'=>"Primary Section",
                'receipt'=>"Reception to Year 6",
                'link'=>"/academics/primary-school",
                'position'=>1,
                'created_at'=>DB::raw('CURRENT_TIMESTAMP'),
                'updated_at'=>DB::raw('CURRENT_TIMESTAMP'),
            ],
            [
                'image'=>'',
                'section'=>"Secondary Section",
                'receipt'=>"JS1 - SS3",
                'link'=>"/academics/secondary-school",
                'position'=>2,
                'created_at'=>DB::raw('CURRENT_TIMESTAMP'),
                'updated_at'=>DB::raw('CURRENT_TIMESTAMP'),
            ],
        ];

        LandingPageExplore::insert($explore);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('landing_page_explores');
    }
}
