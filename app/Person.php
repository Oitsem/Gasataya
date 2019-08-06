<?php

namespace App;

use App\Traits\Filtering;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use Filtering;

    /**
     * Persons table.
     *
     * @var string
     */
    protected $table = 'persons';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'first_name', 'middle_name', 'last_name',
        'extension_name', 'address', 'birthdate', 'place_of_birth',
        'civil_status', 'citizenship', 'number_of_siblings', 'sex',
        'email', 'mobile_number', 'telephone_number',
        'occupation', 'zip_code', 'district'
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['full_name'];

    /**
     * Get the person's full name.
     *
     * @return string
     */
    public function getFullNameAttribute()
    {
        $fullName = $this->first_name . ' ' . substr($this->middle_name, 0, 1) . '. ' . $this->last_name . ' ' . $this->extension_name;

        return trim($fullName);
    }

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
     * The person belongs to a user.
     *
     * @return object
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The person has many medical assistance
     *
     * @return array object
     */
    public function medicalAssistance()
    {
        return $this->hasMany(MedicalAssistance::class);
    }
}
