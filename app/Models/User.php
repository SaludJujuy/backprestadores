<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{

 
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function get_all_users(){

        $result = DB::connection('xeilon')->table('usuarios as us')
        ->select('us.IDUsuario','us.Nombre','us.NombreCompleto','us.Nivel','us.Activo')
        ->get();

        return $result;
    }

    public static function get_user($req){
        $result = DB::connection('xeilon')->table('usuarios as us')
        ->select('us.IDUsuario','us.Nombre','us.NombreCompleto','us.Nivel','us.Activo')
        ->where('us.Nombre','LIKE', '%' . $req . '%')
        ->get();
        
        return $result;
    }
}
