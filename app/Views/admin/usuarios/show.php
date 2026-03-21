<?= $this->extend($layout) ?>

<?= $this->section('breadcrumb') ?>
<!-- Breadcrumb -->
<nav aria-label="breadcrumb" class="topbar-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= base_url('admin/usuarios'); ?>">Usuarios</a></li>
        <li class="breadcrumb-item active" aria-current="page"><?= esc($usuario['nombre_completo']) ?></li>

    </ol>
</nav>
<?= $this->endsection(); ?>

<?= $this->section('content') ?>

<main id="page-content">

    <!-- Page header -->
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="page-title">Ficha de usuario</h1>
            <p class="page-subtitle"><?= esc($usuario['nombre_completo']) ?></p>
        </div>
        <div class="d-flex gap-2">
            <a href="<?= site_url('admin/usuarios') ?>" class="btn btn-outline-secondary btn-sm">
                <i class="bi bi-arrow-left me-1"></i>Volver
            </a>
        </div>
    </div>

    <div class="row g-3">

        <!-- ══════════════════════════════════════
             COLUMNA IZQUIERDA — Perfil + fechas
        ═══════════════════════════════════════ -->
        <div class="col-lg-4 d-flex flex-column gap-3">

            <!-- Tarjeta de perfil -->
            <div class="card text-center">
                <div class="card-body pt-4 pb-4">

                    <img src="<?= base_url(user()->avatar) ?>"
                        alt="<?= esc($usuario['nombre_completo']) ?>"
                        class="user-avatar mx-auto mb-3"
                        style="width:72px;height:72px;border-radius:50%;object-fit:cover"
                        onerror="this.outerHTML='<div class=\'user-avatar mx-auto mb-3\' style=\'width:72px;height:72px;font-size:1.5rem;border-radius:50%\'><?= strtoupper(substr($usuario['first_name'], 0, 1) . substr($usuario['last_name'] ?? '', 0, 1)) ?></div>'">

                    <h5 class="mb-1 fw-bold" style="font-family:'Syne',sans-serif;color:var(--text-heading)">
                        <?= esc($usuario['nombre_completo']) ?>
                    </h5>
                    <div class="mb-3" style="font-size:.82rem;color:var(--text-muted)">
                        <?= esc($usuario['email']) ?>
                    </div>

                    <div class="d-flex align-items-center justify-content-center gap-2 mb-4">
                        <?php
                        $rolKey    = strtolower($roles[$usuario['role']] ?? '');
                        $rolColors = [
                            'admin'    => 'bg-danger bg-opacity-10 text-danger',
                            'editor'   => 'bg-primary bg-opacity-10 text-primary',
                            'viewer'   => 'bg-secondary bg-opacity-10 text-secondary',
                            'profesor' => 'bg-info bg-opacity-10 text-info',
                        ];
                        $rolClass = $rolColors[$rolKey] ?? 'bg-secondary bg-opacity-10 text-secondary';
                        ?>
                        <span class="badge <?= $rolClass ?>">
                            <?= esc($roles[$usuario['role']] ?? '—') ?>
                        </span>

                        <?php if ($usuario['active'] === '1'): ?>
                            <span class="badge-dot text-success">Activo</span>
                        <?php elseif ($usuario['active'] === '0'): ?>
                            <span class="badge-dot text-danger">Inactivo</span>
                        <?php else: ?>
                            <span class="badge-dot text-warning">Pendiente</span>
                        <?php endif; ?>
                    </div>

                    <button class="btn btn-sm btn-outline-secondary w-100"
                        onclick="window.location.href='<?= site_url('usuarios/toggle-estado/' . $usuario['id']) ?>'">
                        <?php if ($usuario['active'] === '1'): ?>
                            <i class="bi bi-person-dash me-1 text-warning"></i>
                            <span class="text-warning">Desactivar usuario</span>
                        <?php else: ?>
                            <i class="bi bi-person-check me-1 text-success"></i>
                            <span class="text-success">Activar usuario</span>
                        <?php endif; ?>
                    </button>

                </div>
                <div class="card-footer px-4 py-3"
                    style="border-top:1px solid color-mix(in srgb, var(--color-danger) 20%, transparent)">
                    <button class="btn btn-sm btn-outline-danger w-100"
                        data-bs-toggle="modal" data-bs-target="#modal-eliminar">
                        <i class="bi bi-trash me-1"></i>Eliminar usuario
                    </button>
                </div>
            </div><!-- /perfil -->

            <!-- Fechas -->
            <div class="card">
                <div class="card-header">
                    <span><i class="bi bi-calendar3 me-2 text-accent"></i>Fechas</span>
                </div>
                <div class="card-body p-0">

                    <div class="d-flex align-items-center justify-content-between px-4 py-3"
                        style="border-bottom:1px solid var(--border-color)">
                        <span style="font-size:.82rem;color:var(--text-muted)">Registro</span>
                        <span style="font-size:.82rem;font-weight:500;color:var(--text-heading)">
                            <?= !empty($usuario['created_at'])
                                ? date('d M Y', strtotime($usuario['created_at']))
                                : '—' ?>
                        </span>
                    </div>

                    <div class="d-flex align-items-center justify-content-between px-4 py-3">
                        <span style="font-size:.82rem;color:var(--text-muted)">Último acceso</span>
                        <span style="font-size:.82rem;font-weight:500;color:var(--text-heading)">
                            <?= !empty($usuario['last_login'])
                                ? date('d M Y', strtotime($usuario['last_login']))
                                : 'Nunca' ?>
                        </span>
                    </div>

                </div>
            </div><!-- /fechas -->

            <!-- Resumen academias -->
            <div class="card">
                <div class="card-header">
                    <span><i class="bi bi-mortarboard me-2 text-accent"></i>Academias</span>
                </div>
                <div class="card-body p-0">

                    <div class="d-flex align-items-center justify-content-between px-4 py-3"
                        style="border-bottom:1px solid var(--border-color)">
                        <span style="font-size:.82rem;color:var(--text-muted)">Asignadas</span>
                        <span class="fw-bold"
                            style="font-family:'Syne',sans-serif;color:var(--text-heading)">
                            <?= count($academias) ?>
                        </span>
                    </div>

                    <div class="d-flex align-items-center justify-content-between px-4 py-3">
                        <span style="font-size:.82rem;color:var(--text-muted)">Activas</span>
                        <span class="fw-bold"
                            style="font-family:'Syne',sans-serif;color:var(--color-success)">
                            <?= count(array_filter($academias, fn($a) => $a['activa'] === '1')) ?>
                        </span>
                    </div>

                </div>
            </div><!-- /resumen academias -->

        </div><!-- /col izquierda -->


        <!-- ══════════════════════════════════════
             COLUMNA DERECHA — Editar + Academias
        ═══════════════════════════════════════ -->
        <div class="col-lg-8 d-flex flex-column gap-3">

            <!-- ── FORMULARIO EDITAR ─────────────── -->
            <div class="card">
                <div class="card-header">
                    <span><i class="bi bi-pencil me-2 text-accent"></i>Editar información</span>
                </div>

                <form action="<?= site_url('usuarios/actualizar/' . $usuario['id']) ?>" method="post">
                    <?= csrf_field() ?>

                    <div class="card-body">
                        <div class="row g-3">

                            <div class="col-sm-6">
                                <label class="form-label" for="first_name">Nombre</label>
                                <input type="text" class="form-control form-control-sm"
                                    id="first_name" name="first_name"
                                    value="<?= esc($usuario['first_name']) ?>"
                                    required>
                            </div>

                            <div class="col-sm-6">
                                <label class="form-label" for="last_name">Apellido</label>
                                <input type="text" class="form-control form-control-sm"
                                    id="last_name" name="last_name"
                                    value="<?= esc($usuario['last_name'] ?? '') ?>"
                                    required>
                            </div>

                            <div class="col-sm-8">
                                <label class="form-label" for="email">Correo electrónico</label>
                                <input type="email" class="form-control form-control-sm"
                                    id="email" name="email"
                                    value="<?= esc($usuario['email']) ?>"
                                    required>
                            </div>

                            <div class="col-sm-4">
                                <label class="form-label" for="roles">Rol</label>
                                <select class="form-select form-select-sm" id="roles" name="roles">
                                    <?php foreach ($roles as $id => $nombre): ?>
                                        <option value="<?= $id ?>"
                                            <?= $usuario['role'] == $id ? 'selected' : '' ?>>
                                            <?= esc($nombre) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <!-- Separador contraseña -->
                            <div class="col-12">
                                <div class="d-flex align-items-center gap-2 my-1">
                                    <hr class="flex-fill" style="border-color:var(--border-color)">
                                    <small style="color:var(--text-muted);white-space:nowrap">
                                        Cambiar contraseña &nbsp;<span style="opacity:.6">(opcional)</span>
                                    </small>
                                    <hr class="flex-fill" style="border-color:var(--border-color)">
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <label class="form-label" for="password">Nueva contraseña</label>
                                <div class="input-group input-group-sm">
                                    <input type="password" class="form-control"
                                        id="password" name="password"
                                        placeholder="Dejar en blanco para no cambiar"
                                        autocomplete="new-password">
                                    <button class="btn btn-outline-secondary" type="button"
                                        onclick="togglePass('password', this)">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <label class="form-label" for="password_confirm">Confirmar contraseña</label>
                                <div class="input-group input-group-sm">
                                    <input type="password" class="form-control"
                                        id="password_confirm" name="password_confirm"
                                        placeholder="Repetir nueva contraseña"
                                        autocomplete="new-password">
                                    <button class="btn btn-outline-secondary" type="button"
                                        onclick="togglePass('password_confirm', this)">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                </div>
                            </div>

                        </div>
                    </div><!-- /card-body -->

                    <div class="card-footer d-flex justify-content-end gap-2">
                        <a href="<?= site_url('usuarios') ?>" class="btn btn-outline-secondary btn-sm">
                            Cancelar
                        </a>
                        <button type="submit" class="btn btn-primary btn-sm">
                            <i class="bi bi-check-lg me-1"></i>Guardar cambios
                        </button>
                    </div>

                </form>
            </div><!-- /form editar -->


            <!-- ── ACADEMIAS ASIGNADAS ───────────── -->
            <div class="card">
                <div class="card-header">
                    <span><i class="bi bi-mortarboard me-2 text-accent"></i>Academias asignadas</span>
                    <button class="btn btn-sm btn-primary"
                        data-bs-toggle="modal" data-bs-target="#modal-asignar">
                        <i class="bi bi-plus-lg me-1"></i>Asignar
                    </button>
                </div>

                <?php if (!empty($academias)): ?>
                    <div class="card-body p-0">
                        <?php foreach ($academias as $idx => $a):
                            $isLast = $idx === array_key_last($academias);
                        ?>
                            <div class="d-flex align-items-center gap-3 px-4 py-3"
                                style="<?= !$isLast ? 'border-bottom:1px solid var(--border-color)' : '' ?>">

                                <div class="d-flex align-items-center justify-content-center flex-shrink-0
                                            bg-primary bg-opacity-10 text-primary"
                                    style="width:38px;height:38px;border-radius:10px;font-size:1rem">
                                    <i class="bi bi-book"></i>
                                </div>

                                <div class="flex-fill">
                                    <div class="fw-semibold"
                                        style="font-size:.875rem;color:var(--text-heading)">
                                        <?= esc($a['nombre']) ?>
                                    </div>
                                    <div style="font-size:.78rem;color:var(--text-muted)">
                                        <i class="bi bi-clock me-1"></i><?= esc($a['horario']) ?>
                                    </div>
                                </div>

                                <?php if ($a['activa'] === '1'): ?>
                                    <span class="badge bg-success bg-opacity-10 text-success">Activa</span>
                                <?php else: ?>
                                    <span class="badge bg-secondary bg-opacity-10 text-secondary">Inactiva</span>
                                <?php endif; ?>

                                <button class="btn btn-sm btn-outline-secondary border-0 text-danger flex-shrink-0"
                                    title="Desasignar"
                                    onclick="confirmarDesasignar(<?= $usuario['id'] ?>, <?= $a['id'] ?>, '<?= esc($a['nombre']) ?>')">
                                    <i class="bi bi-x-lg"></i>
                                </button>

                            </div>
                        <?php endforeach; ?>
                    </div>

                <?php else: ?>
                    <div class="card-body text-center py-5">
                        <i class="bi bi-mortarboard d-block mb-2"
                            style="font-size:2.2rem;color:var(--text-muted)"></i>
                        <p class="mb-3" style="color:var(--text-muted);font-size:.875rem">
                            Sin academias asignadas aún.
                        </p>
                        <button class="btn btn-primary btn-sm"
                            data-bs-toggle="modal" data-bs-target="#modal-asignar">
                            <i class="bi bi-plus-lg me-1"></i>Asignar academia
                        </button>
                    </div>
                <?php endif; ?>

            </div><!-- /academias -->

        </div><!-- /col derecha -->

    </div><!-- /row -->

