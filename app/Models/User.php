<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

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

    public function adminlte_image()
    {
        return asset('images/avatar.png');
    }

    public function adminlte_desc()
    {
        // return 'That\'s a nice guy';
        $user = self::find(auth()->id());
        $label = "";

        if (!empty($user->getRoleNames()))
            foreach ($user->getRoleNames() as $key=>$v) {
                if (
                    ($key < count($user->getRoleNames())-1)
                    &&
                    (count($user->getRoleNames())>1)
                ){
                    $v.=" | ";
                }
                $label .= $v;
            }
        return $label;
    }

    public function adminlte_profile_url()
    {
        return 'users/'.auth()->id();
    }
}
