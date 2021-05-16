<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class SendNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $post;

    public $subscribe;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($subscriber, $topic)
    {
        $this->subscribe = $subscriber;
        $this->post = $topic;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $payload = array(
            'topic' => $this->post->topic,
            'data'  => $this->post->body
        );
        Http::get($this->subscribe->url, $payload);
    }
}
