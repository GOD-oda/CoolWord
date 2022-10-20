<?php

namespace App\Listeners\CoolWord;

use App\Events\CoolWord\CoolWordViewed;
use Main\Domain\CoolWord\CoolWordRepository;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CoolWordViewedListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(private CoolWordRepository $repository) {}

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(CoolWordViewed $event)
    {
        $this->repository->countUpViews($event->coolWordId, 1);
    }
}
