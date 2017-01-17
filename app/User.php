<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'basecamp_id', 'avatar', 'basecamp_token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function findOrCreateBasecampUser($basecampUser)
    {
        $user = User::firstOrNew(['basecamp_id' => $basecampUser->id]);

        if (!$user->exists) {
            $user->fill([
                'name' => $basecampUser->name,
                'email' => $basecampUser->email,
                // 'avatar' => $basecampUser->avatar,
                'basecamp_id' => $basecampUser->id,
                'basecamp_token' => $basecampUser->token
            ])->save();
        }

        return $user;
    }
}
