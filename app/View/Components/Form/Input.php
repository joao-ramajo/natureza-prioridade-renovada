<?php

namespace App\View\Components\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Input extends Component
{
    /**
     * Create a new component instance.
     */
    public string $label;
    public string $type;
    public string $name;
    public string $value;
    public string $placeholder;
    public string $rules;
    public function __construct($label, $type, $name, $value = '', $placeholder = '', $rules = '')
    {
        $this->label = $label;
        $this->type = $type;
        $this->name = $name;
        $this->placeholder = $placeholder;
        $this->value = $value;
        $this->rules = $rules;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form.input');
    }
}
