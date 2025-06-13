<?php
/**
 * Twenty Twenty-Five functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_Five
 * @since Twenty Twenty-Five 1.0
 */

// Adds theme support for post formats.
if ( ! function_exists( 'twentytwentyfive_post_format_setup' ) ) :
	/**
	 * Adds theme support for post formats.
	 *
	 * @since Twenty Twenty-Five 1.0
	 *
	 * @return void
	 */
	function twentytwentyfive_post_format_setup() {
		add_theme_support( 'post-formats', array( 'aside', 'audio', 'chat', 'gallery', 'image', 'link', 'quote', 'status', 'video' ) );
	}
endif;
add_action( 'after_setup_theme', 'twentytwentyfive_post_format_setup' );

// Enqueues editor-style.css in the editors.
if ( ! function_exists( 'twentytwentyfive_editor_style' ) ) :
	/**
	 * Enqueues editor-style.css in the editors.
	 *
	 * @since Twenty Twenty-Five 1.0
	 *
	 * @return void
	 */
	function twentytwentyfive_editor_style() {
		add_editor_style( get_parent_theme_file_uri( 'assets/css/editor-style.css' ) );
	}
endif;
add_action( 'after_setup_theme', 'twentytwentyfive_editor_style' );

// Enqueues style.css on the front.
if ( ! function_exists( 'twentytwentyfive_enqueue_styles' ) ) :
	/**
	 * Enqueues style.css on the front.
	 *
	 * @since Twenty Twenty-Five 1.0
	 *
	 * @return void
	 */
	function twentytwentyfive_enqueue_styles() {
		wp_enqueue_style(
			'twentytwentyfive-style',
			get_parent_theme_file_uri( 'style.css' ),
			array(),
			wp_get_theme()->get( 'Version' )
		);
	}
endif;
add_action( 'wp_enqueue_scripts', 'twentytwentyfive_enqueue_styles' );

// Registers custom block styles.
if ( ! function_exists( 'twentytwentyfive_block_styles' ) ) :
	/**
	 * Registers custom block styles.
	 *
	 * @since Twenty Twenty-Five 1.0
	 *
	 * @return void
	 */
	function twentytwentyfive_block_styles() {
		register_block_style(
			'core/list',
			array(
				'name'         => 'checkmark-list',
				'label'        => __( 'Checkmark', 'twentytwentyfive' ),
				'inline_style' => '
				ul.is-style-checkmark-list {
					list-style-type: "\2713";
				}

				ul.is-style-checkmark-list li {
					padding-inline-start: 1ch;
				}',
			)
		);
	}
endif;
add_action( 'init', 'twentytwentyfive_block_styles' );

// Registers pattern categories.
if ( ! function_exists( 'twentytwentyfive_pattern_categories' ) ) :
	/**
	 * Registers pattern categories.
	 *
	 * @since Twenty Twenty-Five 1.0
	 *
	 * @return void
	 */
	function twentytwentyfive_pattern_categories() {

		register_block_pattern_category(
			'twentytwentyfive_page',
			array(
				'label'       => __( 'Pages', 'twentytwentyfive' ),
				'description' => __( 'A collection of full page layouts.', 'twentytwentyfive' ),
			)
		);

		register_block_pattern_category(
			'twentytwentyfive_post-format',
			array(
				'label'       => __( 'Post formats', 'twentytwentyfive' ),
				'description' => __( 'A collection of post format patterns.', 'twentytwentyfive' ),
			)
		);
	}
endif;
add_action( 'init', 'twentytwentyfive_pattern_categories' );

// Registers block binding sources.
if ( ! function_exists( 'twentytwentyfive_register_block_bindings' ) ) :
	/**
	 * Registers the post format block binding source.
	 *
	 * @since Twenty Twenty-Five 1.0
	 *
	 * @return void
	 */
	function twentytwentyfive_register_block_bindings() {
		register_block_bindings_source(
			'twentytwentyfive/format',
			array(
				'label'              => _x( 'Post format name', 'Label for the block binding placeholder in the editor', 'twentytwentyfive' ),
				'get_value_callback' => 'twentytwentyfive_format_binding',
			)
		);
	}
endif;
add_action( 'init', 'twentytwentyfive_register_block_bindings' );

