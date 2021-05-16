<?php

namespace App\Services;

use App\Models\Topic;

class TopicService
{
    /**
     * Get the topic by ID
     *
     * @var Topic 
     */
    public function find($id) : Topic
    {
        return Topic::findOrFail($id);
    }

    /**
     * Get the topic by topic
     *
     * @var ID 
     */
    public function get($topic) : integer
    {
        return Topic::WhereTopic($topic)->pluck('id')->first();
    }

    /**
     * Create a new topic
     *
     * @var boolean
     */
    public function create(array $data) : Topic
    {
        $topic = new Topic();

        return $this->update($topic, $data);
    }

    /**
     * Update a Topic
     *
     * @var boolean
     */
    public function update(Topic $topic, array $data) : Topic
    {
        $topic->topic = array_key_exists("topic", $data )? $data['topic'] : $topic->topic;
        $topic->body = array_key_exists("data", $data )? $data['data'] : $topic->body;
        $topic->save();
        return $topic;
    }

}
