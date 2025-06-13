<?php
get_header();

function mostrarTablaProyectosTemplate() {
    $esAdmin = false;
    if (isset($_COOKIE['sesion'])) {
        $datos = json_decode(stripslashes($_COOKIE['sesion']), true);
        if (isset($datos['rol']) && $datos['rol'] === 'admin') {
            $esAdmin = true;
        }
    }

    $conexion = conexionBD();

    // Procesar eliminación POST
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && $esAdmin) {
        // Eliminación múltiple
        if (isset($_POST['ids_a_eliminar']) && is_array($_POST['ids_a_eliminar'])) {
            $ids = $_POST['ids_a_eliminar'];
            $ids = array_map('intval', $ids);
            $ids_placeholders = implode(',', $ids);
            if (count($ids) > 0) {
                $sqlDeleteMultiple = "DELETE FROM proyectos WHERE id IN ($ids_placeholders)";
                $conexion->query($sqlDeleteMultiple);
                echo '<p style="color:green;">Proyectos eliminados correctamente.</p>';
            }
        }
        // Eliminación individual
        elseif (isset($_POST['id_proyecto']) && isset($_POST['eliminar'])) {
            $id_eliminar = (int)$_POST['id_proyecto'];
            $sqlDelete = "DELETE FROM proyectos WHERE id = $id_eliminar";
            if ($conexion->query($sqlDelete)) {
                echo '<p style="color:green;">Proyecto eliminado correctamente.</p>';
            } else {
                echo '<p style="color:red;">Error al eliminar proyecto.</p>';
            }
        }
    }

    $titulo = isset($_GET['titulo']) ? $conexion->real_escape_string($_GET['titulo']) : '';
    $autor = isset($_GET['autor']) ? $conexion->real_escape_string($_GET['autor']) : '';
    $etiqueta = isset($_GET['etiqueta']) ? $conexion->real_escape_string($_GET['etiqueta']) : '';
    $profesor = isset($_GET['profesor']) ? $conexion->real_escape_string($_GET['profesor']) : '';

    $condiciones = [];
    if ($titulo !== '') $condiciones[] = "titulo LIKE '%$titulo%'";
    if ($autor !== '') $condiciones[] = "autor LIKE '%$autor%'";
    if ($etiqueta !== '') $condiciones[] = "etiquetas LIKE '%$etiqueta%'";
    if ($profesor !== '') $condiciones[] = "profesores LIKE '%$profesor%'";

    $where = count($condiciones) > 0 ? 'WHERE ' . implode(' AND ', $condiciones) : '';

    $sql = "SELECT id, titulo, autor, correo_electronico, fecha, etiquetas, descripcion, archivo_zip, profesores 
            FROM proyectos 
            $where 
            ORDER BY fecha DESC";
    $resultado = $conexion->query($sql);

    echo '<div class="container">';
    echo '<h2>Proyectos</h2>';

    echo '<form method="GET" class="form-filtro" style="margin-bottom: 20px;">
            <input type="text" name="titulo" placeholder="Filtrar por título" value="' . esc_attr($titulo) . '">
            <input type="text" name="autor" placeholder="Filtrar por autor" value="' . esc_attr($autor) . '">
            <input type="text" name="etiqueta" placeholder="Filtrar por etiqueta" value="' . esc_attr($etiqueta) . '">
            <input type="text" name="profesor" placeholder="Filtrar por profesor" value="' . esc_attr($profesor) . '">
            <button class="btn-filtrar" type="submit">Filtrar</button>
            <a class="btn-filtrar" href="' . home_url('/proyectos') . '" style="margin-left: 10px;">Limpiar filtros</a>
        </form>';

    if ($resultado->num_rows > 0) {
        if ($esAdmin) {
            // Form para eliminar múltiples proyectos
            echo '<form method="POST" onsubmit="return confirm(\'¿Estás seguro de que quieres eliminar los proyectos seleccionados?\');">';
        }

        echo '<table border="1" class="tabla tabla-proyectos">';
        echo '<thead>
                <tr>';
        if ($esAdmin) {
            echo '<th><input type="checkbox" id="check-todos" onclick="toggleAllCheckboxes(this)"></th>';
        }
        echo '      <th>ID</th>
                    <th>Título</th>
                    <th>Autor</th>
                    <th>Correo</th>
                    <th>Fecha</th>
                    <th>Etiquetas</th>
                    <th>Descripción</th>
                    <th>Archivo</th>
                    <th>Profesores</th>';
        if ($esAdmin) {
            echo '<th>Editar</th><th>Eliminar</th>';
        }
        echo '</tr></thead><tbody>';

        while ($row = $resultado->fetch_assoc()) {
            echo '<tr>';
            if ($esAdmin) {
                echo '<td><input type="checkbox" name="ids_a_eliminar[]" value="' . esc_html($row['id']) . '"></td>';
            }
            echo '<td>' . esc_html($row['id']) . '</td>';
            echo '<td>' . esc_html($row['titulo']) . '</td>';
            echo '<td>' . esc_html($row['autor']) . '</td>';
            echo '<td>' . esc_html($row['correo_electronico']) . '</td>';
            echo '<td>' . esc_html($row['fecha']) . '</td>';
            echo '<td>' . esc_html($row['etiquetas']) . '</td>';
            echo '<td>' . esc_html(mb_strimwidth($row['descripcion'], 0, 50, '...')) . '</td>';
            echo '<td><a href="' . esc_url(site_url('/uploads/' . $row['archivo_zip'])) . '" target="_blank">Descargar</a></td>';
            echo '<td>' . esc_html($row['profesores']) . '</td>';
            if ($esAdmin) {
                echo '<td><a class="editar-btn" href="' . home_url() . '/editar-proyecto?id=' . esc_html($row['id']) . '">Editar</a></td>';
                echo '<td>
                        <form method="POST" style="display:inline;">
                            <input type="hidden" name="id_proyecto" value="' . esc_html($row['id']) . '">
                            <button class="btn-eliminar" type="submit" name="eliminar" onclick="return confirm(\'¿Estás seguro de que quieres eliminar este proyecto?\')">Eliminar</button>
                        </form>
                    </td>';
            }
            echo '</tr>';
        }

        echo '</tbody></table>';

        if ($esAdmin) {
            echo '<button class="btn-filtrar" type="submit" name="eliminar-multiples">Eliminar seleccionados</button>';
            echo '</form>';
            echo '<a class="btn-mostrar" href="' . home_url() . '/crear-proyecto">Añadir proyecto</a>';
        }
    } else {
        echo '<p>No se encontraron proyectos.</p>';
        if ($esAdmin) {
            echo '<a class="btn-mostrar" href="' . home_url() . '/crear-proyecto">Añadir proyecto</a>';
        }
    }

    echo '</div>';
    $conexion->close();
}
?>

<script>
function toggleAllCheckboxes(source) {
    const checkboxes = document.querySelectorAll('input[name="ids_a_eliminar[]"]');
    checkboxes.forEach(cb => cb.checked = source.checked);
}
</script>

<?php
mostrarTablaProyectosTemplate();
get_footer();
?>
