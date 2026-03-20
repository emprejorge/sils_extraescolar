<?= $this->extend('admin/template') ?>

<?= $this->section('content') ?>

<div class="row g-4 mb-4">

    <div class="col-md-4">
        <div class="card shadow-sm border-0 rounded-4 p-4">
            <h6 class="text-muted">Total Usuarios</h6>
            <h2 class="fw-bold"><?= $totalUsuarios ?></h2>
        </div>
    </div>



</div>

<?php $this->endSection() ?>