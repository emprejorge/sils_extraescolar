<?= $this->extend($layout) ?>

<?= $this->section('breadcrumb') ?>
<nav aria-label="breadcrumb" class="topbar-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= base_url('admin') ?>">Inicio</a></li>
        <li class="breadcrumb-item"><a href="#">Configuración</a></li>
        <li class="breadcrumb-item active" aria-current="page">Editor de tema</li>
    </ol>
</nav>
<?= $this->endsection() ?>

<?= $this->section('content') ?>

<main id="page-content">

    <div class="d-flex align-items-start justify-content-between mb-4">
        <div>
            <h1 class="page-title">Editor de tema</h1>
            <p class="page-subtitle">Los cambios se aplican en tiempo real sobre el dashboard.</p>
        </div>
        <div class="d-flex gap-2">
            <button class="btn btn-outline-secondary btn-sm" id="btn-reset-all">
                <i class="bi bi-arrow-counterclockwise me-1"></i>Restaurar
            </button>
            <button class="btn btn-outline-secondary btn-sm" id="btn-copy-php">
                <i class="bi bi-clipboard me-1"></i>Copiar PHP
            </button>
        </div>
    </div>

    <!-- ── DOS COLUMNAS ───────────────────────────── -->
    <div class="te-layout">

        <!-- ══ COLUMNA IZQUIERDA: controles ══ -->
        <div class="te-col-left">

            <!-- Tabs -->
            <div class="card mb-3">
                <div class="card-body p-0">
                    <div class="d-flex border-bottom">
                        <button class="te-tab active" data-tab="light"><i class="bi bi-sun me-1"></i>Light</button>
                        <button class="te-tab" data-tab="dark"><i class="bi bi-moon-stars me-1"></i>Dark</button>
                        <button class="te-tab" data-tab="accent"><i class="bi bi-palette me-1"></i>Acento</button>
                    </div>
                </div>
            </div>

            <!-- Grupos de variables -->
            <div id="te-controls"></div>

            <!-- Export -->
            <div class="card mt-3">
                <div class="card-header">
                    <span><i class="bi bi-code-slash me-2 text-accent"></i>PHP generado</span>
                    <small class="text-muted">Pega en <code>dashboard.php</code></small>
                </div>
                <div class="card-body p-0">
                    <textarea id="te-export" readonly style="width:100%;font-size:.7rem;font-family:'SFMono-Regular',monospace;border:none;padding:.75rem 1rem;background:var(--input-bg);color:var(--text-primary);resize:none;height:140px;border-radius:0 0 8px 8px;outline:none"></textarea>
                </div>
            </div>

        </div><!-- /col left -->

        <!-- ══ COLUMNA DERECHA: componentes ══ -->
        <div class="te-col-right">

            <div class="te-components-header mb-3">
                <span class="te-comp-title"><i class="bi bi-grid me-2 text-accent"></i>Componentes</span>
                <small class="text-muted">Vista previa en vivo con el tema activo</small>
            </div>

            <!-- ── STAT CARDS ── -->
            <div class="card mb-3">
                <div class="card-header">
                    <span><i class="bi bi-bar-chart me-2 text-accent"></i>Stat Cards</span>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-6 col-xl-3">
                            <div class="card stat-card mb-0">
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between mb-3">
                                        <div class="stat-icon bg-primary bg-opacity-10 text-primary">
                                            <i class="bi bi-people-fill"></i>
                                        </div>
                                    </div>
                                    <div class="stat-value">1,284</div>
                                    <div class="stat-label">Usuarios totales</div>
                                    <i class="bi bi-people stat-bg-icon"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-xl-3">
                            <div class="card stat-card mb-0">
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between mb-3">
                                        <div class="stat-icon bg-success bg-opacity-10 text-success">
                                            <i class="bi bi-graph-up-arrow"></i>
                                        </div>
                                    </div>
                                    <div class="stat-value">$48.2K</div>
                                    <div class="stat-label">Ingresos del mes</div>
                                    <i class="bi bi-graph-up stat-bg-icon"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-xl-3">
                            <div class="card stat-card mb-0">
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between mb-3">
                                        <div class="stat-icon bg-warning bg-opacity-10 text-warning">
                                            <i class="bi bi-hourglass-split"></i>
                                        </div>
                                    </div>
                                    <div class="stat-value">142</div>
                                    <div class="stat-label">Pendientes</div>
                                    <i class="bi bi-hourglass stat-bg-icon"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-xl-3">
                            <div class="card stat-card mb-0">
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between mb-3">
                                        <div class="stat-icon bg-danger bg-opacity-10 text-danger">
                                            <i class="bi bi-shield-exclamation"></i>
                                        </div>
                                    </div>
                                    <div class="stat-value">5</div>
                                    <div class="stat-label">Alertas activas</div>
                                    <i class="bi bi-shield stat-bg-icon"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ── BUTTONS ── -->
            <div class="card mb-3">
                <div class="card-header">
                    <span><i class="bi bi-toggles me-2 text-accent"></i>Botones</span>
                </div>
                <div class="card-body d-flex flex-wrap gap-2 align-items-center">
                    <button class="btn btn-primary">Primario</button>
                    <button class="btn btn-secondary">Secundario</button>
                    <button class="btn btn-success">Éxito</button>
                    <button class="btn btn-danger">Peligro</button>
                    <button class="btn btn-warning">Advertencia</button>
                    <button class="btn btn-info">Info</button>
                    <hr class="w-100 my-1" style="border-color:var(--border-color)">
                    <button class="btn btn-outline-primary">Outline</button>
                    <button class="btn btn-outline-secondary">Outline</button>
                    <button class="btn btn-outline-success">Outline</button>
                    <button class="btn btn-outline-danger">Outline</button>
                    <hr class="w-100 my-1" style="border-color:var(--border-color)">
                    <button class="btn btn-primary btn-sm"><i class="bi bi-plus-lg me-1"></i>Nuevo</button>
                    <button class="btn btn-outline-secondary btn-sm"><i class="bi bi-download me-1"></i>Exportar</button>
                    <button class="btn btn-outline-secondary btn-sm" disabled>Deshabilitado</button>
                </div>
            </div>

            <!-- ── BADGES & ALERTS ── -->
            <div class="card mb-3">
                <div class="card-header">
                    <span><i class="bi bi-tag me-2 text-accent"></i>Badges y Alertas</span>
                </div>
                <div class="card-body">
                    <div class="d-flex flex-wrap gap-2 mb-3">
                        <span class="badge bg-primary">Primary</span>
                        <span class="badge bg-secondary">Secondary</span>
                        <span class="badge bg-success">Success</span>
                        <span class="badge bg-danger">Danger</span>
                        <span class="badge bg-warning text-dark">Warning</span>
                        <span class="badge bg-info">Info</span>
                        <span class="badge bg-secondary bg-opacity-10 text-secondary">Soft</span>
                        <span class="badge-dot text-success">Activo</span>
                        <span class="badge-dot text-danger">Inactivo</span>
                        <span class="badge-dot text-warning">Pendiente</span>
                    </div>
                    <div class="alert alert-success d-flex align-items-center gap-2 mb-2" role="alert">
                        <i class="bi bi-check-circle-fill"></i>
                        <div><strong>Operación exitosa.</strong> Los cambios fueron guardados correctamente.</div>
                    </div>
                    <div class="alert alert-warning d-flex align-items-center gap-2 mb-2" role="alert">
                        <i class="bi bi-exclamation-triangle-fill"></i>
                        <div><strong>Atención.</strong> Hay tareas pendientes por revisar.</div>
                    </div>
                    <div class="alert alert-danger d-flex align-items-center gap-2 mb-0" role="alert">
                        <i class="bi bi-x-circle-fill"></i>
                        <div><strong>Error.</strong> No se pudo completar la operación.</div>
                    </div>
                </div>
            </div>

            <!-- ── PROGRESS BARS ── -->
            <div class="card mb-3">
                <div class="card-header">
                    <span><i class="bi bi-reception-4 me-2 text-accent"></i>Barras de progreso</span>
                </div>
                <div class="card-body">
                    <?php
                    $bars = [
                        ['Almacenamiento', 72, 'bg-primary'],
                        ['CPU promedio',   38, 'bg-success'],
                        ['Memoria RAM',    56, 'bg-warning'],
                        ['Ancho de banda', 89, 'bg-danger'],
                        ['Base de datos',  44, 'bg-info'],
                    ];
                    foreach ($bars as $b): ?>
                        <div class="mb-3">
                            <div class="d-flex justify-content-between mb-1">
                                <small class="fw-semibold" style="color:var(--text-heading)"><?= $b[0] ?></small>
                                <small style="color:var(--text-muted)"><?= $b[1] ?>%</small>
                            </div>
                            <div class="progress" style="height:6px">
                                <div class="progress-bar <?= $b[2] ?>" style="width:<?= $b[1] ?>%" role="progressbar"></div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- ── TABLA ── -->
            <div class="card mb-3">
                <div class="card-header">
                    <span><i class="bi bi-table me-2 text-accent"></i>Tabla</span>
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
                                $sample_users = [
                                    ['nombre' => 'Ana García',    'email' => 'ana@ejemplo.com',    'rol' => 'Admin',   'estado' => 'activo'],
                                    ['nombre' => 'Carlos López',  'email' => 'carlos@ejemplo.com', 'rol' => 'Editor',  'estado' => 'activo'],
                                    ['nombre' => 'María Torres',  'email' => 'maria@ejemplo.com',  'rol' => 'Viewer',  'estado' => 'pendiente'],
                                    ['nombre' => 'Pedro Ruiz',    'email' => 'pedro@ejemplo.com',  'rol' => 'Editor',  'estado' => 'inactivo'],
                                ];
                                foreach ($sample_users as $u): ?>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center gap-2">
                                                <div class="user-avatar" style="width:32px;height:32px;font-size:.7rem;border-radius:50%">
                                                    <?= strtoupper(substr($u['nombre'], 0, 2)) ?>
                                                </div>
                                                <div>
                                                    <div class="fw-semibold" style="font-size:.85rem;color:var(--text-heading)"><?= $u['nombre'] ?></div>
                                                    <div class="d-none d-sm-block" style="font-size:.75rem;color:var(--text-muted)"><?= $u['email'] ?></div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="d-none d-md-table-cell">
                                            <span class="badge bg-secondary bg-opacity-10 text-secondary"><?= $u['rol'] ?></span>
                                        </td>
                                        <td class="d-none d-sm-table-cell" style="color:var(--text-muted);font-size:.82rem">
                                            <?= date('d/m/Y', strtotime('-' . rand(1, 180) . ' days')) ?>
                                        </td>
                                        <td>
                                            <?php if ($u['estado'] === 'activo'): ?>
                                                <span class="badge-dot text-success">Activo</span>
                                            <?php elseif ($u['estado'] === 'inactivo'): ?>
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
                                                    <li><a class="dropdown-item" href="#"><i class="bi bi-pencil me-2"></i>Editar</a></li>
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

            <!-- ── FORMS ── -->
            <div class="card mb-3">
                <div class="card-header">
                    <span><i class="bi bi-input-cursor-text me-2 text-accent"></i>Formularios</span>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Nombre completo</label>
                            <input type="text" class="form-control" placeholder="Juan Pérez">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Correo electrónico</label>
                            <input type="email" class="form-control" placeholder="juan@ejemplo.com">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Rol</label>
                            <select class="form-select">
                                <option>Administrador</option>
                                <option>Editor</option>
                                <option>Viewer</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Estado</label>
                            <select class="form-select">
                                <option>Activo</option>
                                <option>Inactivo</option>
                                <option>Pendiente</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Notas</label>
                            <textarea class="form-control" rows="2" placeholder="Notas adicionales..."></textarea>
                        </div>
                        <div class="col-12 d-flex gap-2">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="chk1" checked>
                                <label class="form-check-label" for="chk1">Notificaciones activas</label>
                            </div>
                            <div class="form-check ms-3">
                                <input class="form-check-input" type="checkbox" id="chk2">
                                <label class="form-check-label" for="chk2">Acceso admin</label>
                            </div>
                        </div>
                        <div class="col-12 d-flex gap-2">
                            <button class="btn btn-primary btn-sm">Guardar</button>
                            <button class="btn btn-outline-secondary btn-sm">Cancelar</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ── ACTIVIDAD + EQUIPO ── -->
            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <div class="card h-100">
                        <div class="card-header">
                            <span><i class="bi bi-activity me-2 text-accent"></i>Actividad reciente</span>
                        </div>
                        <div class="card-body">
                            <?php
                            $activities = [
                                ['icon' => 'bi-person-plus',       'bg' => 'bg-primary',  'color' => 'text-primary',  'title' => 'Nuevo usuario registrado',  'sub' => 'Hace 5 min'],
                                ['icon' => 'bi-shield-exclamation', 'bg' => 'bg-warning',  'color' => 'text-warning',  'title' => 'Intento de acceso fallido', 'sub' => 'Hace 18 min'],
                                ['icon' => 'bi-check-circle',      'bg' => 'bg-success',  'color' => 'text-success',  'title' => 'Backup completado',         'sub' => 'Hace 1 hora'],
                                ['icon' => 'bi-arrow-repeat',      'bg' => 'bg-info',     'color' => 'text-info',     'title' => 'Sistema actualizado',       'sub' => 'Hace 3 horas'],
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
                </div>

                <div class="col-md-6">
                    <div class="card h-100">
                        <div class="card-header">
                            <span><i class="bi bi-list-check me-2 text-accent"></i>Tareas</span>
                            <span class="badge bg-primary">3</span>
                        </div>
                        <div class="card-body">
                            <?php
                            $tasks = [
                                ['done' => true,  'text' => 'Actualizar dependencias del servidor'],
                                ['done' => true,  'text' => 'Revisar logs de seguridad'],
                                ['done' => false, 'text' => 'Configurar backup automático'],
                                ['done' => false, 'text' => 'Enviar informe semanal'],
                                ['done' => false, 'text' => 'Migrar base de datos staging'],
                            ];
                            foreach ($tasks as $i => $t): ?>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" id="ptask<?= $i ?>" <?= $t['done'] ? 'checked' : '' ?>>
                                    <label class="form-check-label <?= $t['done'] ? 'text-decoration-line-through' : '' ?>"
                                        for="ptask<?= $i ?>"
                                        style="font-size:.875rem;color:<?= $t['done'] ? 'var(--text-muted)' : 'var(--text-primary)' ?>">
                                        <?= $t['text'] ?>
                                    </label>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <span>2 de 5</span>
                            <div class="progress flex-fill mx-3" style="height:5px">
                                <div class="progress-bar bg-success" style="width:40%" role="progressbar"></div>
                            </div>
                            <span>40%</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ── AVATARES + TOASTS DEMO ── -->
            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <div class="card h-100">
                        <div class="card-header">
                            <span><i class="bi bi-people me-2 text-accent"></i>Avatares</span>
                        </div>
                        <div class="card-body">
                            <div class="d-flex align-items-center gap-3 mb-3">
                                <div class="avatar-group">
                                    <div class="avatar-sm bg-primary">JD</div>
                                    <div class="avatar-sm bg-success">AM</div>
                                    <div class="avatar-sm bg-warning">CP</div>
                                    <div class="avatar-sm bg-info">LR</div>
                                    <div class="avatar-sm bg-secondary">+8</div>
                                </div>
                                <small style="color:var(--text-muted)">12 miembros activos</small>
                            </div>
                            <div class="d-flex gap-2">
                                <div class="user-avatar" style="width:48px;height:48px;font-size:.85rem;border-radius:50%">JD</div>
                                <div class="user-avatar" style="width:40px;height:40px;font-size:.78rem;border-radius:50%">AM</div>
                                <div class="user-avatar" style="width:32px;height:32px;font-size:.7rem;border-radius:50%">CP</div>
                                <div class="user-avatar" style="width:24px;height:24px;font-size:.6rem;border-radius:50%">LR</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card h-100">
                        <div class="card-header">
                            <span><i class="bi bi-bell me-2 text-accent"></i>Toasts</span>
                        </div>
                        <div class="card-body d-flex flex-column gap-2">
                            <button class="btn btn-sm btn-outline-success w-100"
                                onclick="showToast('success','Operación exitosa','Los cambios fueron guardados.')">
                                <i class="bi bi-check-circle me-1"></i>Toast Success
                            </button>
                            <button class="btn btn-sm btn-outline-danger w-100"
                                onclick="showToast('error','Error','No se pudo completar la operación.')">
                                <i class="bi bi-x-circle me-1"></i>Toast Error
                            </button>
                            <button class="btn btn-sm btn-outline-warning w-100"
                                onclick="showToast('warning','Advertencia','Revisa los campos del formulario.')">
                                <i class="bi bi-exclamation-triangle me-1"></i>Toast Warning
                            </button>
                            <button class="btn btn-sm btn-outline-info w-100"
                                onclick="showToast('info','Información','El sistema está actualizado.')">
                                <i class="bi bi-info-circle me-1"></i>Toast Info
                            </button>
                        </div>
                    </div>
                </div>
            </div>

        </div><!-- /col right -->

    </div><!-- /te-layout -->

</main>

<!-- ── ESTILOS ─────────────────────────────────────────────── -->
<style>
    .te-layout {
        display: grid;
        grid-template-columns: 320px 1fr;
        gap: 1.25rem;
        align-items: start;
    }

    /* Columna izquierda sticky */
    .te-col-left {
        position: sticky;
        top: 76px;
        max-height: calc(100vh - 106px);
        display: flex;
        flex-direction: column;
        gap: 0;
        overflow: hidden;
    }

    /* Dentro de la col izquierda, los controles hacen scroll */
    #te-controls {
        overflow-y: auto;
        flex: 1;
        min-height: 0;
    }

    .te-components-header {
        display: flex;
        align-items: baseline;
        justify-content: space-between;
    }

    .te-comp-title {
        font-size: .95rem;
        font-weight: 600;
        color: var(--text-heading);
    }

    /* Tabs */
    .te-tab {
        padding: 10px 18px;
        font-size: .8rem;
        font-weight: 500;
        border: none;
        background: transparent;
        cursor: pointer;
        color: var(--text-muted);
        border-bottom: 2px solid transparent;
        transition: color .15s, border-color .15s;
    }

    .te-tab.active {
        color: var(--accent);
        border-bottom-color: var(--accent);
    }

    .te-tab:hover:not(.active) {
        color: var(--text-primary);
        background: var(--btn-ghost-hover);
    }

    /* Grupo de variables */
    .te-group-card {
        border-bottom: 1px solid var(--border-color);
    }

    .te-group-card:last-child {
        border-bottom: none;
    }

    .te-group-header {
        padding: .55rem .85rem;
        font-size: .68rem;
        font-weight: 600;
        color: var(--text-muted);
        text-transform: uppercase;
        letter-spacing: .06em;
        background: var(--input-bg);
        border-bottom: 1px solid var(--border-color);
        position: sticky;
        top: 0;
        z-index: 1;
    }

    /* Fila de color */
    .te-row {
        display: flex;
        align-items: center;
        gap: .6rem;
        padding: .35rem .85rem;
        border-bottom: 1px solid var(--border-color);
        transition: background .1s;
    }

    .te-row:last-child {
        border-bottom: none;
    }

    .te-row:hover {
        background: var(--btn-ghost-hover);
    }

    .te-swatch {
        width: 28px;
        height: 28px;
        border-radius: 7px;
        border: 1px solid var(--border-color);
        cursor: pointer;
        flex-shrink: 0;
        position: relative;
        overflow: hidden;
        transition: transform .15s;
    }

    .te-swatch:hover {
        transform: scale(1.12);
    }

    .te-swatch-bg {
        position: absolute;
        inset: 0;
        pointer-events: none;
    }

    .te-swatch input[type="color"] {
        position: absolute;
        inset: -6px;
        width: calc(100% + 12px);
        height: calc(100% + 12px);
        border: none;
        padding: 0;
        cursor: pointer;
        opacity: 0;
    }

    .te-label {
        font-size: .8rem;
        color: var(--text-primary);
        flex: 1;
        min-width: 0;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .te-hex {
        font-size: .68rem;
        font-family: 'SFMono-Regular', monospace;
        color: var(--text-muted);
        background: var(--input-bg);
        border: 1px solid var(--border-color);
        border-radius: 5px;
        padding: 2px 6px;
        width: 68px;
        text-align: center;
        cursor: pointer;
        user-select: all;
        flex-shrink: 0;
        transition: background .12s, color .12s, border-color .12s;
    }

    .te-hex:hover {
        background: var(--accent);
        color: #fff;
        border-color: var(--accent);
    }

    /* Responsive */
    @media (max-width: 1024px) {
        .te-layout {
            grid-template-columns: 1fr;
        }

        .te-col-left {
            position: static;
            max-height: none;
        }

        #te-controls {
            overflow-y: visible;
        }
    }
