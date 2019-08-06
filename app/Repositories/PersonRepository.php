<?php

namespace App\Repositories;

use App\Person;

class PersonRepository extends Repository
{
    /**
     * List of barangays.
     *
     * @var array
     */
    protected $barangays = [];

    /**
     * List of barangay names.
     *
     * @var array
     */
    protected $barangayNames = [
        '42' => 'Alijis',
        '43' => 'Alangilan',
        '44' => 'Banago',
        '45' => 'Bata',
        '46' => 'Estefania',
        '47' => 'Montevista',
        '48' => 'Mandalagan',
        '49' => 'Tangub',
        '50' => 'Singcang-Airport',
        '51' => 'Sum-ag',
        '52' => 'Punta Taytay',
        '53' => 'Villamonte',
        '54' => 'Pahanocoy',
        '55' => 'Cabug',
        '56' => 'Handumanan',
        '57' => 'Mansilingan',
        '58' => 'Taculing',
        '59' => 'Granada',
        '60' => 'Vista Alegre',
        '61' => 'Felisa'
    ];

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
        $this->generateBarangays()->mergeBarangays();
    }

    /**
     * Generate barangay 1 to 41
     *
     * @return self
     */
    public function generateBarangays()
    {
        for ($i = 1; $i <= 41; $i++) {
            $this->barangays[$i] = $i;
        }

        return $this;
    }

    /**
     * Merge barangays and barangay names.
     *
     * @return self
     */
    public function mergeBarangays()
    {
        foreach ($this->barangayNames as $key => $value) {
            $this->barangays[$key] = $value;
        }

        return $this;
    }

    /**
     * Retrieve barangays.
     *
     * @return array
     */
    public function getBarangays()
    {
        return $this->barangays;
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
