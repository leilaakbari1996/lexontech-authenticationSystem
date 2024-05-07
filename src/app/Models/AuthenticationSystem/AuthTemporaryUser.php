<?php


namespace Lexontech\AuthenticationSystem\app\Models\AuthenticationSystem;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model as Eloquent;

class AuthTemporaryUser extends Eloquent
{
    use HasFactory;

    protected $table = 'auth_temporary_user';
    protected $fillable =
    [
        'Otp'           ,
        'PhoneNumber'
    ];

    public static function DeleteByPhone($phone)
    {
        self::query()->where('PhoneNumber', $phone)->delete();
    }

    public static function FindRow($dara)
    {
        return self::query()->where([
            'Otp'           => $dara['Otp'],
            'PhoneNumber'   => $dara['PhoneNumber']
        ])->orderByDesc('created_at')->first();
    }
}
