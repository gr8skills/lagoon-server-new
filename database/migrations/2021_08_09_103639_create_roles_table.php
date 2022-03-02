<?php

use App\Models\Role;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('label');
            $table->text('description')->nullable();
            $table->timestamps();
        });

        foreach (['admin', 'staff', 'regular'] as $roleTitle) {
            Role::create([
                'title' => $roleTitle,
                'label' => strtoupper($roleTitle),
                'description' => 'site ' . $roleTitle
            ]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles');
    }
}
