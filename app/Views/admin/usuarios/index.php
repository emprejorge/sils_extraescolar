<?= $this->extend($layout) ?>

<?= $this->section('breadcrumb') ?>
<!-- Breadcrumb -->
<nav aria-label="breadcrumb" class="topbar-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">Usuarios</li>
    </ol>
</nav>
<?= $this->endsection(); ?>

<?= $this->section('content') ?>

<main id="page-content">

    <!-- Page header -->
    <div class="d-flex align-items-start justify-content-between mb-4">
        <div>
            <h1 class="page-title">Usuarios</h1>
            <p class="page-subtitle">Gestiona los usuarios del sistema, sus roles y permisos.</p>
        </div>
        <div class="d-flex gap-2">
            <button class="btn btn-outline-secondary btn-sm" id="btn-export">
                <i class="bi bi-download me-1"></i>Exportar
            </button>
            <a href="<?= site_url('admin/usuarios/crear') ?>" class="btn btn-primary btn-sm">
                <i class="bi bi-person-plus me-1"></i>Nuevo usuario
            </a>
        </div>
    </div>

    <!-- ── STAT STRIP ─────────────────────────── -->
    <div class="row g-3 mb-4">

        <div class="col-6 col-md-3">
            <div class="card stat-card">
                <div class="card-body py-3">
                    <div class="d-flex align-items-center gap-3">
                        <div class="stat-icon bg-primary bg-opacity-10 text-primary">
                            <i class="bi bi-people-fill"></i>
                        </div>
                        <div>
                            <div class="stat-value" style="font-size:1.5rem"><?= $totalUsuarios ?></div>
                            <div class="stat-label">Total</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-6 col-md-3">
            <div class="card stat-card">
                <div class="card-body py-3">
                    <div class="d-flex align-items-center gap-3">
                        <div class="stat-icon bg-success bg-opacity-10 text-success">
                            <i class="bi bi-person-check-fill"></i>
                        </div>
                        <div>
                            <div class="stat-value" style="font-size:1.5rem"><?= $totalActivos ?></div>
                            <div class="stat-label">Activos</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-6 col-md-3">
            <div class="card stat-card">
                <div class="card-body py-3">
                    <div class="d-flex align-items-center gap-3">
                        <div class="stat-icon bg-warning bg-opacity-10 text-warning">
                            <i class="bi bi-person-exclamation"></i>
                        </div>
                        <div>
                            <div class="stat-value" style="font-size:1.5rem"><?= $totalPendientes ?></div>
                            <div class="stat-label">Pendientes</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-6 col-md-3">
            <div class="card stat-card">
                <div class="card-body py-3">
                    <div class="d-flex align-items-center gap-3">
                        <div class="stat-icon bg-danger bg-opacity-10 text-danger">
                            <i class="bi bi-person-dash-fill"></i>
                        </div>
                        <div>
                            <div class="stat-value" style="font-size:1.5rem"><?= $totalInactivos ?></div>
                            <div class="stat-label">Inactivos</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div><!-- /stat strip -->

    <!-- ── TABLA PRINCIPAL ───────────────────── -->
    <div class="card">

        <!-- Card header: filtros + búsqueda -->
        <div class="card-header flex-wrap gap-3">
            <span><i class="bi bi-person-lines-fill me-2 text-accent"></i>Lista de usuarios</span>

            <div class="d-flex align-items-center gap-2 ms-auto flex-wrap">

                <!-- Filtro por estado -->
                <select class="form-select form-select-sm" id="filter-estado" style="width:auto">
                    <option value="">Todos los estados</option>
                    <option value="1">Activo</option>
                    <option value="0">Inactivo</option>
                    <option value="pending">Pendiente</option>
                </select>

                <!-- Filtro por rol -->
                <select class="form-select form-select-sm" id="filter-rol" style="width:auto">
                    <option value="">Todos los roles</option>
                    <?php foreach ($roles as $id => $nombre): ?>
                        <option value="<?= $id ?>"><?= $nombre ?></option>
                    <?php endforeach; ?>
                </select>

                <!-- Búsqueda -->
                <div class="input-group input-group-sm" style="width:220px">
                    <span class="input-group-text border-end-0" style="background:var(--input-bg);border-color:var(--border-color)">
                        <i class="bi bi-search" style="color:var(--text-muted)"></i>
                    </span>
                    <input type="text" class="form-control border-start-0 ps-0"
                        id="busqueda"
                        placeholder="Buscar usuario..."
                        style="background:var(--input-bg)">
                </div>

            </div>
        </div>

        <!-- Tabla -->
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0" id="tabla-usuarios">
                    <thead>
                        <tr>
                            <th style="width:40px">
                                <input class="form-check-input" type="checkbox" id="check-all">
                            </th>
                            <th>Usuario</th>
                            <th class="d-none d-md-table-cell">Rol</th>
                            <th class="d-none d-lg-table-cell">Registro</th>
                            <th class="d-none d-lg-table-cell">Último acceso</th>
                            <th>Estado</th>
                            <th class="text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="tabla-body">
                        <?php if (!empty($usuarios)): ?>
                            <?php foreach ($usuarios as $u): ?>
                                <tr data-estado="<?= $u['active'] ?>"
                                    data-rol="<?= $u['roles'] ?>"
                                    data-nombre="<?= strtolower($u['nombre_completo']) ?>"
                                    data-email="<?= strtolower($u['email']) ?>">

                                    <td>
                                        <input class="form-check-input check-row" type="checkbox" value="<?= $u['id'] ?>">
                                    </td>

                                    <!-- Nombre + email -->
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <img src="<?= base_url($u['avatar']) ?>"
                                                alt="<?= esc($u['nombre_completo']) ?>"
                                                class="user-avatar"
                                                style="width:34px;height:34px;border-radius:50%;object-fit:cover;font-size:0.72rem"
                                                onerror="this.outerHTML='<div class=\'user-avatar\' style=\'width:34px;height:34px;font-size:0.72rem;border-radius:50%\'><?= strtoupper(substr($u['first_name'], 0, 1) . substr($u['last_name'] ?? '', 0, 1)) ?></div>'">
                                            <div>
                                                <div class="fw-semibold" style="font-size:.875rem;color:var(--text-heading)">
                                                    <?= esc($u['nombre_completo']) ?>
                                                </div>
                                                <div style="font-size:.75rem;color:var(--text-muted)">
                                                    <?= esc($u['email']) ?>
                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                    <!-- Rol -->
                                    <td class="d-none d-md-table-cell">
                                        <?php
                                        $rolColors = [
                                            'admin'   => 'bg-danger bg-opacity-10 text-danger',
                                            'editor'  => 'bg-primary bg-opacity-10 text-primary',
                                            'viewer'  => 'bg-secondary bg-opacity-10 text-secondary',
                                        ];
                                        $rolKey   = strtolower($roles[$u['roles']] ?? '');
                                        $rolClass = $rolColors[$rolKey] ?? 'bg-secondary bg-opacity-10 text-secondary';
                                        ?>
                                        <span class="badge <?= $rolClass ?>">
                                            <?= esc($roles[$u['roles']] ?? '—') ?>
                                        </span>
                                    </td>

                                    <!-- Fecha registro -->
                                    <td class="d-none d-lg-table-cell" style="color:var(--text-muted);font-size:.82rem">
                                        <?= date('d M Y', strtotime($u['created_at'])) ?>
                                    </td>

                                    <!-- Último acceso -->
                                    <td class="d-none d-lg-table-cell" style="color:var(--text-muted);font-size:.82rem">
                                        <?= !empty($u['last_login']) ? date('d M Y, H:i', strtotime($u['last_login'])) : '<span style="color:var(--text-muted)">—</span>' ?>
                                    </td>

                                    <!-- Estado -->
                                    <td>
                                        <?php if ($u['active'] === '1'): ?>
                                            <span class="badge-dot text-success">Activo</span>
                                        <?php elseif ($u['active'] === '0'): ?>
                                            <span class="badge-dot text-danger">Inactivo</span>
                                        <?php else: ?>
                                            <span class="badge-dot text-warning">Pendiente</span>
                                        <?php endif; ?>
                                    </td>

                                    <!-- Acciones -->
                                    <td class="text-end">
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-outline-secondary border-0"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bi bi-three-dots"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a class="dropdown-item" href="<?= site_url('admin/usuarios/ver/' . $u['id']) ?>">
                                                        <i class="bi bi-eye me-2"></i>Ver detalle
                                                    </a>
                                                </li>

                                                <li>
                                                    <a class="dropdown-item" href="#"
                                                        onclick="toggleEstado(<?= $u['id'] ?>, '<?= $u['active'] ?>')">
                                                        <?php if ($u['active'] === '1'): ?>
                                                            <i class="bi bi-person-dash me-2 text-warning"></i>
                                                            <span class="text-warning">Desactivar</span>
                                                        <?php else: ?>
                                                            <i class="bi bi-person-check me-2 text-success"></i>
                                                            <span class="text-success">Activar</span>
                                                        <?php endif; ?>
                                                    </a>
                                                </li>
                                                <li>
                                                    <hr class="dropdown-divider">
                                                </li>
                                                <li>
                                                    <a class="dropdown-item text-danger" href="#"
                                                        onclick="confirmarEliminar(<?= $u['id'] ?>, '<?= esc($u['nombre_completo']) ?>')">
                                                        <i class="bi bi-trash me-2"></i>Eliminar
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>

                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr id="fila-vacia">
                                <td colspan="7" class="text-center py-5">
                                    <i class="bi bi-people d-block mb-2" style="font-size:2.5rem;color:var(--text-muted)"></i>
                                    <span style="color:var(--text-muted);font-size:.9rem">No hay usuarios registrados aún.</span>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Card footer: acciones masivas + paginación -->
        <div class="card-footer d-flex align-items-center justify-content-between flex-wrap gap-3">

            <!-- Acciones en lote (ocultas hasta seleccionar) -->
            <div class="d-flex align-items-center gap-2" id="bulk-actions" style="display:none!important">
                <span class="fw-semibold" style="font-size:.82rem;color:var(--text-heading)">
                    <span id="selected-count">0</span> seleccionados
                </span>
                <button class="btn btn-sm btn-outline-secondary" onclick="bulkExport()">
                    <i class="bi bi-download me-1"></i>Exportar
                </button>
                <button class="btn btn-sm btn-outline-danger" onclick="bulkDelete()">
                    <i class="bi bi-trash me-1"></i>Eliminar
                </button>
            </div>

            <span style="font-size:.82rem;color:var(--text-muted)" id="bulk-label">
                <?= count($usuarios) ?> usuario<?= count($usuarios) !== 1 ? 's' : '' ?> en total
            </span>

            <!-- Paginación Bootstrap -->
            <?php if ($pager): ?>
                <nav aria-label="Paginación de usuarios">
                    <?= $pager->links('default', 'bootstrap_pagination') ?>
                </nav>
            <?php endif; ?>

        </div>

    </div><!-- /card tabla -->

