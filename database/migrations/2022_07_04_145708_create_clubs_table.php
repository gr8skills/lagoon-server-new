<?php

use App\Models\Club;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClubsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clubs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('category');
            $table->timestamps();
        });

        $clubs=[
            ['name'=>'Babysitting Course','category'=>'primary'],
            ['name'=>'Clef Hangers - A Cappella','category'=>'primary'],
            ['name'=>'Drama & Musicals – Lagoon Players','category'=>'primary'],
            ['name'=>'Film Club','category'=>'primary'],
            ['name'=>'Junior Classical League','category'=>'secondary'],
            ['name'=>'Newspaper - The Looking Glass','category'=>'secondary'],
            ['name'=>'Set Design Club','category'=>'secondary'],
            ['name'=>'Student Government','category'=>'secondary'],
        ];

        foreach ($clubs as $club) {
           Club::create($club);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clubs');
    }
}
