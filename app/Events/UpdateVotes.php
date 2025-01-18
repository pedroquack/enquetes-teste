<?php

namespace App\Events;

use App\Models\Option;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UpdateVotes implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public Option $option;

    public function __construct(Option $option)
    {
        $this->option = $option;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('update_votes_channel');
    }

    public function broadcastWith()
    {
        return [
            'option' => [
                'id' => $this->option->id,
                'text' => $this->option->text,
                'votes' => $this->option->votes,
            ],
        ];
    }
}
