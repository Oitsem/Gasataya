<?php

namespace App\Repositories;

use App\Queue;

class QueueRepository extends Repository
{
    /**
     * The queue type.
     *
     * @var array
     */
    protected $types = [
        1 => 'CHED',
        2 => 'Medical',
        3 => 'Solicitation'
    ];

    /**
     * Create new instance of queue repository.
     *
     * @param Queue $queue Queue model
     */
    public function __construct(Queue $queue)
    {
        parent::__construct($queue);
        $this->queue = $queue;
    }

    /**
     * Get all resources in the storage.
     *
     * @return array json object
     */
    public function getAllUsingType($type)
    {
        return $this->queue->where('type', $type)->get();
    }
}
