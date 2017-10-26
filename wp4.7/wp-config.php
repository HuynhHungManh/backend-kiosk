<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //


/**
*  The name of the database for WordPress
*/
define('DB_NAME', 'wp');

/**
*  MySQL database username
*/
define('DB_USER', 'wp');

/**
*  MySQL database username
*/
define('DB_PASSWORD', '123456');

/**
*  MySQL hostname
*/
define('DB_HOST', 'db');

/**
*  Database Charset to use in creating database tables.
*/
define('DB_CHARSET', 'utf8mb4');

/**
*  The Database Collate type. Don't change this if in doubt.
*/
define('DB_COLLATE', '');

/**
*  WordPress Database Table prefix.
*  You can have multiple installations in one database if you give each a unique
*  prefix. Only numbers, letters, and underscores please!
*/
$table_prefix = 'wp_';

/**
*  disallow unfiltered HTML for everyone, including administrators and super administrators. To disallow unfiltered HTML for all users, you can add this to wp-config.php:
*/
define('DISALLOW_UNFILTERED_HTML', false);

/**
*
*/
define('ALLOW_UNFILTERED_UPLOADS', false);

/**
*  The easiest way to manipulate core updates is with the WP_AUTO_UPDATE_CORE constant
*/
define('WP_AUTO_UPDATE_CORE', true);

/**
*  forces the filesystem method
*/
define('FS_METHOD', 'direct');

/**
*  Authentication Unique Keys and Salts.
*  Change these to different unique phrases!
*  You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
*  You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
*  @since 2.6.0
*/
define('AUTH_KEY', '>RP2cB7An-Y*s;89@DH0w6@FC?Vh@~;)w89]V{yM+k~@Qi(BL3knf~A0G#R,lm}f');
define('SECURE_AUTH_KEY', '`9BR@Z-<9W?5{1t#v@?p#@3U4WP],!P}QjpkVL}WBj3!H$8)5~]K f4j=A y!rz(');
define('LOGGED_IN_KEY', 'zolKv|vfS-WKORq4ybgk9TkE:GgXyF!n1E*r_T3<FNfMk*p@0fNj|{.F9E2[_n0X');
define('NONCE_KEY', 'MXI{5!jL0c(W.AwPVWjWe4%4%Kn/;Q:=hU(,S/nm,hVTz N5UX j]s$yCjUc6<&w');
define('AUTH_SALT', 'T=cE^n%)v}t]kut(zL65 CF/*A)-KZt`o !j>2$`rk7Lo.Tj{sgyga6n/{GqW~ C');
define('SECURE_AUTH_SALT', 'm//73&|BnabL$9U*qmJa/W)~XOx^<*]ZowfT0[(Ht2Kc1kWN/@XBBG~fdA_:H#.h');
define('LOGGED_IN_SALT', 'v%W.{DH<UhSfaH<jO[{4EQDMXSzMr$yy.?bM|4+caZr6%T9iO$CxNZ~_hN$l;UhC');
define('NONCE_SALT', 'Pdy$V0n;g;+y}YtDepp>-fVPr65M^+_]}o2lSO+-H&0P5k[WfC0*Vm2nAjG=p[@T');
// define('WP_HOME','http://192.168.1.54:8080/');
// define('WP_SITEURL','http://192.168.1.54:8080/');


/**
*  For developers: WordPress debugging mode.
*  Change this to true to enable the display of notices during development.
*  It is strongly recommended that plugin and theme developers use WP_DEBUG
*  in their development environments.
*/
define('WP_DEBUG', false);
define('WP_DEBUG_LOG', false);
define('WP_DEBUG_DISPLAY', true);

/**
*  For developers: WordPress Script Debugging
*  Force Wordpress to use unminified JavaScript files
*/
define('SCRIPT_DEBUG', false);

/**
*  WordPress Localized Language, defaults to English.
*  Change this to localize WordPress. A corresponding MO file for the chosen
*  language must be installed to wp-content/languages. For example, install
*  de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
*  language support.
*/
define('WPLANG', '');

/**
*  Setup Multi site
*/
define('WP_ALLOW_MULTISITE', false);

/**
*  Post Autosave Interval
*/
define('AUTOSAVE_INTERVAL', 60);

/**
*  Disable / Enable Post Revisions and specify revisions max count
*/
define('WP_POST_REVISIONS', true);

/**
*  this constant controls the number of days before WordPress permanently deletes
*  posts, pages, attachments, and comments, from the trash bin
*/
define('EMPTY_TRASH_DAYS', 30);

/**
*  Make sure a cron process cannot run more than once every WP_CRON_LOCK_TIMEOUT seconds
*/
define('WP_CRON_LOCK_TIMEOUT', 60);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
