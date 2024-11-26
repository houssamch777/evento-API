<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Event extends Component
{
    /**
     * Create a new component instance.
     */
    public $event;

    // Initialize the component with event data
    public function __construct($event)
    {
        $this->event = $event;
    }

    // Render the component view
    public function render()
    {
        return view('components.event');
    }
}
