<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatisticsToSiteSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->string('statistics_graduates')->default('300');
            $table->string('statistics_student_mentor_ratio')->default('1:1');
            $table->string('statistics_enrolment')->default('800');
            $table->string('statistics_average_class_size')->default('35');
            $table->string('statistics_parent_partnership')->nullable();
            $table->string('statistics_faith')->nullable();
            $table->string('statistics_academic_excellence')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->dropColumn('statistics_graduates');
            $table->dropColumn('statistics_student_mentor_ratio');
            $table->dropColumn('statistics_enrolment');
            $table->dropColumn('statistics_average_class_size');
            $table->dropColumn('statistics_parent_partnership');
            $table->dropColumn('statistics_faith');
            $table->dropColumn('statistics_academic_excellence');
        });
    }
}
