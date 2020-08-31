<?php

namespace App\Listeners;

use App\Events\VideoViewer;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class IncrementCount
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  VideoViewer  $event
     * @return void
     */
    public function handle(VideoViewer $event)
    {
        //if the videopage have no videoIsVisited session =>update the counter
        if(! session()->has('videoIsVisited')){
            $this->updateViwer($event->video);
        }
    }

    public function updateViwer($video){
        $video->viewers = $video->viewers + 1 ;
        $video->save();
        // put session in the page to mark => i have visited this page before
        session()->put('videoIsVisited',$video->id);
    }
}
