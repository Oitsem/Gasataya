<?php

namespace App;

use App\Traits\Filtering;
use Illuminate\Database\Eloquent\Model;

class ChedScholar extends Model
{
    use Filtering;
    
    /**
     * Ched scholars table.
     *
     * @var string
     */
    protected $table = 'ched_scholars';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'person_id', 'file',

        'school_last_attended', 'school_last_attended_address',
        'highest_attained_grade', 'school_last_attended_sector',
        
        'school_intended_to_enroll', 'school_intended_to_enroll_address',
        'degree_program', 'school_intended_to_enroll_sector',

        'fathers_first_name', 'fathers_middle_name', 'fathers_last_name', 'fathers_extension_name',
        'fathers_address', 'fathers_city', 'fathers_province',
        'fathers_contact_number',
        'fathers_occupation', 'fathers_annual_gross_income',
        'fathers_name_of_employer', 'fathers_employer_address',

        'mothers_first_name', 'mothers_middle_name', 'mothers_last_name',
        'mothers_address', 'mothers_city', 'mothers_province',
        'mothers_contact_number',
        'mothers_occupation', 'mothers_annual_gross_income',
        'mothers_name_of_employer', 'mothers_employer_address',

        'legal_guardian_first_name', 'legal_guardian_middle_name',
        'legal_guardian_last_name', 'legal_guardian_extension_name',
        'legal_guardian_address', 'legal_guardian_city', 'legal_guardian_province',
        'legal_guardian_contact_number',
        'legal_guardian_occupation', 'legal_guardian_annual_gross_income',
        'legal_guardian_name_of_employer', 'legal_guardian_employer_address'
    ];

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
