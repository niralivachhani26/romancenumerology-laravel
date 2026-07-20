<?php

namespace App\View\Components;

use Illuminate\View\Component;

class DashboardHeader extends Component
{
    public $title;

    public $add;

    public $edit;

    public $index;

    public $open;

    public $customUrl;

    public $customName;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title, $index = '', $customUrl='', $customName='', $add = '', $edit='', $open='')
    {
        $this->title = $title;
        $this->index = $index;
        $this->add = $add;
        $this->edit = $edit;
        $this->customUrl = $customUrl;
        $this->open = $open;
        $this->customName = $customName;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.dashboard-header');
    }
}
