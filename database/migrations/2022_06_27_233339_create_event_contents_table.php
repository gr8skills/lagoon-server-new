<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_contents', function (Blueprint $table) {
            $table->id();
            $table->string('holder')->nullable();
            $table->string('header')->nullable();
            $table->string('date')->nullable();
            $table->longText('ceremony')->nullable();
            $table->longText('paragraph')->nullable();
            $table->integer('position')->nullable();
            $table->integer('status')->default(1);
            $table->timestamps();
        });

        $data = [
            [
               'header'=>'Primary section Interhouse Sports',
                'date'=>'3/10/2022',
                'ceremony'=>'lore dolore magna aliqua. Ut enim ad minim consectetur adipiscing elit, sed do Lorem ipsum dolor sit amet, veniam,',
                'position'=> 1,
                'created_at'=>DB::raw('CURRENT_TIMESTAMP'),
                'updated_at'=>DB::raw('CURRENT_TIMESTAMP'),
            ],
            [
               'header'=>'Primary section Interhouse Sports',
                'date'=>'3/10/2022',
                'ceremony'=>'lore dolore magna aliqua. Ut enim ad minim consectetur adipiscing elit, sed do Lorem ipsum dolor sit amet, veniam,',
                'position'=> 2,
                'created_at'=>DB::raw('CURRENT_TIMESTAMP'),
                'updated_at'=>DB::raw('CURRENT_TIMESTAMP'),
            ]
        ];

        \App\Models\EventContent::insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('event_contents');
    }
}
