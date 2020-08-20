<?php

namespace App\View\Components;

use Illuminate\Support\Facades\Route;
use Illuminate\View\Component;

class PanelHeader extends Component
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

    public function routeClass()
    {
        return 'home' === Route::currentRouteName() ? 'panel-header-lg' : 'panel-header-sm';
    }

    public function routeId()
    {
        return 'home' === Route::currentRouteName() ? 'id="btm"' : '';
    }

    public function routeImage()
    {
        if ('home' === Route::currentRouteName()) {
            $assetUrl = asset('img/bgdown.png');

            return "<img src=\"{$assetUrl}\" alt=\"Dashboard background image\">";
        }

        return '';
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return <<<blade
<div class="panel-header {$this->routeClass()}" {$this->routeId()}>
{$this->routeImage()}
</div>
blade;
    }
}
