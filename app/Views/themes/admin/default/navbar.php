<!-- ─────────────────────────────────────────────
       TOPBAR
  ────────────────────────────────────────────── -->
<header id="topbar">
    <div class="topbar-left">

        <!-- Hamburger desktop (colapsar) -->
        <button class="btn-hamburger d-none d-lg-flex" id="btn-sidebar-collapse" title="Colapsar menú">
            <i class="bi bi-layout-sidebar"></i>
        </button>

        <!-- Hamburger mobile (mostrar) -->
        <button class="btn-hamburger d-flex d-lg-none" id="btn-sidebar-mobile" title="Menú">
            <i class="bi bi-list"></i>
        </button>

        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="topbar-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
            </ol>
        </nav>

    </div>

    <div class="topbar-right">

        <!-- Dark mode toggle -->
        <button class="btn-dark-mode" id="btn-dark-mode" title="Cambiar tema">
            <i class="bi bi-moon-stars" id="dark-mode-icon"></i>
        </button>

        <!-- Notifications -->
        <button class="btn-icon" title="Notificaciones">
            <i class="bi bi-bell"></i>
            <span class="notification-dot"></span>
        </button>

        <div class="topbar-divider d-none d-sm-block"></div>

        <!-- User dropdown -->
        <div class="dropdown">
            <a href="#" class="topbar-user dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                <div class="user-avatar">JD</div>
                <div class="user-info d-none d-md-flex">
                    <span class="user-name">Juan Díaz</span>
                    <span class="user-role">Administrador</span>
                </div>
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
                <li>
                    <h6 class="dropdown-header">Mi cuenta</h6>
                </li>
                <li><a class="dropdown-item" href="#"><i class="bi bi-person me-2"></i>Perfil</a></li>
                <li><a class="dropdown-item" href="#"><i class="bi bi-shield-check me-2"></i>Seguridad</a></li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li>
                    <a class="dropdown-item text-danger" href="#">
                        <i class="bi bi-box-arrow-right me-2"></i>Cerrar sesión
                    </a>
                </li>
            </ul>
        </div>

    </div>
</header>