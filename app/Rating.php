<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    /**
     * Attributes that can be mass assigned
     *
     * @var array
     */
    protected $fillable = ['episode_id', 'user_id', 'rating'];

    /**
     * A rating belongs to a episode
     *
     * @return Illuminate\Database\Eloquent\Relations\Relation
     */

    public function episode()
    {
        return $this->belongsTo(Episode::class);
    }


}
