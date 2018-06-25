<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
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
     * A User has many ReviewsController
     * @return QueryBuilder
     */
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    /**
     * A Client has many Restaurants
     * @return QueryBuilder
     */
    public function restaurants()
    {
        return $this->hasMany(Restaurant::class);
    }
}
