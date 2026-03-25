<?= $this->extend($layout) ?>

<?= $this->section('content') ?>

<?php
// ──────────────────────────────────────────────────────────────
// DATOS FICTICIOS — reemplazar con variables del controlador
// ──────────────────────────────────────────────────────────────

// Lista de academias
// Cada academia trae sus horarios ya agrupados (JOIN con academia_horarios)
// y conteos calculados en el controlador
$academias = [
    [
        'id'          => 1,
        'nombre'      => 'Fútbol',
        'descripcion' => 'Entrenamiento de fútbol para alumnos de 7° y 8°.',
        'sala'        => 'Cancha principal',
        'activa'      => '1',
        'cupos'       => 20,
        'alumnos'     => 18,   // COUNT desde academia_alumno
        'profesor'    => 'Carlos Pérez',
        'profesorId'    => 1,
        'horarios'    => [     // rows de academia_horarios para esta academia
            ['dia_semana' => 1, 'hora_inicio' => '15:00', 'hora_fin' => '16:30'],
            ['dia_semana' => 3, 'hora_inicio' => '15:00', 'hora_fin' => '16:30'],
        ],
    ],
    [
        'id'          => 2,
        'nombre'      => 'Básquetbol',
        'descripcion' => 'Taller de básquetbol, nivel intermedio.',
        'sala'        => 'Gimnasio',
        'activa'      => '1',
        'cupos'       => 16,
        'alumnos'     => 14,
        'profesor'    => 'Ana Martínez',
        'profesorId'    => 2,
        'horarios'    => [
            ['dia_semana' => 2, 'hora_inicio' => '14:00', 'hora_fin' => '15:30'],
        ],
    ],
    [
        'id'          => 3,
        'nombre'      => 'Pintura',
        'descripcion' => 'Taller de pintura y expresión artística.',
        'sala'        => 'Sala de artes',
        'activa'      => '1',
        'cupos'       => 15,
        'alumnos'     => 12,
        'profesor'    => 'Laura Ríos',
        'profesorId'    => 3,
        'horarios'    => [
            ['dia_semana' => 4, 'hora_inicio' => '13:30', 'hora_fin' => '15:00'],
        ],
    ],
    [
        'id'          => 4,
        'nombre'      => 'Robótica',
        'descripcion' => null,
        'sala'        => 'Laboratorio de computación',
        'activa'      => '0',
        'cupos'       => 12,
        'alumnos'     => 0,
        'profesor'    => null,   // null = sin profesor asignado
        'profesorId'    => null,
        'horarios'    => [
            ['dia_semana' => 5, 'hora_inicio' => '14:30', 'hora_fin' => '16:00'],
        ],
    ],
    [
        'id'          => 5,
        'nombre'      => 'Teatro',
        'descripcion' => 'Taller de expresión teatral y oratoria.',
        'sala'        => 'Sala multiusos',
        'activa'      => '1',
        'cupos'       => 18,
        'alumnos'     => 11,
        'profesor'    => 'Sofía Vega',
        'profesorId'    => 5,
        'horarios'    => [
            ['dia_semana' => 1, 'hora_inicio' => '16:30', 'hora_fin' => '18:00'],
            ['dia_semana' => 3, 'hora_inicio' => '16:30', 'hora_fin' => '18:00'],
        ],
    ],
];

// Helpers
$dias = [1 => 'Lun', 2 => 'Mar', 3 => 'Mié', 4 => 'Jue', 5 => 'Vie'];
$dias_full = [1 => 'Lunes', 2 => 'Martes', 3 => 'Miércoles', 4 => 'Jueves', 5 => 'Viernes'];
$hoy_num = (int) date('N'); // 1=Lunes ... 5=Viernes
// ──────────────────────────────────────────────────────────────
?>

