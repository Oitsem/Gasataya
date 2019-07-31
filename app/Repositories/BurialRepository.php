<?php

namespace App\Repositories;

use App\Burial;

class BurialRepository extends Repository
{
    /**
     * Create new instance of Burial repository.
     *
     * @param Burial $burial Burial model
     */
    public function __construct(Burial $burial)
    {
        parent::__construct($burial);
        $this->burial = $burial;
    }
}