</main>


<!-- ═══════════════════════════════════════════════
     MODAL — Asignar academia
════════════════════════════════════════════════ -->
<div class="modal fade" id="modal-asignar" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width:460px">
        <div class="modal-content"
            style="background:var(--card-bg);border:1px solid var(--border-color);border-radius:16px">

            <div class="modal-header"
                style="border-color:var(--border-color);padding:20px 24px 16px">
                <h6 class="modal-title fw-bold mb-0"
                    style="font-family:'Syne',sans-serif;color:var(--text-heading)">
                    <i class="bi bi-mortarboard me-2 text-accent"></i>Asignar academia
                </h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body px-4 py-3">

                <div class="input-group input-group-sm mb-3">
                    <span class="input-group-text"
                        style="background:var(--input-bg);border-color:var(--border-color)">
                        <i class="bi bi-search" style="color:var(--text-muted)"></i>
                    </span>
                    <input type="text" class="form-control" id="buscar-academia"
                        placeholder="Buscar academia..."
                        style="background:var(--input-bg)">
                </div>

                <div style="max-height:300px;overflow-y:auto" id="lista-academias-modal">
                    <?php if (!empty($academias_disponibles)): ?>
                        <?php foreach ($academias_disponibles as $ac): ?>
                            <label class="d-flex align-items-center gap-3 p-3 mb-1"
                                style="cursor:pointer;border:1px solid var(--border-color);border-radius:10px;transition:background .15s"
                                onmouseover="this.style.background='var(--btn-ghost-hover)'"
                                onmouseout="this.style.background=''"
                                data-nombre="<?= strtolower($ac['nombre']) ?>">
                                <input class="form-check-input flex-shrink-0 mt-0"
                                    type="checkbox" name="academias[]"
                                    value="<?= $ac['id'] ?>">
                                <div class="flex-fill">
                                    <div class="fw-semibold"
                                        style="font-size:.875rem;color:var(--text-heading)">
                                        <?= esc($ac['nombre']) ?>
                                    </div>
                                    <div style="font-size:.75rem;color:var(--text-muted)">
                                        <i class="bi bi-clock me-1"></i><?= esc($ac['horario']) ?>
                                    </div>
                                </div>
                                <?php if ($ac['activa'] === '1'): ?>
                                    <span class="badge bg-success bg-opacity-10 text-success">Activa</span>
                                <?php else: ?>
                                    <span class="badge bg-secondary bg-opacity-10 text-secondary">Inactiva</span>
                                <?php endif; ?>
                            </label>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p class="text-center py-3 mb-0"
                            style="color:var(--text-muted);font-size:.875rem">
                            No hay academias disponibles.
                        </p>
                    <?php endif; ?>
                </div>

            </div>

            <div class="modal-footer"
                style="border-color:var(--border-color);padding:16px 24px">
                <button type="button" class="btn btn-outline-secondary btn-sm"
                    data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary btn-sm"
                    id="btn-guardar-asignacion">
                    <i class="bi bi-check-lg me-1"></i>Guardar
                </button>
            </div>

        </div>
    </div>
