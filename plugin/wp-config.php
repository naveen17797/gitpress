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
define( 'DB_NAME', 'wordpress' );

/** MySQL database username */
define( 'DB_USER', 'wordpress' );

/** MySQL database password */
define( 'DB_PASSWORD', 'password' );

/** MySQL hostname */
define( 'DB_HOST', 'db' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY', 'Axow]OIjRqod[!Sl@t|+Pi1*i[j>vCVh2}:n9DKCG[n8+Hi{U)nb`En#dJk[[8TD' );
define( 'SECURE_AUTH_KEY', 'I}uIq!UZ)`_}I?0=xpAkZ#(i(_UG0/-pS`o<VMc!$m^;nlfSWeCYg6qgOWs?*uXV' );
define( 'LOGGED_IN_KEY', 'P}LM~S0YAP8|X+y6@UbkNctB]6BVC<uO.V^T{#oaG)S)+TNA>$VfAi*naN:E+Ava' );
define( 'NONCE_KEY', 'WB/V_|ZhdNhA5wrWMa]UL<D;u@rQqpFWz]R_EdH_z/Rh*=H9M*Jdie Y;X[._!nO' );
define( 'AUTH_SALT', 'O(}Feq!@@W-n#2>i:PwK3Y(PVF<<.n1 ,a8w4SB]5Kor.g[UX;Y/FO+wK Fpnn@d' );
define( 'SECURE_AUTH_SALT', '3sebSHTcO,!eY);zf$P=xvuTII)^S{z%i(#Tz^<O-J[~bd(r=ntK:Bq/zfgsDzj(' );
define( 'LOGGED_IN_SALT', '0~+3$at~_D*wF|AS(?iDvW]ami!hGr^;]{I?xGQRI{!#yt]1~k#=|a)8Y&2s_nIx' );
define( 'NONCE_SALT', 'Q/uenA/r/tV0%K BlH;_hwP9U@ BQP.1Yf{4*c]_U<|QXBHX;DiUKE,t* oB1Q;b' );

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
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
