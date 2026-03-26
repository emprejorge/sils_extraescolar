<?= $this->extend($layout) ?>

<?= $this->section('content') ?>

<?php
// ──────────────────────────────────────────────────────────────
// DATOS FICTICIOS — reemplazar con variables del controlador
// ──────────────────────────────────────────────────────────────

// Academia a la que se asignan alumnos
// Viene del controlador: $this->academiaModel->getConDetalle($id)
$academia = [
    'id'     => 1,
    'nombre' => 'Fútbol',
    'sala'   => 'Cancha principal',
    'cupos'  => 20,
];

// Cursos del colegio ordenados por 'orden'
// SELECT id, code, nombre, orden FROM cursos ORDER BY orden ASC
$cursos = [
    ['id' => 1,  'code' => '1BA', 'nombre' => '1° Básico A',  'orden' => 10],
    ['id' => 2,  'code' => '1BB', 'nombre' => '1° Básico B',  'orden' => 20],
    ['id' => 3,  'code' => '2BA', 'nombre' => '2° Básico A',  'orden' => 30],
    ['id' => 4,  'code' => '2BB', 'nombre' => '2° Básico B',  'orden' => 40],
    ['id' => 5,  'code' => '3BA', 'nombre' => '3° Básico A',  'orden' => 50],
    ['id' => 6,  'code' => '4BA', 'nombre' => '4° Básico A',  'orden' => 60],
    ['id' => 7,  'code' => '5BA', 'nombre' => '5° Básico A',  'orden' => 70],
    ['id' => 8,  'code' => '6BA', 'nombre' => '6° Básico A',  'orden' => 80],
    ['id' => 9,  'code' => '7MA', 'nombre' => '7° Básico A',  'orden' => 90],
    ['id' => 10, 'code' => '7MB', 'nombre' => '7° Básico B',  'orden' => 100],
    ['id' => 11, 'code' => '8MA', 'nombre' => '8° Básico A',  'orden' => 110],
    ['id' => 12, 'code' => '8MB', 'nombre' => '8° Básico B',  'orden' => 120],
    ['id' => 13, 'code' => '1MA', 'nombre' => '1° Medio A',   'orden' => 130],
    ['id' => 14, 'code' => '1MB', 'nombre' => '1° Medio B',   'orden' => 140],
    ['id' => 15, 'code' => '2MA', 'nombre' => '2° Medio A',   'orden' => 150],
    ['id' => 16, 'code' => '3MA', 'nombre' => '3° Medio A',   'orden' => 160],
    ['id' => 17, 'code' => '4MA', 'nombre' => '4° Medio A',   'orden' => 170],
];

// IDs de alumnos ya inscritos en esta academia
// SELECT alumno_id FROM academia_alumno WHERE academia_id = $academiaId
$inscritos_ids = [3, 7, 12, 18, 25];

