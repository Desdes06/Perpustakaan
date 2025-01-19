<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Form extends Component
{
    public $action;
    public $title;
    public $buttonText;

    public function __construct($action, $title, $buttonText)
    {
        $this->action = $action;
        $this->title = $title;
        $this->buttonText = $buttonText;
    }

    public function render(): View|Closure|string
    {
        return view('components.form');
    }
}