<main id="page-content">

    <!-- Page header -->
    <div class="d-flex align-items-start justify-content-between mb-4">
        <div>
            <h1 class="page-title">Academias</h1>
            <p class="page-subtitle">Gestiona las academias, horarios y cupos del colegio.</p>
        </div>
        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modal-nueva">
            <i class="bi bi-plus-lg me-1"></i>Nueva academia
        </button>
    </div>


    <!-- ── STATS ──────────────────────────────── -->
    <div class="row g-3 mb-4">

        <div class="col-6 col-md-3">
            <div class="card stat-card">
                <div class="card-body py-3">
                    <div class="d-flex align-items-center gap-3">
                        <div class="stat-icon bg-primary bg-opacity-10 text-primary">
                            <i class="bi bi-mortarboard-fill"></i>
                        </div>
                        <div>
                            <div class="stat-value" style="font-size:1.5rem"><?= $stats['total'] ?></div>
                            <div class="stat-label">Total academias</div>
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
                            <i class="bi bi-calendar-check"></i>
                        </div>
                        <div>
                            <div class="stat-value" style="font-size:1.5rem"><?= $stats['activas_hoy'] ?></div>
                            <div class="stat-label">Con clases hoy</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-6 col-md-3">
            <div class="card stat-card">
                <div class="card-body py-3">
                    <div class="d-flex align-items-center gap-3">
                        <div class="stat-icon bg-info bg-opacity-10 text-info">
                            <i class="bi bi-people-fill"></i>
                        </div>
                        <div>
                            <div class="stat-value" style="font-size:1.5rem"><?= $stats['total_alumnos'] ?></div>
                            <div class="stat-label">Alumnos inscritos</div>
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
                            <div class="stat-value" style="font-size:1.5rem"><?= $stats['sin_profesor'] ?></div>
                            <div class="stat-label">Sin profesor</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div><!-- /stats -->


    <!-- ── TABLA ACADEMIAS ─────────────────────── -->
    <div class="card">
        <div class="card-header flex-wrap gap-2">
            <span><i class="bi bi-grid me-2 text-accent"></i>Lista de academias</span>
            <div class="d-flex align-items-center gap-2 ms-auto">

                <!-- Filtro estado -->
                <select class="form-select form-select-sm" id="filter-estado" style="width:auto">
                    <option value="">Todos los estados</option>
                    <option value="1">Activas</option>
                    <option value="0">Inactivas</option>
                </select>

                <!-- Búsqueda -->
                <div class="input-group input-group-sm" style="width:200px">
                    <span class="input-group-text"
                        style="background:var(--input-bg);border-color:var(--border-color)">
                        <i class="bi bi-search" style="color:var(--text-muted)"></i>
                    </span>
                    <input type="text" class="form-control border-start-0 ps-0"
                        id="buscar-academia" placeholder="Buscar..."
                        style="background:var(--input-bg)">
                </div>

            </div>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0" id="tabla-academias">
                    <thead>
                        <tr>
                            <th>Academia</th>
                            <th class="d-none d-md-table-cell">Sala</th>
                            <th>Horarios</th>
                            <th class="d-none d-lg-table-cell">Cupos</th>
                            <th class="d-none d-lg-table-cell">Profesor</th>
                            <th>Estado</th>
                            <th class="text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="tabla-body">
                        <?php foreach ($academias as $a): ?>
                            <tr data-activa="<?= $a['activa'] ?>"
                                data-nombre="<?= strtolower($a['nombre']) ?>">

                                <!-- Nombre + descripción -->
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="d-flex align-items-center justify-content-center flex-shrink-0
                                                    <?= $a['activa'] === '1' ? 'bg-primary bg-opacity-10 text-primary' : 'bg-secondary bg-opacity-10 text-secondary' ?>"
                                            style="width:34px;height:34px;border-radius:9px;font-size:.95rem">
                                            <i class="bi bi-book"></i>
                                        </div>
                                        <div>
                                            <div class="fw-semibold" style="font-size:.875rem;color:var(--text-heading)">
                                                <?= esc($a['nombre']) ?>
                                            </div>
                                            <?php if ($a['descripcion']): ?>
                                                <div class="d-none d-md-block"
                                                    style="font-size:.75rem;color:var(--text-muted);max-width:200px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap">
                                                    <?= esc($a['descripcion']) ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </td>

                                <!-- Sala -->
                                <td class="d-none d-md-table-cell"
                                    style="color:var(--text-muted);font-size:.82rem">
                                    <i class="bi bi-geo-alt me-1"></i><?= esc($a['sala']) ?>
                                </td>

                                <!-- Horarios (pills por día) -->
                                <td>
                                    <div class="d-flex flex-wrap gap-1">
                                        <?php foreach ($a['horarios'] as $h):
                                            $esHoy = $h['dia_semana'] == $hoy_num && $a['activa'] === '1';
                                        ?>
                                            <span class="badge <?= $esHoy ? 'bg-success' : 'bg-secondary' ?> bg-opacity-10 <?= $esHoy ? '' : 'text-secondary' ?>"
                                                style="font-size:.7rem;"
                                                title="<?= $dias_full[$h['dia_semana']] ?> <?= substr($h['hora_inicio'], 0, 5) ?>–<?= substr($h['hora_fin'], 0, 5) ?>">
                                                <?= $dias[$h['dia_semana']] ?>
                                                <span class="d-none d-xl-inline">
                                                    <?= substr($h['hora_inicio'], 0, 5) ?>
                                                </span>
                                            </span>
                                        <?php endforeach; ?>
                                    </div>
                                </td>

                                <!-- Cupos -->
                                <td class="d-none d-lg-table-cell">
                                    <?php
                                    $pctCupo = $a['cupos'] > 0
                                        ? round($a['alumnos'] / $a['cupos'] * 100)
                                        : 0;
                                    $cupoColor = $pctCupo >= 90 ? 'text-danger'
                                        : ($pctCupo >= 70 ? 'text-warning' : 'text-success');
                                    ?>
                                    <div style="font-size:.82rem">
                                        <span class="fw-semibold <?= $cupoColor ?>">
                                            <?= $a['alumnos'] ?>
                                        </span>
                                        <span style="color:var(--text-muted)">/ <?= $a['cupos'] ?></span>
                                    </div>
                                    <div class="progress mt-1" style="height:3px;width:60px">
                                        <div class="progress-bar <?= $pctCupo >= 90 ? 'bg-danger' : ($pctCupo >= 70 ? 'bg-warning' : 'bg-success') ?>"
                                            style="width:<?= $pctCupo ?>%"></div>
                                    </div>
                                </td>

                                <!-- Profesor -->
                                <td class="d-none d-lg-table-cell" style="font-size:.82rem">
                                    <?php if ($a['profesor']): ?>
                                        <span style="color:var(--text-heading)"><?= esc($a['profesor']) ?></span>
                                    <?php else: ?>
                                        <span class="badge bg-warning bg-opacity-10 text-warning">Sin asignar</span>
                                    <?php endif; ?>
                                </td>

                                <!-- Estado -->
                                <td>
                                    <?php if ($a['activa'] === '1'): ?>
                                        <span class="badge-dot text-success">Activa</span>
                                    <?php else: ?>
                                        <span class="badge-dot text-danger">Inactiva</span>
                                    <?php endif; ?>
                                </td>

                                <!-- Acciones -->
                                <td class="text-end">
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-outline-secondary border-0"
                                            data-bs-toggle="dropdown">
                                            <i class="bi bi-three-dots"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li>
                                                <a class="dropdown-item" href="<?= site_url('academias/ver/' . $a['id']) ?>">
                                                    <i class="bi bi-eye me-2"></i>Ver detalle
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item"
                                                    href="#"
                                                    onclick="abrirEditar(<?= htmlspecialchars(json_encode($a), ENT_QUOTES) ?>)">
                                                    <i class="bi bi-pencil me-2"></i>Editar
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="<?= site_url('academias/toggle/' . $a['id']) ?>">
                                                    <?php if ($a['activa'] === '1'): ?>
                                                        <i class="bi bi-pause-circle me-2 text-warning"></i>
                                                        <span class="text-warning">Desactivar</span>
                                                    <?php else: ?>
                                                        <i class="bi bi-play-circle me-2 text-success"></i>
                                                        <span class="text-success">Activar</span>
                                                    <?php endif; ?>
                                                </a>
                                            </li>
                                            <li>
                                                <hr class="dropdown-divider">
                                            </li>
                                            <li>
                                                <a class="dropdown-item text-danger" href="#"
                                                    onclick="confirmarEliminar(<?= $a['id'] ?>, '<?= esc($a['nombre']) ?>')">
                                                    <i class="bi bi-trash me-2"></i>Eliminar
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>

                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card-footer">
            <span style="font-size:.82rem;color:var(--text-muted)">
                <?= count($academias) ?> academia<?= count($academias) !== 1 ? 's' : '' ?> en total
            </span>
        </div>

    </div><!-- /card tabla -->

