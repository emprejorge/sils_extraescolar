<?= $this->extend($layout) ?>

<?= $this->section('content') ?>

<main id="page-content">

    <!-- Page header -->
    <div class="d-flex align-items-start justify-content-between mb-4">
        <div>
            <h1 class="page-title">Hola, <?= esc(explode(' ', $profesor['first_name'])[0]) ?> 👋</h1>
            <p class="page-subtitle">
                <?= date('l d \d\e F \d\e Y') ?> &mdash; <?= $academias_hoy > 0 ? $academias_hoy . ' academia' . ($academias_hoy > 1 ? 's' : '') . ' programada' . ($academias_hoy > 1 ? 's' : '') . ' hoy' : 'Sin academias programadas hoy' ?>
            </p>
        </div>
    </div>


    <!-- ══════════════════════════════════════════
         ACADEMIAS DE HOY — sección principal
    ═══════════════════════════════════════════ -->
    <?php if (!empty($academias_pendientes)): ?>

        <div class="d-flex align-items-center gap-2 mb-3">
            <span class="fw-bold" style="font-family:'Syne',sans-serif;font-size:.85rem;color:var(--text-heading)">
                <i class="bi bi-clock-history me-1 text-accent"></i>Pendientes de pasar asistencia
            </span>
            <span class="badge bg-warning bg-opacity-10 text-warning">
                <?= count($academias_pendientes) ?>
            </span>
        </div>

        <div class="row g-3 mb-4">
            <?php foreach ($academias_pendientes as $a): ?>
                <div class="col-md-6 col-xl-4">
                    <div class="card h-100" style="border-left:3px solid var(--color-warning)">
                        <div class="card-body">
                            <div class="d-flex align-items-start justify-content-between mb-3">
                                <div class="d-flex align-items-center gap-2">
                                    <div class="d-flex align-items-center justify-content-center
                                                bg-warning bg-opacity-10 text-warning"
                                        style="width:38px;height:38px;border-radius:10px;font-size:1rem;flex-shrink:0">
                                        <i class="bi bi-book"></i>
                                    </div>
                                    <div>
                                        <div class="fw-bold" style="font-size:.9rem;color:var(--text-heading)">
                                            <?= esc($a['nombre']) ?>
                                        </div>
                                        <div style="font-size:.75rem;color:var(--text-muted)">
                                            <i class="bi bi-clock me-1"></i><?= esc($a['horario']) ?>
                                        </div>
                                    </div>
                                </div>
                                <span class="badge bg-warning bg-opacity-10 text-warning">Pendiente</span>
                            </div>

                            <div class="d-flex align-items-center justify-content-between mb-3"
                                style="font-size:.8rem;color:var(--text-muted)">
                                <span><i class="bi bi-people me-1"></i><?= $a['total_alumnos'] ?> alumnos</span>
                                <span><i class="bi bi-geo-alt me-1"></i><?= esc($a['sala'] ?? 'Sin sala') ?></span>
                            </div>

                            <a href="<?= site_url('asistencia/pasar/' . $a['id']) ?>"
                                class="btn btn-warning btn-sm w-100">
                                <i class="bi bi-clipboard-check me-1"></i>Pasar asistencia
                            </a>
                        </div>
                    </div>
                </div>


            <?php endforeach; ?>
        </div>

    <?php endif; ?>


    <!-- Academias ya pasadas hoy -->
    <?php if (!empty($academias_completadas_hoy)): ?>

        <div class="d-flex align-items-center gap-2 mb-3">
            <span class="fw-bold" style="font-family:'Syne',sans-serif;font-size:.85rem;color:var(--text-heading)">
                <i class="bi bi-check-circle me-1 text-accent"></i>Completadas hoy
            </span>
            <span class="badge bg-success bg-opacity-10 text-success">
                <?= count($academias_completadas_hoy) ?>
            </span>
        </div>

        <div class="row g-3 mb-4">
            <?php foreach ($academias_completadas_hoy as $a): ?>
                <div class="col-md-6 col-xl-4">
                    <div class="card h-100" style="border-left:3px solid var(--color-success)">
                        <div class="card-body">
                            <div class="d-flex align-items-start justify-content-between mb-3">
                                <div class="d-flex align-items-center gap-2">
                                    <div class="d-flex align-items-center justify-content-center
                                                bg-success bg-opacity-10 text-success"
                                        style="width:38px;height:38px;border-radius:10px;font-size:1rem;flex-shrink:0">
                                        <i class="bi bi-book"></i>
                                    </div>
                                    <div>
                                        <div class="fw-bold" style="font-size:.9rem;color:var(--text-heading)">
                                            <?= esc($a['nombre']) ?>
                                        </div>
                                        <div style="font-size:.75rem;color:var(--text-muted)">
                                            <i class="bi bi-clock me-1"></i><?= esc($a['horario']) ?>
                                        </div>
                                    </div>
                                </div>
                                <span class="badge bg-success bg-opacity-10 text-success">Completa</span>
                            </div>

                            <!-- Resumen de asistencia del día -->
                            <div class="d-flex align-items-center gap-3 mb-3">
                                <div class="text-center">
                                    <div class="fw-bold" style="font-family:'Syne',sans-serif;font-size:1.2rem;color:var(--color-success)">
                                        <?= $a['presentes'] ?>
                                    </div>
                                    <div style="font-size:.72rem;color:var(--text-muted)">Presentes</div>
                                </div>
                                <div class="text-center">
                                    <div class="fw-bold" style="font-family:'Syne',sans-serif;font-size:1.2rem;color:var(--color-danger)">
                                        <?= $a['ausentes'] ?>
                                    </div>
                                    <div style="font-size:.72rem;color:var(--text-muted)">Ausentes</div>
                                </div>
                                <div class="flex-fill">
                                    <?php $pct = $a['total_alumnos'] > 0 ? round($a['presentes'] / $a['total_alumnos'] * 100) : 0; ?>
                                    <div class="d-flex justify-content-between mb-1">
                                        <small style="color:var(--text-muted)">Asistencia</small>
                                        <small class="fw-semibold" style="color:var(--text-heading)"><?= $pct ?>%</small>
                                    </div>
                                    <div class="progress" style="height:5px">
                                        <div class="progress-bar <?= $pct >= 75 ? 'bg-success' : ($pct >= 50 ? 'bg-warning' : 'bg-danger') ?>"
                                            style="width:<?= $pct ?>%" role="progressbar"></div>
                                    </div>
                                </div>
                            </div>

                            <a href="<?= site_url('asistencia/ver/' . $a['id'] . '/' . date('Y-m-d')) ?>"
                                class="btn btn-outline-secondary btn-sm w-100">
                                <i class="bi bi-eye me-1"></i>Ver detalle
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

    <?php endif; ?>


    <!-- Sin academias hoy -->
    <?php if (empty($academias_pendientes) && empty($academias_completadas_hoy)): ?>
        <div class="card mb-4">
            <div class="card-body text-center py-5">
                <i class="bi bi-calendar-check d-block mb-2"
                    style="font-size:2.5rem;color:var(--text-muted)"></i>
                <p class="mb-0" style="color:var(--text-muted)">
                    No tienes academias programadas para hoy.
                </p>
            </div>
        </div>
    <?php endif; ?>


    <!-- ══════════════════════════════════════════
         FILA INFERIOR — Mis academias + Últimos registros
    ═══════════════════════════════════════════ -->
    <div class="row g-3">

        <!-- Todas mis academias -->
        <div class="col-lg-5">
            <div class="card h-100">
                <div class="card-header">
                    <span><i class="bi bi-mortarboard me-2 text-accent"></i>Mis academias</span>
                    <span class="badge bg-primary bg-opacity-10 text-primary"><?= count($todas_academias) ?></span>
                </div>
                <div class="card-body p-0">
                    <?php if (!empty($todas_academias)): ?>
                        <?php foreach ($todas_academias as $idx => $a):
                            $isLast = $idx === array_key_last($todas_academias);
                        ?>
                            <div class="d-flex align-items-center gap-3 px-4 py-3"
                                style="<?= !$isLast ? 'border-bottom:1px solid var(--border-color)' : '' ?>">

                                <div class="d-flex align-items-center justify-content-center flex-shrink-0
                                            bg-primary bg-opacity-10 text-primary"
                                    style="width:36px;height:36px;border-radius:9px;font-size:.95rem">
                                    <i class="bi bi-book"></i>
                                </div>

                                <div class="flex-fill">
                                    <div class="fw-semibold" style="font-size:.875rem;color:var(--text-heading)">
                                        <?= esc($a['nombre']) ?>
                                    </div>
                                    <div style="font-size:.75rem;color:var(--text-muted)">
                                        <i class="bi bi-clock me-1"></i><?= esc($a['horario']) ?>
                                        &nbsp;&middot;&nbsp;
                                        <i class="bi bi-people me-1"></i><?= $a['total_alumnos'] ?> alumnos
                                    </div>
                                </div>

                                <!-- Asistencia promedio histórica -->
                                <?php
                                $avg = (int)($a['asistencia_promedio'] ?? 0);
                                $avgColor = $avg >= 75 ? 'text-success' : ($avg >= 50 ? 'text-warning' : 'text-danger');
                                ?>
                                <div class="text-end flex-shrink-0">
                                    <div class="fw-bold <?= $avgColor ?>"
                                        style="font-family:'Syne',sans-serif;font-size:1rem">
                                        <?= $avg ?>%
                                    </div>
                                    <div style="font-size:.7rem;color:var(--text-muted)">promedio</div>
                                </div>

                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="text-center py-4">
                            <span style="color:var(--text-muted);font-size:.875rem">
                                Sin academias asignadas.
                            </span>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Últimos registros de asistencia -->
        <div class="col-lg-7">
            <div class="card h-100">
                <div class="card-header">
                    <span><i class="bi bi-clipboard-data me-2 text-accent"></i>Últimos registros</span>
                </div>
                <div class="card-body p-0">
                    <?php if (!empty($ultimos_registros)): ?>
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>Academia</th>
                                        <th>Fecha</th>
                                        <th>Presentes</th>
                                        <th>Asistencia</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($ultimos_registros as $r):
                                        $pct = $r['total_alumnos'] > 0
                                            ? round($r['presentes'] / $r['total_alumnos'] * 100)
                                            : 0;
                                        $barColor = $pct >= 75 ? 'bg-success' : ($pct >= 50 ? 'bg-warning' : 'bg-danger');
                                    ?>
                                        <tr>
                                            <td>
                                                <span class="fw-semibold"
                                                    style="font-size:.85rem;color:var(--text-heading)">
                                                    <?= esc($r['academia_nombre']) ?>
                                                </span>
                                            </td>
                                            <td style="color:var(--text-muted);font-size:.82rem;white-space:nowrap">
                                                <?= date('d M Y', strtotime($r['fecha'])) ?>
                                            </td>
                                            <td style="font-size:.85rem;color:var(--text-heading)">
                                                <?= $r['presentes'] ?>/<?= $r['total_alumnos'] ?>
                                            </td>
                                            <td style="min-width:100px">
                                                <div class="d-flex align-items-center gap-2">
                                                    <div class="progress flex-fill" style="height:5px">
                                                        <div class="progress-bar <?= $barColor ?>"
                                                            style="width:<?= $pct ?>%"
                                                            role="progressbar"></div>
                                                    </div>
                                                    <small class="fw-semibold"
                                                        style="color:var(--text-heading);min-width:30px">
                                                        <?= $pct ?>%
                                                    </small>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <div class="text-center py-4">
                            <i class="bi bi-clipboard d-block mb-2"
                                style="font-size:2rem;color:var(--text-muted)"></i>
                            <span style="color:var(--text-muted);font-size:.875rem">
                                Aún no hay registros de asistencia.
                            </span>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

    </div><!-- /fila inferior -->

</main>

<?= $this->endSection() ?>