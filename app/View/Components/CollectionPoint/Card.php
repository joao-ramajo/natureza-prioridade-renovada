<?php

namespace App\View\Components\CollectionPoint;

use App\Models\CollectionPoint;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Card extends Component
{
    /**
     * Create a new component instance.
     */


    public CollectionPoint $point;
    public function __construct(CollectionPoint $point)
    {
        $this->point = $point;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.collection-point.card');
    }
}
