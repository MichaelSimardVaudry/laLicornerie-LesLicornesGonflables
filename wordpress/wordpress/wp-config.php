<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'licorne' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

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
define( 'AUTH_KEY',         'H[;pcaBk:HG/zi!Vv9rOAn&m-5.f:w$090)6Bu$C-/o}6K#[%UW Eak)&i,l,<(P' );
define( 'SECURE_AUTH_KEY',  'xz(K?c6f #..Lx}!8z59W;p41fGNxa/.k_?U1yeol#HF q-<QeR+T22c H/tmu=/' );
define( 'LOGGED_IN_KEY',    'AW;O/lJz7rRgTxnjO7EdKuy`4wtR/$Efj;dlm%vHfPKYLb-*z]N8+qqq-cuCu@of' );
define( 'NONCE_KEY',        '|dYKO@ nlb/qL^F/!j2 too,e82i[n4{9O %,M>-(n^*I7>FS$6CPp]yc%j1R4sC' );
define( 'AUTH_SALT',        'Q}MY^9q{!7d=:Y~@(bsh@@$rq@?w<HU2zqfoGtM#L` l5[*&/to=ZePx$wo<eX|t' );
define( 'SECURE_AUTH_SALT', 'OH&SVQ%nyAR=cU_mBOy6<QcS:;,QXkU} Azh+dV:iY+?TL3E5K:-G:Mx+=f*8VL:' );
define( 'LOGGED_IN_SALT',   'Y.KjD.PG8iLlHFqJU4e^Y@4[(DqiM;v$4DBgy5D?FGKw2 EMb#6$u{>c9lAL/?EB' );
define( 'NONCE_SALT',       '`$JS*ARsT_F%JYNk <):*2DMOUk81?no>7;?=mdh,Jez~T.)fKtF9,xe&et<1r,g' );

/**#@-*/

/**
 * WordPress database table prefix.
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

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
