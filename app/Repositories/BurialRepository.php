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
     * Create pagination with filters for the resources.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string                    $orderBy
     * @param  integer                   $length
     * @param  boolean                   $removePage
     * @return array json object
     */
    public function paginateWithFilters(
        $request = null,
        $orderBy = 'desc',
        $length = 10,
        $removePage = true
    ) {
        if ($orderBy == null) {
            $orderBy = 'desc';
        }

        return $this->model->filter($request)
                            ->orderBy('created_at', $orderBy)
                            ->with('person')
                            ->paginate($length)
                            ->withPath(
                                $this->model->createPaginationUrl($request, $removePage)
                            );
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