</main>


<!-- ═══════════════════════════════════════════════
     MODAL — Nueva / Editar academia
     El mismo modal sirve para crear y editar.
     Al editar, JS rellena los campos.
════════════════════════════════════════════════ -->
<div class="modal fade" id="modal-nueva" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content"
            style="background:var(--card-bg);border:1px solid var(--border-color);border-radius:16px">

            <div class="modal-header" style="border-color:var(--border-color);padding:20px 24px 16px">
                <h6 class="modal-title fw-bold mb-0"
                    style="color:var(--text-heading)">
                    <i class="bi bi-mortarboard me-2 text-accent"></i>
                    <span id="modal-titulo">Nueva academia</span>
                </h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form id="form-academia"
                action="<?= site_url('academias/guardar') ?>"
                method="post">
                <?= csrf_field() ?>
                <!-- Campo oculto: si tiene valor = edición, si está vacío = creación -->
                <input type="hidden" name="id" id="field-id" value="">

                <div class="modal-body px-4 py-3">
                    <div class="row g-3">

                        <!-- Nombre -->
                        <div class="col-sm-8">
                            <label class="form-label" for="field-nombre">
                                Nombre <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control form-control-sm"
                                id="field-nombre" name="nombre"
                                placeholder="Ej: Fútbol, Robótica, Teatro..." required>
                        </div>

                        <!-- Estado switch -->
                        <div class="col-sm-4 d-flex align-items-end pb-1">
                            <div class="form-check form-switch mb-0">
                                <input class="form-check-input" type="checkbox"
                                    role="switch" id="field-activa" name="activa"
                                    value="1" checked>
                                <label class="form-check-label" for="field-activa"
                                    style="font-size:.875rem;color:var(--text-primary)">
                                    Academia activa
                                </label>
                            </div>
                        </div>

                        <!-- Descripción -->
                        <div class="col-12">
                            <label class="form-label" for="field-descripcion">Descripción</label>
                            <textarea class="form-control form-control-sm"
                                id="field-descripcion" name="descripcion"
                                rows="2"
                                placeholder="Descripción breve de la academia..."></textarea>
                        </div>

                        <!-- Descripción -->
                        <div class="col-12">
                            <label class="form-label" for="field-profesor">Profesor/a</label>
                            <select class="form-select form-select-sm"
                                name="field-profesor" id="field-profesor" required>
                                <option value="" disabled selected>Seleccionar...</option>
                                <?php foreach ($profesores as $p): ?>
                                    <option value="<?= $p['id']; ?>"><?= $p['nombre_completo']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <!-- Sala + Cupos -->
                        <div class="col-sm-8">
                            <label class="form-label" for="field-sala">Sala / Espacio</label>
                            <input type="text" class="form-control form-control-sm"
                                id="field-sala" name="sala"
                                placeholder="Ej: Gimnasio, Cancha, Sala 12...">
                        </div>

                        <div class="col-sm-4">
                            <label class="form-label" for="field-cupos">
                                Cupos <span class="text-danger">*</span>
                            </label>
                            <input type="number" class="form-control form-control-sm"
                                id="field-cupos" name="cupos"
                                min="1" max="100" value="20" required>
                        </div>

                        <!-- Separador horarios -->
                        <div class="col-12">
                            <div class="d-flex align-items-center gap-2">
                                <hr class="flex-fill" style="border-color:var(--border-color)">
                                <small style="font-size:.7rem;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--text-muted);white-space:nowrap">
                                    Días y horarios
                                </small>
                                <hr class="flex-fill" style="border-color:var(--border-color)">
                            </div>
                        </div>

                        <!-- Contenedor de filas de horario -->
                        <div class="col-12" id="horarios-container">
                            <!-- Primera fila siempre visible (no se puede eliminar) -->
                            <div class="horario-row row g-2 align-items-end mb-2">
                                <div class="col-sm-4">
                                    <label class="form-label">Día <span class="text-danger">*</span></label>
                                    <select class="form-select form-select-sm"
                                        name="horarios[0][dia_semana]" required>
                                        <option value="" disabled selected>Seleccionar...</option>
                                        <option value="1">Lunes</option>
                                        <option value="2">Martes</option>
                                        <option value="3">Miércoles</option>
                                        <option value="4">Jueves</option>
                                        <option value="5">Viernes</option>
                                    </select>
                                </div>
                                <div class="col-sm-3">
                                    <label class="form-label">Inicio <span class="text-danger">*</span></label>
                                    <input type="time" class="form-control form-control-sm"
                                        name="horarios[0][hora_inicio]" required>
                                </div>
                                <div class="col-sm-3">
                                    <label class="form-label">Fin <span class="text-danger">*</span></label>
                                    <input type="time" class="form-control form-control-sm"
                                        name="horarios[0][hora_fin]" required>
                                </div>
                                <div class="col-sm-2 d-flex justify-content-end">
                                    <!-- Espacio reservado para botón eliminar en filas adicionales -->
                                </div>
                            </div>
                        </div>

                        <!-- Botón agregar día -->
                        <div class="col-12">
                            <button type="button" class="btn btn-sm btn-outline-secondary"
                                id="btn-agregar-horario">
                                <i class="bi bi-plus-lg me-1"></i>Agregar otro día
                            </button>
                        </div>

                    </div>
                </div><!-- /modal-body -->

                <div class="modal-footer" style="border-color:var(--border-color);padding:16px 24px">
                    <button type="button" class="btn btn-outline-secondary btn-sm"
                        data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary btn-sm">
                        <i class="bi bi-check-lg me-1"></i>
                        <span id="btn-submit-label">Crear academia</span>
                    </button>
                </div>

            </form>

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
                    <i class="bi bi-trash"></i>
                </div>
                <h6 class="fw-bold mb-1" style="color:var(--text-heading)">
                    ¿Eliminar academia?
                </h6>
                <p style="color:var(--text-muted);font-size:.875rem;margin-bottom:4px">
                    Estás a punto de eliminar
                    <strong id="modal-nombre-academia" style="color:var(--text-heading)"></strong>.
                </p>
                <p class="mb-0" style="color:var(--color-danger);font-size:.8rem;font-weight:600">
                    Se eliminarán también todos sus horarios y registros de asistencia.
                </p>
            </div>
            <div class="modal-footer border-0 pt-0 d-flex gap-2 px-4 pb-4">
                <button type="button" class="btn btn-outline-secondary btn-sm flex-fill"
                    data-bs-dismiss="modal">Cancelar</button>
                <a href="#" id="btn-confirmar-eliminar"
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

        // ── Filtros ───────────────────────────────────
        const filterEstado = document.getElementById('filter-estado');
        const buscar = document.getElementById('buscar-academia');

        function filtrar() {
            const estado = filterEstado.value;
            const q = buscar.value.toLowerCase().trim();
            document.querySelectorAll('#tabla-body tr[data-nombre]').forEach(tr => {
                const matchEstado = !estado || tr.dataset.activa === estado;
                const matchNombre = !q || tr.dataset.nombre.includes(q);
                tr.style.display = matchEstado && matchNombre ? '' : 'none';
            });
        }

        filterEstado.addEventListener('change', filtrar);
        buscar.addEventListener('input', filtrar);

        // ── Contador de filas de horario ──────────────
        let horarioIdx = 1;

        // ── Agregar fila de horario ───────────────────
        document.getElementById('btn-agregar-horario').addEventListener('click', function() {
            const idx = horarioIdx++;
            const fila = document.createElement('div');
            fila.className = 'horario-row row g-2 align-items-end mb-2';
            fila.innerHTML = `
            <div class="col-sm-4">
                <select class="form-select form-select-sm" name="horarios[${idx}][dia_semana]" required>
                    <option value="" disabled selected>Seleccionar...</option>
                    <option value="1">Lunes</option>
                    <option value="2">Martes</option>
                    <option value="3">Miércoles</option>
                    <option value="4">Jueves</option>
                    <option value="5">Viernes</option>
                </select>
            </div>
            <div class="col-sm-3">
                <input type="time" class="form-control form-control-sm"
                       name="horarios[${idx}][hora_inicio]" required>
            </div>
            <div class="col-sm-3">
                <input type="time" class="form-control form-control-sm"
                       name="horarios[${idx}][hora_fin]" required>
            </div>
            <div class="col-sm-2 d-flex justify-content-end">
                <button type="button"
                        class="btn btn-sm btn-outline-danger border-0"
                        onclick="this.closest('.horario-row').remove()"
                        title="Quitar este horario">
                    <i class="bi bi-x-lg"></i>
                </button>
            </div>`;
            document.getElementById('horarios-container').appendChild(fila);
        });

        // ── Abrir modal en modo edición ───────────────
        window.abrirEditar = function(academia) {

            // Cambia título y botón
            document.getElementById('modal-titulo').textContent = 'Editar academia';
            document.getElementById('btn-submit-label').textContent = 'Guardar cambios';

            // Cambia action del form al endpoint de actualizar
            document.getElementById('form-academia').action =
                '<?= site_url('academias/actualizar') ?>/' + academia.id;

            // Rellena campos
            document.getElementById('field-id').value = academia.id;
            document.getElementById('field-nombre').value = academia.nombre;
            document.getElementById('field-descripcion').value = academia.descripcion ?? '';
            document.getElementById('field-profesor').value = academia.profesorId ?? '';
            document.getElementById('field-sala').value = academia.sala ?? '';
            document.getElementById('field-cupos').value = academia.cupos;
            document.getElementById('field-activa').checked = academia.activa === '1';

            // Reconstruye filas de horario
            const container = document.getElementById('horarios-container');
            container.innerHTML = '';
            horarioIdx = 0;

            academia.horarios.forEach(function(h, idx) {
                const esPrimero = idx === 0;
                const fila = document.createElement('div');
                fila.className = 'horario-row row g-2 align-items-end mb-2';

                const dias = ['', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes'];
                const opciones = dias.map((d, i) => i === 0 ? '' :
                    `<option value="${i}" ${h.dia_semana == i ? 'selected' : ''}>${d}</option>`
                ).join('');

                fila.innerHTML = `
                <div class="col-sm-4">
                    <label class="form-label">Día <span class="text-danger">*</span></label>
                    <select class="form-select form-select-sm"
                            name="horarios[${idx}][dia_semana]" required>
                        <option value="" disabled>Seleccionar...</option>
                        ${opciones}
                    </select>
                </div>
                <div class="col-sm-3">
                    <label class="form-label">Inicio <span class="text-danger">*</span></label>
                    <input type="time" class="form-control form-control-sm"
                           name="horarios[${idx}][hora_inicio]"
                           value="${h.hora_inicio}" required>
                </div>
                <div class="col-sm-3">
                    <label class="form-label">Fin <span class="text-danger">*</span></label>
                    <input type="time" class="form-control form-control-sm"
                           name="horarios[${idx}][hora_fin]"
                           value="${h.hora_fin}" required>
                </div>
                <div class="col-sm-2 d-flex align-items-end justify-content-end pb-1">
                    ${!esPrimero ? `<button type="button" class="btn btn-sm btn-outline-danger border-0"
                        onclick="this.closest('.horario-row').remove()">
                        <i class="bi bi-x-lg"></i></button>` : ''}
                </div>`;
                container.appendChild(fila);
                horarioIdx = idx + 1;
            });

            new bootstrap.Modal(document.getElementById('modal-nueva')).show();
        };

        // Resetear modal al cerrar (vuelve a modo "crear")
        document.getElementById('modal-nueva').addEventListener('hidden.bs.modal', function() {
            document.getElementById('form-academia').reset();
            document.getElementById('form-academia').action = '<?= site_url('academias/guardar') ?>';
            document.getElementById('modal-titulo').textContent = 'Nueva academia';
            document.getElementById('btn-submit-label').textContent = 'Crear academia';
            document.getElementById('field-id').value = '';
            document.getElementById('field-activa').checked = true;

            // Deja solo la primera fila de horario limpia
            const container = document.getElementById('horarios-container');
            const filas = container.querySelectorAll('.horario-row');
            filas.forEach((f, i) => {
                if (i > 0) f.remove();
            });
            filas[0]?.querySelectorAll('select, input').forEach(el => el.value = '');
            horarioIdx = 1;
        });

        // ── Confirmar eliminación ─────────────────────
        window.confirmarEliminar = function(id, nombre) {
            document.getElementById('modal-nombre-academia').textContent = nombre;
            document.getElementById('btn-confirmar-eliminar').href =
                '<?= site_url('academias/eliminar') ?>/' + id;
            new bootstrap.Modal(document.getElementById('modal-eliminar')).show();
        };

    })();
</script>

<?= $this->endSection() ?>