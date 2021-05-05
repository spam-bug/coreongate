<?php

namespace App\View\Components;

use App\Models\Ads;
use Illuminate\View\Component;

class GuestLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     *
     * @return \Illuminate\View\View
     */

    public function render()
    {
        $ads = Ads::all();

        return view('layouts.guest', compact('ads'));
    }
}
