<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario médico</title>
    <link rel="stylesheet" href="../css/estilos.css">
</head>
<body>
    <div class="container">
        <header class="form-header">
            <a href="index.php" class="back-link">
                <span aria-hidden="true">←</span> Volver al directorio
            </a>
            <div class="form-title">
                <div class="brand-mark" aria-hidden="true">+</div>
                <div>
                    <p class="eyebrow"><?= isset($medicoEdit) ? 'ACTUALIZACIÓN DE DATOS' : 'NUEVO REGISTRO' ?></p>
                    <h1><?= isset($medicoEdit) ? 'Editar médico' : 'Agregar médico' ?></h1>
                    <p class="page-description">Completa los datos del profesional de salud.</p>
                </div>
            </div>
        </header>

        <form class="doctor-form" action="index.php" method="POST" enctype="multipart/form-data">
            <?php if (isset($medicoEdit)): ?>
                <input type="hidden" name="id" value="<?= (int) $medicoEdit['id'] ?>">
            <?php endif; ?>

            <input type="hidden" name="accion" value="<?= isset($medicoEdit) ? 'actualizar' : 'guardar' ?>">

            <div class="form-grid">
                <div class="field-group">
                    <label for="nombres">Nombres <span>*</span></label>
                    <input type="text" id="nombres" name="nombres" placeholder="Ej. Ana María" value="<?= htmlspecialchars($medicoEdit['nombres'] ?? '') ?>" required>
                </div>

                <div class="field-group">
                    <label for="apellidos">Apellidos <span>*</span></label>
                    <input type="text" id="apellidos" name="apellidos" placeholder="Ej. Pérez García" value="<?= htmlspecialchars($medicoEdit['apellidos'] ?? '') ?>" required>
                </div>

                <div class="field-group">
                    <label for="especialidad">Especialidad <span>*</span></label>
                    <?php
                    $especialidades = [
                        'Medicina general',
                        'Medicina interna',
                        'Geriatría',
                        'Cardiología',
                        'Dermatología',
                        'Endocrinología',
                        'Gastroenterología',
                        'Ginecología y obstetricia',
                        'Neurología',
                        'Oftalmología',
                        'Oncología',
                        'Otorrinolaringología',
                        'Pediatría',
                        'Psiquiatría',
                        'Traumatología y ortopedia',
                        'Urología',
                    ];
                    $especialidadActual = $medicoEdit['especialidad'] ?? '';
                    ?>
                    <select id="especialidad" name="especialidad" required>
                        <option value="" disabled <?= $especialidadActual === '' ? 'selected' : '' ?>>Selecciona una especialidad</option>
                        <?php if ($especialidadActual !== '' && !in_array($especialidadActual, $especialidades, true)): ?>
                            <option value="<?= htmlspecialchars($especialidadActual) ?>" selected><?= htmlspecialchars($especialidadActual) ?> (actual)</option>
                        <?php endif; ?>
                        <?php foreach ($especialidades as $especialidad): ?>
                            <option value="<?= htmlspecialchars($especialidad) ?>" <?= $especialidadActual === $especialidad ? 'selected' : '' ?>>
                                <?= htmlspecialchars($especialidad) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="field-group">
                    <label for="telefono">Teléfono <small>Opcional</small></label>
                    <input type="text" id="telefono" name="telefono" placeholder="Ej. 555 123 456" value="<?= htmlspecialchars($medicoEdit['telefono'] ?? '') ?>">
                </div>
            </div>

            <div class="field-group photo-field">
                <label for="foto">Fotografía <small>Opcional</small></label>
                <input type="file" id="foto" name="foto" accept="image/*">
                <span class="field-hint">Puedes seleccionar una imagen para identificar al profesional.</span>
            </div>

            <?php if (!empty($medicoEdit['foto'] ?? '')): ?>
                <div class="current-photo">
                    <img src="<?= htmlspecialchars($medicoEdit['foto']) ?>" alt="Foto actual de <?= htmlspecialchars($medicoEdit['nombres']) ?>" class="foto-medico">
                    <div>
                        <strong>Fotografía actual</strong>
                        <span>Elige otro archivo solo si deseas reemplazarla.</span>
                    </div>
                </div>
            <?php endif; ?>

            <div class="form-actions">
                <a href="index.php" class="btn btn-secondary">Cancelar</a>
                <button type="submit" class="btn btn-success">
                    <?= isset($medicoEdit) ? 'Actualizar' : 'Guardar' ?>
                </button>
            </div>
        </form>

        <footer class="page-footer">Los campos marcados con <span>*</span> son obligatorios.</footer>
    </div>
</body>
</html>
