<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use Auth, Request;

class MainmenuComposer
{
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('main_menu', $this->menuAdmin()->render());
    }

    public function menuAdmin()
    {
        $menus = array(
            'categories' => array(
                'title'      => 'Categories',
                'icon_class' => 'fa fa-dashboard',
                'childs'     => array(
                    'category' => array(
                        'route' => 'admin_category_main',
                        'name'  => 'Category',
                    )
                ),
            ),
            'manage' => array(
                'title'      => 'Manage',
                'icon_class' => 'fa fa-dashboard',
                'childs'     => array(
                    'dashboard' => array(
                        'route' => 'admin_dashboard',
                        'name'  => 'Dashboard',
                    ),
                    'user' => array(
                        'route' => 'admin_user',
                        'name'  => 'Users',
                    ),
                ),
            ),
            'setting' => array(
                'title'      => 'Settings',
                'icon_class' => 'fa fa-dashboard',
                'childs'     => array(
                    'dashboard' => array(
                        'route' => 'admin_setting_general',
                        'name'  => 'General',
                    ),
                    'setting_social' => array(
                        'route' => 'admin_setting_socical',
                        'name'  => 'Config'
                    ),
                ),
            ),
        );
        $menus = $this->checkActiveMenu($menus);

        return view('admin.menu', ['menus' => $menus]);
    }

    public function checkActiveMenu(&$menus)
    {
        foreach ($menus as $key => $items) {
            $menus[$key]['active'] = false;
            if(isset($items['childs'])) {
                foreach ($items['childs'] as $subKey => $value) {
                    $menus[$key]['childs'][$subKey]['active'] = false;
                    if (strpos(Request::fullUrl(), route($value['route'])) !== false) {
                        $menus[$key]['active'] = true;
                        $menus[$key]['childs'][$subKey]['active'] = true;
                    }
                }
            }
        }

        return $menus;
    }
}
