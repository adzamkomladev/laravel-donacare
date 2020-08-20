<?php

namespace App\View\Components;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class NavIcon extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function iconName()
    {
        $role = Auth::user()->role;

        if ($role ===  'admin') {
            return 'education_atom';
        }

        if ($role === 'patient') {
            return 'gestures_tap-01';
        }

        return 'media-1_button-play';
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return <<<blade
<i class="now-ui-icons {$this->iconName()}"></i>
blade;
    }
}
