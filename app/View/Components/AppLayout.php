<?php

namespace App\View\Components;

use Illuminate\View\Component;

class AppLayout extends Component
{
    public string $title;
    public string $description;

    /**
     * @param string $title
     * @param string $description
     * @param bool $show;
     */
    public function __construct(string $title = "", string $description = "")
    {
        $this->title = $title;
        $this->description = $description;
    }

    /**
     * Get the view / contents that represents the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('layouts.app');
    }
}
