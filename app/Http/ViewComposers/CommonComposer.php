<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Languages;
use App\Statics;

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
        $staticPageMenu = Statics::getPageInfoListByLang(\App::getLocale());
        $arrStaticPage = array();
        foreach ($staticPageMenu as $item) {
            $arrStaticPage[$item->type] = array(
               'title' => $item->title,
               'slug' => $item->slug,
            );
        }

        $view->with([
            'languages' => $langs,
            'staticPage' => $arrStaticPage
        ]);
    }
}
