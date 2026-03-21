<?= $this->extend($layout) ?>

<?= $this->section('breadcrumb') ?>
<!-- Breadcrumb -->
<nav aria-label="breadcrumb" class="topbar-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Inicio</a></li>
        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
    </ol>
</nav>
<?= $this->endsection(); ?>

<?= $this->section('content') ?>

<!-- ─────────────────────────────────────────────
       PAGE CONTENT
  ────────────────────────────────────────────── -->
<main id="page-content">

    <!-- Page header -->
    <div class="d-flex align-items-start justify-content-between mb-4">
        <div>
            <h1 class="page-title">Dashboard</h1>
            <p class="page-subtitle">Bienvenido de vuelta, <?= user()->name ?>. Aquí tienes el resumen de hoy.</p>
        </div>
        <div class="d-flex gap-2">
            <button class="btn btn-outline-secondary btn-sm">
                <i class="bi bi-download me-1"></i>Exportar
            </button>
            <button class="btn btn-primary btn-sm">
                <i class="bi bi-plus-lg me-1"></i>Nuevo
            </button>
        </div>
    </div>

    <!-- ── STAT CARDS ─────────────────────────── -->
    <div class="row g-3 mb-4">

        <div class="col-6 col-xl-3">
            <div class="card stat-card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="stat-icon bg-primary bg-opacity-10 text-primary">
                            <i class="bi bi-people-fill"></i>
                        </div>
                        <div class="sparkline-bar" style="width:60px">
                            <span style="height:40%"></span>
                            <span style="height:60%"></span>
                            <span style="height:45%"></span>
                            <span style="height:80%"></span>
                            <span style="height:65%"></span>
                            <span style="height:90%"></span>
                            <span class="active" style="height:100%"></span>
                        </div>
                    </div>
                    <div class="stat-value"><?= $totalUsuarios; ?></div>
                    <div class="stat-label">Usuarios totales</div>
                    <!-- 
                    <div class="stat-change up">
                        <i class="bi bi-arrow-up-right"></i>+12.4% este mes
                    </div>
                     -->
                    <i class="bi bi-people stat-bg-icon"></i>
                </div>
            </div>
        </div>

        <div class="col-6 col-xl-3">
            <div class="card stat-card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="stat-icon bg-success bg-opacity-10 text-success">
                            <i class="bi bi-graph-up-arrow"></i>
                        </div>
                        <div class="sparkline-bar" style="width:60px">
                            <span style="height:55%"></span>
                            <span style="height:70%"></span>
                            <span style="height:50%"></span>
                            <span style="height:85%"></span>
                            <span style="height:72%"></span>
                            <span style="height:60%"></span>
                            <span class="active" style="height:95%"></span>
                        </div>
                    </div>
                    <div class="stat-value">$48.2K</div>
                    <div class="stat-label">Ingresos del mes</div>
                    <!--                     
                    <div class="stat-change up">
                        <i class="bi bi-arrow-up-right"></i>+8.1% vs anterior
                    </div> -->
                    <i class="bi bi-graph-up stat-bg-icon"></i>
                </div>
            </div>
        </div>

        <div class="col-6 col-xl-3">
            <div class="card stat-card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="stat-icon bg-warning bg-opacity-10 text-warning">
                            <i class="bi bi-hourglass-split"></i>
                        </div>
                        <div class="sparkline-bar" style="width:60px">
                            <span style="height:80%"></span>
                            <span style="height:40%"></span>
                            <span style="height:65%"></span>
                            <span style="height:30%"></span>
                            <span style="height:50%"></span>
                            <span style="height:75%"></span>
                            <span class="active" style="height:55%"></span>
                        </div>
                    </div>
                    <div class="stat-value">142</div>
                    <div class="stat-label">Solicitudes pendientes</div>
                    <!--                     
                    <div class="stat-change down">
                        <i class="bi bi-arrow-down-right"></i>-3.2% esta semana
                    </div> -->
                    <i class="bi bi-hourglass stat-bg-icon"></i>
                </div>
            </div>
        </div>

        <div class="col-6 col-xl-3">
            <div class="card stat-card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="stat-icon bg-info bg-opacity-10 text-info">
                            <i class="bi bi-server"></i>
                        </div>
                        <div class="sparkline-bar" style="width:60px">
                            <span style="height:92%"></span>
                            <span style="height:88%"></span>
                            <span style="height:95%"></span>
                            <span style="height:90%"></span>
                            <span style="height:93%"></span>
                            <span style="height:97%"></span>
                            <span class="active" style="height:99%"></span>
                        </div>
                    </div>
                    <div class="stat-value">99.8%</div>
                    <div class="stat-label">Uptime del sistema</div>
                    <!--                     
                    <div class="stat-change up">
                        <i class="bi bi-arrow-up-right"></i>Estable
                    </div> -->
                    <i class="bi bi-server stat-bg-icon"></i>
                </div>
            </div>
        </div>

    </div><!-- /row stats -->

    <!-- ── ROW 2: Tabla + Quick Actions ──────── -->
    <div class="row g-3 mb-4">

        <!-- Tabla de usuarios recientes -->
        <div class="col-lg-8">
            <div class="card h-100">
                <div class="card-header">
                    <span><i class="bi bi-person-lines-fill me-2 text-accent"></i>Usuarios recientes</span>
                    <a href="#" class="btn btn-sm btn-outline-secondary">Ver todos</a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>Usuario</th>
                                    <th class="d-none d-md-table-cell">Rol</th>
                                    <th class="d-none d-sm-table-cell">Registro</th>
                                    <th>Estado</th>
                                    <th class="text-end">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $users = $usuarios;
                                foreach ($users as $u): ?>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center gap-2">
                                                <img src="<?= base_url($u['avatar']) ?>"
                                                    alt="<?= esc($u['nombre_completo']) ?>"
                                                    class="user-avatar"
                                                    style="width:34px;height:34px;border-radius:50%;object-fit:cover;font-size:0.72rem"
                                                    onerror="this.outerHTML='<div class=\'user-avatar\' style=\'width:34px;height:34px;font-size:0.72rem;border-radius:50%\'><?= strtoupper(substr($u['first_name'], 0, 1) . substr($u['last_name'] ?? '', 0, 1)) ?></div>'">
                                                <div>
                                                    <div class="fw-semibold" style="font-size:.85rem;color:var(--text-heading)"><?= $u['nombre_completo'] ?></div>
                                                    <div class="d-none d-sm-block" style="font-size:.75rem;color:var(--text-muted)"><?= $u['email'] ?></div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="d-none d-md-table-cell">
                                            <span class="badge bg-secondary bg-opacity-10 text-secondary"><?= $roles[$u['roles']] ?></span>
                                        </td>
                                        <td class="d-none d-sm-table-cell" style="color:var(--text-muted);font-size:.82rem"><?= $u['created_at'] ?></td>
                                        <td>
                                            <?php if ($u['active'] === '1'): ?>
                                                <span class="badge-dot text-success">Activo</span>
                                            <?php elseif ($u['status'] === 'inactive'): ?>
                                                <span class="badge-dot text-danger">Inactivo</span>
                                            <?php else: ?>
                                                <span class="badge-dot text-warning">Pendiente</span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-end">
                                            <div class="dropdown">
                                                <button class="btn btn-sm btn-outline-secondary border-0" data-bs-toggle="dropdown">
                                                    <i class="bi bi-three-dots"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li><a class="dropdown-item" href="<?= base_url('admin/usuarios/ver/' . $u['id']); ?>"><i class="bi bi-pencil me-2"></i>Editar</a></li>
                                                    <li><a class="dropdown-item text-danger" href="#"><i class="bi bi-trash me-2"></i>Eliminar</a></li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div><!-- /col tabla -->

        <!-- Quick actions & actividad -->
        <div class="col-lg-4 d-flex flex-column gap-3">

            <!-- Actividad reciente -->
            <div class="card flex-fill">
                <div class="card-header">
                    <span><i class="bi bi-activity me-2 text-accent"></i>Actividad reciente</span>
                </div>
                <div class="card-body">
                    <?php
                    $activities = [
                        ['icon' => 'bi-person-plus', 'color' => 'text-primary', 'bg' => 'bg-primary', 'title' => 'Nuevo usuario registrado', 'sub' => 'Hace 5 min'],
                        ['icon' => 'bi-shield-exclamation', 'color' => 'text-warning', 'bg' => 'bg-warning', 'title' => 'Intento de acceso fallido', 'sub' => 'Hace 18 min'],
                        ['icon' => 'bi-check-circle', 'color' => 'text-success', 'bg' => 'bg-success', 'title' => 'Backup completado', 'sub' => 'Hace 1 hora'],
                        ['icon' => 'bi-arrow-repeat', 'color' => 'text-info', 'bg' => 'bg-info', 'title' => 'Sistema actualizado', 'sub' => 'Hace 3 horas'],
                    ];
                    foreach ($activities as $a): ?>
                        <div class="quick-action">
                            <div class="quick-action-icon <?= $a['bg'] ?> bg-opacity-10 <?= $a['color'] ?>">
                                <i class="bi <?= $a['icon'] ?>"></i>
                            </div>
                            <div class="quick-action-info">
                                <div class="quick-action-title"><?= $a['title'] ?></div>
                                <div class="quick-action-sub"><?= $a['sub'] ?></div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

        </div><!-- /col quick -->

    </div><!-- /row 2 -->

    <!-- ── ROW 3: Progreso + Alertas + Mini Stats ── -->
    <div class="row g-3 mb-4">

        <!-- Progreso de módulos -->
        <div class="col-md-6 col-xl-4">
            <div class="card h-100">
                <div class="card-header">
                    <span><i class="bi bi-bar-chart-steps me-2 text-accent"></i>Progreso del sistema</span>
                </div>
                <div class="card-body">
                    <?php
                    $modules = [
                        ['name' => 'Almacenamiento', 'pct' => 72, 'color' => 'bg-primary'],
                        ['name' => 'CPU promedio', 'pct' => 38, 'color' => 'bg-success'],
                        ['name' => 'Memoria RAM', 'pct' => 56, 'color' => 'bg-warning'],
                        ['name' => 'Ancho de banda', 'pct' => 89, 'color' => 'bg-danger'],
                        ['name' => 'Base de datos', 'pct' => 44, 'color' => 'bg-info'],
                    ];
                    foreach ($modules as $m): ?>
                        <div class="mb-3">
                            <div class="d-flex justify-content-between mb-1">
                                <small class="fw-semibold" style="color:var(--text-heading)"><?= $m['name'] ?></small>
                                <small style="color:var(--text-muted)"><?= $m['pct'] ?>%</small>
                            </div>
                            <div class="progress" style="height:6px">
                                <div class="progress-bar <?= $m['color'] ?>" style="width:<?= $m['pct'] ?>%;background-color:inherit" role="progressbar"></div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <!-- Tareas / Checklist -->
        <div class="col-md-6 col-xl-4">
            <div class="card h-100">
                <div class="card-header">
                    <span><i class="bi bi-list-check me-2 text-accent"></i>Tareas pendientes</span>
                    <span class="badge bg-primary">3</span>
                </div>
                <div class="card-body">
                    <?php
                    $tasks = [
                        ['done' => true,  'text' => 'Actualizar dependencias del servidor'],
                        ['done' => true,  'text' => 'Revisar logs de seguridad del día'],
                        ['done' => false, 'text' => 'Configurar copia de seguridad automática'],
                        ['done' => false, 'text' => 'Enviar informe semanal al equipo'],
                        ['done' => false, 'text' => 'Migrar base de datos de staging'],
                    ];
                    foreach ($tasks as $i => $t): ?>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" id="task<?= $i ?>" <?= $t['done'] ? 'checked' : '' ?>>
                            <label class="form-check-label <?= $t['done'] ? 'text-decoration-line-through' : '' ?>"
                                for="task<?= $i ?>" style="font-size:.875rem;color:<?= $t['done'] ? 'var(--text-muted)' : 'var(--text-primary)' ?>">
                                <?= $t['text'] ?>
                            </label>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <span>2 de 5 completadas</span>
                    <div class="progress flex-fill mx-3" style="height:5px">
                        <div class="progress-bar bg-success" style="width:40%" role="progressbar"></div>
                    </div>
                    <span>40%</span>
                </div>
            </div>
        </div>

        <!-- Info + Alert cards -->
        <div class="col-xl-4 d-flex flex-column gap-3">

            <!-- Equipo -->
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <span class="fw-bold" style="font-family:'Syne',sans-serif;color:var(--text-heading)">
                            <i class="bi bi-people me-2 text-accent"></i>Equipo activo
                        </span>
                        <span class="badge bg-success bg-opacity-10 text-success">Online</span>
                    </div>
                    <div class="d-flex align-items-center gap-3">
                        <div class="avatar-group">
                            <div class="avatar-sm bg-primary">JD</div>
                            <div class="avatar-sm bg-success">AM</div>
                            <div class="avatar-sm bg-warning">CP</div>
                            <div class="avatar-sm bg-info">LR</div>
                            <div class="avatar-sm bg-secondary">+8</div>
                        </div>
                        <div style="font-size:.82rem;color:var(--text-muted)">
                            12 miembros activos ahora
                        </div>
                    </div>
                </div>
            </div>

            <!-- Alert info -->
            <div class="alert alert-warning d-flex align-items-start gap-3 mb-0" role="alert">
                <i class="bi bi-exclamation-triangle-fill mt-1"></i>
                <div>
                    <strong>Mantenimiento programado</strong><br>
                    <small>El servidor estará en mantenimiento el <strong>domingo 23 Mar, 02:00–04:00 AM</strong>.</small>
                </div>
            </div>

            <!-- Alert success -->
            <div class="alert alert-success d-flex align-items-start gap-3 mb-0" role="alert">
                <i class="bi bi-shield-check-fill mt-1"></i>
                <div>
                    <strong>Seguridad al día</strong><br>
                    <small>Último escaneo completado sin vulnerabilidades detectadas.</small>
                </div>
            </div>

        </div>

    </div><!-- /row 3 -->

</main><!-- /page-content -->

<?php $this->endSection() ?>