</div>


<!-- ═══════════════════════════════════════════════
     MODAL — Confirmar desasignar
════════════════════════════════════════════════ -->
<div class="modal fade" id="modal-desasignar" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width:380px">
        <div class="modal-content"
            style="background:var(--card-bg);border:1px solid var(--border-color);border-radius:16px">
            <div class="modal-body p-4 text-center">
                <div class="mx-auto mb-3 d-flex align-items-center justify-content-center
                            bg-warning bg-opacity-10 text-warning rounded-circle"
                    style="width:52px;height:52px;font-size:1.3rem">
                    <i class="bi bi-mortarboard"></i>
                </div>
                <h6 class="fw-bold mb-1"
                    style="font-family:'Syne',sans-serif;color:var(--text-heading)">
                    ¿Desasignar academia?
                </h6>
                <p class="mb-0" style="color:var(--text-muted);font-size:.875rem">
                    Se quitará
                    <strong id="modal-nombre-academia"
                        style="color:var(--text-heading)"></strong>
                    de este profesor.
                </p>
            </div>
            <div class="modal-footer border-0 pt-0 d-flex gap-2 px-4 pb-4">
                <button type="button"
                    class="btn btn-outline-secondary btn-sm flex-fill"
                    data-bs-dismiss="modal">Cancelar</button>
                <a href="#" id="btn-confirmar-desasignar"
                    class="btn btn-warning btn-sm flex-fill">
                    <i class="bi bi-x-lg me-1"></i>Desasignar
                </a>
            </div>
        </div>
    </div>
