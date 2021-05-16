<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    use HasFactory;

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'body' => 'array',
    ];

    public function subscribers(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Subscriber::class);
    }

    /**
     * Scope a query to include a post of a topic.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  mixed  $topic
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfTopic($query, $topic)
    {
        return $query->where('topic', $topic);
    }
}
