<?php

namespace App\Http\Middleware;

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
                    'activematches' => 'admin/dashboard*',
                ])
                ->link->attr([
                    'class' => 'nav-link',
                ]);

            // Log Viewer
            // Log Viewer Dropdown
            $accessControl = $menu->add('<i class="nav-icon cil-list-rich"></i> Menu', [
                'class' => 'nav-group',
            ])
            ->data([
                'order'         => 107,
                'activematches' => [
                    'log-viewer*',
                ],
                'permission'    => ['view_logs'],
            ]);
            $accessControl->link->attr([
                'class' => 'nav-link nav-group-toggle',
                'href'  => '#',
            ]);

            // Submenu: Log Viewer Dashboard
            $accessControl->add('<i class="nav-icon cil-list"></i> Daftar Alat', [
                'route' => 'log-viewer::dashboard',
                'class' => 'nav-item',
            ])
            ->data([
                'order'         => 108,
                'activematches' => 'admin/log-viewer',
            ])
            ->link->attr([
                'class' => 'nav-link',
            ]);

            // Submenu: Log Viewer Logs by Days
            $accessControl->add('<i class="nav-icon cil-list-numbered"></i> Daftar Bahan', [
                'route' => 'log-viewer::logs.list',
                'class' => 'nav-item',
            ])
            ->data([
                'order'         => 109,
                'activematches' => 'admin/log-viewer/logs*',
            ])
            ->link->attr([
                'class' => 'nav-link',
            ]);

            // Teams
            $menu->add('<i class="nav-icon fa-sharp fa-solid fa-users"></i> Teams', [
                'route' => 'backend.settings',
                'class' => 'nav-item',
            ])
                ->data([
                    'order'         => 110,
                    'activematches' => 'admin/settings*',
                    'permission'    => ['edit_settings'],
                ])
                ->link->attr([
                    'class' => 'nav-link',
                ]);

            // Keluar
            $menu->add('<i class="nav-icon fa-solid fa-right-from-bracket"></i> Keluar', [
                'route' => 'backend.settings',
                'class' => 'nav-item',
            ])
            ->data([
                'order'         => 110,
                'activematches' => 'admin/settings*',
                'permission'    => ['edit_settings'],
            ])
            ->link->attr([
                'class' => 'nav-link',
            ]);

            // Access Permission Check
            $menu->filter(function ($item) {
                if ($item->data('permission')) {
                    if (auth()->check()) {
                        if (auth()->user()->hasRole('super admin')) {
                            return true;
                        } elseif (auth()->user()->hasAnyPermission($item->data('permission'))) {
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

        return $next($request);
    }
}
