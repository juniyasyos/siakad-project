<?php

namespace App\Providers\Filament;

use Filament\Pages;
use Filament\Panel;
use Filament\Widgets;
use Filament\PanelProvider;
use Filament\Pages\Dashboard;
use Filament\Pages\Auth\Login;
use Filament\Support\Colors\Color;
use Filament\Navigation\NavigationItem;
use Filament\Http\Middleware\Authenticate;
use Jeffgreco13\FilamentBreezy\BreezyCore;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login(Login::class)
            ->sidebarCollapsibleOnDesktop()
            // ->authGuard('admin')
            ->plugins([
                BreezyCore::make()
            ])
            ->colors([
                'primary' => Color::Violet,
                'Gray' => Color::Slate,
                'danger' => Color::Rose,
                'gray' => Color::Gray,
                'info' => Color::Blue,
                'success' => Color::Emerald,
                'warning' => Color::Orange,
            ])
            ->discoverClusters(in: app_path('Filament/Clusters'), for: 'App\\Filament\\Clusters')
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->unsavedChangesAlerts()
            ->brandLogoHeight('1.25rem')
            ->navigationGroups([
                'Akademik & Informasi',
                'Manajemen',
            ])
            ->databaseNotifications()
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ])
            ->NavigationItems([
                NavigationItem::make('Dashboard')
                    ->label('Dashboard')
                    ->icon('heroicon-o-home')
                    ->url(fn(): string => Dashboard::getUrl())
                    ->isActiveWhen(fn() => request()->routeIs('filament.admin.pages.dashboard')),

                NavigationItem::make('Pengumuman')
                    ->label('Pengumuman')
                    ->icon('heroicon-o-megaphone')
                    ->group('Akademik & Informasi')
                    ->sort(1),

                NavigationItem::make('Acara')
                    ->label('Acara')
                    ->icon('heroicon-o-calendar')
                    ->group('Akademik & Informasi')
                    ->sort(2),

                NavigationItem::make('Kelas')
                    ->label('Kelas')
                    ->icon('heroicon-o-academic-cap')
                    ->group('Akademik & Informasi')
                    ->sort(3),

                NavigationItem::make('Mata Pelajaran')
                    ->label('Mata Pelajaran')
                    ->group('Akademik & Informasi')
                    ->icon('heroicon-o-book-open')
                    ->sort(4),

                NavigationItem::make('Ekstrakurikuler')
                    ->label('Ekstrakurikuler')
                    ->icon('heroicon-o-user-group')
                    ->group('Akademik & Informasi')
                    ->sort(5),

                NavigationItem::make('Lampiran')
                    ->label('Lampiran')
                    ->icon('heroicon-o-paper-clip')
                    ->group('Akademik & Informasi')
                    ->sort(7),

                NavigationItem::make('Pengguna')
                    ->label('Pengguna')
                    ->group('Manajemen')
                    ->icon('heroicon-o-users')
                    ->sort(8),

                NavigationItem::make('Roles & Permissions')
                    ->label('Roles & Permissions')
                    ->icon('heroicon-o-shield-check')
                    ->group('Manajemen')
                    ->sort(9),

                NavigationItem::make('Umpan Balik')
                    ->label('Umpan Balik')
                    ->group('Manajemen')
                    ->icon('heroicon-m-chat-bubble-oval-left-ellipsis')
                    ->sort(10),
            ]);
    }
}
