<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Queue extends Model
{
    /**
     * Queues table.
     *
     * @var string
     */
    protected $table = 'queues';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'person_id', 'number', 'type'
    ];

    /**
     * Eager load relationships.
     *
     * @var array
     */
    protected $with = ['person'];

    /**
     * Run functions on boot.
     *
     */
    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (auth('api')->check()) {
                $model->user_id = auth('api')->user()->id;
            } else {
                $model->user_id = request()->headers->get('USER-ID');
            }
        });
    }

    /**
     * The queue belongs to a person.
     *
     * @return object
     */
    public function person()
    {
        return $this->belongsTo(Person::class);
    }

    /**
     * The queue belongs to a user.
     *
     * @return object
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
