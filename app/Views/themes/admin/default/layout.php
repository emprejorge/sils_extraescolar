<?php

/**
 * MIMETIC — Admin Dashboard Base Template
 * dashboard.php
 *
 * Variables de color separadas para fácil personalización con selector de plantilla.
 * Los colores se inyectan como CSS custom properties en el <head>.
 */

// ─── TEMA: LIGHT ──────────────────────────────────────────────────────────────
$theme_light = [
    '--body-bg'                => '#f0f2f7',
    '--sidebar-bg'             => '#fafafa',
    '--topbar-bg'              => 'rgba(255,255,255,0.85)',
    '--card-bg'                => '#fcfcfc',
    '--toast-bg'               => '#ffffff',
    '--dropdown-bg'            => '#ffffff',
    '--input-bg'               => '#f4f5f7',
    '--border-color'           => '#e8eaed',
    '--text-brand'           => '#3b3b3b',
    '--text-primary'           => '#424242',
    '--text-heading'           => '#585858',
    '--text-muted'             => '#8b90a7',
    '--sidebar-text'           => '#cacaca',
    '--sidebar-link'           => '#3b3b3b',
    '--sidebar-link-hover'     => '#2d3142',
    '--sidebar-link-hover-bg'  => '#f4f5f7',
    '--sidebar-link-active-text' => '#f6f6f6',
    '--sidebar-link-active-bg' => '#223654',
    '--btn-ghost-hover'        => '#f0f1f5',
    '--table-row-hover'        => '#f8f9fb',
    '--table-stripe-bg'        => '#fafbfc',
    '--progress-bg'            => '#eceef2',
    '--skeleton-base'          => '#e8eaed',
    '--skeleton-shine'         => '#f4f5f7',
    '--card-shadow'            => '0 1px 3px rgba(0,0,0,0.05), 0 4px 16px rgba(0,0,0,0.04)',
    '--card-shadow-hover'      => '0 4px 20px rgba(0,0,0,0.09)',
];

// ─── TEMA: DARK ───────────────────────────────────────────────────────────────
$theme_dark = [
    '--body-bg'                => '#0f1117',
    '--sidebar-bg'             => '#161820',
    '--topbar-bg'              => 'rgba(22,24,32,0.88)',
    '--card-bg'                => '#1c1e28',
    '--toast-bg'               => '#1c1e28',
    '--dropdown-bg'            => '#1c1e28',
    '--input-bg'               => '#12141b',
    '--border-color'           => '#2a2d3a',
    '--text-primary'           => '#c8cadb',
    '--text-heading'           => '#e8eaf0',
    '--text-muted'             => '#5c6070',
    '--sidebar-text'           => '#6b7080',
    '--sidebar-link'           => '#7a7f96',
    '--sidebar-link-hover'     => '#e8eaf0',
    '--sidebar-link-hover-bg'  => '#22253000',
    '--sidebar-link-active-bg' => 'rgba(99,102,241,0.12)',
    '--btn-ghost-hover'        => '#222535',
    '--table-row-hover'        => '#20222e',
    '--table-stripe-bg'        => '#191b24',
    '--progress-bg'            => '#2a2d3a',
    '--skeleton-base'          => '#2a2d3a',
    '--skeleton-shine'         => '#333646',
    '--card-shadow'            => '0 1px 3px rgba(0,0,0,0.3), 0 4px 16px rgba(0,0,0,0.2)',
    '--card-shadow-hover'      => '0 4px 24px rgba(0,0,0,0.35)',
];

// ─── COLORES DE ACENTO (comunes a todos los temas) ────────────────────────────
$theme_accent = [
    '--accent'        => '#0590a2',   // Indigo
    '--accent-hover'  => '#4f52d6',
    '--color-success' => '#22c55e',
    '--color-danger'  => '#ef4444',
    '--color-warning' => '#f59e0b',
    '--color-info'    => '#3b82f6',
];

// ─── DIMENSIONES ──────────────────────────────────────────────────────────────
$layout_vars = [
    '--sidebar-width'           => '248px',
    '--sidebar-collapsed-width' => '68px',
];

// Helper para generar CSS variables
function buildCssVars(array ...$maps): string
{
    $lines = [];
    foreach ($maps as $map) {
        foreach ($map as $prop => $val) {
            $lines[] = "    {$prop}: {$val};";
        }
    }
    return implode("\n", $lines);
}