// JSON con TODOS los alumnos del colegio
// SELECT a.id, a.nombre, a.apellido, c.id AS curso_id, c.nombre AS curso_nombre, c.code AS curso_code
// FROM alumnos a
// JOIN cursos c ON c.id = a.curso_id
// WHERE a.activo = 1
// ORDER BY c.orden ASC, a.apellido ASC, a.nombre ASC
$alumnos_json = json_encode([
    // curso_id 9 — 7° Básico A
    ['id' =>  1, 'nombre' => 'Benjamín',  'apellido' => 'Rojas',     'curso_id' => 9,  'curso_nombre' => '7° Básico A', 'curso_code' => '7MA'],
    ['id' =>  2, 'nombre' => 'Catalina',  'apellido' => 'Muñoz',     'curso_id' => 9,  'curso_nombre' => '7° Básico A', 'curso_code' => '7MA'],
    ['id' =>  3, 'nombre' => 'Diego',     'apellido' => 'Castro',    'curso_id' => 9,  'curso_nombre' => '7° Básico A', 'curso_code' => '7MA'],
    ['id' =>  4, 'nombre' => 'Fernanda',  'apellido' => 'Soto',      'curso_id' => 9,  'curso_nombre' => '7° Básico A', 'curso_code' => '7MA'],
    ['id' =>  5, 'nombre' => 'Gonzalo',   'apellido' => 'Pérez',     'curso_id' => 9,  'curso_nombre' => '7° Básico A', 'curso_code' => '7MA'],
    // curso_id 10 — 7° Básico B
    ['id' =>  6, 'nombre' => 'Isidora',   'apellido' => 'Vargas',    'curso_id' => 10, 'curso_nombre' => '7° Básico B', 'curso_code' => '7MB'],
    ['id' =>  7, 'nombre' => 'Joaquín',   'apellido' => 'Herrera',   'curso_id' => 10, 'curso_nombre' => '7° Básico B', 'curso_code' => '7MB'],
    ['id' =>  8, 'nombre' => 'Karla',     'apellido' => 'Díaz',      'curso_id' => 10, 'curso_nombre' => '7° Básico B', 'curso_code' => '7MB'],
    ['id' =>  9, 'nombre' => 'Luis',      'apellido' => 'González',  'curso_id' => 10, 'curso_nombre' => '7° Básico B', 'curso_code' => '7MB'],
    ['id' => 10, 'nombre' => 'Martina',   'apellido' => 'Torres',    'curso_id' => 10, 'curso_nombre' => '7° Básico B', 'curso_code' => '7MB'],
    // curso_id 11 — 8° Básico A
    ['id' => 11, 'nombre' => 'Nicolás',   'apellido' => 'Fuentes',   'curso_id' => 11, 'curso_nombre' => '8° Básico A', 'curso_code' => '8MA'],
    ['id' => 12, 'nombre' => 'Olivia',    'apellido' => 'Morales',   'curso_id' => 11, 'curso_nombre' => '8° Básico A', 'curso_code' => '8MA'],
    ['id' => 13, 'nombre' => 'Pablo',     'apellido' => 'Navarro',   'curso_id' => 11, 'curso_nombre' => '8° Básico A', 'curso_code' => '8MA'],
    ['id' => 14, 'nombre' => 'Renata',    'apellido' => 'Alvarado',  'curso_id' => 11, 'curso_nombre' => '8° Básico A', 'curso_code' => '8MA'],
    ['id' => 15, 'nombre' => 'Sebastián', 'apellido' => 'Campos',    'curso_id' => 11, 'curso_nombre' => '8° Básico A', 'curso_code' => '8MA'],
    // curso_id 12 — 8° Básico B
    ['id' => 16, 'nombre' => 'Tamara',    'apellido' => 'Espinoza',  'curso_id' => 12, 'curso_nombre' => '8° Básico B', 'curso_code' => '8MB'],
    ['id' => 17, 'nombre' => 'Ulises',    'apellido' => 'Ramírez',   'curso_id' => 12, 'curso_nombre' => '8° Básico B', 'curso_code' => '8MB'],
    ['id' => 18, 'nombre' => 'Valentina', 'apellido' => 'Ríos',      'curso_id' => 12, 'curso_nombre' => '8° Básico B', 'curso_code' => '8MB'],
    ['id' => 19, 'nombre' => 'Williams',  'apellido' => 'Moya',      'curso_id' => 12, 'curso_nombre' => '8° Básico B', 'curso_code' => '8MB'],
    ['id' => 20, 'nombre' => 'Ximena',    'apellido' => 'Pizarro',   'curso_id' => 12, 'curso_nombre' => '8° Básico B', 'curso_code' => '8MB'],
    // curso_id 13 — 1° Medio A
    ['id' => 21, 'nombre' => 'Agustín',   'apellido' => 'Bravo',     'curso_id' => 13, 'curso_nombre' => '1° Medio A',  'curso_code' => '1MA'],
    ['id' => 22, 'nombre' => 'Bárbara',   'apellido' => 'Sepúlveda', 'curso_id' => 13, 'curso_nombre' => '1° Medio A',  'curso_code' => '1MA'],
    ['id' => 23, 'nombre' => 'Cristóbal', 'apellido' => 'Vega',      'curso_id' => 13, 'curso_nombre' => '1° Medio A',  'curso_code' => '1MA'],
    ['id' => 24, 'nombre' => 'Daniela',   'apellido' => 'Ortiz',     'curso_id' => 13, 'curso_nombre' => '1° Medio A',  'curso_code' => '1MA'],
    ['id' => 25, 'nombre' => 'Emilio',    'apellido' => 'Lagos',     'curso_id' => 13, 'curso_nombre' => '1° Medio A',  'curso_code' => '1MA'],
]);
// ──────────────────────────────────────────────────────────────
?>

