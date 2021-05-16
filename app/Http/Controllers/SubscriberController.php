<?php

namespace App\Http\Controllers;

use App\Models\Subscriber;
use App\Services\SubscribeService;
use App\Http\Requests\SubscriberRequest;
use App\Http\Resources\SubscribeResource;

class SubscriberController extends Controller
{
    private $subscribeService;

    public function __construct(SubscribeService $subscribe)
    {
        $this->subscribeService = $subscribe;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubscriberRequest $request, string $topic)
    {
        $data = $request->all();
        $data['topic'] = $topic;
        if($subscribe = $this->subscribeService->create($data)){
            return response()->json(new SubscribeResource($subscribe), 201);
        }else{
            return response()->json([
                'success' => false,
                'message' => "Unable to handle your request at the moment, please try again later."
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Subscriber  $subscriber
     * @return \Illuminate\Http\Response
     */
    public function show(Subscriber $subscriber)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Subscriber  $subscriber
     * @return \Illuminate\Http\Response
     */
    public function edit(Subscriber $subscriber)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Subscriber  $subscriber
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subscriber $subscriber)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subscriber  $subscriber
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subscriber $subscriber)
    {
        //
    }
}
