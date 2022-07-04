<?php

use App\Models\UsefulLinks;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateUsefulLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('useful_links', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('slug')->nullable();
            $table->string('url')->nullable();
            $table->string('target')->default('_blank');
            $table->string('description')->nullable();
            $table->integer('status')->default(1);
            $table->timestamps();
        });

        $protocol = 'https://';
        $data = [
            [
                'title'=>'Wavecrest Study Center',
                'url'=>$protocol.'wavecreststudycentre.com',
                'created_at'=>DB::raw('CURRENT_TIMESTAMP'),
                'updated_at'=>DB::raw('CURRENT_TIMESTAMP'),
            ],
            [
                'title'=>'Elara Study Center',
                'url'=>$protocol.'www.elarastudycentre.com',
                'created_at'=>DB::raw('CURRENT_TIMESTAMP'),
                'updated_at'=>DB::raw('CURRENT_TIMESTAMP'),
            ],
            [
                'title'=>'Whitesand School',
                'url'=>$protocol.'www.whitesands.org.ng/',
                'created_at'=>DB::raw('CURRENT_TIMESTAMP'),
                'updated_at'=>DB::raw('CURRENT_TIMESTAMP'),
            ],
            [
                'title'=>'Rosevile School',
                'url'=>$protocol.'rosevilleschool.org',
                'created_at'=>DB::raw('CURRENT_TIMESTAMP'),
                'updated_at'=>DB::raw('CURRENT_TIMESTAMP'),
            ],
            [
                'title'=>'Opus Dei',
                'url'=>$protocol.'opusdei.org/en-ng/',
                'created_at'=>DB::raw('CURRENT_TIMESTAMP'),
                'updated_at'=>DB::raw('CURRENT_TIMESTAMP'),
            ],
            [
                'title'=>'NAWA',
                'url'=>$protocol.'nawa.gov.pl/en/',
                'created_at'=>DB::raw('CURRENT_TIMESTAMP'),
                'updated_at'=>DB::raw('CURRENT_TIMESTAMP'),
            ],
        ];

        UsefulLinks::insert($data);

        $links = UsefulLinks::all();
        foreach ($links as $link){
            $slug = str_replace(" ", "", $link->title);
            $slug = strtolower($slug);
            $link->slug = $slug;
            $link->description = $link->title;
            $link->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('useful_links');
    }
}
