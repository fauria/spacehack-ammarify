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
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'heroku_3b43d5ede499fdf');

/** MySQL database username */
define('DB_USER', 'b03d1eb2dc2192');

/** MySQL database password */
define('DB_PASSWORD', '1067d4ef');

/** MySQL hostname */
define('DB_HOST', 'us-cdbr-iron-east-04.cleardb.net');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

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
define('AUTH_KEY',         'MY}1=#$]*am/U}pb+#:B;BOu*r_waNi]2:lv7) ~o?[ew#7;x* 7V_P{c9>=/@36');
define('SECURE_AUTH_KEY',  'Xn{#f/O) znZt*Gir/WtwA:hw8BjO#J.cl]>{j4KkbR]ZS_>eo_)SjE@[`zlta2e');
define('LOGGED_IN_KEY',    '~3gs2> |e,Y&~By03?C~rV$<s7}sakGLZPP1{$;3?G]]7V@LH;VD-V_:juCy?b3>');
define('NONCE_KEY',        '4Dz:lp%s/ LROHs$EMpt=FWIW?Gyh$$<eeOz^@tu(f*oAXAD;>X;Uy|Lj&c4};Xb');
define('AUTH_SALT',        'B8$1X*,/,i*|@UCc|m3Xn#p]$|^3/i)yy,7<iez{,sFeX:_s`zX-gsY=Vn0Qj/a_');
define('SECURE_AUTH_SALT', 'e|>|Zn9y6+yTRb9:YQ&r[w.YsP8z?#LOaET3MW9rFc:C6F 4-`VXWM.W2ot_imZ4');
define('LOGGED_IN_SALT',   'QMws~$lVw}@!x{beq.A87X/NXV|.!+#Reuz1Su-U=uzo6~_(NKpgiEO:_txhQ<Sm');
define('NONCE_SALT',       '#UKO28N;J=3To~*#R5F9cHbp7Kwur)Ac=a:$Wl_QTX|{cRP/))qLb9ifke{34g!N');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
