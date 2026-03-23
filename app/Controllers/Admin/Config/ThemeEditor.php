<?php

namespace App\Controllers\Admin\Config;

use App\Controllers\BaseController;

/**
 * ThemeEditor
 * Controlador para la vista de personalización del tema del dashboard.
 *
 * Ruta sugerida (app/Config/Routes.php):
 *   $routes->get('admin/tema', 'Admin\ThemeEditor::index');
 */
class ThemeEditor extends BaseController
{
    public function index(): string
    {
        // ── TEMA LIGHT ────────────────────────────────────────────────────────
        // Copia estos mismos arrays desde dashboard.php para mantener consistencia.
        // En el futuro, estos valores se leerán desde base de datos.
        $theme_light = [
            '--body-bg'                  => '#f0f2f7',
            '--sidebar-bg'               => '#fafafa',
            '--topbar-bg'                => 'rgba(255,255,255,0.85)',
            '--card-bg'                  => '#fcfcfc',
            '--toast-bg'                 => '#ffffff',
            '--dropdown-bg'              => '#ffffff',
            '--input-bg'                 => '#f4f5f7',
            '--border-color'             => '#e8eaed',
            '--text-brand'               => '#3b3b3b',
            '--text-primary'             => '#424242',
            '--text-heading'             => '#585858',
            '--text-muted'               => '#8b90a7',
            '--sidebar-text'             => '#cacaca',
            '--sidebar-link'             => '#3b3b3b',
            '--sidebar-link-hover'       => '#2d3142',
            '--sidebar-link-hover-bg'    => '#f4f5f7',
            '--sidebar-link-active-text' => '#f6f6f6',
            '--sidebar-link-active-bg'   => '#223654',
            '--btn-ghost-hover'          => '#f0f1f5',
            '--table-row-hover'          => '#f8f9fb',
            '--table-stripe-bg'          => '#fafbfc',
            '--progress-bg'              => '#eceef2',
        ];

        // ── TEMA DARK ─────────────────────────────────────────────────────────
        $theme_dark = [
            '--body-bg'                  => '#0f1117',
            '--sidebar-bg'               => '#161820',
            '--topbar-bg'                => 'rgba(22,24,32,0.88)',
            '--card-bg'                  => '#1c1e28',
            '--toast-bg'                 => '#1c1e28',
            '--dropdown-bg'              => '#1c1e28',
            '--input-bg'                 => '#12141b',
            '--border-color'             => '#2a2d3a',
            '--text-primary'             => '#c8cadb',
            '--text-heading'             => '#e8eaf0',
            '--text-muted'               => '#5c6070',
            '--sidebar-text'             => '#6b7080',
            '--sidebar-link'             => '#7a7f96',
            '--sidebar-link-hover'       => '#e8eaf0',
            '--sidebar-link-hover-bg'    => '#22253000',
            '--sidebar-link-active-bg'   => 'rgba(99,102,241,0.12)',
            '--btn-ghost-hover'          => '#222535',
            '--table-row-hover'          => '#20222e',
            '--table-stripe-bg'          => '#191b24',
            '--progress-bg'              => '#2a2d3a',
        ];

        // ── COLORES DE ACENTO ─────────────────────────────────────────────────
        $theme_accent = [
            '--accent'         => '#0590a2',
            '--accent-hover'   => '#4f52d6',
            '--color-success'  => '#22c55e',
            '--color-danger'   => '#ef4444',
            '--color-warning'  => '#f59e0b',
            '--color-info'     => '#3b82f6',
        ];

        return view('themes/admin/default/theme_editor', [
            'layout'       => 'themes/admin/default/layout',
            'title'        => 'Editor de tema — Mimetic',
            'theme_light'  => $theme_light,
            'theme_dark'   => $theme_dark,
            'theme_accent' => $theme_accent,
        ]);
    }
}
