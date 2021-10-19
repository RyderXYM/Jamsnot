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

define( 'DB_NAME', 'bitnami_wordpress' );


/** MySQL database username */

define( 'DB_USER', 'bn_wordpress' );


/** MySQL database password */

define( 'DB_PASSWORD', '372a70217f2821cd55ae120ed8eebb0e0647a0c9d2f1036976f631e0d4e89a8e' );


/** MySQL hostname */

define( 'DB_HOST', 'localhost:3306' );


/** Database charset to use in creating database tables. */

define( 'DB_CHARSET', 'utf8' );


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

define( 'AUTH_KEY',         '2cgWPN+PqhT)w<7~-2Z</EgWa,;:yQXb$7)ziUFAwn*M<||CP)`Q&iT;TK=KC|KI' );

define( 'SECURE_AUTH_KEY',  '6XWX4LXnwu^6DE`^Z%2rZK3z^~L2+(+GG|0%0Y<jbB0FHz]u]PgONhNFdV)FnD_=' );

define( 'LOGGED_IN_KEY',    '&Yrne%i10F2B1X$}3)XC]Xr*G@VicV#*ZzpW>1#nU=lZXa&;.MxDQgR0~>j905WX' );

define( 'NONCE_KEY',        'Awpjx*=n1j<5EVllwtjJpO]h>M#3v$}Vu~a<_cFa&@FBi5I_HrTwn0B9i0nsZ1EJ' );

define( 'AUTH_SALT',        ';dSOV%+ {jprHI6GZ:bq1P$IG6SSt+4VWG4;|yP~sR2;SUX1Pq22:$=*W*d,Cu[5' );

define( 'SECURE_AUTH_SALT', '``OsdHUue^8F|}{FY;W4T1SdS_`q#<7ITOefXb]K-WCD@&A`?_^QR+P5_]Ve|36>' );

define( 'LOGGED_IN_SALT',   'U<Pe~Zy<<@n]Vu*_0[/:Tu]=JMWy[2:T5CKR67Kb~4qy)B3(FvwSV?[#;DKJI@&a' );

define( 'NONCE_SALT',       'HR@oY@nn-k~G)J7oFV{<r|RshwY{y6AiHZrU(UvK#?[u[D8^/!Fjn4E/y}u28=cx' );


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




define( 'FS_METHOD', 'direct' );
/**
 * The WP_SITEURL and WP_HOME options are configured to access from any hostname or IP address.
 * If you want to access only from an specific domain, you can modify them. For example:
 *  define('WP_HOME','http://example.com');
 *  define('WP_SITEURL','http://example.com');
 *
 */
if ( defined( 'WP_CLI' ) ) {
	$_SERVER['HTTP_HOST'] = '127.0.0.1';
}

define( 'WP_HOME', 'http://' . $_SERVER['HTTP_HOST'] . '/' );
define( 'WP_SITEURL', 'http://' . $_SERVER['HTTP_HOST'] . '/' );
define( 'WP_AUTO_UPDATE_CORE', 'minor' );
/* That's all, stop editing! Happy publishing. */


/** Absolute path to the WordPress directory. */

if ( ! defined( 'ABSPATH' ) ) {

	define( 'ABSPATH', __DIR__ . '/' );

}


/** Sets up WordPress vars and included files. */

require_once ABSPATH . 'wp-settings.php';

/**
 * Disable pingback.ping xmlrpc method to prevent WordPress from participating in DDoS attacks
 * More info at: https://docs.bitnami.com/general/apps/wordpress/troubleshooting/xmlrpc-and-pingback/
 */
if ( !defined( 'WP_CLI' ) ) {
	// remove x-pingback HTTP header
	add_filter("wp_headers", function($headers) {
		unset($headers["X-Pingback"]);
		return $headers;
	});
	// disable pingbacks
	add_filter( "xmlrpc_methods", function( $methods ) {
		unset( $methods["pingback.ping"] );
		return $methods;
	});
}
