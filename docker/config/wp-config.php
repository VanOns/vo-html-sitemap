<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'vo-html-sitemap');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'docker.for.mac.localhost:3306');

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
define('AUTH_KEY', 's$l]L&ln=vEE6G,Wg.isY-|i#3<?/0<$o#Wjq<`a-dY,bCe $.-g2`db#td1qb`j');
define('SECURE_AUTH_KEY', 'j(J<+29$>|pF=3N^2RI<; yFz)VXITf%4P=rE25`EUZGYGl;y;x^P%HNjL-dn=G3');
define('LOGGED_IN_KEY', 'zQPC16!O^,`Fa{P a*X0;X@;vV/AY7UKr#f0CktD>kX)Y#I9Se+<]DfIc.w>l_^v');
define('NONCE_KEY', 'k/dp+H$-cV%)~g.SqIu1,hw#u)}];&#eK$KiFBB^oGI5f2FqoylII&lk|lZ+zscL');
define('AUTH_SALT', '|5S3J <}5~KMLB?vWcGV`r*@|i=[l`/%W+SW78s`#<0IQ}84}#8+:Q-X(|4p+?1-');
define('SECURE_AUTH_SALT', 'JA)C9?7*%-g);I98.--y-Mha*WNR W2Xs>|W *]eHhwUdvcZGbQ5Z1t`c3Teo1L-');
define('LOGGED_IN_SALT', '=+g5+t>LyV),|t@o-vv-yr6sHn~;$rK#`qEP,>~@*irEi;ip;DDX0$e%3HHc=&~p');
define('NONCE_SALT', '8P0 ?L|}p)7!4Go=^)&;9N8`Z2$r[O.bJ|@K6x$7$pDlw4<|g+k[(7R#P1mO+9xR');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
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
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define('WP_DEBUG', true);
define('WP_DEBUG_DISPLAY', true);

define('WP_ENVIRONMENT_TYPE', 'development');

ini_set('upload_max_filesize', '10m');
ini_set('post_max_size', '10m');

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if (!defined('ABSPATH')) {
    define('ABSPATH', __DIR__ . '/');
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
