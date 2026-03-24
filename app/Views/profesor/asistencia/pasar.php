<?= $this->extend($layout) ?>

<?= $this->section('content') ?>

<?php
// ──────────────────────────────────────────────────────────────
// DATOS FICTICIOS — reemplazar con variables del controlador
// ──────────────────────────────────────────────────────────────

// La academia activa (la que el profesor eligió o la única del día)
$academia = [
    'id'        => 1,
    'nombre'    => 'Fútbol',
    'sala'      => 'Cancha principal',
    'horario'   => 'Lunes 15:00 – 16:30',
];

// Otras academias del profesor hoy (para el selector)
// Si solo tiene una, este array vendría vacío y se oculta el selector
$academias_hoy = [
    ['id' => 1, 'nombre' => 'Fútbol',    'horario' => 'Lunes 15:00 – 16:30'],
    ['id' => 3, 'nombre' => 'Básquetbol', 'horario' => 'Lunes 16:30 – 17:30'],
];

// Alumnos inscritos en esta academia
// 'presente' => true por defecto — el controlador siempre lo envía en true
// Si la sesión ya fue guardada antes, el controlador carga el estado real
$alumnos = [
    ['id' => 1,  'nombre' => 'Benjamín',   'apellido' => 'Rojas',     'curso' => '7°A', 'presente' => true],
    ['id' => 2,  'nombre' => 'Sofía',       'apellido' => 'Muñoz',    'curso' => '7°B', 'presente' => true],
    ['id' => 3,  'nombre' => 'Matías',      'apellido' => 'Pérez',    'curso' => '8°A', 'presente' => true],
    ['id' => 4,  'nombre' => 'Valentina',   'apellido' => 'Soto',     'curso' => '8°B', 'presente' => true],
    ['id' => 5,  'nombre' => 'Diego',       'apellido' => 'Castro',   'curso' => '7°A', 'presente' => true],
    ['id' => 6,  'nombre' => 'Isidora',     'apellido' => 'Vargas',   'curso' => '8°A', 'presente' => true],
    ['id' => 7,  'nombre' => 'Sebastián',   'apellido' => 'Morales',  'curso' => '7°B', 'presente' => true],
    ['id' => 8,  'nombre' => 'Catalina',    'apellido' => 'Herrera',  'curso' => '8°B', 'presente' => true],
    ['id' => 9,  'nombre' => 'Tomás',       'apellido' => 'Díaz',     'curso' => '7°A', 'presente' => true],
    ['id' => 10, 'nombre' => 'Antonia',     'apellido' => 'González', 'curso' => '8°A', 'presente' => true],
    ['id' => 11, 'nombre' => 'Felipe',      'apellido' => 'Torres',   'curso' => '7°B', 'presente' => true],
    ['id' => 12, 'nombre' => 'Martina',     'apellido' => 'Fuentes',  'curso' => '8°B', 'presente' => true],
];

// Si la sesión ya existe (asistencia ya fue guardada hoy), el controlador
// envía el id. Null = sesión nueva.
$sesion_id = null; // o el id de asistencia_sesiones si ya existe

// Fecha de hoy — el controlador la pasa
$fecha_hoy = date('Y-m-d');
$fecha_display = date('l d \d\e F \d\e Y');
// ──────────────────────────────────────────────────────────────
?>

