<?php

namespace App\View\Components\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Form extends Component
{
    /**
     * Create a new component instance.
     */

    public string $route;
    public string $method;
    public string $title;
    public string $btnLabel;
    
    public function __construct($route, $method, $title, $btnLabel)
    {
        $this->route = $route;
        $this->method = $method;
        $this->title = $title;
        $this->btnLabel = $btnLabel;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form.form');
    }
}
