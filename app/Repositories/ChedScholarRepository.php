<?php

namespace App\Repositories;

use App\ChedScholar;

class ChedScholarRepository extends Repository
{
    /**
     * Create new instance of ched scholar repository.
     *
     * @param ChedScholar $chedScholar ChedScholar model
     */
    public function __construct(ChedScholar $chedScholar)
    {
        parent::__construct($chedScholar);
        $this->chedScholar = $chedScholar;
    }
}
