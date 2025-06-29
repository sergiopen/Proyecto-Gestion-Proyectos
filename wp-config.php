<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wordpress' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'a_Ou/T??Chk,1HBEp-jI0.vdY%n #&?Xbpblo@A{<[Sgrql6~KC{.3L<$BN 4<oI' );
define( 'SECURE_AUTH_KEY',  '|q?=;IP&.Lffz5Y,/lj<q/qfqGc}cj?9^)(NqWpUK07i,jG5$ ki6pe:9J^)t{ >' );
define( 'LOGGED_IN_KEY',    '3uBTyLfD FFbyC|X:y=4/91>Ar!J`;bW!Y>Uhd!Y@JX~Es<*~=P9|R^D<mP2b)C-' );
define( 'NONCE_KEY',        '0?O;Di>C+Q%c!-^HHA})noH!eaVx=SqUh4Wp.O9}P(ulOpTG}i/a-s.K4qSe 37v' );
define( 'AUTH_SALT',        '^(UXSdjlE4tt`1s*[!C6zo<}* p}]`<s|dlMD:q~pi!=YG:ojt1T}B6I]ZX]|^%~' );
define( 'SECURE_AUTH_SALT', 'e15:lyeW?[GxRYr.bxy7E@RSY]>7HF|otYMD~vso])zdE0$N2f_]#kQy*G0PbG%!' );
define( 'LOGGED_IN_SALT',   'YKS;wKrw=lXqb93kgnKw<3e:K=:`[*dPx3 jVli2fZ/$724I{_{MbF59I#$Rk <}' );
define( 'NONCE_SALT',       '_,a2qKR<Sd^$CH~]s02!hrktCfT^z/s^ooB|UcS0:-q&g^<A3RU.T6DerK</b.B~' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */

define('WP_HOME', 'http://localhost/wordpress-practicas');
define('WP_SITEURL', 'http://localhost/wordpress-practicas');

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
