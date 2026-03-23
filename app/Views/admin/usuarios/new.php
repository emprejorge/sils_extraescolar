<?= $this->extend($layout) ?>
<?= $this->section('breadcrumb') ?>
<!-- Breadcrumb -->
<nav aria-label="breadcrumb" class="topbar-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= base_url('admin/usuarios'); ?>">Usuarios</a></li>
        <li class="breadcrumb-item active" aria-current="page">Nuevo usuario</li>

    </ol>
</nav>
<?= $this->endsection(); ?>
<?= $this->section('content') ?>

<main id="page-content">

    <!-- Page header -->
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="page-title">Nuevo usuario</h1>
            <p class="page-subtitle">Completa los datos para registrar un nuevo profesor.</p>
        </div>
        <a href="<?= site_url('admin/usuarios') ?>" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-arrow-left me-1"></i>Volver
        </a>
    </div>

    <form action="<?= site_url('usuarios/guardar') ?>" method="post" id="form-nuevo-usuario">
        <?= csrf_field() ?>

        <div class="row g-3">

            <!-- ══════════════════════════════════════
                 COLUMNA IZQUIERDA — Avatar preview
            ═══════════════════════════════════════ -->
            <div class="col-lg-4 d-flex flex-column gap-3">

                <!-- Preview de perfil -->
                <div class="card text-center">
                    <div class="card-body py-4">

                        <div class="mx-auto mb-3 user-avatar"
                            id="avatar-preview"
                            style="width:72px;height:72px;font-size:1.5rem;border-radius:50%">
                            ?
                        </div>

                        <div class="fw-bold mb-1" id="preview-nombre"
                            style="font-family:'Syne',sans-serif;font-size:1rem;color:var(--text-heading);min-height:1.4em">
                            Nombre del profesor
                        </div>
                        <div class="mb-3" id="preview-email"
                            style="font-size:.8rem;color:var(--text-muted);min-height:1.2em">
                            correo@ejemplo.com
                        </div>

                        <div class="d-flex align-items-center justify-content-center gap-2">
                            <span class="badge bg-secondary bg-opacity-10 text-secondary"
                                id="preview-rol">Sin rol</span>
                            <span class="badge bg-info bg-opacity-10 text-info"
                                id="preview-area" style="display:none"></span>
                        </div>

                    </div>
                    <div class="card-footer py-3" style="font-size:.78rem;color:var(--text-muted)">
                        <i class="bi bi-eye me-1"></i>Vista previa del perfil
                    </div>
                </div>

                <!-- Consejos -->
                <div class="card">
                    <div class="card-header">
                        <span><i class="bi bi-info-circle me-2 text-accent"></i>Indicaciones</span>
                    </div>
                    <div class="card-body p-0">

                        <div class="d-flex align-items-start gap-3 px-4 py-3"
                            style="border-bottom:1px solid var(--border-color)">
                            <i class="bi bi-shield-lock text-primary mt-1" style="font-size:1rem;flex-shrink:0"></i>
                            <p class="mb-0" style="font-size:.8rem;color:var(--text-muted);line-height:1.5">
                                La contraseña debe tener al menos <strong style="color:var(--text-heading)">8 caracteres</strong>.
                            </p>
                        </div>

                        <div class="d-flex align-items-start gap-3 px-4 py-3"
                            style="border-bottom:1px solid var(--border-color)">
                            <i class="bi bi-envelope text-primary mt-1" style="font-size:1rem;flex-shrink:0"></i>
                            <p class="mb-0" style="font-size:.8rem;color:var(--text-muted);line-height:1.5">
                                El correo será usado para <strong style="color:var(--text-heading)">iniciar sesión</strong> y debe ser único.
                            </p>
                        </div>

                        <div class="d-flex align-items-start gap-3 px-4 py-3">
                            <i class="bi bi-mortarboard text-primary mt-1" style="font-size:1rem;flex-shrink:0"></i>
                            <p class="mb-0" style="font-size:.8rem;color:var(--text-muted);line-height:1.5">
                                Podrás asignar academias al profesor desde su <strong style="color:var(--text-heading)">ficha de perfil</strong>.
                            </p>
                        </div>

                    </div>
                </div>

            </div><!-- /col izquierda -->


            <!-- ══════════════════════════════════════
                 COLUMNA DERECHA — Formulario
            ═══════════════════════════════════════ -->
            <div class="col-lg-8">
                <div class="card">

                    <div class="card-header">
                        <span><i class="bi bi-person-plus me-2 text-accent"></i>Datos del profesor</span>
                    </div>

                    <div class="card-body">
                        <div class="row g-3">

                            <!-- ── Datos personales ──────────────── -->
                            <div class="col-12">
                                <p class="mb-0" style="font-family:'Syne',sans-serif;font-size:.7rem;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--text-muted)">
                                    Datos personales
                                </p>
                            </div>

                            <div class="col-sm-6">
                                <label class="form-label" for="first_name">Nombre <span class="text-danger">*</span></label>
                                <input type="text"
                                    class="form-control form-control-sm <?= isset($errors['first_name']) ? 'is-invalid' : '' ?>"
                                    id="first_name" name="first_name"
                                    value="<?= old('first_name') ?>"
                                    placeholder="Ej: María"
                                    required>
                                <?php if (isset($errors['first_name'])): ?>
                                    <div class="invalid-feedback"><?= $errors['first_name'] ?></div>
                                <?php endif; ?>
                            </div>

                            <div class="col-sm-6">
                                <label class="form-label" for="last_name">Apellido <span class="text-danger">*</span></label>
                                <input type="text"
                                    class="form-control form-control-sm <?= isset($errors['last_name']) ? 'is-invalid' : '' ?>"
                                    id="last_name" name="last_name"
                                    value="<?= old('last_name') ?>"
                                    placeholder="Ej: González"
                                    required>
                                <?php if (isset($errors['last_name'])): ?>
                                    <div class="invalid-feedback"><?= $errors['last_name'] ?></div>
                                <?php endif; ?>
                            </div>

                            <div class="col-sm-8">
                                <label class="form-label" for="email">Correo electrónico <span class="text-danger">*</span></label>
                                <div class="input-group input-group-sm">
                                    <span class="input-group-text"
                                        style="background:var(--input-bg);border-color:var(--border-color)">
                                        <i class="bi bi-envelope" style="color:var(--text-muted)"></i>
                                    </span>
                                    <input type="email"
                                        class="form-control <?= isset($errors['email']) ? 'is-invalid' : '' ?>"
                                        id="email" name="email"
                                        value="<?= old('email') ?>"
                                        placeholder="profesor@colegio.cl"
                                        required>
                                    <?php if (isset($errors['email'])): ?>
                                        <div class="invalid-feedback"><?= $errors['email'] ?></div>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <label class="form-label" for="active">Estado</label>
                                <select class="form-select form-select-sm" id="active" name="active">
                                    <option value="1" selected>Activo</option>
                                    <option value="0">Inactivo</option>
                                </select>
                            </div>

                            <!-- ── Rol y área ─────────────────────── -->
                            <div class="col-12 mt-2">
                                <div class="d-flex align-items-center gap-2">
                                    <hr class="flex-fill" style="border-color:var(--border-color)">
                                    <small style="font-family:'Syne',sans-serif;font-size:.7rem;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--text-muted);white-space:nowrap">
                                        Rol y área
                                    </small>
                                    <hr class="flex-fill" style="border-color:var(--border-color)">
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <label class="form-label" for="roles">Rol <span class="text-danger">*</span></label>
                                <select class="form-select form-select-sm <?= isset($errors['roles']) ? 'is-invalid' : '' ?>"
                                    id="roles" name="roles" required>
                                    <option value="" disabled selected>Seleccionar rol...</option>
                                    <?php foreach ($roles as $id => $nombre): ?>
                                        <option value="<?= $id ?>"
                                            <?= old('roles') == $id ? 'selected' : '' ?>>
                                            <?= esc($nombre) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <?php if (isset($errors['roles'])): ?>
                                    <div class="invalid-feedback"><?= $errors['roles'] ?></div>
                                <?php endif; ?>
                            </div>

                            <div class="col-sm-6">
                                <label class="form-label" for="area">Área <span class="text-danger">*</span></label>
                                <select class="form-select form-select-sm <?= isset($errors['area']) ? 'is-invalid' : '' ?>"
                                    id="area" name="area" required>
                                    <option value="" disabled selected>Seleccionar área...</option>
                                    <?php foreach ($areas as $id => $nombre): ?>
                                        <option value="<?= $id ?>"
                                            <?= old('area') == $id ? 'selected' : '' ?>>
                                            <?= esc($nombre) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <?php if (isset($errors['area'])): ?>
                                    <div class="invalid-feedback"><?= $errors['area'] ?></div>
                                <?php endif; ?>
                            </div>

                            <!-- ── Contraseña ─────────────────────── -->
                            <div class="col-12 mt-2">
                                <div class="d-flex align-items-center gap-2">
                                    <hr class="flex-fill" style="border-color:var(--border-color)">
                                    <small style="font-family:'Syne',sans-serif;font-size:.7rem;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--text-muted);white-space:nowrap">
                                        Contraseña
                                    </small>
                                    <hr class="flex-fill" style="border-color:var(--border-color)">
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <label class="form-label" for="password">
                                    Contraseña <span class="text-danger">*</span>
                                </label>
                                <div class="input-group input-group-sm">
                                    <input type="password"
                                        class="form-control <?= isset($errors['password']) ? 'is-invalid' : '' ?>"
                                        id="password" name="password"
                                        placeholder="Mínimo 8 caracteres"
                                        autocomplete="new-password"
                                        required>
                                    <button class="btn btn-outline-secondary" type="button"
                                        onclick="togglePass('password', this)">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                    <?php if (isset($errors['password'])): ?>
                                        <div class="invalid-feedback"><?= $errors['password'] ?></div>
                                    <?php endif; ?>
                                </div>
                                <!-- Indicador de fortaleza -->
                                <div class="mt-2 d-none" id="strength-wrap">
                                    <div class="progress" style="height:4px">
                                        <div class="progress-bar" id="strength-bar"
                                            style="width:0%;transition:width .3s,background-color .3s"
                                            role="progressbar"></div>
                                    </div>
                                    <small id="strength-label"
                                        style="font-size:.72rem;color:var(--text-muted)"></small>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <label class="form-label" for="password_confirm">
                                    Confirmar contraseña <span class="text-danger">*</span>
                                </label>
                                <div class="input-group input-group-sm">
                                    <input type="password"
                                        class="form-control"
                                        id="password_confirm" name="password_confirm"
                                        placeholder="Repetir contraseña"
                                        autocomplete="new-password"
                                        required>
                                    <button class="btn btn-outline-secondary" type="button"
                                        onclick="togglePass('password_confirm', this)">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                </div>
                                <small class="d-none mt-1" id="pw-match-msg" style="font-size:.72rem"></small>
                            </div>

                        </div>
                    </div><!-- /card-body -->

                    <div class="card-footer d-flex align-items-center justify-content-between gap-2">
                        <small style="color:var(--text-muted);font-size:.78rem">
                            <span class="text-danger">*</span> Campos obligatorios
                        </small>
                        <div class="d-flex gap-2">
                            <a href="<?= site_url('usuarios') ?>"
                                class="btn btn-outline-secondary btn-sm">Cancelar</a>
                            <button type="submit" class="btn btn-primary btn-sm" id="btn-guardar">
                                <i class="bi bi-check-lg me-1"></i>Crear usuario
                            </button>
                        </div>
                    </div>

                </div>
            </div><!-- /col derecha -->

        </div><!-- /row -->

    </form>

