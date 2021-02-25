<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTurmasAlunosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('turmas_alunos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('turma_id');
            $table->unsignedBigInteger('aluno_id');
            $table->softDeletes();
            $table->timestamps();

            $table->index(['turma_id'], 'fk_turmas_turmas_alunos_idx');
            $table->index(['aluno_id'], 'fk_turmas_alunos_alunos_idx');

            $table->foreign('turma_id', 'fk_turmas_turmas_alunos_idx')
                    ->references('id')->on('turmas')
                    ->onDelete('no action')
                    ->onUpdate('no action');

            $table->foreign('aluno_id', 'fk_turmas_alunos_alunos_idx')
                    ->references('id')->on('alunos')
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
        Schema::dropIfExists('turmas_alunos');
    }
}