<main id="page-content">

    <!-- Page header -->
    <div class="d-flex align-items-start justify-content-between mb-4">
        <div>
            <h1 class="page-title">Asignar alumnos</h1>
            <p class="page-subtitle">
                Academia: <strong style="color:var(--text-heading)"><?= esc($academia['nombre']) ?></strong>
                &mdash; <?= esc($academia['sala']) ?>
            </p>
        </div>
        <a href="<?= site_url('academias') ?>" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-arrow-left me-1"></i>Volver
        </a>
    </div>


    <div class="row g-3">

        <!-- ══════════════════════════════════════
             COLUMNA IZQUIERDA — Resumen + inscritos
        ═══════════════════════════════════════ -->
        <div class="col-lg-4 d-flex flex-column gap-3">

            <!-- Cupos -->
            <div class="card">
                <div class="card-header">
                    <span><i class="bi bi-people me-2 text-accent"></i>Cupos</span>
                </div>
                <div class="card-body p-0">

                    <div class="d-flex align-items-center justify-content-between px-4 py-3"
                        style="border-bottom:1px solid var(--border-color)">
                        <span style="font-size:.82rem;color:var(--text-muted)">Capacidad</span>
                        <span class="fw-bold" style="color:var(--text-heading)">
                            <?= $academia['cupos'] ?>
                        </span>
                    </div>

                    <div class="d-flex align-items-center justify-content-between px-4 py-3"
                        style="border-bottom:1px solid var(--border-color)">
                        <span style="font-size:.82rem;color:var(--text-muted)">Ya inscritos</span>
                        <span class="fw-bold" id="cnt-inscritos-actuales"
                            style="color:var(--text-heading)">
                            <?= count($inscritos_ids) ?>
                        </span>
                    </div>

                    <div class="d-flex align-items-center justify-content-between px-4 py-3"
                        style="border-bottom:1px solid var(--border-color)">
                        <span style="font-size:.82rem;color:var(--text-muted)">Seleccionados ahora</span>
                        <span class="fw-bold" id="cnt-seleccionados"
                            style="color:var(--accent)">0</span>
                    </div>

                    <div class="px-4 py-3">
                        <div class="d-flex justify-content-between mb-1">
                            <small style="color:var(--text-muted)">Ocupación</small>
                            <small class="fw-bold" id="cnt-pct-cupo"
                                style="color:var(--text-heading)">
                                <?= round(count($inscritos_ids) / $academia['cupos'] * 100) ?>%
                            </small>
                        </div>
                        <div class="progress" style="height:6px">
                            <div class="progress-bar" id="barra-cupo"
                                style="width:<?= round(count($inscritos_ids) / $academia['cupos'] * 100) ?>%;transition:width .3s"
                                role="progressbar"></div>
                        </div>
                    </div>

                </div>
            </div><!-- /cupos -->

            <!-- Lista de ya inscritos -->
            <div class="card flex-fill">
                <div class="card-header">
                    <span><i class="bi bi-person-check me-2 text-accent"></i>Inscritos actualmente</span>
                    <span class="badge bg-success bg-opacity-10 text-success" id="badge-inscritos">
                        <?= count($inscritos_ids) ?>
                    </span>
                </div>
                <div class="card-body p-0" id="lista-inscritos-actual" style="max-height:380px;overflow-y:auto">
                    <!-- Se renderiza con JS desde el JSON -->
                </div>
            </div>

        </div><!-- /col izquierda -->


        <!-- ══════════════════════════════════════
             COLUMNA DERECHA — Selector de alumnos
        ═══════════════════════════════════════ -->
        <div class="col-lg-8">
            <div class="card">

                <div class="card-header flex-wrap gap-2">
                    <span><i class="bi bi-person-plus me-2 text-accent"></i>Seleccionar alumnos</span>
                    <div class="d-flex align-items-center gap-2 ms-auto flex-wrap">

                        <!-- Filtro por curso -->
                        <select class="form-select form-select-sm" id="filtro-curso" style="width:auto;max-width:200px">
                            <option value="">Todos los cursos</option>
                            <?php foreach ($cursos as $c): ?>
                                <option value="<?= $c['id'] ?>">
                                    <?= esc($c['nombre']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>

                        <!-- Búsqueda por nombre -->
                        <div class="input-group input-group-sm" style="width:190px">
                            <span class="input-group-text"
                                style="background:var(--input-bg);border-color:var(--border-color)">
                                <i class="bi bi-search" style="color:var(--text-muted)"></i>
                            </span>
                            <input type="text" class="form-control border-start-0 ps-0"
                                id="buscar-alumno" placeholder="Buscar alumno..."
                                style="background:var(--input-bg)">
                        </div>

                    </div>
                </div>

                <!-- Acciones rápidas -->
                <div class="d-flex align-items-center gap-2 px-4 py-2"
                    style="border-bottom:1px solid var(--border-color)">
                    <button type="button" class="btn btn-sm btn-outline-secondary"
                        id="btn-seleccionar-visibles">
                        <i class="bi bi-check-all me-1"></i>Seleccionar visibles
                    </button>
                    <button type="button" class="btn btn-sm btn-outline-secondary"
                        id="btn-deseleccionar-todo">
                        <i class="bi bi-x-lg me-1"></i>Limpiar selección
                    </button>
                    <span style="font-size:.78rem;color:var(--text-muted);margin-left:4px"
                        id="label-visibles"></span>
                </div>

                <!-- Tabla de alumnos -->
                <div class="card-body p-0" style="max-height:460px;overflow-y:auto">
                    <table class="table table-hover mb-0" id="tabla-alumnos">
                        <thead style="position:sticky;top:0;z-index:1;background:var(--card-bg)">
                            <tr>
                                <th style="width:40px">
                                    <input class="form-check-input" type="checkbox" id="check-all-visible">
                                </th>
                                <th>Alumno</th>
                                <th class="d-none d-md-table-cell">Curso</th>
                                <th class="text-center">Estado</th>
                            </tr>
                        </thead>
                        <tbody id="tabla-body-alumnos">
                            <!-- Se renderiza con JS -->
                        </tbody>
                    </table>
                </div>

                <!-- Footer: guardar -->
                <div class="card-footer d-flex align-items-center justify-content-between gap-2 flex-wrap">
                    <small style="color:var(--text-muted);font-size:.78rem" id="footer-label">
                        Selecciona alumnos para inscribir o desinscribir
                    </small>
                    <div class="d-flex gap-2">
                        <a href="<?= site_url('academias') ?>"
                            class="btn btn-outline-secondary btn-sm">Cancelar</a>
                        <button type="button" class="btn btn-primary btn-sm"
                            id="btn-guardar" disabled>
                            <i class="bi bi-check-lg me-1"></i>Guardar cambios
                        </button>
                    </div>
                </div>

            </div>
        </div><!-- /col derecha -->

    </div><!-- /row -->

</main>


<!-- ═══════════════════════════════════════════════
     JS LOCAL
════════════════════════════════════════════════ -->
<script>
    (function() {

        // ── Datos desde PHP ───────────────────────────
        const ACADEMIA_ID = <?= $academia['id'] ?>;
        const CUPOS = <?= $academia['cupos'] ?>;
        const alumnos = <?= $alumnos_json ?>;

        // Set de IDs ya inscritos en BD (estado inicial)
        const inscritosOriginales = new Set(<?= json_encode($inscritos_ids) ?>);

        // Set de IDs seleccionados actualmente en la UI (se modifica al hacer click)
        const seleccionados = new Set(inscritosOriginales);

        // ── Referencias DOM ───────────────────────────
        const filtroCurso = document.getElementById('filtro-curso');
        const buscarAlumno = document.getElementById('buscar-alumno');
        const tablaBody = document.getElementById('tabla-body-alumnos');
        const checkAllVisible = document.getElementById('check-all-visible');
        const btnGuardar = document.getElementById('btn-guardar');
        const cntSelec = document.getElementById('cnt-seleccionados');
        const cntPct = document.getElementById('cnt-pct-cupo');
        const barraOcupacion = document.getElementById('barra-cupo');
        const footerLabel = document.getElementById('footer-label');
        const labelVisibles = document.getElementById('label-visibles');

        // ── Filtrar alumnos visibles ──────────────────
        function alumnosFiltrados() {
            const cursoId = filtroCurso.value;
            const texto = buscarAlumno.value.toLowerCase().trim();

            return alumnos.filter(a => {
                const matchCurso = !cursoId || a.curso_id == cursoId;
                const matchTexto = !texto ||
                    (a.nombre + ' ' + a.apellido).toLowerCase().includes(texto) ||
                    (a.apellido + ' ' + a.nombre).toLowerCase().includes(texto);
                return matchCurso && matchTexto;
            });
        }

        // ── Renderizar tabla ──────────────────────────
        function renderTabla() {
            const visibles = alumnosFiltrados();
            labelVisibles.textContent = visibles.length + ' alumno' + (visibles.length !== 1 ? 's' : '');

            if (visibles.length === 0) {
                tablaBody.innerHTML = `
                <tr>
                    <td colspan="4" class="text-center py-4"
                        style="color:var(--text-muted);font-size:.875rem">
                        <i class="bi bi-search d-block mb-1" style="font-size:1.5rem"></i>
                        Sin resultados para este filtro.
                    </td>
                </tr>`;
                checkAllVisible.checked = false;
                checkAllVisible.indeterminate = false;
                return;
            }

            tablaBody.innerHTML = visibles.map(a => {
                const estaSeleccionado = seleccionados.has(a.id);
                const eraInscrito = inscritosOriginales.has(a.id);

                // Badge de estado
                let estadoBadge = '';
                if (eraInscrito && estaSeleccionado) {
                    estadoBadge = `<span class="badge bg-success bg-opacity-10 text-success">Inscrito</span>`;
                } else if (eraInscrito && !estaSeleccionado) {
                    estadoBadge = `<span class="badge bg-danger bg-opacity-10 text-danger">Se quitará</span>`;
                } else if (!eraInscrito && estaSeleccionado) {
                    estadoBadge = `<span class="badge bg-primary bg-opacity-10 text-primary">Se agregará</span>`;
                } else {
                    estadoBadge = `<span style="color:var(--text-muted);font-size:.78rem">—</span>`;
                }

                return `
                <tr data-id="${a.id}"
                    style="cursor:pointer${eraInscrito && !estaSeleccionado ? ';background:color-mix(in srgb,var(--color-danger) 4%,transparent)' : estaSeleccionado && !eraInscrito ? ';background:color-mix(in srgb,var(--accent) 5%,transparent)' : ''}">
                    <td onclick="event.stopPropagation()">
                        <input class="form-check-input check-alumno"
                               type="checkbox"
                               value="${a.id}"
                               ${estaSeleccionado ? 'checked' : ''}>
                    </td>
                    <td>
                        <div class="d-flex align-items-center gap-2">
                            <div class="user-avatar flex-shrink-0"
                                 style="width:32px;height:32px;font-size:.7rem;border-radius:50%">
                                ${a.nombre[0]}${a.apellido[0]}
                            </div>
                            <span style="font-size:.875rem;color:var(--text-heading);font-weight:500">
                                ${a.apellido}, ${a.nombre}
                            </span>
                        </div>
                    </td>
                    <td class="d-none d-md-table-cell">
                        <span class="badge bg-secondary bg-opacity-10 text-secondary"
                              style="font-size:.72rem">${a.curso_nombre}</span>
                    </td>
                    <td class="text-center">${estadoBadge}</td>
                </tr>`;
            }).join('');

            // Click en toda la fila
            tablaBody.querySelectorAll('tr[data-id]').forEach(tr => {
                tr.addEventListener('click', function() {
                    const cb = this.querySelector('.check-alumno');
                    cb.checked = !cb.checked;
                    toggleAlumno(parseInt(this.dataset.id), cb.checked);
                });
                // Evitar doble toggle al hacer click directo en el checkbox
                tr.querySelector('.check-alumno').addEventListener('change', function(e) {
                    e.stopPropagation();
                    toggleAlumno(parseInt(tr.dataset.id), this.checked);
                });
            });

            actualizarCheckAll(visibles);
        }

        // ── Toggle alumno ─────────────────────────────
        function toggleAlumno(id, agregar) {
            if (agregar) {
                seleccionados.add(id);
            } else {
                seleccionados.delete(id);
            }
            actualizarContadores();
            renderTabla();
            renderInscritos();
        }

        // ── Check all visibles ────────────────────────
        checkAllVisible.addEventListener('change', function() {
            const visibles = alumnosFiltrados();
            visibles.forEach(a => {
                if (this.checked) seleccionados.add(a.id);
                else seleccionados.delete(a.id);
            });
            actualizarContadores();
            renderTabla();
            renderInscritos();
        });

        function actualizarCheckAll(visibles) {
            const totalVis = visibles.length;
            const selecVis = visibles.filter(a => seleccionados.has(a.id)).length;
            checkAllVisible.checked = totalVis > 0 && selecVis === totalVis;
            checkAllVisible.indeterminate = selecVis > 0 && selecVis < totalVis;
        }

        // ── Botones seleccionar / limpiar ─────────────
        document.getElementById('btn-seleccionar-visibles').addEventListener('click', () => {
            alumnosFiltrados().forEach(a => seleccionados.add(a.id));
            actualizarContadores();
            renderTabla();
            renderInscritos();
        });

        document.getElementById('btn-deseleccionar-todo').addEventListener('click', () => {
            seleccionados.clear();
            actualizarContadores();
            renderTabla();
            renderInscritos();
        });

        // ── Contadores y barra ────────────────────────
        function actualizarContadores() {
            const totalSelec = seleccionados.size;
            const pct = Math.round(totalSelec / CUPOS * 100);
            const pctClamped = Math.min(pct, 100);

            cntSelec.textContent = totalSelec;
            cntPct.textContent = pctClamped + '%';
            barraOcupacion.style.width = pctClamped + '%';
            barraOcupacion.className = 'progress-bar ' +
                (pctClamped >= 90 ? 'bg-danger' : pctClamped >= 70 ? 'bg-warning' : 'bg-success');

            // Detectar cambios respecto al estado original
            const hayDiferencias = [...seleccionados].some(id => !inscritosOriginales.has(id)) ||
                [...inscritosOriginales].some(id => !seleccionados.has(id));

            btnGuardar.disabled = !hayDiferencias;

            // Calcular qué va a cambiar
            const seAgregan = [...seleccionados].filter(id => !inscritosOriginales.has(id)).length;
            const seQuitan = [...inscritosOriginales].filter(id => !seleccionados.has(id)).length;

            if (hayDiferencias) {
                let partes = [];
                if (seAgregan > 0) partes.push(`+${seAgregan} se inscribirán`);
                if (seQuitan > 0) partes.push(`-${seQuitan} se quitarán`);
                footerLabel.textContent = partes.join(' · ');
                footerLabel.style.color = 'var(--text-heading)';
            } else {
                footerLabel.textContent = 'Sin cambios pendientes';
                footerLabel.style.color = 'var(--text-muted)';
            }

            // Advertencia si supera cupos
            if (totalSelec > CUPOS) {
                cntSelec.style.color = 'var(--color-danger)';
                window.showToast('warning', 'Cupos superados',
                    `La academia tiene ${CUPOS} cupos y hay ${totalSelec} seleccionados.`);
            } else {
                cntSelec.style.color = 'var(--accent)';
            }
        }

        // ── Lista de inscritos (col izquierda) ────────
        function renderInscritos() {
            const contenedor = document.getElementById('lista-inscritos-actual');
            const badge = document.getElementById('badge-inscritos');
            const inscritos = alumnos.filter(a => seleccionados.has(a.id));

            badge.textContent = inscritos.length;
            document.getElementById('cnt-inscritos-actuales').textContent = inscritos.length;

            if (inscritos.length === 0) {
                contenedor.innerHTML = `
                <div class="text-center py-4"
                     style="color:var(--text-muted);font-size:.875rem">
                    Sin alumnos inscritos.
                </div>`;
                return;
            }

            contenedor.innerHTML = inscritos.map((a, idx) => {
                const isLast = idx === inscritos.length - 1;
                const esNuevo = !inscritosOriginales.has(a.id);
                return `
                <div class="d-flex align-items-center gap-2 px-4 py-2"
                     style="${!isLast ? 'border-bottom:1px solid var(--border-color)' : ''}
                            ${esNuevo ? 'background:color-mix(in srgb,var(--accent) 5%,transparent)' : ''}">
                    <div class="user-avatar flex-shrink-0"
                         style="width:28px;height:28px;font-size:.65rem;border-radius:50%">
                        ${a.nombre[0]}${a.apellido[0]}
                    </div>
                    <div class="flex-fill" style="min-width:0">
                        <div style="font-size:.8rem;color:var(--text-heading);font-weight:500;
                                    overflow:hidden;text-overflow:ellipsis;white-space:nowrap">
                            ${a.apellido}, ${a.nombre}
                        </div>
                        <div style="font-size:.7rem;color:var(--text-muted)">${a.curso_nombre}</div>
                    </div>
                    ${esNuevo ? '<span class="badge bg-primary bg-opacity-10 text-primary" style="font-size:.65rem">Nuevo</span>' : ''}
                </div>`;
            }).join('');
        }

        // ── Guardar ───────────────────────────────────
        // Envía los IDs finales seleccionados al controlador vía fetch.
        // El controlador hace la diferencia en BD: inserta los nuevos,
        // elimina los que ya no están.
        btnGuardar.addEventListener('click', function() {
            this.disabled = true;
            this.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span>Guardando...';

            fetch('<?= site_url('academias/guardar-alumnos') ?>', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                        '<?= csrf_header() ?>': '<?= csrf_hash() ?>',
                    },
                    body: JSON.stringify({
                        academia_id: ACADEMIA_ID,
                        alumno_ids: [...seleccionados],
                    }),
                })
                .then(r => r.json())
                .then(data => {
                    if (data.success) {
                        window.showToast('success', 'Guardado', data.message ?? 'Alumnos actualizados correctamente.');
                        // Actualizar estado original para reflejar los cambios guardados
                        inscritosOriginales.clear();
                        seleccionados.forEach(id => inscritosOriginales.add(id));
                        actualizarContadores();
                        renderTabla();
                        renderInscritos();
                    } else {
                        window.showToast('error', 'Error', data.message ?? 'No se pudo guardar.');
                    }
                })
                .catch(() => {
                    window.showToast('error', 'Error de red', 'No se pudo conectar con el servidor.');
                })
                .finally(() => {
                    this.disabled = false;
                    this.innerHTML = '<i class="bi bi-check-lg me-1"></i>Guardar cambios';
                });
        });

        // ── Filtros ───────────────────────────────────
        filtroCurso.addEventListener('change', renderTabla);
        buscarAlumno.addEventListener('input', renderTabla);

        // ── Inicializar ───────────────────────────────
        renderTabla();
        renderInscritos();
        actualizarContadores();

    })();
</script>

<?= $this->endSection() ?>