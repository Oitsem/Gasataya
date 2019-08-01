<?php

namespace App\Repositories;

use App\Person;

class PersonRepository extends Repository
{
    /**
     * Civil status options.
     *
     * @var array
     */
    protected $civilStatusOptions = [
        1 => 'Single',
        2 => 'Married',
        3 => 'Annulled',
        4 => 'Widowed',
        5 => 'Separated',
        6 => 'Others'
    ];

    /**
     * Create new instance of person repository.
     *
     * @param Person $person Person model
     */
    public function __construct(Person $person)
    {
        parent::__construct($person);
        $this->person = $person;
    }

    /**
     * Search the specified data from the storage.
     *
     * @param  string|null $column
     * @param  string|null $key
     * @return boolean
     */
    public function search($column = null, $key = null)
    {
        if ($column == null) {
            return $this->person->where('first_name', 'LIKE', '%' . $key .'%')
                                ->orWhere('middle_name', 'LIKE', '%' . $key .'%')
                                ->orWhere('last_name', 'LIKE', '%' . $key .'%')
                                ->orderBy('created_at', 'desc')
                                ->limit(15)
                                ->get();
        }

        return $this->person->where($column, 'LIKE', '%' . $key .'%')->get();
    }

    /**
     * Find the resource using the specified id or else fail.
     *
     * @param  int $id
     * @return json object
     */
    public function findOrFail($id)
    {
        return $this->person->with('user', 'medicalAssistance')->findOrFail($id);
    }
}