</main>

<!-- ═══════════════════════════════════════════════
     MODAL CONFIRMAR ELIMINACIÓN
════════════════════════════════════════════════ -->
<div class="modal fade" id="modal-eliminar" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width:420px">
        <div class="modal-content" style="background:var(--card-bg);border:1px solid var(--border-color);border-radius:16px">
            <div class="modal-body p-4 text-center">
                <div class="mx-auto mb-3 d-flex align-items-center justify-content-center bg-danger bg-opacity-10 text-danger rounded-circle"
                    style="width:56px;height:56px;font-size:1.5rem">
                    <i class="bi bi-person-dash-fill"></i>
                </div>
                <h5 class="fw-bold mb-1" style="font-family:'Syne',sans-serif;color:var(--text-heading)">
                    ¿Eliminar usuario?
                </h5>
                <p class="mb-0" style="color:var(--text-muted);font-size:.875rem">
                    Estás a punto de eliminar a <strong id="modal-nombre-usuario" style="color:var(--text-heading)"></strong>.
                    Esta acción no se puede deshacer.
                </p>
            </div>
            <div class="modal-footer border-0 pt-0 d-flex gap-2 px-4 pb-4">
                <button type="button" class="btn btn-outline-secondary flex-fill" data-bs-dismiss="modal">
                    Cancelar
                </button>
                <a href="#" id="btn-confirmar-eliminar" class="btn btn-danger flex-fill">
                    <i class="bi bi-trash me-1"></i>Eliminar
                </a>
            </div>
        </div>
    </div>
