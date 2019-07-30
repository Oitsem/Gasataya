<?php

namespace App;

use App\Traits\Filtering;
use Illuminate\Database\Eloquent\Model;

class MedicalRecord extends Model
{
    use Filtering;
    
    /**
     * Medical records table.
     *
     * @var string
     */
    protected $table = 'medical_records';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'person_id', 'hospital_bills', 'medicines', 'consultation',
        'medical_supplies', 'minor_procedures', 'laboratory', 'laboratory_test',
        'blood_processing', 'biopsy', 'others', 'radiology', 'xray', 'ct_scan',
        'utz', '2d_echo', 'mri', 'others', 'others_detail'
    ];

    /**
     * Eager load the relationships
     * @var array
     */
    protected $with = ['person', 'user'];

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
     * The medical records belongs to a person
     *
     * @return object
     */
    public function person()
    {
        return $this->belongsTo(Person::class);
    }

    /**
     * The medical records belongs to a user.
     *
     * @return object
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
