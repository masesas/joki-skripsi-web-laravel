<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Support\Facades\Request;

class GenerateMenus {
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        \Menu::make('admin_sidebar', function ($menu) {
            // Dashboard
            $menu->add('<i class="nav-icon fa-solid fa-house"></i> ' . __('Beranda'), [
                'route' => 'backend.dashboard',
                'class' => 'nav-item',
            ])
                ->data([
                    'order'         => 1,
                    'activematches' => 'admin',
                ])
                ->link->attr([
                    'class' => 'nav-link',
                ]);

            // Menu Dropdown
            $menuList = $menu->add('<i class="nav-icon cil-list-rich"></i> Menu', [
                'class' => 'nav-group',
            ])
            ->data([
                'order'         => 107,
                'activematches' => [
                    'log-viewer*',
                ],
            ]);
            $menuList->link->attr([
                'class' => 'nav-link nav-group-toggle',
                'href'  => '#',
            ]);

            // Submenu: Menu
            $menuList->add('<i class="nav-icon cil-list"></i> Alat', [
                //'route' => '',
                'class' => 'nav-item',
            ])
            ->data([
                'order'         => 108,
                'activematches' => 'admin/alat*',
                'permission'    => ['view_alat_labs'],
            ])
            ->link->attr([
                'class' => 'nav-link',
            ]);

            // Submenu: Menu
            $menuList->add('<i class="nav-icon cil-list-numbered"></i> Bahan', [
               // 'route' => '',
                'class' => 'nav-item',
            ])
            ->data([
                'order'         => 109,
                'activematches' => 'admin/bahan*',
                'permission'    => ['view_bahan_labs'],
            ])
            ->link->attr([
                'class' => 'nav-link',
            ]);

            // Submenu: Menu
            $menuList->add('<i class="nav-icon cil-list-numbered"></i> Alat Pecah', [
                // 'route' => '',
                'class' => 'nav-item',
            ])
            ->data([
                'order'         => 109,
                'activematches' => 'admin/alat-pecah*',
            ])
            ->link->attr([
                'class' => 'nav-link',
            ]);

            // Submenu: Menu
            $menuList->add('<i class="nav-icon cil-list-numbered"></i> Peminjam Alat', [
                // 'route' => '',
                'class' => 'nav-item',
            ])
            ->data([
                'order'         => 109,
                'activematches' => 'admin/peminjam-alat*',
            ])
            ->link->attr([
                'class' => 'nav-link',
            ]);

            // Submenu: Menu
            $menuList->add('<i class="nav-icon cil-list-numbered"></i> Pengembalian Alat', [
                // 'route' => '',
                'class' => 'nav-item',
            ])
            ->data([
                'order'         => 109,
                'activematches' => 'admin/pengembalian-alat*',
            ])
            ->link->attr([
                'class' => 'nav-link',
            ]);

            // Submenu: Menu
            $menuList->add('<i class="nav-icon cil-list-numbered"></i> Jadwal Praktikum', [
                // 'route' => '',
                'class' => 'nav-item',
            ])
            ->data([
                'order'         => 109,
                'activematches' => 'admin/jadwal-praktikum*',
            ])
            ->link->attr([
                'class' => 'nav-link',
            ]);

            // Teams
            $menu->add('<i class="nav-icon fa-sharp fa-solid fa-users"></i> Teams', [
                'route' => 'backend.users.index',
                'class' => 'nav-item',
            ])
                ->data([
                    'order'         => 110,
                    'activematches' => 'admin/users*',
                    'permission'    => ['view_users'],
                ])
                ->link->attr([
                    'class' => 'nav-link',
                ]);

            // Keluar
            $menu->add('<i class="nav-icon fa-solid fa-right-from-bracket"></i> Keluar', [
                'route' => 'logout',
                'class' => 'nav-item',
            ])
            ->data([
                'order'         => 110,
            ])
            ->link->attr([
                'class' => 'nav-link',
            ]);

            // Access Permission Check
            $menu->filter(function ($item) {
                if ($item->data('permission')) {
                    if (auth()->check()) {
                        if (Auth::user()->hasRole('admin')) {
                            return true;
                        } elseif (Auth::user()->hasAnyPermission($item->data('permission'))) {
                            return true;
                        }
                    }

                    return false;
                } else {
                    return true;
                }
            });

            // Set Active Menu
            $menu->filter(function ($item) {
                if ($item->activematches) {
                    $activematches = (is_string($item->activematches)) ? [$item->activematches] : $item->activematches;
                    foreach ($activematches as $pattern) {
                        if (request()->is($pattern)) {
                            $item->active();
                            $item->link->active();
                            if ($item->hasParent()) {
                                $item->parent()->active();
                            }
                        }
                    }
                }

                return true;
            });
        })->sortBy('order');

        view()->share('global_all_categories', 'abc');

        return $next($request);
    }
}
