<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use Auth, Request;

class CommonComposer
{
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('xxxxx', 'This is xxxx');
    }
}
