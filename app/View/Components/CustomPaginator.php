<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Pagination\LengthAwarePaginator;

class CustomPaginator extends Component
{
    /**
     * Create a new component instance.
     */
    public LengthAwarePaginator $paginator;
    public function __construct(LengthAwarePaginator $paginator)
    {
        //
        $this->paginator = $paginator;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.custom-paginator', [
            'paginator' => $this->paginator,
            'elements' => $this->paginator->links()->elements,
        ]);
    }
}
