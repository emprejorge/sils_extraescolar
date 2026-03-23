<!-- ═══════════════════════════════════════════════
     SIDEBAR
════════════════════════════════════════════════ -->
<aside id="sidebar">

    <!-- Brand -->
    <a href="#" class="sidebar-brand">
        <span class="sidebar-brand-icon">Mi</span>
        <span class="sidebar-brand-name">Mimetic</span>
    </a>

    <!-- Nav -->
    <nav class="sidebar-nav text-white">

        <span class="sidebar-section-label">Principal</span>

        <a href="<?= base_url('admin'); ?>" class="nav-item-link <?= (url_is('admin')) ? 'active' : ''; ?>">
            <i class="bi bi-grid-1x2 nav-icon"></i>
            <span class="nav-label">Dashboard</span>
        </a>

        <a href="<?= base_url('admin/usuarios'); ?>" class="nav-item-link <?= (url_is('admin/usuarios*')) ? 'active' : ''; ?>">
            <i class="bi bi-people nav-icon"></i>
            <span class="nav-label">Usuarios</span>
        </a>

        <span class="sidebar-section-label">Sistema</span>

        <!-- ── Configuración (dropdown) ── -->
        <?php
        $config_active = url_is('admin/configuracion*') || url_is('admin/tema*') || url_is('admin/permisos*');
        ?>
        <div class="nav-group <?= $config_active ? 'open' : '' ?>">
            <button class="nav-item-link nav-group-toggle w-100 <?= $config_active ? 'active' : '' ?>">
                <i class="bi bi-gear nav-icon"></i>
                <span class="nav-label">Configuración</span>
                <i class="bi bi-chevron-down nav-chevron ms-auto"></i>
            </button>
            <div class="nav-group-body">
                <a href="<?= base_url('admin/configuracion/general') ?>"
                    class="nav-item-link nav-item-child <?= url_is('admin/configuracion/general*') ? 'active' : '' ?>">
                    <i class="bi bi-sliders nav-icon"></i>
                    <span class="nav-label">General</span>
                </a>

                <a href="<?= base_url('admin/permisos') ?>"
                    class="nav-item-link nav-item-child <?= url_is('admin/permisos*') ? 'active' : '' ?>">
                    <i class="bi bi-shield-check nav-icon"></i>
                    <span class="nav-label">Permisos</span>
                </a>

                <a href="<?= base_url('admin/config/tema') ?>"
                    class="nav-item-link nav-item-child <?= url_is('admin/tema*') ? 'active' : '' ?>">
                    <i class="bi bi-palette nav-icon"></i>
                    <span class="nav-label">Editor de tema</span>
                </a>
            </div>
        </div>

    </nav>

    <!-- Sidebar footer -->
    <div class="sidebar-footer">
        <span class="version-tag">v1.0.0 &mdash; Mimetic</span>
    </div>

</aside>

<!-- Overlay mobile -->
<div id="sidebar-overlay"></div>