</div>

<!-- ═══════════════════════════════════════════════
     JS LOCAL (solo lógica de esta vista)
════════════════════════════════════════════════ -->
<script>
    (function() {

        // ── Filtros client-side ───────────────────────
        const filterEstado = document.getElementById('filter-estado');
        const filterRol = document.getElementById('filter-rol');
        const busqueda = document.getElementById('busqueda');
        const tablaBody = document.getElementById('tabla-body');

        function filtrar() {
            const estado = filterEstado.value;
            const rol = filterRol.value;
            const texto = busqueda.value.toLowerCase().trim();
            let visible = 0;

            tablaBody.querySelectorAll('tr[data-nombre]').forEach(tr => {
                const matchEstado = !estado || tr.dataset.estado === estado;
                const matchRol = !rol || tr.dataset.rol === rol;
                const matchTexto = !texto ||
                    tr.dataset.nombre.includes(texto) ||
                    tr.dataset.email.includes(texto);

                const show = matchEstado && matchRol && matchTexto;
                tr.style.display = show ? '' : 'none';
                if (show) visible++;
            });

            // Fila vacía dinámica
            let filaEmpty = document.getElementById('fila-vacia-dynamic');
            if (visible === 0) {
                if (!filaEmpty) {
                    filaEmpty = document.createElement('tr');
                    filaEmpty.id = 'fila-vacia-dynamic';
                    filaEmpty.innerHTML = `
                    <td colspan="7" class="text-center py-5">
                        <i class="bi bi-search d-block mb-2" style="font-size:2rem;color:var(--text-muted)"></i>
                        <span style="color:var(--text-muted);font-size:.875rem">Sin resultados para tu búsqueda.</span>
                    </td>`;
                    tablaBody.appendChild(filaEmpty);
                }
            } else {
                filaEmpty?.remove();
            }
        }

        filterEstado.addEventListener('change', filtrar);
        filterRol.addEventListener('change', filtrar);
        busqueda.addEventListener('input', filtrar);

        // ── Selección masiva ──────────────────────────
        const checkAll = document.getElementById('check-all');
        const bulkPanel = document.getElementById('bulk-actions');
        const bulkLabel = document.getElementById('bulk-label');
        const countSpan = document.getElementById('selected-count');

        function actualizarBulk() {
            const checks = tablaBody.querySelectorAll('.check-row:checked');
            const cantidad = checks.length;
            countSpan.textContent = cantidad;

            if (cantidad > 0) {
                bulkPanel.style.display = 'flex';
                bulkLabel.style.display = 'none';
            } else {
                bulkPanel.style.display = 'none';
                bulkLabel.style.display = '';
            }
        }

        checkAll.addEventListener('change', function() {
            tablaBody.querySelectorAll('.check-row').forEach(c => {
                if (c.closest('tr').style.display !== 'none') c.checked = this.checked;
            });
            actualizarBulk();
        });

        tablaBody.addEventListener('change', e => {
            if (e.target.classList.contains('check-row')) actualizarBulk();
        });

        // ── Modal eliminar ────────────────────────────
        window.confirmarEliminar = function(id, nombre) {
            document.getElementById('modal-nombre-usuario').textContent = nombre;
            document.getElementById('btn-confirmar-eliminar').href = `<?= site_url('usuarios/eliminar') ?>/${id}`;
            new bootstrap.Modal(document.getElementById('modal-eliminar')).show();
        };

        // ── Toggle estado ─────────────────────────────
        window.toggleEstado = function(id, estadoActual) {
            window.location.href = `<?= site_url('usuarios/toggle-estado') ?>/${id}`;
        };

        // ── Bulk export / delete (placeholder) ───────
        window.bulkExport = function() {
            const ids = [...tablaBody.querySelectorAll('.check-row:checked')].map(c => c.value);
            window.showToast('info', 'Exportando', `Exportando ${ids.length} usuario(s)...`);
        };

        window.bulkDelete = function() {
            const ids = [...tablaBody.querySelectorAll('.check-row:checked')].map(c => c.value);
            window.showToast('warning', 'Eliminar en lote', `¿Eliminar ${ids.length} usuario(s)? (Implementa la acción en el controlador)`);
        };

    })();
</script>

<?= $this->endSection() ?>