<?php

namespace App;

use App\Traits\Filtering;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable, Filtering;

    /**
     * Users table.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The user has many persons.
     *
     * @return array object
     */
    public function persons()
    {
        return $this->hasMany(Person::class);
    }

    /**
     * The user has many medical assistance
     * @return [type] [description]
     */
    public function medicalAssistance()
    {
        return $this->hasMany(MedicalAssistance::class);
    }
}
