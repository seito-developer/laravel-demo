<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Alert extends Component
{
    public string $bg;
    public string $role;

    /**
     * Create a new component instance.
     */
    public function __construct(
        string $bg = "bg-gray-800", 
        string $role = "alert"
    )
    {
        $this->bg = $bg;
        $this->role = $role;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.alert');
    }
}