<main id="page-content">

    <!-- Page header -->
    <div class="d-flex align-items-start justify-content-between mb-4">
        <div>
            <h1 class="page-title">Pasar asistencia</h1>
            <p class="page-subtitle"><?= $fecha_display ?></p>
        </div>
        <a href="<?= site_url('profesor/dashboard') ?>" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-arrow-left me-1"></i>Volver
        </a>
    </div>

    <div class="row g-3">

        <!-- ══════════════════════════════════════
             COLUMNA IZQUIERDA — Info + contador
        ═══════════════════════════════════════ -->
        <div class="col-lg-4 d-flex flex-column gap-3">

            <!-- Info academia -->
            <div class="card">
                <div class="card-body">

                    <!-- Selector si tiene más de una academia hoy -->
                    <!--                     <?php if (count($academias_hoy) > 1): ?>
                        <label class="form-label" for="selector-academia">Academia</label>
                        <select class="form-select form-select-sm mb-3"
                            id="selector-academia"
                            onchange="window.location.href='<?= site_url('asistencia/pasar/') ?>' + this.value">
                            <?php foreach ($academias_hoy as $ah): ?>
                                <option value="<?= $ah['id'] ?>"
                                    <?= $ah['id'] == $academia['id'] ? 'selected' : '' ?>>
                                    <?= esc($ah['nombre']) ?> — <?= esc($ah['horario']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    <?php endif; ?> -->

                    <!-- Nombre academia -->
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <div class="d-flex align-items-center justify-content-center flex-shrink-0
                                    bg-primary bg-opacity-10 text-primary"
                            style="width:42px;height:42px;border-radius:11px;font-size:1.1rem">
                            <i class="bi bi-mortarboard"></i>
                        </div>
                        <div>
                            <div class="fw-bold" style="font-size:1rem;color:var(--text-heading)">
                                <?= esc($academia['nombre']) ?>
                            </div>
                            <div style="font-size:.78rem;color:var(--text-muted)">
                                <i class="bi bi-clock me-1"></i><?= esc($academia['horario']) ?>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex align-items-center gap-2"
                        style="font-size:.8rem;color:var(--text-muted);padding-top:12px;border-top:1px solid var(--border-color)">
                        <i class="bi bi-geo-alt"></i>
                        <?= esc($academia['sala']) ?>
                    </div>

                </div>
            </div><!-- /info academia -->

            <!-- Contador en tiempo real -->
            <div class="card">
                <div class="card-header">
                    <span><i class="bi bi-people me-2 text-accent"></i>Resumen</span>
                </div>
                <div class="card-body p-0">

                    <div class="d-flex align-items-center justify-content-between px-4 py-3"
                        style="border-bottom:1px solid var(--border-color)">
                        <span style="font-size:.82rem;color:var(--text-muted)">Total alumnos</span>
                        <span class="fw-bold" style="font-family:'Lato',sans-serif;color:var(--text-heading)">
                            <?= count($alumnos) ?>
                        </span>
                    </div>

                    <div class="d-flex align-items-center justify-content-between px-4 py-3"
                        style="border-bottom:1px solid var(--border-color)">
                        <span style="font-size:.82rem;color:var(--text-muted)">Presentes</span>
                        <span class="fw-bold" id="cnt-presentes"
                            style="font-family:'Lato',sans-serif;color:var(--color-success)">
                            <?= count($alumnos) ?>
                        </span>
                    </div>

                    <div class="d-flex align-items-center justify-content-between px-4 py-3"
                        style="border-bottom:1px solid var(--border-color)">
                        <span style="font-size:.82rem;color:var(--text-muted)">Ausentes</span>
                        <span class="fw-bold" id="cnt-ausentes"
                            style="font-family:'Lato',sans-serif;color:var(--color-danger)">
                            0
                        </span>
                    </div>

                    <!-- Barra de asistencia -->
                    <div class="px-4 py-3">
                        <div class="d-flex justify-content-between mb-1">
                            <small style="color:var(--text-muted)">Asistencia</small>
                            <small class="fw-bold" id="cnt-pct"
                                style="color:var(--text-heading)">100%</small>
                        </div>
                        <div class="progress" style="height:6px">
                            <div class="progress-bar bg-success" id="barra-asistencia"
                                style="width:100%;transition:width .3s ease"
                                role="progressbar"></div>
                        </div>
                    </div>

                </div>
            </div><!-- /contador -->

            <!-- Aviso si la sesión ya fue guardada -->
            <?php if ($sesion_id): ?>
                <div class="alert alert-info d-flex align-items-start gap-2 mb-0" role="alert"
                    style="font-size:.82rem">
                    <i class="bi bi-info-circle-fill mt-1 flex-shrink-0"></i>
                    <div>
                        <strong>Asistencia ya registrada.</strong><br>
                        Puedes modificarla y guardar de nuevo.
                    </div>
                </div>
            <?php endif; ?>

        </div><!-- /col izquierda -->


        <!-- ══════════════════════════════════════
             COLUMNA DERECHA — Lista de alumnos
        ═══════════════════════════════════════ -->
        <div class="col-lg-8">
            <div class="card">

                <div class="card-header flex-wrap gap-2">
                    <span>
                        <i class="bi bi-clipboard-check me-2 text-accent"></i>Lista de alumnos
                    </span>
                    <div class="d-flex align-items-center gap-2 ms-auto">
                        <!-- Marcar todos presente / ausente -->
                        <button class="btn btn-sm btn-outline-secondary"
                            onclick="marcarTodos(true)" title="Todos presentes">
                            <i class="bi bi-check-all me-1"></i>Todos presentes
                        </button>
                        <button class="btn btn-sm btn-outline-secondary"
                            onclick="marcarTodos(false)" title="Todos ausentes">
                            <i class="bi bi-x-lg me-1"></i>Todos ausentes
                        </button>
                    </div>
                </div>

                <!-- Búsqueda rápida -->
                <div class="px-4 pt-3 pb-2" style="border-bottom:1px solid var(--border-color)">
                    <div class="input-group input-group-sm">
                        <span class="input-group-text"
                            style="background:var(--input-bg);border-color:var(--border-color)">
                            <i class="bi bi-search" style="color:var(--text-muted)"></i>
                        </span>
                        <input type="text" class="form-control"
                            id="buscar-alumno"
                            placeholder="Buscar alumno..."
                            style="background:var(--input-bg)">
                    </div>
                </div>

                <!-- Lista -->
                <form id="form-asistencia"
                    action="<?= site_url('asistencia/guardar') ?>"
                    method="post">
                    <?= csrf_field() ?>
                    <input type="hidden" name="academia_id" value="<?= $academia['id'] ?>">
                    <input type="hidden" name="fecha" value="<?= $fecha_hoy ?>">
                    <?php if ($sesion_id): ?>
                        <input type="hidden" name="sesion_id" value="<?= $sesion_id ?>">
                    <?php endif; ?>

                    <div id="lista-alumnos">
                        <?php foreach ($alumnos as $idx => $alumno):
                            $isLast = $idx === array_key_last($alumnos);
                        ?>
                            <div class="alumno-row d-flex align-items-center gap-3 px-4 py-3"
                                style="<?= !$isLast ? 'border-bottom:1px solid var(--border-color)' : '' ?>;transition:background .15s"
                                data-nombre="<?= strtolower($alumno['nombre'] . ' ' . $alumno['apellido']) ?>">

                                <!-- Avatar inicial -->
                                <div class="user-avatar flex-shrink-0"
                                    style="width:36px;height:36px;font-size:.8rem;border-radius:50%">
                                    <?= strtoupper(substr($alumno['nombre'], 0, 1) . substr($alumno['apellido'], 0, 1)) ?>
                                </div>

                                <!-- Nombre -->
                                <div class="flex-fill">
                                    <div class="fw-semibold alumno-nombre"
                                        style="font-size:.875rem;color:var(--text-heading)">
                                        <?= esc($alumno['apellido']) ?>, <?= esc($alumno['nombre']) ?>
                                    </div>
                                    <div style="font-size:.75rem;color:var(--text-muted)">
                                        <?= esc($alumno['curso']) ?>
                                    </div>
                                </div>

                                <!-- Estado — el núcleo de la vista -->
                                <div class="d-flex align-items-center gap-2 flex-shrink-0">

                                    <!-- Input hidden que envía el valor real al controlador -->
                                    <input type="hidden"
                                        name="asistencia[<?= $alumno['id'] ?>]"
                                        id="val-<?= $alumno['id'] ?>"
                                        value="<?= $alumno['presente'] ? '1' : '0' ?>">

                                    <!-- Botón toggle visible -->
                                    <button type="button"
                                        class="btn btn-sm btn-toggle-asistencia <?= $alumno['presente'] ? 'btn-success' : 'btn-danger' ?>"
                                        id="btn-<?= $alumno['id'] ?>"
                                        onclick="toggleAlumno(<?= $alumno['id'] ?>)"
                                        style="min-width:110px;border-radius:8px">
                                        <?php if ($alumno['presente']): ?>
                                            <i class="bi bi-check-circle me-1"></i>Presente
                                        <?php else: ?>
                                            <i class="bi bi-x-circle me-1"></i>Ausente
                                        <?php endif; ?>
                                    </button>

                                </div>

                            </div>
                        <?php endforeach; ?>
                    </div>

                    <!-- Footer con campo observación y guardar -->
                    <div class="card-footer d-flex flex-column gap-3">

                        <div>
                            <label class="form-label" for="observacion">
                                Observación <span style="font-weight:400;color:var(--text-muted)">(opcional)</span>
                            </label>
                            <textarea class="form-control form-control-sm"
                                id="observacion" name="observacion"
                                rows="2"
                                placeholder="Ej: Lluvia, actividad escolar, etc."><?= old('observacion') ?></textarea>
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <a href="<?= site_url('profesor/dashboard') ?>"
                                class="btn btn-outline-secondary btn-sm">Cancelar</a>
                            <button type="submit" class="btn btn-primary btn-sm" id="btn-guardar">
                                <i class="bi bi-check-lg me-1"></i>Guardar asistencia
                            </button>
                        </div>

                    </div>

                </form>

            </div>
        </div><!-- /col derecha -->




    </div><!-- /row -->

</main>


<!-- ═══════════════════════════════════════════════
     JS LOCAL
════════════════════════════════════════════════ -->
<script>
    (function() {

        const total = <?= count($alumnos) ?>;

        // ── Estado en memoria ─────────────────────────
        // Inicializa leyendo los hidden inputs (refleja estado del servidor)
        const estado = {};
        document.querySelectorAll('input[id^="val-"]').forEach(inp => {
            const id = inp.id.replace('val-', '');
            estado[id] = inp.value === '1';
        });

        // ── Toggle individual ─────────────────────────
        window.toggleAlumno = function(id) {
            estado[id] = !estado[id];
            aplicarEstado(id);
            actualizarContadores();
        };

        function aplicarEstado(id) {
            const presente = estado[id];
            const btn = document.getElementById('btn-' + id);
            const val = document.getElementById('val-' + id);
            const row = btn.closest('.alumno-row');

            val.value = presente ? '1' : '0';

            btn.className = 'btn btn-sm btn-toggle-asistencia ' +
                (presente ? 'btn-success' : 'btn-danger');
            btn.innerHTML = presente ?
                '<i class="bi bi-check-circle me-1"></i>Presente' :
                '<i class="bi bi-x-circle me-1"></i>Ausente';

            row.style.background = presente ? '' : 'color-mix(in srgb, var(--color-danger) 5%, transparent)';
        }

        // ── Marcar todos ──────────────────────────────
        window.marcarTodos = function(presente) {
            Object.keys(estado).forEach(id => {
                estado[id] = presente;
                aplicarEstado(id);
            });
            actualizarContadores();
        };

        // ── Contadores ────────────────────────────────
        function actualizarContadores() {
            const presentes = Object.values(estado).filter(Boolean).length;
            const ausentes = total - presentes;
            const pct = total > 0 ? Math.round(presentes / total * 100) : 0;

            document.getElementById('cnt-presentes').textContent = presentes;
            document.getElementById('cnt-ausentes').textContent = ausentes;
            document.getElementById('cnt-pct').textContent = pct + '%';

            const barra = document.getElementById('barra-asistencia');
            barra.style.width = pct + '%';
            barra.className = 'progress-bar ' +
                (pct >= 75 ? 'bg-success' : pct >= 50 ? 'bg-warning' : 'bg-danger');
        }

        // ── Búsqueda ──────────────────────────────────
        document.getElementById('buscar-alumno').addEventListener('input', function() {
            const q = this.value.toLowerCase().trim();
            document.querySelectorAll('.alumno-row').forEach(row => {
                row.style.display = (!q || row.dataset.nombre.includes(q)) ? '' : 'none';
            });
        });

        // ── Guardar: confirma si hay muchos ausentes ──
        document.getElementById('form-asistencia').addEventListener('submit', function(e) {
            const ausentes = Object.values(estado).filter(v => !v).length;
            const pct = Math.round((total - ausentes) / total * 100);

            if (ausentes > 0 && pct < 50) {
                e.preventDefault();
                if (confirm(`Hay ${ausentes} ausentes (${100 - pct}% del curso). ¿Confirmas el registro?`)) {
                    this.submit();
                }
            }
        });

    })();
</script>

<?= $this->endSection() ?>