</div>


<!-- ═══════════════════════════════════════════════
     MODAL — Confirmar eliminación
════════════════════════════════════════════════ -->
<div class="modal fade" id="modal-eliminar" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width:400px">
        <div class="modal-content"
            style="background:var(--card-bg);border:1px solid var(--border-color);border-radius:16px">
            <div class="modal-body p-4 text-center">
                <div class="mx-auto mb-3 d-flex align-items-center justify-content-center
                            bg-danger bg-opacity-10 text-danger rounded-circle"
                    style="width:56px;height:56px;font-size:1.4rem">
                    <i class="bi bi-person-x-fill"></i>
                </div>
                <h6 class="fw-bold mb-1"
                    style="font-family:'Syne',sans-serif;color:var(--text-heading)">
                    ¿Eliminar usuario?
                </h6>
                <p style="color:var(--text-muted);font-size:.875rem;margin-bottom:4px">
                    Estás a punto de eliminar a
                    <strong style="color:var(--text-heading)">
                        <?= esc($usuario['nombre_completo']) ?>
                    </strong>.
                </p>
                <p class="mb-0" style="color:var(--color-danger);font-size:.8rem;font-weight:500">
                    Esta acción no se puede deshacer.
                </p>
            </div>
            <div class="modal-footer border-0 pt-0 d-flex gap-2 px-4 pb-4">
                <button type="button"
                    class="btn btn-outline-secondary btn-sm flex-fill"
                    data-bs-dismiss="modal">Cancelar</button>
                <a href="<?= site_url('usuarios/eliminar/' . $usuario['id']) ?>"
                    class="btn btn-danger btn-sm flex-fill">
                    <i class="bi bi-trash me-1"></i>Sí, eliminar
                </a>
            </div>
        </div>
    </div>
