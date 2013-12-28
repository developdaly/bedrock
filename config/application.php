<?php
$root_dir = dirname(dirname(__FILE__));

/**
 * Use Dotenv to set required environment variables and load .env file in root
 */
Dotenv::load($root_dir);
Dotenv::required(array('DB_NAME', 'DB_USER', 'DB_PASSWORD', 'WP_HOME', 'WP_SITEURL'));

/**
 * Set up our global environment constant and load its config first
 * Default: development
 */
define('WP_ENV', getenv('WP_ENV') ? getenv('WP_ENV') : 'development');

$env_config = dirname(__FILE__) . '/environments/' . WP_ENV . '.php';

if (file_exists($env_config)) {
  require_once $env_config;
}

/**
 * Custom Content Directory
 */
define('CONTENT_DIR', '/app');
define('WP_CONTENT_DIR', $root_dir . CONTENT_DIR);
define('WP_CONTENT_URL', 'http://' . $_SERVER['HTTP_HOST'] . CONTENT_DIR);

/**
 * DB settings
 */
define('DB_CHARSET', 'utf8');
define('DB_COLLATE', '');
$table_prefix = 'wp_';

/**
 * Authentication Unique Keys and Salts
 * https://api.wordpress.org/secret-key/1.1/salt
 */
define('AUTH_KEY',         '}a 85hHk%!Olo%W}D>_z|w]uEQ>Cye6U|iLIa`|#Y3PooS|9K{Eof;1u[ei:%n2k');
define('SECURE_AUTH_KEY',  'r;l~A7-E[IsoV+Q8g(.IzCy|2McIa@A<kQWc9$7<[)l$b@8W*+iP.wzb(|ixrW%}');
define('LOGGED_IN_KEY',    '-d~{5;zhw]4ClaQH>iC2!y}?0o7|#%AOV+RSIH5;Hf5O;@W]Y6!Uk]CXmCUVCNL,');
define('NONCE_KEY',        'U]fd|M]P1BqEQh]<cImh1[uKhPql4ZO6z_9W)G|@cHPnXQ!Tj0UP,OkK4sLd12@/');
define('AUTH_SALT',        '&%q]3-kv+a4m2HdOnGzB|PFG}|v:|-n}5ct/hXw+r%>LFF-H-E=kn382(|;HF0Oo');
define('SECURE_AUTH_SALT', '%OMH%~bB`Y<S~d/&>Y@J),pl- ^q_W>7X[F<G7js-3S()rHc_7p_TF,NeC]m^lb8');
define('LOGGED_IN_SALT',   'A*l[N5`S315#~`3C[dj/h@F(T}z4Pk||~@iXvh7hu9~46[8L4,e!_>-a5o.)=wK,');
define('NONCE_SALT',       'i[-LZ9xpf#6AE}h1^u4e #x#+CU<IHL w:5U]qzowoll(f&`RgTT7y<1+/!hW]]r');

/**
 * Custom Settings
 */
define('AUTOMATIC_UPDATER_DISABLED', true);
define('DISABLE_WP_CRON', true);
define('DISALLOW_FILE_EDIT', true);

/**
 * Bootstrap WordPress
 */
if (!defined('ABSPATH')) {
  define('ABSPATH', $root_dir . '/wp/');
}
