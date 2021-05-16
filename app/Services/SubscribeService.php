<?php

namespace App\Services;

use App\Services\TopicService;

use App\Models\Subscriber;

use App\Jobs\SendNotification;

use App\Models\Topic;

class SubscribeService
{
    private $topicService;

    public function __construct(TopicService $topic)
    {
        $this->topicService = $topic;
    }
    /**
     * Get the Subscriber by URL
     *
     * @var Subscriber 
     */
    public function find($url) : Subscriber
    {
        return Subscriber::whereUrl($url)->first();
    }

    /**
     * Create a new subscriber's account
     *
     * @var Subscriber
     */
    public function create(array $data) : Subscriber
    {
        $subscriber = new Subscriber();

        return $this->update($subscriber, $data);
    }

    /**
     * Update a Subscriber
     *
     * @var Subscriber
     */
    public function update(Subscriber $subscriber, array $data) : Subscriber
    {
        $subscriber->url = array_key_exists("url", $data )? $data['url'] : $subscriber->url;
        $subscriber->topic_id = array_key_exists("topic", $data )? $this->topicService->get($data['topic']) : $subscriber->topic_id;
        $subscriber->save();
        return $subscriber;
    }

    /**
     * Get topic subscribers and dispatch request to them all
     */
    public function subscribe(Topic $post) : bool
    {
        $subscribers = $post->subscribers;
        foreach($subscribers as $subscriber){
            SendNotification::dispatch($subscriber, $post);
        }
        return true;
    }

}
