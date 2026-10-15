<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hospital - Médicos</title>
    <link rel="stylesheet" href="../css/estilos.css">
</head>
<body>
    <div class="container">
        <header class="page-header">
            <div class="brand">
                <div class="brand-mark" aria-hidden="true">+</div>
                <div>
                    <p class="eyebrow">CENTRO MÉDICO</p>
                    <h1>Directorio médico</h1>
                    <p class="page-description">Administra la información de los profesionales de salud.</p>
                </div>
            </div>

            <a href="index.php?nuevo=1" class="btn btn-success">
                <span class="button-icon" aria-hidden="true">+</span>
                Agregar médico
            </a>
        </header>

        <section class="summary-card" aria-label="Resumen de médicos">
            <div class="summary-icon" aria-hidden="true">✚</div>
            <div>
                <p class="summary-label">Médicos registrados</p>
                <p class="summary-value"><?= count($medicos) ?></p>
            </div>
            <span class="summary-note">Directorio actualizado</span>
        </section>

        <section class="directory-section">
            <div class="section-heading">
                <div>
                    <p class="eyebrow">PERSONAL DE SALUD</p>
                    <h2>Equipo médico</h2>
                </div>
                <span class="record-count"><?= count($medicos) ?> <?= count($medicos) === 1 ? 'registro' : 'registros' ?></span>
            </div>

            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombres</th>
                            <th>Apellidos</th>
                            <th>Especialidad</th>
                            <th>Teléfono</th>
                            <th>Foto</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($medicos)): ?>
                            <?php foreach ($medicos as $medico): ?>
                                <tr>
                                    <td><span class="id-badge">#<?= htmlspecialchars($medico['id']) ?></span></td>
                                    <td class="name-cell"><?= htmlspecialchars($medico['nombres']) ?></td>
                                    <td><?= htmlspecialchars($medico['apellidos']) ?></td>
                                    <td><span class="specialty-badge"><?= htmlspecialchars($medico['especialidad']) ?></span></td>
                                    <td><?= htmlspecialchars($medico['telefono'] ?? 'Sin teléfono') ?></td>
                                    <td>
                                        <?php if (!empty($medico['foto'])): ?>
                                            <img src="<?= htmlspecialchars($medico['foto']) ?>" alt="Foto de <?= htmlspecialchars($medico['nombres']) ?>" class="foto-medico">
                                        <?php else: ?>
                                            <span class="no-photo">Sin foto</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <div class="row-actions">
                                            <a href="index.php?editar=<?= (int) $medico['id'] ?>" class="btn btn-primary">Editar</a>
                                            <a href="index.php?eliminar=<?= (int) $medico['id'] ?>" class="btn btn-danger" onclick="return confirm('¿Desea eliminar este médico?');">Eliminar</a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7">
                                    <div class="empty-state">
                                        <span class="empty-icon" aria-hidden="true">✚</span>
                                        <strong>Aún no hay médicos registrados</strong>
                                        <span>Agrega el primer profesional para comenzar tu directorio.</span>
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </section>

        <footer class="page-footer">Gestión de personal médico <span>•</span> Panel administrativo</footer>
    </div>
</body>
</html>