// Mensaje de notificación desde el controlador (simula retorno CI)
// $ci_flash = ['type' => 'success', 'title' => 'Guardado', 'message' => 'Los cambios fueron guardados correctamente.'];
$ci_flash = null; // null = no hay flash message
?>
<!doctype html>
<html lang="es" data-theme="light">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title ?></title>

    <!-- Bootstrap 5 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css?v=' . filemtime(FCPATH . 'assets/css/style.css')) ?>">

    <!-- ═══════════════════════════════════════════════════════════
       COLOR VARIABLES — Aquí se definen los colores del tema.
       Para crear un selector de plantilla, solo modifica estas
       variables con PHP o con JS sin tocar style.css.
  ════════════════════════════════════════════════════════════ -->
    <style id="theme-vars">
        :root {
            <?= buildCssVars($theme_accent, $layout_vars, $theme_light) ?>
            /* ── Bootstrap bridge ── */
            --bs-primary: var(--accent);
            --bs-link-color: var(--accent);
            --bs-link-hover-color: var(--accent-hover);
            --bs-success: var(--color-success);
            --bs-danger: var(--color-danger);
            --bs-warning: var(--color-warning);
            --bs-info: var(--color-info);
            --bs-body-bg: var(--body-bg);
            --bs-body-color: var(--text-primary);
            --bs-border-color: var(--border-color);
            --bs-secondary-bg: var(--card-bg);
            --bs-tertiary-bg: var(--input-bg);

            /* RGB para que Bootstrap pueda hacer rgba() con opacidad */
            --bs-primary-rgb: <?= implode(',', sscanf($theme_accent['--accent'],      '#%02x%02x%02x')) ?>;
            --bs-success-rgb: <?= implode(',', sscanf($theme_accent['--color-success'], '#%02x%02x%02x')) ?>;
            --bs-danger-rgb: <?= implode(',', sscanf($theme_accent['--color-danger'], '#%02x%02x%02x')) ?>;
            --bs-warning-rgb: <?= implode(',', sscanf($theme_accent['--color-warning'], '#%02x%02x%02x')) ?>;
            --bs-info-rgb: <?= implode(',', sscanf($theme_accent['--color-info'],   '#%02x%02x%02x')) ?>;
        }

        [data-theme="dark"] {
            <?= buildCssVars($theme_dark) ?>
            /* Bridge oscuro */
            --bs-body-bg: var(--body-bg);
            --bs-body-color: var(--text-primary);
            --bs-border-color: var(--border-color);
            --bs-secondary-bg: var(--card-bg);
            --bs-tertiary-bg: var(--input-bg);
        }
    </style>
</head>

<body>


    <?= $this->include('themes/admin/default/sidebar') ?>
    <!-- ═══════════════════════════════════════════════
     MAIN WRAPPER
════════════════════════════════════════════════ -->
    <div id="main-wrapper">

        <?= $this->include('themes/admin/default/navbar') ?>

        <?= $this->renderSection('content') ?>

        <?= view('themes/admin/default/footer'); ?>

    </div><!-- /main-wrapper -->


    <!-- ═══════════════════════════════════════════════
     TOAST CONTAINER
════════════════════════════════════════════════ -->
    <div id="toast-container"></div>


    <!-- ═══════════════════════════════════════════════
     BOOTSTRAP JS