// Registers block binding callback function for the post format name.
if ( ! function_exists( 'twentytwentyfive_format_binding' ) ) :
	/**
	 * Callback function for the post format name block binding source.
	 *
	 * @since Twenty Twenty-Five 1.0
	 *
	 * @return string|void Post format name, or nothing if the format is 'standard'.
	 */
	function twentytwentyfive_format_binding() {
		$post_format_slug = get_post_format();

		if ( $post_format_slug && 'standard' !== $post_format_slug ) {
			return get_post_format_string( $post_format_slug );
		}
	}
endif;

function agregarRutaProyectos() {
    add_rewrite_rule('^proyectos/?$', 'index.php?proyectos=1', 'top');
}
add_action('init', 'agregarRutaProyectos');

function agregarRutaCrearProyecto() {
    add_rewrite_rule('^crear-proyecto/?$', 'index.php?crear-proyecto=1', 'top');
}
add_action('init', 'agregarRutaCrearProyecto');

function agregarRutaEditarProyecto() {
    add_rewrite_rule('^editar-proyecto/?$', 'index.php?editar-proyecto=1', 'top');
}
add_action('init', 'agregarRutaEditarProyecto');

function agregarRutaLogin() {
    add_rewrite_rule('^iniciar/?$', 'index.php?iniciar=1', 'top');
}
add_action('init', 'agregarRutaLogin');

function agregarRutaCopiaSeguridad() {
    add_rewrite_rule('^copia-seguridad/?$', 'index.php?copia-seguridad=1', 'top');
}
add_action('init', 'agregarRutaCopiaSeguridad');

function agregarRutaRestaurar() {
    add_rewrite_rule('^restaurar/?$', 'index.php?restaurar=1', 'top');
}
add_action('init', 'agregarRutaRestaurar');

function agregarRutaProfesores() {
    add_rewrite_rule('^profesores/?$', 'index.php?profesores=1', 'top');
}
add_action('init', 'agregarRutaProfesores');

function agregarRutaCrearProfesor() {
    add_rewrite_rule('^crear-profesor/?$', 'index.php?crear-profesor=1', 'top');
}
add_action('init', 'agregarRutaCrearProfesor');

function agregarRutaEditarProfesor() {
    add_rewrite_rule('^editar-profesor/?$', 'index.php?editar-profesor=1', 'top');
}
add_action('init', 'agregarRutaEditarProfesor');

function agregarQueryVars($vars) {
    $vars[] = 'proyectos';
    $vars[] = 'crear-proyecto';
    $vars[] = 'editar-proyecto';
    $vars[] = 'iniciar';
    $vars[] = 'copia-seguridad';
    $vars[] = 'restaurar';
    $vars[] = 'profesores';
    $vars[] = 'crear-profesor';
    $vars[] = 'editar-profesor';
    return $vars;
}
add_filter('query_vars', 'agregarQueryVars');

function cargarTemplates($template) {
    if (get_query_var('proyectos') == 1) {
        return get_template_directory() . '/templates/template-proyectos.php';
    }
    if (get_query_var('crear-proyecto') == 1) {
        return get_template_directory() . '/templates/template-nuevo-proyecto.php';
    }
    if (get_query_var('editar-proyecto') == 1) {
        return get_template_directory() . '/templates/template-editar-proyecto.php';
    }
    if (get_query_var('iniciar') == 1) {
        return get_template_directory() . '/templates/template-login.php';
    }
    if (get_query_var('copia-seguridad') == 1) {
        return get_template_directory() . '/templates/template-copia-seguridad.php';
    }
    if (get_query_var('restaurar') == 1) {
        return get_template_directory() . '/templates/template-restaurar.php';
    }
    if (get_query_var('profesores') == 1) {
        return get_template_directory() . '/templates/template-profesores.php';
    }
    if (get_query_var('crear-profesor') == 1) {
        return get_template_directory() . '/templates/template-nuevo-profesor.php';
    }
    if (get_query_var('editar-profesor') == 1) {
        return get_template_directory() . '/templates/template-editar-profesor.php';
    }
    return $template;
}
add_filter('template_include', 'cargarTemplates');

require_once get_template_directory() . '/includes/db-connection.php';

