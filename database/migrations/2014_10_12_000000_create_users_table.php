<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Create hierarchy table
        Schema::create('hierarchy', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
        });

        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('surnames');
            $table->unsignedBigInteger('jobId');
            $table->string('sex');
            $table->date('birthday');
            $table->string('civilStatus')->nullable();
            $table->string('curp');
            $table->string('rfc');
            $table->string('adress');
            $table->string('street');
            $table->string('postalCode')->nullable();
            $table->string('phoneNumber');
            $table->string('scholarship')->nullable();
            $table->string('password');
            $table->unsignedBigInteger('vehicleId')->nullable();
            $table->string('profilePick')->nullable();
            $table->foreign('jobId')->references('id')->on('hierarchy');
            $table->rememberToken();
            $table->timestamps();
        });

        //Create vehicles table
        Schema::create('vehicles', function(Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('driverId')->nullable();
            $table->string('label');
            $table->string('brand');
            $table->string('model');
            $table->date('date')->nullable();
            $table->string('image')->nullable();
            $table->string('titular');
            $table->string('engine')->nullable();
            $table->string('color')->nullable();
            $table->string('type')->nullable();
            $table->string('cabina')->nullable();
            $table->string('rines')->nullable();
            $table->string('llantas')->nullable();
            $table->integer('propulsion')->nullable();
            $table->integer('engineId')->nullable();
            $table->foreign('driverId')->references('id')->on('users');
        });

        //Add foreign key vehicleId on users table
        Schema::table('users', function(Blueprint $table) {
            $table->foreign('vehicleId')->references('id')->on('vehicles');
        });

        //Create maintenances table
        Schema::create('maintenances', function(Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('vehicleId');
            $table->text('report');
            $table->timestamp('createdAt');
            $table->timestamp('finishedAt')->nullable();
            $table->double('amount');
            $table->foreign('vehicleId')->references('id')->on('vehicles');
        });

        //Create routes tables
        Schema::create('routes', function(Blueprint $table) {
           $table->bigIncrements('id');
           $table->unsignedBigInteger('vehicleId');
           $table->text('streets');
           $table->text('colony');
           $table->string('time');
           $table->foreign('vehicleId')->references('id')->on('vehicles');
        });

        //Create partners table
        Schema::create('partners', function (Blueprint $table) {
           $table->bigIncrements('id');
           $table->string('name');
           $table->string('adress');
           $table->string('street');
           $table->string('postalColde')->nullable();
           $table->string('phone');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('set foreign_key_checks = 0');
        Schema::dropIfExists('vehicles');
        Schema::dropIfExists('users');
        Schema::dropIfExists('hierarchy');
        Schema::dropIfExists('maintenances');
        Schema::dropIfExists('routes');
        Schema::dropIfExists('partners');
        DB::statement('set foreign_key_checks = 1');
    }
}
