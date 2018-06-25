<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    protected $fillable = [
        'name', 'description',
    ];

    /**
     * Create Restaurant by Request
     *
     * @param User $user;
     * @param  array $data
     * @return Restaurant
     */
    public static function createFromRequest(User $user, array $data)
    {
        $restaurant = new self($data);
        $restaurant->user_id = $user->id;
        $restaurant->save();
        return $restaurant;
    }

    /**
     * Update Restaurant by Request
     *
     * @param User $user;
     * @param  array $data
     * @return Restaurant
     */
    public function updateFromRequest(User $user, array $data)
    {
        $this->user_id = $user->id;
        $this->update($data);
        $this->save();

        return $this;
    }

    /**
     * A Restaurant belongs to a User
     * @return QueryBuilder
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
