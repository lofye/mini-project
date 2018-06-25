<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'title', 'content', 'value', 'user_id', 'restaurant_id'
    ];

    /**
     * Create Review by Request
     *
     * @param User $user;
     * @param  array $data
     * @return Restaurant
     */
    public static function createFromRequest(User $user, array $data)
    {
        $review = new Review();
        $review->title = $data['title'];
        $review->content = $data['content'];
        $review->value = $data['value'];
        $review->restaurant_id = $data['restaurant_id'];
        $review->user_id = $user->id;
        $review->save();
        return $review;
    }

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
