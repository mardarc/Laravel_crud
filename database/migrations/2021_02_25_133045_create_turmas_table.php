<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTurmasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('turmas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('disciplina_id');
            $table->unsignedBigInteger('professor_id');
            $table->softDeletes();
            $table->timestamps();

            $table->index(['disciplina_id'], 'fk_turmas_disciplinas_idx');
            $table->index(['professor_id'], 'fk_turmas_professores_idx');

            $table->foreign('disciplina_id', 'fk_turmas_disciplinas_idx')
                    ->references('id')->on('disciplinas')
                    ->onDelete('no action')
                    ->onUpdate('no action');

            $table->foreign('professor_id', 'fk_turmas_professores_idx')
                    ->references('id')->on('professores')
                    ->onDelete('no action')
                    ->onUpdate('no action');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('turmas');
    }
}