</style>

<!-- ── JS ─────────────────────────────────────────────────── -->
<script>
    (function() {

        const DEFS = {
            light: {
                groups: {
                    'Fondos': {
                        '--body-bg': {
                            label: 'Fondo de página',
                            val: '<?= $theme_light["--body-bg"] ?>'
                        },
                        '--sidebar-bg': {
                            label: 'Fondo sidebar',
                            val: '<?= $theme_light["--sidebar-bg"] ?>'
                        },
                        '--topbar-bg': {
                            label: 'Fondo topbar',
                            val: '#ffffff'
                        },
                        '--card-bg': {
                            label: 'Tarjetas',
                            val: '<?= $theme_light["--card-bg"] ?>'
                        },
                        '--input-bg': {
                            label: 'Inputs',
                            val: '<?= $theme_light["--input-bg"] ?>'
                        },
                        '--dropdown-bg': {
                            label: 'Dropdown',
                            val: '<?= $theme_light["--dropdown-bg"] ?>'
                        },
                    },
                    'Textos': {
                        '--text-primary': {
                            label: 'Texto principal',
                            val: '<?= $theme_light["--text-primary"] ?>'
                        },
                        '--text-heading': {
                            label: 'Títulos',
                            val: '<?= $theme_light["--text-heading"] ?>'
                        },
                        '--text-muted': {
                            label: 'Texto secundario',
                            val: '<?= $theme_light["--text-muted"] ?>'
                        },
                        '--text-brand': {
                            label: 'Nombre de marca',
                            val: '<?= $theme_light["--text-brand"] ?>'
                        },
                    },
                    'Sidebar': {
                        '--sidebar-text': {
                            label: 'Etiquetas sección',
                            val: '<?= $theme_light["--sidebar-text"] ?>'
                        },
                        '--sidebar-link': {
                            label: 'Links normales',
                            val: '<?= $theme_light["--sidebar-link"] ?>'
                        },
                        '--sidebar-link-hover': {
                            label: 'Link hover texto',
                            val: '<?= $theme_light["--sidebar-link-hover"] ?>'
                        },
                        '--sidebar-link-hover-bg': {
                            label: 'Link hover fondo',
                            val: '<?= $theme_light["--sidebar-link-hover-bg"] ?>'
                        },
                        '--sidebar-link-active-text': {
                            label: 'Link activo texto',
                            val: '<?= $theme_light["--sidebar-link-active-text"] ?>'
                        },
                        '--sidebar-link-active-bg': {
                            label: 'Link activo fondo',
                            val: '<?= $theme_light["--sidebar-link-active-bg"] ?>'
                        },
                    },
                    'Bordes y UI': {
                        '--border-color': {
                            label: 'Bordes',
                            val: '<?= $theme_light["--border-color"] ?>'
                        },
                        '--btn-ghost-hover': {
                            label: 'Botón ghost hover',
                            val: '<?= $theme_light["--btn-ghost-hover"] ?>'
                        },
                        '--table-row-hover': {
                            label: 'Tabla fila hover',
                            val: '<?= $theme_light["--table-row-hover"] ?>'
                        },
                        '--progress-bg': {
                            label: 'Fondo barra progreso',
                            val: '<?= $theme_light["--progress-bg"] ?>'
                        },
                    },
                }
            },
            dark: {
                groups: {
                    'Fondos': {
                        '--body-bg': {
                            label: 'Fondo de página',
                            val: '<?= $theme_dark["--body-bg"] ?>'
                        },
                        '--sidebar-bg': {
                            label: 'Fondo sidebar',
                            val: '<?= $theme_dark["--sidebar-bg"] ?>'
                        },
                        '--topbar-bg': {
                            label: 'Fondo topbar',
                            val: '<?= $theme_dark["--topbar-bg"] ?>'
                        },
                        '--card-bg': {
                            label: 'Tarjetas',
                            val: '<?= $theme_dark["--card-bg"] ?>'
                        },
                        '--input-bg': {
                            label: 'Inputs',
                            val: '<?= $theme_dark["--input-bg"] ?>'
                        },
                        '--dropdown-bg': {
                            label: 'Dropdown',
                            val: '<?= $theme_dark["--dropdown-bg"] ?>'
                        },
                    },
                    'Textos': {
                        '--text-primary': {
                            label: 'Texto principal',
                            val: '<?= $theme_dark["--text-primary"] ?>'
                        },
                        '--text-heading': {
                            label: 'Títulos',
                            val: '<?= $theme_dark["--text-heading"] ?>'
                        },
                        '--text-muted': {
                            label: 'Texto secundario',
                            val: '<?= $theme_dark["--text-muted"] ?>'
                        },
                    },
                    'Sidebar': {
                        '--sidebar-text': {
                            label: 'Etiquetas sección',
                            val: '<?= $theme_dark["--sidebar-text"] ?>'
                        },
                        '--sidebar-link': {
                            label: 'Links normales',
                            val: '<?= $theme_dark["--sidebar-link"] ?>'
                        },
                        '--sidebar-link-hover': {
                            label: 'Link hover texto',
                            val: '<?= $theme_dark["--sidebar-link-hover"] ?>'
                        },
                        '--sidebar-link-hover-bg': {
                            label: 'Link hover fondo',
                            val: '<?= $theme_dark["--sidebar-link-hover-bg"] ?>'
                        },
                        '--sidebar-link-active-bg': {
                            label: 'Link activo fondo',
                            val: '<?= $theme_dark["--sidebar-link-active-bg"] ?>'
                        },
                    },
                    'Bordes y UI': {
                        '--border-color': {
                            label: 'Bordes',
                            val: '<?= $theme_dark["--border-color"] ?>'
                        },
                        '--btn-ghost-hover': {
                            label: 'Botón ghost hover',
                            val: '<?= $theme_dark["--btn-ghost-hover"] ?>'
                        },
                        '--table-row-hover': {
                            label: 'Tabla fila hover',
                            val: '<?= $theme_dark["--table-row-hover"] ?>'
                        },
                        '--progress-bg': {
                            label: 'Fondo barra progreso',
                            val: '<?= $theme_dark["--progress-bg"] ?>'
                        },
                    },
                }
            },
            accent: {
                groups: {
                    'Acento': {
                        '--accent': {
                            label: 'Color principal',
                            val: '<?= $theme_accent["--accent"] ?>'
                        },
                        '--accent-hover': {
                            label: 'Hover',
                            val: '<?= $theme_accent["--accent-hover"] ?>'
                        },
                    },
                    'Semánticos': {
                        '--color-success': {
                            label: 'Éxito (verde)',
                            val: '<?= $theme_accent["--color-success"] ?>'
                        },
                        '--color-danger': {
                            label: 'Peligro (rojo)',
                            val: '<?= $theme_accent["--color-danger"] ?>'
                        },
                        '--color-warning': {
                            label: 'Advertencia (ámbar)',
                            val: '<?= $theme_accent["--color-warning"] ?>'
                        },
                        '--color-info': {
                            label: 'Info (azul)',
                            val: '<?= $theme_accent["--color-info"] ?>'
                        },
                    },
                }
            }
        };

        /* ── Estado ── */
        const STORAGE_KEY = 'mimetic_theme_v1';
        let state = {};
        let currentTab = 'light';

        function initState() {
            let saved = {};
            try {
                saved = JSON.parse(localStorage.getItem(STORAGE_KEY)) || {};
            } catch {}
            for (const [tab, def] of Object.entries(DEFS)) {
                state[tab] = {};
                for (const vars of Object.values(def.groups)) {
                    for (const [k, cfg] of Object.entries(vars)) {
                        state[tab][k] = (saved[tab] && saved[tab][k]) ? saved[tab][k] : cfg.val;
                    }
                }
            }
        }

        /* ── Aplicar al DOM real ── */
        function applyToRoot() {
            const root = document.documentElement;
            const isDark = root.getAttribute('data-theme') === 'dark';
            const vars = isDark ? state.dark : state.light;

            for (const [k, v] of Object.entries(vars)) {
                root.style.setProperty(k, v);
                syncBsVars(k, v);
            }
            for (const [k, v] of Object.entries(state.accent)) {
                root.style.setProperty(k, v);
                syncBsVars(k, v);
            }
        }

        /* ── toHex ── */
        function toHex(val) {
            if (!val) return '#888888';
            val = String(val).trim();
            if (/^#[0-9a-fA-F]{6}$/.test(val)) return val;
            if (/^#[0-9a-fA-F]{3}$/.test(val)) return '#' + val[1] + val[1] + val[2] + val[2] + val[3] + val[3];
            const m = val.match(/rgba?\(\s*(\d+),\s*(\d+),\s*(\d+)/);
            if (m) return '#' + [m[1], m[2], m[3]].map(n => parseInt(n).toString(16).padStart(2, '0')).join('');
            return '#888888';
        }

        /* ── Render controles ── */
        function renderControls() {
            const container = document.getElementById('te-controls');
            const def = DEFS[currentTab];
            let html = '<div class="card" style="border-radius:8px;overflow:hidden">';

            for (const [groupName, vars] of Object.entries(def.groups)) {
                html += `<div class="te-group-card">
                <div class="te-group-header">${groupName}</div>`;
                for (const [varName, cfg] of Object.entries(vars)) {
                    const hex = toHex(state[currentTab][varName]);
                    const safeId = varName.replace(/[^a-zA-Z0-9]/g, '_');
                    html += `
                <div class="te-row">
                    <div class="te-swatch" title="Seleccionar color">
                        <div class="te-swatch-bg" id="bg_${safeId}" style="background:${hex}"></div>
                        <input type="color" value="${hex}"
                               data-var="${varName}" data-tab="${currentTab}" data-id="${safeId}">
                    </div>
                    <span class="te-label" title="${varName}">${cfg.label}</span>
                    <span class="te-hex" id="hex_${safeId}" data-val="${hex}">${hex}</span>
                </div>`;
                }
                html += '</div>';
            }
            html += '</div>';
            container.innerHTML = html;

            container.querySelectorAll('input[type="color"]').forEach(inp => {
                inp.addEventListener('input', () => handleChange(inp));
                inp.addEventListener('change', () => handleChange(inp));
            });

            container.querySelectorAll('.te-hex').forEach(badge => {
                badge.addEventListener('click', () => {
                    navigator.clipboard.writeText(badge.dataset.val).then(() => {
                        const orig = badge.textContent;
                        badge.textContent = '✓ copiado';
                        setTimeout(() => badge.textContent = orig, 1300);
                    });
                });
            });

            updateExport();
        }

        /* ── hexToRgb helper ── */
        function hexToRgb(hex) {
            hex = hex.replace('#', '');
            if (hex.length === 3) hex = hex.split('').map(c => c + c).join('');
            const n = parseInt(hex, 16);
            return `${(n >> 16) & 255}, ${(n >> 8) & 255}, ${n & 255}`;
        }

        /* ── Mapa: variable custom → variable(s) Bootstrap a sincronizar ── */
        const BS_BRIDGE = {
            '--accent': ['--bs-primary', '--bs-link-color', ['--bs-primary-rgb', hexToRgb]],
            '--accent-hover': ['--bs-link-hover-color'],
            '--color-success': ['--bs-success', ['--bs-success-rgb', hexToRgb]],
            '--color-danger': ['--bs-danger', ['--bs-danger-rgb', hexToRgb]],
            '--color-warning': ['--bs-warning', ['--bs-warning-rgb', hexToRgb]],
            '--color-info': ['--bs-info', ['--bs-info-rgb', hexToRgb]],
            '--body-bg': ['--bs-body-bg'],
            '--text-primary': ['--bs-body-color'],
            '--border-color': ['--bs-border-color'],
            '--card-bg': ['--bs-secondary-bg'],
            '--input-bg': ['--bs-tertiary-bg'],
        };

        function syncBsVars(varName, val) {
            const targets = BS_BRIDGE[varName];
            if (!targets) return;
            const root = document.documentElement;
            targets.forEach(t => {
                if (Array.isArray(t)) {
                    // [bsVarName, transformFn]
                    root.style.setProperty(t[0], t[1](val));
                } else {
                    root.style.setProperty(t, val);
                }
            });
        }

        function handleChange(inp) {
            const varName = inp.dataset.var;
            const tab = inp.dataset.tab;
            const safeId = inp.dataset.id;
            const val = inp.value;

            state[tab][varName] = val;

            const bg = document.getElementById('bg_' + safeId);
            const hex = document.getElementById('hex_' + safeId);
            if (bg) bg.style.background = val;
            if (hex) {
                hex.textContent = val;
                hex.dataset.val = val;
            }

            document.documentElement.style.setProperty(varName, val);
            syncBsVars(varName, val); // ← nueva línea

            try {
                localStorage.setItem(STORAGE_KEY, JSON.stringify(state));
            } catch {}
            updateExport();
        }

        /* ── Export ── */
        function updateExport() {
            const lines = [
                '// $theme_light',
                ...Object.entries(state.light).map(([k, v]) => `    '${k}' => '${v}',`),
                '',
                '// $theme_dark',
                ...Object.entries(state.dark).map(([k, v]) => `    '${k}' => '${v}',`),
                '',
                '// $theme_accent',
                ...Object.entries(state.accent).map(([k, v]) => `    '${k}' => '${v}',`),
            ];
            document.getElementById('te-export').value = lines.join('\n');
        }

        /* ── Eventos globales ── */
        document.querySelectorAll('.te-tab').forEach(btn => {
            btn.addEventListener('click', () => {
                document.querySelectorAll('.te-tab').forEach(b => b.classList.remove('active'));
                btn.classList.add('active');
                currentTab = btn.dataset.tab;
                renderControls();
            });
        });

        document.getElementById('btn-reset-all').addEventListener('click', () => {
            localStorage.removeItem(STORAGE_KEY);
            const root = document.documentElement;
            for (const def of Object.values(DEFS))
                for (const vars of Object.values(def.groups))
                    for (const k of Object.keys(vars))
                        root.style.removeProperty(k);
            initState();
            renderControls();
            applyToRoot();
            if (typeof showToast === 'function')
                showToast('info', 'Tema restaurado', 'Colores restablecidos a los valores por defecto.');
        });

        document.getElementById('btn-copy-php').addEventListener('click', () => {
            navigator.clipboard.writeText(document.getElementById('te-export').value).then(() => {
                const btn = document.getElementById('btn-copy-php');
                btn.innerHTML = '<i class="bi bi-check-lg me-1"></i>¡Copiado!';
                setTimeout(() => btn.innerHTML = '<i class="bi bi-clipboard me-1"></i>Copiar PHP', 2000);
                if (typeof showToast === 'function')
                    showToast('success', 'Copiado', 'Pega el código en dashboard.php');
            });
        });

        // Sincronizar cuando cambia dark/light
        document.getElementById('btn-dark-mode')?.addEventListener('click', () => {
            setTimeout(applyToRoot, 50);
        });

        /* ── Init ── */
        initState();
        applyToRoot();
        renderControls();

    })();
</script>

<?= $this->endSection() ?>