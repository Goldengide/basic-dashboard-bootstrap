<?php

$menuItems = [
    [
        'label' => 'Dashboard',
        'route' => route('dashboard'),
        'icon' => '<svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">...</svg>',
        // 'permission' => 'view-dashboard', // Permission required to view the dashboard
    ],
    [
        'label' => 'Users',
        'icon' => '<svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">...</svg>',
        'permission' => 'user-view',
        'subMenu' => [
            [
                'label' => 'User List',
                'route' => route('users.index'),
                'icon' => '<svg width="10" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">...</svg>',
                'permission' => 'user-view', // Permission required to view the user list
            ],
            [
                'label' => 'Roles and Perms',
                'route' => route('role.permission.list'),
                'icon' => '<svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">...</svg>',
                'permission' => 'permission-role-view', // Permission required to view roles and permissions
            ],
        ],
    ],
    [
        'label' => 'Blog',
        'icon' => '<svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">...</svg>',
        'permission' => 'post-view',
        'subMenu' => [
            [
                'label' => 'Posts',
                'route' => route('posts.index'),
                'icon' => '<svg width="10" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">...</svg>',
                'permission' => 'post-view', // Permission required to view the user list
            ],
            [
                'label' => 'Categories',
                'route' => route('blog.categories'),
                'icon' => '<svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">...</svg>',
                'permission' => 'post-view', // Permission required to view roles and permissions
            ],
        ],
    ],
    [
        'label' => 'Components',
        'route' => route('uisheet'),
        'icon' => '<i class="icon"><svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">...</i>',
    ],
    [
        'label' => 'Media',
        'route' => route('media'),
        'icon' => '<i class="icon"><svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">...</i>',
    ],
];

?>

<ul class="navbar-nav iq-main-menu" id="sidebar">
    @foreach ($menuItems as $item)
        @php
            $hasPermission = isset($item['permission'])
                ? auth()
                    ->user()
                    ->hasPermissionTo($item['permission'])
                : true;
        @endphp
        @if ($hasPermission)
            <li class="nav-item">
                @if (isset($item['route']))
                    <a class="nav-link {{ activeRoute($item['route']) }}" aria-current="page" href="{{ $item['route'] }}">
                    @else
                        <a class="nav-link" data-bs-toggle="collapse" href="#{{ Str::slug($item['label']) }}" role="button"
                            aria-expanded="false" aria-controls="{{ Str::slug($item['label']) }}">
                @endif
                {!! $item['icon'] !!}
                <span class="item-name">{{ $item['label'] }}</span>
                @if (isset($item['subMenu']))
                    <i class="right-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">...</svg>
                    </i>
                @endif
                </a>
                @if (isset($item['subMenu']))
                    <ul class="sub-nav collapse" id="{{ Str::slug($item['label']) }}" data-bs-parent="#sidebar">
                        @foreach ($item['subMenu'] as $subItem)
                            @if (isset($subItem['permission']) &&
                                    auth()->user()->hasPermissionTo($subItem['permission']))
                                <li class="nav-item">
                                    <a class="nav-link {{ activeRoute($subItem['route']) }}"
                                        href="{{ $subItem['route'] }}">
                                        {!! $subItem['icon'] !!}
                                        <i class="sidenav-mini-icon"> U </i>
                                        <span class="item-name">{{ $subItem['label'] }}</span>
                                    </a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                @endif
            </li>
        @endif
    @endforeach
</ul>
