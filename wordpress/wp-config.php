<?php
/**
 * Baskonfiguration för WordPress.
 *
 * Denna fil används av wp-config.php-genereringsskript under installationen.
 * Du behöver inte använda webbplatsens installationsrutin, utan kan kopiera
 * denna fil direkt till "wp-config.php" och fylla i alla värden.
 *
 * Denna fil innehåller följande konfigurationer:
 *
 * * Inställningar för MySQL
 * * Säkerhetsnycklar
 * * Tabellprefix för databas
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL-inställningar - MySQL-uppgifter får du från ditt webbhotell ** //
/** Namnet på databasen du vill använda för WordPress */
define('DB_NAME', 'kraftfulltraning');

/** MySQL-databasens användarnamn */
define('DB_USER', 'root');

/** MySQL-databasens lösenord */
define('DB_PASSWORD', 'root');

/** MySQL-server */
define('DB_HOST', 'localhost');

/** Teckenkodning för tabellerna i databasen. */
define('DB_CHARSET', 'utf8mb4');

/** Kollationeringstyp för databasen. Ändra inte om du är osäker. */
define('DB_COLLATE', '');

/**#@+
 * Unika autentiseringsnycklar och salter.
 *
 * Ändra dessa till unika fraser!
 * Du kan generera nycklar med {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * Du kan när som helst ändra dessa nycklar för att göra aktiva cookies obrukbara, vilket tvingar alla användare att logga in på nytt.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '!kagfUq/p[_o)({2qxpa sYwOxw)OZ&A7cR|DY7-Z_?1!GkRym9-(2*!*@CbT~lp');
define('SECURE_AUTH_KEY',  'j+3=wsZ$UIQ)6iy[?{dGk)/n0FZ`Epm^=7fcY&71)cV+zA4prTN~yCL;h3L$s{<]');
define('LOGGED_IN_KEY',    ':x0sf`_DKIG?F]#@~@[;,M^uwd/c(?a?P[^ft39!ytYC/.3tV+7X>c{SP;~Wg-jA');
define('NONCE_KEY',        '#!|VXMi@@j,o.BwYLLSt|@Sxuu-uzCHE8a$@3]2^d;u,@,}n@/jy.d +(;t&EF _');
define('AUTH_SALT',        'n5`]z=a?BBxA{XkKOqD)/-s](zU_$feBr>K*lU%d[}$#<>cJ%9_e.Z{tO8#7.{U9');
define('SECURE_AUTH_SALT', 'LO[Vxiy%9/<$Eq9;f;uUjjs?.9a.rAv>q`V@Iy,WMw6uP-s?]D^#Gm=oMZH!2_`p');
define('LOGGED_IN_SALT',   'uhI/DOWp#ix6]_my8j|W!7|1! ^nvCkcpSp~^nXpD,1n&t3E&r C?!ZXr8~,XV%>');
define('NONCE_SALT',       'NG?8r!WY4]SodJvSDuU?3`d6t-}n!Jn&B_6{Ht|-oxmkJYzEy9<XoQd~uo5lizr{');

/**#@-*/

/**
 * Tabellprefix för WordPress-databasen.
 *
 * Du kan ha flera installationer i samma databas om du ger varje installation ett unikt
 * prefix. Använd endast siffror, bokstäver och understreck!
 */
$table_prefix  = 'wp_';

/** 
 * För utvecklare: WordPress felsökningsläge. 
 * 
 * Ändra detta till true för att aktivera meddelanden under utveckling. 
 * Det rekommenderas att man som tilläggsskapare och temaskapare använder WP_DEBUG 
 * i sin utvecklingsmiljö. 
 *
 * För information om andra konstanter som kan användas för felsökning, 
 * se dokumentationen. 
 * 
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */ 
define('WP_DEBUG', true);

/* Det var allt, sluta redigera här och börja publicera! */

/** Absolut sökväg till WordPress-katalogen. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Anger WordPress-värden och inkluderade filer. */
require_once(ABSPATH . 'wp-settings.php');