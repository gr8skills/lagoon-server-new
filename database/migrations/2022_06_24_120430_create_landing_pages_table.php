<?php

use App\Models\LandingPage;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLandingPagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('landing_pages', function (Blueprint $table) {
            $table->id();
            $table->longText('message')->nullable();
            $table->longText('mission')->nullable();
            $table->timestamps();
        });

        $message = [
            'Heading' =>'Welcome to the Lagoon School',
            'Paragraph1'=>"The Lagoon School aims at investing in the Nigerian girl child for the good of the society. We have both  primary and secondary sections. Our school has a reputation of high moral and academic standards. We have  been able to achieve these through our mission => ‘ partnership with the parents to give an all-round education to the students, based on the dignity of the human person, integrity, leadership qualities and academic excellence ’ and our vision => ‘ Christian I dentity ’ ",
            'Button'=>"READ MORE FROM MISS DOREEN ONYEKWELU | THE SCHOOL HEAD",
            'link'=>'/about',
        ];

        $mission = [
            [
                'Heading' =>'Mission',
                'Paragraph1'=>"Partnership with parents to give an  all-round education to each   student, based on Christian  principles, with emphasis on the  dignity of the human person, integrity, leadership qualities and  academic excellence.",
            ],
            [
                'Heading' =>'Vission',
                'Paragraph1'=>"To see every Lagoon student equipped with an integral education which enables her to play her unique role in the home,  work place and the larger society ",
            ],
            [
                'Heading' =>'Core values',
                'Paragraph1'=>"<ol> <li>Freedom and responsibility </li> <li>Dignity of work   </li><li>Responsible use of resources</li><li>Spirit of service   </li><li>Parents involvement as  primary educators</li></ol> ",
            ]
        ];

        (new LandingPage)->create([
            'message'=>json_encode($message),
            'mission'=>json_encode($mission),
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('landing_pages');
    }
}
