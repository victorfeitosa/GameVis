<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link http://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'wordpress');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '$+j[9T!t5mKdU$>i+_xC|:?V/+$-*$h5Auzz6RmM|.,t|~FYBh}{{s{=-I BOWsg');
define('SECURE_AUTH_KEY',  ';]jolZhVitX0o4qO#.+YVL`,yJXUXY&h):MJh!]8357VZgT-n;+*[yT8/?.B^-W:');
define('LOGGED_IN_KEY',    'ad*az%aO,S#r;@g;pp LO,l&$c:m(y##s3Wg_-S&Rnf-pM&oAQm]}GK9uvSSQpFA');
define('NONCE_KEY',        'DYc|i]n;6K+Z=u4#yC9Wu+oROJ`,X$Xr[Jb@8).JC6}V=mW|k;Rd,*wba>}YNd6Y');
define('AUTH_SALT',        'g].OU{7l.}@qU^BL%xBaYdb[gv^U |fzEddVGFU|1Muu#q~.Bap:1j}@s=sy|k5-');
define('SECURE_AUTH_SALT', '9z$7l*C;.$c%t|#y7yi,;.f$@5YXmLY+*@d-V,917m;5PaUkMh_0CIS8(>p;*rY,');
define('LOGGED_IN_SALT',   ',Gio6X{ch.VqI[P?}jql<}{8sf7-4vTO.qcsV9[t;<^@C2CN}~R%IdB.TM@:|{[+');
define('NONCE_SALT',       '941T_Vure5B`|F)!6U+k5^&94N,U9_B5R{;3ZvRQ-sFw!6Cs4Zs-+g+ F+dV)>95');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