function iniciarSesion() {
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['usuario'], $_POST['password'])) {
        $usuario = sanitize_text_field($_POST['usuario']);
        $password = sanitize_text_field($_POST['password']);

        $conexion = conexionBD();
        if ($conexion->connect_error) {
            die("Error de conexión: " . $conexion->connect_error);
        }

        $sql = "SELECT id, nombre_usuario, password, rol FROM profesores WHERE nombre_usuario = ?";
        $queryFormateada = $conexion->prepare($sql);

        if ( false === $queryFormateada ) {
            die("Error en la consulta: " . $conexion->error);
        }

        $queryFormateada->bind_param('s', $usuario);
        $queryFormateada->execute();
        $resultadoLogin = $queryFormateada->get_result();

        if ($resultadoLogin->num_rows == 1) {
            $usuarioDB = $resultadoLogin->fetch_assoc();

            if (password_verify($password, $usuarioDB['password'])) {
                $datos = [
                    "id" => $usuarioDB["id"],
                    "nombre_usuario" => $usuarioDB["nombre_usuario"],
                    "rol" => $usuarioDB["rol"],
                ];
                $jsonFormateo = json_encode($datos);
                setcookie('sesion', $jsonFormateo, time() + 3600 * 24 * 30, '/');
                wp_redirect(home_url());
                exit;
            } else {
                echo "<p class='error'>Usuario o contraseña incorrectos</p>";
            }
        } else {
            echo "<p class='error'>Usuario o contraseña incorrectos</p>";
        }

        $conexion->close();
    }
}

add_action("init", "iniciarSesion");

function cerrarSesion() {
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['cerrar_sesion'])) {
        setcookie('sesion', '', time() - 3600, '/');
        wp_redirect(home_url());
        exit;
    }
}
add_action("init", "cerrarSesion");


function agregarProfesor() {
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['nombre-profesor'], $_POST['apellidos-profesor'], $_POST['email-profesor'], $_POST['usuario-profesor'], $_POST['rol-profesor'], $_POST['password-profesor'])) {

        $nombre = sanitize_text_field($_POST['nombre-profesor']);
        $apellidos = sanitize_text_field($_POST['apellidos-profesor']);
        $email = filter_var($_POST['email-profesor'], FILTER_SANITIZE_EMAIL);
        $usuario = sanitize_text_field($_POST['usuario-profesor']);
        $rol = $_POST['rol-profesor'];
        $password = $_POST['password-profesor'];

        if(empty($nombre) || empty($apellidos) || empty($email) || empty($usuario) || empty($rol) || empty($password)) {
            echo "<p class='error'>Todos los campos son obligatorios</p>";
            return;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "<p class='error'>El email no es válido</p>";
            return;
        }

        if (strlen($password) < 8) {
            echo "<p class='error'>La contraseña debe tener al menos 8 caracteres</p>";
            return;
        }

        $passwordHash = password_hash($password, PASSWORD_BCRYPT);

        $conexion = conexionBD();

        if ($conexion->connect_error) {
            die("Error en la conexión a la base de datos");
        }

        $sql = "INSERT INTO profesores (nombre, apellidos, email, nombre_usuario, rol, password) VALUES (?, ?, ?, ?, ?, ?)";
        
        $stmt = $conexion->prepare($sql);

        if ($stmt === false) {
            die("Error en la consulta SQL: " . $conexion->error);
        }

        $stmt->bind_param("ssssss", $nombre, $apellidos, $email, $usuario, $rol, $passwordHash);

        if ($stmt->execute()) {
            echo "<p class='exito'>Profesor añadido correctamente</p>";
        } else {
            echo "<p class='error'>Error al añadir el profesor: " . $stmt->error . "</p>";
        }

        $stmt->close();
        $conexion->close();
    }
}
add_action('init', 'agregarProfesor');

function eliminarProfesor() {
    $conexion = conexionBD();
    if (isset($_POST['id_profesor'])) {
        $id_profesor = intval($_POST['id_profesor']);
        
        $sql = "DELETE FROM profesores WHERE id = $id_profesor";
        
        if ($conexion->query($sql) === true) {
            echo "<p class='exito'>Profesor eliminado correctamente.</p>";
        } else {
            echo "<p class='error'>Error al eliminar el profesor: " . $conexion->error . "</p>";
        }
    }
}
add_action('init', 'eliminarProfesor');