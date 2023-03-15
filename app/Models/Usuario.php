<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Usuario extends Model
{
    use HasFactory;
    protected $table = "usuarios";
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $fillable = [
        'nombre',
        'apellidos',
        'dni',
        'email',
        'password',
        'telefono',
        'pais',
        'iban',
        'about',
    ];

    protected $hidden = ['id'];

    public static function getUserByEmail($email)
    {
        return DB::table('usuarios')->where('email', $email)->first();
    }
}
