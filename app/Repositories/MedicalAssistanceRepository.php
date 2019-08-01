<?php

namespace App\Repositories;

use App\MedicalAssistance;

class MedicalAssistanceRepository extends Repository
{
    /**
     * Create new instance of medical assistance repository.
     *
     * @param MedicalAssistance $medicalAssistance MedicalAssistance model
     */
    public function __construct(MedicalAssistance $medicalAssistance)
    {
        parent::__construct($medicalAssistance);
        $this->medicalAssistance = $medicalAssistance;
    }

    /**
     * Find the resource using the specified id or else fail.
     *
     * @param  int $id
     * @return json object
     */
    public function findOrFail($id)
    {
        return $this->medicalAssistance->with('user', 'person')->findOrFail($id);
    }
}
