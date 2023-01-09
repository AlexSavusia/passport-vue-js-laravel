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

class RegistrationToManyUsers
{
	use Dispatchable, InteractsWithSockets, SerializesModels;

	/**
	 * Input request
	 *
	 * @var Illuminate\Http\Request
	 */
	public $request;

	/**
	 * Number of registered users
	 *
	 * @var int
	 */
	public $num;

	/**
	 * Create a new event instance.
	 *
	 * @param Illuminate\Http\Request $request
	 * @param int $num
	 * @return void
	 */
	public function __construct($request, $num = 0)
	{
		$this->request = $request;
		$this->num = $num;
	}
}
