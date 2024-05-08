<?php

namespace Lexontech\AuthenticationSystem\app\Models\AuthenticationSystem;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;


class User extends Authenticatable
{
    use HasApiTokens,HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'auth_users';

    protected $fillable = [
        'lex_PhoneNumber',
        'password'
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

    public static function updateOrCreateByPhone($phone)
    {
        return self::updateOrCreate([
            'lex_PhoneNumber' => $phone
        ],[
            'password'    => Hash::make('123456')
        ]);
    }

}
