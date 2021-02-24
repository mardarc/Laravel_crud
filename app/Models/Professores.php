<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Professores extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'email',
        'cpf',
    ];
    
    protected $primaryKey = 'id';

}
