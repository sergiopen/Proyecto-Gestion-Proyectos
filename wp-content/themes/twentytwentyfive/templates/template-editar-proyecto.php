<?php
require_once get_template_directory() . '/includes/db-connection.php';
get_header();
$conexion = conexionBD();

$id = isset($_GET['id']) ? (int)$_GET['id'] : null;
if (!$id) {
    echo "<h2 style='text-align:center;'>Proyecto no encontrado.</h2>";
    exit;
}

$sql = "SELECT titulo, autor, correo_electronico, fecha, etiquetas, descripcion, archivo_zip, profesores FROM proyectos WHERE id = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$resultado = $stmt->get_result();
$proyecto = $resultado->fetch_assoc();
$stmt->close();

if (!$proyecto) {
    echo "<h2 style='text-align:center;'>Proyecto no encontrado.</h2>";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = trim($_POST['titulo']) ?? '';
    $autor = trim($_POST['autor']) ?? '';
    $correo = trim($_POST['correo_electronico']) ?? '';
    $fecha = $_POST['fecha'] ?? '';
    $etiquetas = trim($_POST['etiquetas']) ?? null;
    $descripcion = trim($_POST['descripcion']) ?? null;
    $profesores = trim($_POST['profesores']) ?? null;

    // Carpeta donde se guardarán los ZIPs dentro de wp-content/uploads (ruta absoluta)
    $uploadDir = wp_upload_dir(); // Array con rutas base de uploads
    $targetDir = $uploadDir['basedir'] . '/proyectos_zip'; 
    $targetUrlDir = $uploadDir['baseurl'] . '/proyectos_zip';

    // Crear carpeta si no existe
    if (!file_exists($targetDir)) {
        mkdir($targetDir, 0755, true);
    }

    // Manejo archivo ZIP subido
    $archivo_zip = $proyecto['archivo_zip']; // valor previo
    if (isset($_FILES['archivo_zip']) && $_FILES['archivo_zip']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['archivo_zip']['tmp_name'];
        $fileName = $_FILES['archivo_zip']['name'];
        $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);

        if (strtolower($fileExtension) === 'zip') {
            // Generar nombre único para evitar colisiones
            $newFileName = 'proj_' . uniqid() . '.' . $fileExtension;
            $destPath = $targetDir . '/' . $newFileName;

            if (move_uploaded_file($fileTmpPath, $destPath)) {
                $archivo_zip = $newFileName; // Guardamos solo el nombre del archivo
            } else {
                echo "<p class='error'>Error al mover el archivo ZIP.</p>";
            }
        } else {
            echo "<p class='error'>Solo se permiten archivos ZIP.</p>";
        }
    } elseif (empty($archivo_zip)) {
        echo "<p class='error'>El archivo ZIP es obligatorio.</p>";
    }

    if (empty($titulo) || empty($autor) || empty($correo) || empty($fecha) || empty($archivo_zip)) {
        echo "<p class='error'>Los campos Título, Autor, Correo, Fecha y Archivo ZIP son obligatorios.</p>";
    } else {
        $sqlUpdate = "UPDATE proyectos SET titulo=?, autor=?, correo_electronico=?, fecha=?, etiquetas=?, descripcion=?, archivo_zip=?, profesores=? WHERE id=?";
        $stmtUpdate = $conexion->prepare($sqlUpdate);
        $stmtUpdate->bind_param(
            "ssssssssi",
            $titulo,
            $autor,
            $correo,
            $fecha,
            $etiquetas,
            $descripcion,
            $archivo_zip,
            $profesores,
            $id
        );
        if ($stmtUpdate->execute()) {
            echo "<p class='exito'>Proyecto actualizado correctamente.</p>";
            $proyecto = [
                'titulo' => $titulo,
                'autor' => $autor,
                'correo_electronico' => $correo,
                'fecha' => $fecha,
                'etiquetas' => $etiquetas,
                'descripcion' => $descripcion,
                'archivo_zip' => $archivo_zip,
                'profesores' => $profesores,
            ];
        } else {
            echo "<p class='error'>Error al actualizar el proyecto: " . $stmtUpdate->error . "</p>";
        }
        $stmtUpdate->close();
    }
}
?>

<main>
    <div class="container">
        <h2>Editando proyecto: <?php echo htmlspecialchars($proyecto['titulo']); ?></h2>

        <form class="form-container" method="POST" enctype="multipart/form-data">

            <div class="form-field">
                <label class="form-label" for="titulo">Título <b style="color:red">*</b></label>
                <input class="form-input" type="text" id="titulo" name="titulo" required value="<?php echo htmlspecialchars($proyecto['titulo']); ?>" />
            </div>

            <div class="form-field">
                <label class="form-label" for="autor">Autor <b style="color:red">*</b></label>
                <input class="form-input" type="text" id="autor" name="autor" required value="<?php echo htmlspecialchars($proyecto['autor']); ?>" />
            </div>

            <div class="form-field">
                <label class="form-label" for="correo_electronico">Correo electrónico <b style="color:red">*</b></label>
                <input class="form-input" type="email" id="correo_electronico" name="correo_electronico" required value="<?php echo htmlspecialchars($proyecto['correo_electronico']); ?>" />
            </div>

            <div class="form-field">
                <label class="form-label" for="fecha">Fecha <b style="color:red">*</b></label>
                <input class="form-input" type="date" id="fecha" name="fecha" required value="<?php echo htmlspecialchars($proyecto['fecha']); ?>" />
            </div>

            <div class="form-field">
                <label class="form-label" for="etiquetas">Etiquetas</label>
                <input class="form-input" type="text" id="etiquetas" name="etiquetas" value="<?php echo htmlspecialchars($proyecto['etiquetas']); ?>" />
            </div>

            <div class="form-field">
                <label class="form-label" for="descripcion">Descripción</label>
                <textarea class="form-input" id="descripcion" name="descripcion"><?php echo htmlspecialchars($proyecto['descripcion']); ?></textarea>
            </div>

            <div class="form-field">
                <label class="form-label" for="profesores">Profesores</label>
                <textarea class="form-input" id="profesores" name="profesores"><?php echo htmlspecialchars($proyecto['profesores']); ?></textarea>
            </div>

            <span><b style="color:red">*</b> Campo obligatorio</span>
            <button class="form-button" type="submit">Actualizar proyecto</button>
            <a class="form-button-cancel" href="<?php echo home_url('/proyectos'); ?>">Volver</a>
        </form>
    </div>
</main>