</div>


<!-- ═══════════════════════════════════════════════
     JS LOCAL
════════════════════════════════════════════════ -->
<script>
    (function() {

        // ── Mostrar/ocultar contraseña ────────────────
        window.togglePass = function(fieldId, btn) {
            const input = document.getElementById(fieldId);
            const isText = input.type === 'text';
            input.type = isText ? 'password' : 'text';
            btn.querySelector('i').className = isText ? 'bi bi-eye' : 'bi bi-eye-slash';
        };

        // ── Validar contraseñas antes de enviar ───────
        document.querySelector('form')?.addEventListener('submit', function(e) {
            const pw = document.getElementById('password').value;
            const pw2 = document.getElementById('password_confirm').value;
            if (pw && pw !== pw2) {
                e.preventDefault();
                window.showToast('error', 'Contraseñas no coinciden',
                    'Verifica que ambos campos sean iguales.');
                document.getElementById('password_confirm').focus();
            }
        });

        // ── Buscar en modal ───────────────────────────
        document.getElementById('buscar-academia')?.addEventListener('input', function() {
            const q = this.value.toLowerCase().trim();
            document.querySelectorAll('#lista-academias-modal label[data-nombre]').forEach(lbl => {
                lbl.style.display = (!q || lbl.dataset.nombre.includes(q)) ? '' : 'none';
            });
        });

        // ── Guardar asignación ─────────────────────────
        document.getElementById('btn-guardar-asignacion')?.addEventListener('click', function() {
            const ids = [...document.querySelectorAll(
                '#lista-academias-modal input[name="academias[]"]:checked'
            )].map(c => c.value);

            if (!ids.length) {
                window.showToast('warning', 'Sin selección',
                    'Selecciona al menos una academia.');
                return;
            }
            const params = ids.map(id => 'academias[]=' + id).join('&');
            window.location.href =
                '<?= site_url('usuarios/asignar-academia/' . $usuario['id']) ?>?' + params;
        });

        // ── Confirmar desasignar ──────────────────────
        window.confirmarDesasignar = function(userId, academiaId, nombre) {
            document.getElementById('modal-nombre-academia').textContent = nombre;
            document.getElementById('btn-confirmar-desasignar').href =
                '<?= site_url('usuarios/desasignar-academia') ?>/' + userId + '/' + academiaId;
            new bootstrap.Modal(document.getElementById('modal-desasignar')).show();
        };

    })();
</script>

<?= $this->endSection() ?>