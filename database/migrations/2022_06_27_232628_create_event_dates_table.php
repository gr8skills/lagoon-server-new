<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventDatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_dates', function (Blueprint $table) {
            $table->id();
            $table->string('date')->nullable();
            $table->string('ceremony')->nullable();
//            $table->integer('position')->nullable();
            $table->integer('status')->default(1);
            $table->timestamps();
        });

        $data = [
          [
              'date'=> '27 April',
              'ceremony'=> 'World Book Day',
//              'position'=> 1,
          ],
          [
              'date'=>'05 May',
              'ceremony'=> 'Art Day',
//              'position'=> 2,
          ],
            [
                'date'=> '27 May',
                'ceremony'=> 'Children’s Day',
//              'position'=> 3,
            ]
        ];

        \App\Models\EventDate::insert($data);


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('event_dates');
    }
}
