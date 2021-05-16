<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use App\Services\TopicService;
use App\Services\SubscribeService;
use App\Http\Requests\PublishRequest;
use App\Http\Resources\PublishResource;

class PublishController extends Controller
{
    private $topicService;

    private $subscribeService;

    public function __construct(TopicService $topic, SubscribeService $subscribers)
    {
        $this->topicService = $topic;
        $this->subscribeService = $subscribers;
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
    public function store(PublishRequest $request, string $topic)
    {
        $data = $request->all();
        if(!is_null($this->topicService->find($topic))){
            $post = $this->topicService->find($topic);
            $this->topicService->update($post, $data, $topic);
        }else{
            $post = $this->topicService->create($topic, $data);
        }
        if($this->subscribeService->subscribe($post)){
            return response()->json(new PublishResource($post), 201);
        }else{
            return response()->json([
                'success' => false,
                'message' => 'operation could not be completed at the moment, please tr again.',
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PublishRequest $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
