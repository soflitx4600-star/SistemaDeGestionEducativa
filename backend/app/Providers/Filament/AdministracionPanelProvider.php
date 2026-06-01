<?php

namespace App\Providers\Filament;

use App\Filament\Widgets\ConsultasPendientes;
use App\Filament\Widgets\ProximosEventos;
use App\Filament\Widgets\StatsOverview;
use App\Filament\Widgets\UltimasNoticias;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Caresome\FilamentAuthDesigner\AuthDesignerPlugin;
use Caresome\FilamentAuthDesigner\Data\AuthPageConfig;
use Caresome\FilamentAuthDesigner\Enums\MediaPosition;

class AdministracionPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('administracion')
            ->path('administracion')
            ->login()
            ->colors([
                'primary' => Color::hex('#4A7FA5'),
                'gray'    => Color::Slate,
            ])
            ->brandLogo(asset('logo.png'))
            ->brandLogoHeight('3.5rem')
            ->favicon(asset('logo.png'))
            ->sidebarCollapsibleOnDesktop()
            ->sidebarWidth('16rem')
            ->collapsedSidebarWidth('4rem')
            ->renderHook('panels::head.end', fn () => new \Illuminate\Support\HtmlString('
<style>
/* ── MODO CLARO ── */
.fi-body,.fi-main-ctn{background:#EEF2F7!important}
.fi-topbar{background:#fff!important;border-bottom:1px solid #D6E4F0!important;box-shadow:0 2px 12px rgba(74,127,165,.08)!important}
.fi-logo img{background:#fff;border:2px solid #D6E4F0;border-radius:12px;padding:6px;box-shadow:0 2px 8px rgba(74,127,165,.12)}
.fi-sidebar,.fi-sidebar-nav{background:#fff!important;border-right:1px solid #D6E4F0!important}
.fi-nav-item a{border-radius:10px!important;transition:background .2s}
.fi-nav-item a:hover{background:#EEF2F7!important}
.fi-nav-item a[aria-current]{background:linear-gradient(135deg,#4A7FA5,#6BA3C7)!important;color:#fff!important;box-shadow:0 4px 12px rgba(74,127,165,.3)!important}
.fi-wi-stats-overview-stat{background:#fff!important;border:1px solid #D6E4F0!important;border-radius:16px!important;box-shadow:0 2px 12px rgba(74,127,165,.07)!important}
.fi-ta-ctn{background:#fff!important;border-radius:16px!important;border:1px solid #D6E4F0!important;box-shadow:0 2px 12px rgba(74,127,165,.07)!important;overflow:hidden}
.fi-ta-header-ctn{background:#F4F8FB!important;border-bottom:1px solid #D6E4F0!important}
.fi-btn-primary{background:linear-gradient(135deg,#4A7FA5,#6BA3C7)!important;border:none!important;border-radius:10px!important}
.fi-badge{border-radius:8px!important}
.fi-page-header-heading{color:#1A3A5C!important;font-weight:700!important}
.fi-input{border-radius:10px!important;border-color:#D6E4F0!important}
.fi-section{background:#fff!important;border:1px solid #D6E4F0!important;border-radius:16px!important;box-shadow:0 2px 12px rgba(74,127,165,.07)!important}
/* ── MODO OSCURO ── */
.dark .fi-body,.dark .fi-main-ctn{background:#0F172A!important}
.dark .fi-topbar{background:#1E293B!important;border-bottom:1px solid #334155!important;box-shadow:0 2px 12px rgba(0,0,0,.3)!important}
.dark .fi-logo img{background:#1E293B;border:2px solid #334155;border-radius:12px;padding:6px}
.dark .fi-sidebar,.dark .fi-sidebar-nav{background:#1E293B!important;border-right:1px solid #334155!important}
.dark .fi-nav-item a{color:#94A3B8!important}
.dark .fi-nav-item a:hover{background:#334155!important;color:#E2E8F0!important}
.dark .fi-nav-item a[aria-current]{background:linear-gradient(135deg,#4A7FA5,#6BA3C7)!important;color:#fff!important}
.dark .fi-wi-stats-overview-stat{background:#1E293B!important;border:1px solid #334155!important;border-radius:16px!important}
.dark .fi-wi-stats-overview-stat-value,.dark .fi-wi-stats-overview-stat-label,.dark .fi-wi-stats-overview-stat-description{color:#E2E8F0!important}
.dark .fi-ta-ctn{background:#1E293B!important;border:1px solid #334155!important;border-radius:16px!important}
.dark .fi-ta-header-ctn{background:#162032!important;border-bottom:1px solid #334155!important}
.dark .fi-ta-row{border-bottom:1px solid #334155!important}
.dark .fi-ta-cell{color:#CBD5E1!important}
.dark .fi-ta-header-cell{color:#94A3B8!important}
.dark .fi-section{background:#1E293B!important;border:1px solid #334155!important;border-radius:16px!important}
.dark .fi-section-header-heading,.dark .fi-page-header-heading{color:#E2E8F0!important}
.dark .fi-input{background:#0F172A!important;border-color:#334155!important;color:#E2E8F0!important}
.dark .fi-select-input{background:#0F172A!important;border-color:#334155!important;color:#E2E8F0!important}
.dark .fi-dropdown-panel{background:#1E293B!important;border:1px solid #334155!important}
.dark .fi-dropdown-list-item{color:#CBD5E1!important}
.dark .fi-dropdown-list-item:hover{background:#334155!important}
</style>
            '))
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\Filament\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\Filament\Pages')
            ->pages([
                Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\Filament\Widgets')
            ->widgets([
                StatsOverview::class,
                UltimasNoticias::class,
                ProximosEventos::class,
                ConsultasPendientes::class,
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
            ->plugins([
                AuthDesignerPlugin::make()
                    ->login(
                        fn(AuthPageConfig $config) => $config
                            ->media(asset('foto-fondo-olga-aredez.png'))
                            ->mediaPosition(MediaPosition::Left)
                            ->mediaSize('50%')
                    ),
            ]);
    }
}
