<?php

namespace App\View\Components\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class InputField extends Component
{
    /**
     * Create a new component instance.
     */
    public string $name;
    public string $type;
    public string $label;
    public string $value;
    public function __construct($name, $label, $type, $value = '')
    {
        $this->name = $name;
        $this->type = $type;
        $this->label = $label;
        $this->value = $value;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form.input-field');
    }
}
