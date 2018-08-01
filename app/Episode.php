<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Episode extends Model
{
    /**
     * Attributes that can be mass assigned
     *
     * @var array
     */
    protected $fillable = ['user_id', 'id', 'downloadurl', 'title', 'description',
    'episodenumber','createddate'];

    /**
     * An episode belongs to a user
     *
     * @return Illuminate\Database\Eloquent\Relations\Relation
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * An episode can have many ratings
     *
     * @return Illuminate\Database\Eloquent\Relations\Relation
     */
    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    /**
     * Calculate the average rating on a episode
     *
     * @return integer
     */
    public function averageRating()
    {
        $ratings = $this->ratings;

        if (!$ratings->isEmpty()) {
            $sum = 0;

            foreach ($ratings as $rating) {
                $sum += $rating->rating;
            }

            return $sum / $ratings->count();
        }
    }
}
