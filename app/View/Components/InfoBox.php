<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class InfoBox extends Component
{
    public $title;

    public $icon;

    public $value;

    public $value_sub;

    public $link;

    public $bg;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title, $icon = 'ion-stats-bars', $value='', $value_sub='', $link = '#', $bg='bg-info')
    {
        $this->title = $title;
        $this->icon = $icon;
        $this->value = $value;
        $this->value_sub = $value_sub;
        $this->link = $link;
        $this->bg = $bg;
        // $this->customName = $customName;
    }

//     /**
//      * Get the view / contents that represent the component.
//      *
//      * @return \Illuminate\Contracts\View\View|\Closure|string
//      */
//     public function render()
//     {
//         return view('components.dashboard-header');
//     }
// }

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    // : View|Closure|string
    {
        return view('components.info-box');
    }
}
