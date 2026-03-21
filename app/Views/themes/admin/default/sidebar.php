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
            <!-- <span class="nav-badge">12</span> -->
        </a>

        <span class="sidebar-section-label">Sistema</span>

        <a href="#" class="nav-item-link">
            <i class="bi bi-gear nav-icon"></i>
            <span class="nav-label">Configuración</span>
        </a>

    </nav>

    <!-- Sidebar footer -->
    <div class="sidebar-footer">
        <span class="version-tag">v1.0.0 &mdash; Mimetic</span>
    </div>

</aside>

<!-- Overlay mobile -->
<div id="sidebar-overlay"></div>