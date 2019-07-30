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
}
