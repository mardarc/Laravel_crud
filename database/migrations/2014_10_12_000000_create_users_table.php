<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use Ramsey\Uuid\Uuid;


class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('usuario')->unique();
            $table->string('nome');
            $table->string('cpf')->unique();
            $table->string('email')->unique();
            $table->string('telefone')->nullable();
            $table->string('password');
            $table->string('uuid');
            $table->softdeletes();
            $table->timestamps();
        });

        DB::table('users')->insert(
            array(
                'usuario' => 'admin',
                'nome' => 'administrador',
                'cpf' => '000.000.000-00',
                'email' => 'admin@teste.com',
                'uuid' => Uuid::uuid4(),
                'password' => Hash::make('123456')
            )
        );

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
