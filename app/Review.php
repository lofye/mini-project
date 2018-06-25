<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'title', 'content', 'value', 'user_id', 'restaurant_id'
    ];

    /**
     * A Review belongs to a User
     * @return QueryBuilder
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * A Review belongs to a Restaurant
     * @return QueryBuilder
     */
    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }
}
