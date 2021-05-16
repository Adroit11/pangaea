<?php

namespace App\Services;

use App\Models\Topic;

class TopicService
{
    /**
     * Get the topic by name
     *
     * @var Topic 
     */
    public function find($topic) : Topic
    {
        return Topic::ofTopic($topic)->first();
    }

    /**
     * Get the topic by topic
     *
     * @var ID 
     */
    public function get($topic) : int
    {
        return Topic::ofTopic($topic)->pluck('id')->first();
    }

    /**
     * Create a new topic
     *
     * @var boolean
     */
    public function create(string $topic, array $data) : Topic
    {
        $post = new Topic();

        return $this->update($post, $data, $topic);
    }

    /**
     * Update a Topic
     *
     * @var boolean
     */
    public function update(Topic $post, array $data, string $topic) : Topic
    {
        $post->topic = isset($topic)? $topic : $post->topic;
        $post->body = isset($data)? $data : $post->body;
        $post->save();
        return $post;
    }

}
