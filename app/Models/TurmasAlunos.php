<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Turmas;
use App\Models\Alunos;

class TurmasAlunos extends Model
{
    use HasFactory, SoftDeletes;

    public function turma()
    {
        return $this->hasOne(Turmas::class, 'id', 'turma_id');
    }
    
    public function alunos()
    {
        return $this->hasMany(Alunos::class, 'id', 'aluno_id');
    }
}