</main>


<!-- ═══════════════════════════════════════════════
     JS LOCAL
════════════════════════════════════════════════ -->
<script>
    (function() {

        // ── Referencias ───────────────────────────────
        const firstName = document.getElementById('first_name');
        const lastName = document.getElementById('last_name');
        const emailField = document.getElementById('email');
        const rolesField = document.getElementById('roles');
        const areaField = document.getElementById('area');
        const pw = document.getElementById('password');
        const pwConfirm = document.getElementById('password_confirm');

        const avatarEl = document.getElementById('avatar-preview');
        const previewNombre = document.getElementById('preview-nombre');
        const previewEmail = document.getElementById('preview-email');
        const previewRol = document.getElementById('preview-rol');
        const previewArea = document.getElementById('preview-area');

        // ── Live preview ──────────────────────────────
        function updatePreview() {
            const fn = firstName.value.trim();
            const ln = lastName.value.trim();

            // Avatar iniciales
            const initials = (fn[0] || '') + (ln[0] || '');
            avatarEl.textContent = initials ? initials.toUpperCase() : '?';

            // Nombre
            const fullName = [fn, ln].filter(Boolean).join(' ');
            previewNombre.textContent = fullName || 'Nombre del profesor';

            // Email
            previewEmail.textContent = emailField.value.trim() || 'correo@ejemplo.com';

            // Rol
            const rolOpt = rolesField.options[rolesField.selectedIndex];
            if (rolesField.value) {
                previewRol.textContent = rolOpt.text;
                previewRol.className = 'badge bg-primary bg-opacity-10 text-primary';
            } else {
                previewRol.textContent = 'Sin rol';
                previewRol.className = 'badge bg-secondary bg-opacity-10 text-secondary';
            }

            // Área
            if (areaField.value) {
                previewArea.textContent = areaField.options[areaField.selectedIndex].text;
                previewArea.style.display = '';
            } else {
                previewArea.style.display = 'none';
            }
        }

        [firstName, lastName, emailField, rolesField, areaField]
        .forEach(el => el.addEventListener('input', updatePreview));
        [rolesField, areaField]
        .forEach(el => el.addEventListener('change', updatePreview));

        // ── Indicador de fortaleza de contraseña ──────
        const strengthWrap = document.getElementById('strength-wrap');
        const strengthBar = document.getElementById('strength-bar');
        const strengthLabel = document.getElementById('strength-label');

        const levels = [{
                label: 'Muy débil',
                color: '#ef4444',
                width: '20%'
            },
            {
                label: 'Débil',
                color: '#f59e0b',
                width: '40%'
            },
            {
                label: 'Regular',
                color: '#f59e0b',
                width: '60%'
            },
            {
                label: 'Buena',
                color: '#22c55e',
                width: '80%'
            },
            {
                label: 'Excelente',
                color: '#22c55e',
                width: '100%'
            },
        ];

        function getStrength(val) {
            let score = 0;
            if (val.length >= 8) score++;
            if (val.length >= 12) score++;
            if (/[A-Z]/.test(val)) score++;
            if (/[0-9]/.test(val)) score++;
            if (/[^A-Za-z0-9]/.test(val)) score++;
            return Math.min(score, 4);
        }

        pw.addEventListener('input', function() {
            const val = this.value;
            if (!val) {
                strengthWrap.classList.add('d-none');
                return;
            }
            strengthWrap.classList.remove('d-none');
            const lvl = getStrength(val);
            strengthBar.style.width = levels[lvl].width;
            strengthBar.style.backgroundColor = levels[lvl].color;
            strengthLabel.textContent = levels[lvl].label;
            strengthLabel.style.color = levels[lvl].color;
            checkMatch();
        });

        // ── Confirmar coincidencia de contraseñas ─────
        const pwMatchMsg = document.getElementById('pw-match-msg');

        function checkMatch() {
            if (!pwConfirm.value) {
                pwMatchMsg.classList.add('d-none');
                return;
            }
            pwMatchMsg.classList.remove('d-none');
            if (pw.value === pwConfirm.value) {
                pwMatchMsg.textContent = '✓ Las contraseñas coinciden';
                pwMatchMsg.style.color = 'var(--color-success)';
                pwConfirm.classList.remove('is-invalid');
            } else {
                pwMatchMsg.textContent = '✗ Las contraseñas no coinciden';
                pwMatchMsg.style.color = 'var(--color-danger)';
                pwConfirm.classList.add('is-invalid');
            }
        }

        pwConfirm.addEventListener('input', checkMatch);

        // ── Mostrar/ocultar contraseña ────────────────
        window.togglePass = function(fieldId, btn) {
            const input = document.getElementById(fieldId);
            const isText = input.type === 'text';
            input.type = isText ? 'password' : 'text';
            btn.querySelector('i').className = isText ? 'bi bi-eye' : 'bi bi-eye-slash';
        };

        // ── Validación antes de enviar ────────────────
        document.getElementById('form-nuevo-usuario').addEventListener('submit', function(e) {
            if (pw.value !== pwConfirm.value) {
                e.preventDefault();
                window.showToast('error', 'Contraseñas no coinciden',
                    'Verifica que ambos campos sean iguales.');
                pwConfirm.focus();
                return;
            }
            if (pw.value.length < 8) {
                e.preventDefault();
                window.showToast('error', 'Contraseña muy corta',
                    'Debe tener al menos 8 caracteres.');
                pw.focus();
            }
        });

    })();
</script>

<?= $this->endSection() ?>