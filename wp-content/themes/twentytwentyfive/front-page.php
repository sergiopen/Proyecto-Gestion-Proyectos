<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proyecto - Inicio</title>
</head>
<body>
    <?php
        get_header();

        function mostrarInformacionInicio() {
            $sesionActiva = isset($_COOKIE['sesion']) && !empty($_COOKIE['sesion']);
            $esAdmin = false;

            echo '<main class="main">';
            echo '<div class="menu">';

            if ($sesionActiva) {
                $datos = json_decode(stripslashes($_COOKIE['sesion']), true);
                $rol = $datos['rol'] ?? '';
                $esAdmin = $rol === 'admin';

                if (isset($datos['nombre_usuario'])) {
                    $usuario = $datos['nombre_usuario'];
                    echo '<div class="bienvenida-usuario">';
                    echo '<h2 style="text-align: center;">¡Bienvenido, ' . esc_html($usuario) . '!</h2>';
                    echo '</div>';

                    echo '<div class="container" style="display: flex; flex-direction:row; gap: 1rem"/>';
                    echo '    <a class="menu-item" href="' . home_url('/profesores') . '">';
                    echo '        <img src="' . home_url('/wp-content/uploads/2025/04/alumno.png') . '" alt="Profesores">';
                    echo '        <span>Usuarios</span>';
                    echo '    </a>';
                    echo '    <a class="menu-item" href="' . home_url('/proyectos') . '">';
                    echo '        <img src="' . home_url('/wp-content/uploads/2025/04/alumno.png') . '" alt="Proyectos">';
                    echo '        <span>Proyectos</span>';
                    echo '    </a>';
                    echo '</div>';
                }

                echo '</div>';

                if($esAdmin) {
                    echo '<div class="container">';
                    echo '<h3>Acciones de Administrador</h3>';
                    echo "<form method='post' action='" . site_url('/backup-db.php') . "'>
                            <button class='btn-mostrar' type='submit' name='backup'>Descargar copia de seguridad</button>
                    </form>";

                    echo '<form method="post" action="" enctype="multipart/form-data">
                        <input type="file" name="sql_file" accept=".sql" required />
                        <button class="btn-mostrar" type="submit" name="restore">Restaurar copia de seguridad</button>
                    </form>';
                    echo '</div>';
                }
            } else {
                echo '    <a class="menu-item" href="' . home_url('/proyectos') . '">';
                echo '        <img src="' . home_url('/wp-content/uploads/2025/04/alumno.png') . '" alt="Proyectos">';
                echo '        <span>Proyectos</span>';
                echo '    </a>';
                echo '</div>';
            }

            echo '</main>';
        }

        mostrarInformacionInicio();

        function mostrarTablaProyectos() {
            $esAdmin = false;
            if (isset($_COOKIE['sesion'])) {
                $datos = json_decode(stripslashes($_COOKIE['sesion']), true);
                if (isset($datos['rol']) && $datos['rol'] === 'admin') {
                    $esAdmin = true;
                }
            }

            $conexion = conexionBD();

            $sql = "SELECT id, titulo, autor, correo_electronico, fecha, etiquetas, descripcion, archivo_zip, profesores 
                    FROM proyectos 
                    ORDER BY fecha DESC 
                    LIMIT 5";
            $resultado = $conexion->query($sql);

            if ($resultado->num_rows > 0) {
                echo '<div class="container">';
                echo '<h3>Lista de Proyectos</h3>';
                echo '<table border="1" class="tabla tabla-proyectos">';
                echo '<thead>
                        <tr>
                            <th>ID</th>
                            <th>Título</th>
                            <th>Autor</th>
                            <th>Correo Electrónico</th>
                            <th>Fecha</th>
                            <th>Etiquetas</th>
                            <th>Descripción</th>
                            <th>Archivo ZIP</th>
                            <th>Profesores</th>';
                if ($esAdmin) {
                    echo '<th>Editar</th><th>Eliminar</th>';
                }
                echo '  </tr>
                    </thead>';
                echo '<tbody>';

                while ($row = $resultado->fetch_assoc()) {
                    echo '<tr>';
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

                echo '</tbody>';
                echo '</table>';
                if ($esAdmin) {
                    echo '<a class="btn-mostrar" href="' . home_url() . '/crear-proyecto">Añadir proyecto</a>';
                }
                echo '<a class="btn-mostrar" href="' . home_url() . '/proyectos">Todos los proyectos</a>';
                echo '</div>';
            } else {
                echo '<div class="container">';
                echo '<p>No se encontraron proyectos.</p>';
                if ($esAdmin) {
                    echo '<a class="btn-mostrar" href="' . home_url() . '/crear-proyecto">Añadir proyecto</a>';
                }
                echo '</div>';
            }

            $conexion->close();
        }

        mostrarTablaProyectos();

        if (isset($_POST['restore'])) {
            if (isset($_FILES['sql_file']) && $_FILES['sql_file']['error'] === UPLOAD_ERR_OK) {
                $sqlFilePath = $_FILES['sql_file']['tmp_name'];
                $sqlContent = file_get_contents($sqlFilePath);

                if ($sqlContent === false) {
                    echo "Error al leer el archivo SQL.";
                    exit;
                }

                $mysqli = new mysqli('localhost', 'root', '', 'bd_gestion');
                if ($mysqli->connect_errno) {
                    echo "Error de conexión a la base de datos: " . $mysqli->connect_error;
                    exit;
                }

                if ($mysqli->multi_query($sqlContent)) {
                    do {
                        if ($result = $mysqli->store_result()) {
                            $result->free();
                        }
                    } while ($mysqli->more_results() && $mysqli->next_result());
                    echo "Restauración completada correctamente.";
                } else {
                    echo "Error en la restauración: " . $mysqli->error;
                }

                $mysqli->close();
            } else {
                echo "Error al subir el archivo SQL.";
            }
        }

        get_footer();
    ?>
</body>
</html>
