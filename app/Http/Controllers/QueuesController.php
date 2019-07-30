<?php

namespace App\Http\Controllers;

use App\Http\Resources\QueueResource;
use App\Repositories\QueueRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class QueuesController extends Controller
{
    /**
     * Queue repository.
     *
     * @var App\Repositories\QueueRepository
     */
    protected $queue;
    
    /**
     * Create new instance of queue controller.
     *
     * @param QueueRepository queue Queue repository
     */
    public function __construct(QueueRepository $queue)
    {
        $this->queue = $queue;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->queue->getAllUsingType(request()->type);
    
        if (! $data) {
            return response()->json([
                'message' => 'Failed to retrieve resource'
            ], 400);
        }
    
        return $data;
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors'  => $validator->errors()
            ], 400);
        }
    
        if (! $this->queue->store($request)) {
            return response()->json([
                'message' => 'Failed to store resource'
            ], 500);
        }
    
        return response()->json([
            'message' => 'Resource successfully stored'
        ], 200);
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! $queue = $this->queue->findOrFail($id)) {
            return response()->json([
                'message' => 'Resource does not exist'
            ], 400);
        }
    
        return response()->json([
            'message' => 'Resource successfully retrieve',
            'queue' => $queue
        ], 200);
    }
}
