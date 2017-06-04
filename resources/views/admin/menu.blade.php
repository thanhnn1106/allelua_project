<!-- sidebar menu: : style can be found in sidebar.less -->
<ul class="sidebar-menu">
    <li class="header">MAIN NAVIGATION</li>
    @foreach($menus as $menu)
    <li class="@if($menu['active'] === true) active @endif treeview">
        <a href="javascript:void(0);">
            <i class="{{ $menu['icon_class'] }}"></i> <span>{{ $menu['title'] }}</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        @if(isset($menu['childs']))
        <ul class="treeview-menu">
            @foreach($menu['childs'] as $sub)
            <li class="@if($sub['active'] === true) active @endif"><a href="{{ route($sub['route']) }}"><i class="fa fa-circle-o"></i>{{ $sub['name'] }}</a></li>
            @endforeach
        </ul>
        @endif
    </li>
    @endforeach
</ul>