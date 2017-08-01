<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Languages;

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
        // Load languges
        $langs = Languages::getResults();
        $langs = array_column($langs->toArray(), 'name', 'iso2');

        $view->with('languages', $langs);
        $view->with('cartCount', \Cart::getTotalQuantity());
    }
}