════════════════════════════════════════════════ -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        /* ============================================================
   MIMETIC — Dashboard JS
   (inline para mantener todo en un solo archivo de plantilla)
============================================================ */

        // ── 1. SIDEBAR COLLAPSE (desktop) ────────────────────────────
        const sidebar = document.getElementById('sidebar');
        const mainWrapper = document.getElementById('main-wrapper');
        const btnCollapse = document.getElementById('btn-sidebar-collapse');
        const btnMobile = document.getElementById('btn-sidebar-mobile');
        const sidebarOverlay = document.getElementById('sidebar-overlay');

        const STORAGE_KEY_COLLAPSED = 'mimetic_sidebar_collapsed';
        const STORAGE_KEY_THEME = 'mimetic_theme';

        // Restaurar estado colapsado
        if (localStorage.getItem(STORAGE_KEY_COLLAPSED) === 'true') {
            sidebar.classList.add('collapsed');
            mainWrapper.classList.add('sidebar-collapsed');
        }

        btnCollapse?.addEventListener('click', () => {
            const isCollapsed = sidebar.classList.toggle('collapsed');
            mainWrapper.classList.toggle('sidebar-collapsed', isCollapsed);
            localStorage.setItem(STORAGE_KEY_COLLAPSED, isCollapsed);
        });

        // ── 2. SIDEBAR MOBILE ─────────────────────────────────────────
        btnMobile?.addEventListener('click', () => {
            sidebar.classList.toggle('mobile-open');
            sidebarOverlay.classList.toggle('active');
            document.body.style.overflow = sidebar.classList.contains('mobile-open') ? 'hidden' : '';
        });

        sidebarOverlay.addEventListener('click', closeMobileSidebar);

        function closeMobileSidebar() {
            sidebar.classList.remove('mobile-open');
            sidebarOverlay.classList.remove('active');
            document.body.style.overflow = '';
        }

        // Cerrar sidebar mobile si se redimensiona a desktop
        window.addEventListener('resize', () => {
            if (window.innerWidth >= 992) closeMobileSidebar();
        });

        // ── 3. DARK MODE ──────────────────────────────────────────────
        const htmlEl = document.documentElement;
        const btnDarkMode = document.getElementById('btn-dark-mode');
        const darkModeIcon = document.getElementById('dark-mode-icon');

        function applyTheme(theme) {
            htmlEl.setAttribute('data-theme', theme);
            darkModeIcon.className = theme === 'dark' ? 'bi bi-sun' : 'bi bi-moon-stars';
            localStorage.setItem(STORAGE_KEY_THEME, theme);
        }

        // Restaurar tema
        const savedTheme = localStorage.getItem(STORAGE_KEY_THEME) ||
            (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');
        applyTheme(savedTheme);

        btnDarkMode?.addEventListener('click', () => {
            applyTheme(htmlEl.getAttribute('data-theme') === 'dark' ? 'light' : 'dark');
        });

        // ── 4. TOAST SYSTEM ───────────────────────────────────────────
        /**
         * showToast(type, title, message, duration)
         * type: 'success' | 'error' | 'info' | 'warning'
         * Se llama automáticamente con los datos de CI flash si existen.
         */
        const toastContainer = document.getElementById('toast-container');

        const toastIcons = {
            success: 'bi-check-circle-fill',
            error: 'bi-x-circle-fill',
            info: 'bi-info-circle-fill',
            warning: 'bi-exclamation-triangle-fill',
        };

        const toastTitles = {
            success: 'Operación exitosa',
            error: 'Error',
            info: 'Información',
            warning: 'Advertencia',
        };

        function showToast(type = 'info', title = '', message = '', duration = 5000) {
            const el = document.createElement('div');
            el.className = `app-toast toast-${type}`;
            el.innerHTML = `
    <i class="bi ${toastIcons[type] || toastIcons.info} toast-icon"></i>
    <div class="toast-body">
      <div class="toast-title">${title || toastTitles[type]}</div>
      ${message ? `<div class="toast-message">${message}</div>` : ''}
    </div>
    <button class="toast-close ms-2" aria-label="Cerrar"><i class="bi bi-x-lg"></i></button>
  `;

            toastContainer.appendChild(el);

            // Cerrar manual
            el.querySelector('.toast-close').addEventListener('click', () => dismissToast(el));

            // Auto-dismiss
            const timer = duration > 0 ? setTimeout(() => dismissToast(el), duration) : null;

            el.addEventListener('mouseenter', () => timer && clearTimeout(timer));
            el.addEventListener('mouseleave', () => timer && setTimeout(() => dismissToast(el), 1500));
        }

        function dismissToast(el) {
            if (!el.parentElement) return;
            el.classList.add('hiding');
            el.addEventListener('animationend', () => el.remove(), {
                once: true
            });
        }

        // ── 5. FLASH DESDE CONTROLADOR CI ────────────────────────────
        <?php if ($ci_flash): ?>
            window.addEventListener('DOMContentLoaded', () => {
                showToast(
                    '<?= htmlspecialchars($ci_flash['type']) ?>',
                    '<?= htmlspecialchars($ci_flash['title'] ?? '') ?>',
                    '<?= htmlspecialchars($ci_flash['message'] ?? '') ?>'
                );
            });
        <?php endif; ?>

        // ── 6. Demo toasts (remover en producción) ────────────────────
        /* window.addEventListener('DOMContentLoaded', () => {
            // Simula mensajes de demostración al cargar la página
            setTimeout(() => showToast('success', 'Sesión iniciada', 'Bienvenido de vuelta, Juan.'), 800);
        });
 */
        // Exponer globalmente para uso desde controladores CI
        window.showToast = showToast;

        // ── 7. CHECKBOXES animados ────────────────────────────────────
        document.querySelectorAll('.form-check-input').forEach(cb => {
            cb.addEventListener('change', function() {
                const label = this.nextElementSibling;
                if (this.checked) {
                    label.classList.add('text-decoration-line-through');
                    label.style.color = 'var(--text-muted)';
                } else {
                    label.classList.remove('text-decoration-line-through');
                    label.style.color = 'var(--text-primary)';
                }
            });
        });


        // ── 8. SIDEBAR NAV GROUPS ─────────────────────────────────
        document.querySelectorAll('.nav-group-toggle').forEach(btn => {
            btn.addEventListener('click', () => {
                // Si el sidebar está colapsado, no hacer nada
                if (sidebar.classList.contains('collapsed')) return;

                const group = btn.closest('.nav-group');
                const isOpen = group.classList.toggle('open');

                // Cerrar otros grupos abiertos (acordeón opcional)
                document.querySelectorAll('.nav-group').forEach(g => {
                    if (g !== group) g.classList.remove('open');
                });
            });
        });

        // Reabrir el grupo si tiene un hijo activo al cargar
        document.querySelectorAll('.nav-group').forEach(group => {
            if (group.querySelector('.nav-item-child.active')) {
                group.classList.add('open');
            }
        });
    </script>

</body>

</html>