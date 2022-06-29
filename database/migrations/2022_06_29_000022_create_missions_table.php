<?php

use App\Models\Mission;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('missions', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Mission::query()->create(['title'=>"Mission",'description'=>"Partnership with parents to give an  all-round education to each   student, based on Christian  principles, with emphasis on the  dignity of the human person, integrity, leadership qualities and  academic excellence."]);
        Mission::query()->create(['title'=>"Vision",'description'=>"To see every Lagoon student equipped with an integral education which enables her to play her unique role in the home,  work place and the larger society "]);
        Mission::query()->create(['title'=>"Core Values",'description'=>"<ol> <li>Freedom and responsibility </li> <li>Dignity of work   </li><li>Responsible use of resources</li><li>Spirit of service   </li><li>Parents involvement as  primary educators</li></ol> "]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('missions');
    }
}
