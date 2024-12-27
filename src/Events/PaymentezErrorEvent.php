<?php

namespace TonyStore\LaravelPaymentez\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PaymentezErrorEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @param  string|null  $type
     * @param  string|null  $description
     * @param  string|null  $help
     * @param  int|null  $status
     * @param  object|null  $response
     * @param  string|null  $url
     * @param  array|null  $request
     * @return void
     */
    public function __construct(
        public ?string $type = null,
        public ?string $description = null,
        public ?string $help = null,
        public ?int $status = null,
        public ?object $response = null,
        public ?string $url = null,
        public array|null $request = null
    ) {}
}
