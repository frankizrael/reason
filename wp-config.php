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
define( 'DB_NAME', 'dc_reason' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

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
define( 'AUTH_KEY',         'MHfbdso`+C5uk64PPJJ(S[cp}E8v,&*xM7O$P=)*-4Ks&Qi!C6!nDk2gk</K)JV>' );
define( 'SECURE_AUTH_KEY',  '+;/}UW?ueEgZI)g_qz!>0H?pxD1_);JE*{[WrACrb59DTyG_RHHNN=ZD*8]fkIw0' );
define( 'LOGGED_IN_KEY',    'se0VD[}NnS{I]-63IT8(TV6m19$T*+v_XTa}whv+BL0;Y>PBH-]-12V0N1&6fAcj' );
define( 'NONCE_KEY',        '![J2Y1xVoY%O&r7gof^7Ij pA}n/;;.;S0=AY:^_8`zvz7Q=i$[o`  I4O-YMpGX' );
define( 'AUTH_SALT',        '{iK$5>H:1`od85~WV&xVB-.9>gP=707n7?$Sr7m6OmhxfE9|7~3cIXY9<fi}6e:*' );
define( 'SECURE_AUTH_SALT', ')[X2PCpBpm$#6RA>^(*1lir&v$A0yS7QZR&y?z0:B2-c0|9T:UVUErau$8eN$Tz ' );
define( 'LOGGED_IN_SALT',   'N[MnpiLaO(ESPS-@hPuCSfYJ;wSfYTHq8,@Xc.xSM-&4/94ki&gN)1UT+ qlg=pR' );
define( 'NONCE_SALT',       'vN;O&AS{MV]Z@W#;&bSUj^sBx@,:.i^f9<=cZMRaPk|I8H%7z=irk;H$0a.H^BAQ' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 're_';

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
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
