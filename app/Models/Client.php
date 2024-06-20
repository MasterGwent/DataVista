<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $table = 'clients';

    protected $fillable = [
        'number',
        'lastname',
        'firstname',
        'surname',
        'birthdate',
        'inn',
        'name_is_responsible',
        'status'
    ];
}
