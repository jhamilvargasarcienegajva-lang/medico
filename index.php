<?php
require_once __DIR__ . '/controlador/MedicoController.php';

$controller = new MedicoController();

if (isset($_GET['nuevo'])) {
    require __DIR__ . '/vista/medicos/formulario.php';
    exit;
}

if (isset($_GET['editar'])) {
    $medicoEdit = $controller->obtenerPorId((int) $_GET['editar']);
    if (!$medicoEdit) {
        header('Location: index.php');
        exit;
    }

    require __DIR__ . '/vista/medicos/formulario.php';
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['accion'])) {
    $accion = $_POST['accion'];

    if ($accion === 'guardar') {
        $foto = null;
        if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
            $nombreFoto = time() . '_' . basename($_FILES['foto']['name']);
            $destino = __DIR__ . '/public/fotos/' . $nombreFoto;

            if (!is_dir(dirname($destino))) {
                mkdir(dirname($destino), 0777, true);
            }

            if (move_uploaded_file($_FILES['foto']['tmp_name'], $destino)) {
                $foto = 'public/fotos/' . $nombreFoto;
            }
        }

        $medico = new Medico(
            null,
            trim($_POST['nombres'] ?? ''),
            trim($_POST['apellidos'] ?? ''),
            trim($_POST['especialidad'] ?? ''),
            trim($_POST['telefono'] ?? ''),
            $foto
        );

        $controller->guardar($medico);
        header('Location: index.php');
        exit;
    }

    if ($accion === 'actualizar') {
        $id = (int) ($_POST['id'] ?? 0);
        $medicoActual = $controller->obtenerPorId($id);
        $foto = $medicoActual['foto'] ?? null;

        if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
            $nombreFoto = time() . '_' . basename($_FILES['foto']['name']);
            $destino = __DIR__ . '/public/fotos/' . $nombreFoto;

            if (!is_dir(dirname($destino))) {
                mkdir(dirname($destino), 0777, true);
            }

            if (move_uploaded_file($_FILES['foto']['tmp_name'], $destino)) {
                $foto = 'public/fotos/' . $nombreFoto;
            }
        }

        $medico = new Medico(
            $id,
            trim($_POST['nombres'] ?? ''),
            trim($_POST['apellidos'] ?? ''),
            trim($_POST['especialidad'] ?? ''),
            trim($_POST['telefono'] ?? ''),
            $foto
        );

        $controller->actualizar($medico);
        header('Location: index.php');
        exit;
    }
}

if (isset($_GET['eliminar'])) {
    $id = (int) $_GET['eliminar'];
    $controller->eliminar($id);
    header('Location: index.php');
    exit;
}

$medicos = $controller->listar();
require __DIR__ . '/vista/medicos/index.php';
