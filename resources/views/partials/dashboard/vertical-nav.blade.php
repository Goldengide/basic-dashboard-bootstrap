<?php

$menuItems = [
    [
        'label' => 'Dashboard',
        'route' => route('dashboard'),
        'icon' => 'fi fi-rr-dashboard',
        // 'permission' => 'view-dashboard', // Permission required to view the dashboard
    ],
    [
        'label' => 'Users',
        'icon' => 'fi fi-rr-users',
        'permission' => 'user-view',
        'subMenu' => [
            [
                'label' => 'User List',
                'route' => route('users.index'),
                'icon' => 'fi fi-rr-user',
                'permission' => 'user-view', // Permission required to view the user list
            ],
            [
                'label' => 'Roles and Perms',
                'route' => route('role.permission.list'),
                'icon' => 'fi fi-rr-key',
                'permission' => 'permission-role-view', // Permission required to view roles and permissions
            ],
        ],
    ],
    [
        'label' => 'Blog',
        'icon' => 'fi fi-rr-blog-text',
        'permission' => 'post-view',
        'subMenu' => [
            [
                'label' => 'Posts',
                'route' => route('posts.index'),
                'icon' => '',
                'permission' => 'post-view', // Permission required to view the user list
            ],
            [
                'label' => 'Categories',
                'route' => route('blog.categories'),
                'icon' => '',
                'permission' => 'post-view', // Permission required to view roles and permissions
            ],
        ],
    ],
    [
        'label' => 'Components',
        'route' => route('uisheet'),
        'icon' => 'fi fi-rr-template-alt',
    ],
    [
        'label' => 'Media',
        'route' => route('media'),
        'icon' => 'fi fi-rr-picture',
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
                <i class="{{ $item['icon'] }} mr-2"></i>
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
                                        <i class="{{ $subItem['icon'] }} mr-2"></i>
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
