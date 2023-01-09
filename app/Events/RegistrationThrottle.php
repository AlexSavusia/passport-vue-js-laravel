<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Http\Request;

class RegistrationThrottle
{
	use Dispatchable, InteractsWithSockets, SerializesModels;

	/**
	 * Input request
	 *
	 * @var Illuminate\Http\Request
	 */
	public $request;

	/**
	 * Received cookie
	 *
	 * @var string
	 */
	public $cookie;

	/**
	 * Previous saved data
	 *
	 * @var mixed
	 */
	public $previous;

	/**
	 * Create a new event instance.
	 *
	 * @param Illuminate\Http\Request $request
	 * @param array $cookie
	 * @param mixed $previous
	 * @return void
	 */
	public function __construct($request, $cookie = false, $previous = false)
	{
		$this->request = $request;
		$this->cookie = $cookie;
		$this->previous = $previous;
	}
}
