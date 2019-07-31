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

    /**
     * Find the resource using the specified id or else fail.
     *
     * @param  int $id
     * @return json object
     */
    public function findOrFail($id)
    {
        return $this->burial->with('person')->findOrFail($id);
    }
}
