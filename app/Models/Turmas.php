<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Disciplinas;
use App\Models\Professores;

class Turmas extends Model
{
    use HasFactory, SoftDeletes;

    public function disciplina()
    {
        return $this->hasOne(Disciplinas::class, 'id', 'disciplina_id');
    }
    
    public function professor()
    {
        return $this->hasOne(Professores::class, 'id', 'professor_id');
    }
}
