<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Crear Proyecto</title>
</head>
<body>
<?php
get_header();
$conexion = conexionBD();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = trim($_POST['titulo'] ?? '');
    $autor = trim($_POST['autor'] ?? '');
    $correo_electronico = trim($_POST['correo_electronico'] ?? '');
    $fecha = $_POST['fecha'] ?? '';
    $etiquetas = trim($_POST['etiquetas'] ?? '');
    $descripcion = trim($_POST['descripcion'] ?? '');
    $profesores = trim($_POST['profesores'] ?? '');

    if ($titulo && $autor && $correo_electronico && $fecha && $descripcion) {
        if (isset($_FILES['archivo_zip']) && $_FILES['archivo_zip']['error'] === UPLOAD_ERR_OK) {
            $fileTmpPath = $_FILES['archivo_zip']['tmp_name'];
            $fileName = $_FILES['archivo_zip']['name'];
            $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

            if ($fileExtension === 'zip') {
                $uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/wordpress-practicas/uploads/';
                if (!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);

                $newFileName = uniqid('proj_', true) . '.' . $fileExtension;
                $destPath = $uploadDir . $newFileName;

                if (move_uploaded_file($fileTmpPath, $destPath)) {
                    $stmt = $conexion->prepare("INSERT INTO proyectos (titulo, autor, correo_electronico, fecha, etiquetas, descripcion, archivo_zip, profesores) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
                    $stmt->bind_param(
                        'ssssssss',
                        $titulo,
                        $autor,
                        $correo_electronico,
                        $fecha,
                        $etiquetas,
                        $descripcion,
                        $newFileName,
                        $profesores
                    );
                    if ($stmt->execute()) {
                        echo '<p style="color:green;">Proyecto creado correctamente.</p>';
                    } else {
                        echo '<p style="color:red;">Error al guardar el proyecto en la base de datos.</p>';
                    }
                    $stmt->close();
                } else {
                    echo '<p style="color:red;">Error al mover el archivo subido.</p>';
                }
            } else {
                echo '<p style="color:red;">El archivo debe ser un ZIP.</p>';
            }
        } else {
            echo '<p style="color:red;">Debes subir un archivo ZIP.</p>';
        }
    } else {
        echo '<p style="color:red;">Por favor, completa todos los campos obligatorios.</p>';
    }
}
?>

<div class="container">
    <h1>Crear nuevo proyecto</h1>
    <form class="form-container" method="POST" enctype="multipart/form-data">

        <div class="form-field">
            <label class="form-label" for="titulo">Título del proyecto</label>
            <input class="form-input" type="text" name="titulo" id="titulo" required />
        </div>

        <div class="form-field">
            <label class="form-label" for="autor">Autor</label>
            <input class="form-input" type="text" name="autor" id="autor" required />
        </div>

        <div class="form-field">
            <label class="form-label" for="correo_electronico">Correo electrónico</label>
            <input class="form-input" type="email" name="correo_electronico" id="correo_electronico" required />
        </div>

        <div class="form-field">
            <label class="form-label" for="fecha">Fecha</label>
            <input class="form-input" type="date" name="fecha" id="fecha" required />
        </div>

        <div class="form-field">
            <label class="form-label" for="etiquetas">Etiquetas (separadas por comas)</label>
            <input class="form-input" type="text" name="etiquetas" id="etiquetas" placeholder="Ej: PHP, JavaScript, MySQL" />
        </div>

        <div class="form-field">
            <label class="form-label" for="descripcion">Descripción</label>
            <textarea class="form-input" name="descripcion" id="descripcion" rows="5" required></textarea>
        </div>

        <div class="form-field">
            <label class="form-label" for="archivo_zip">Archivo ZIP del proyecto</label>
            <input class="form-input" type="file" name="archivo_zip" id="archivo_zip" accept=".zip" required />
        </div>

        <div class="form-field">
            <label class="form-label" for="profesores">Profesores (separados por comas)</label>
            <input class="form-input" type="text" name="profesores" id="profesores" placeholder="Ej: Juan Pérez, María López" />
        </div>

        <button class="form-button" type="submit">Crear proyecto</button>
    </form>
</div>

</body>
</html>
