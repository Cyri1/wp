<?php
/**
 * La configuration de base de votre installation WordPress.
 *
 * Ce fichier est utilisé par le script de création de wp-config.php pendant
 * le processus d’installation. Vous n’avez pas à utiliser le site web, vous
 * pouvez simplement renommer ce fichier en « wp-config.php » et remplir les
 * valeurs.
 *
 * Ce fichier contient les réglages de configuration suivants :
 *
 * Réglages MySQL
 * Préfixe de table
 * Clés secrètes
 * Langue utilisée
 * ABSPATH
 *
 * @link https://fr.wordpress.org/support/article/editing-wp-config-php/.
 *
 * @package WordPress
 */

// ** Réglages MySQL - Votre hébergeur doit vous fournir ces informations. ** //
/** Nom de la base de données de WordPress. */
define( 'DB_NAME', 'wp' );

/** Utilisateur de la base de données MySQL. */
define( 'DB_USER', 'root' );

/** Mot de passe de la base de données MySQL. */
define( 'DB_PASSWORD', '' );

/** Adresse de l’hébergement MySQL. */
define( 'DB_HOST', 'localhost' );

/** Jeu de caractères à utiliser par la base de données lors de la création des tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/**
 * Type de collation de la base de données.
 * N’y touchez que si vous savez ce que vous faites.
 */
define( 'DB_COLLATE', '' );

/**#@+
 * Clés uniques d’authentification et salage.
 *
 * Remplacez les valeurs par défaut par des phrases uniques !
 * Vous pouvez générer des phrases aléatoires en utilisant
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ le service de clés secrètes de WordPress.org}.
 * Vous pouvez modifier ces phrases à n’importe quel moment, afin d’invalider tous les cookies existants.
 * Cela forcera également tous les utilisateurs à se reconnecter.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '@xgONqG @FMp8PWmEwH]]5f=?LaMH:cTS3G-:bU$g?r8rs3J8$[Ok Ky[0C-!$49' );
define( 'SECURE_AUTH_KEY',  '%**u@.^}2/V2axc)L|y$DOlVx@HGAY0(RPIv|@%geaty)6tbN*x!<X^t._(9QB=R' );
define( 'LOGGED_IN_KEY',    '}xf;}OiIN?lgyw s!l9q]rZ) TYT&Mm7I(+fOXk,pm0i$b,SrL>e9j=/r1E{jUEQ' );
define( 'NONCE_KEY',        'mq6f*zlH;5K(%W([rz3q%A qP|6#I{9B*|@AWQieNtIJC>43|h>D$+/fH@:,r$*x' );
define( 'AUTH_SALT',        'eC2i2>;me`dt(]4.hb :Z,:~`iFfFetHa$u+lV(`aT9A7j>LI`]LSOjvb+ #0/Ga' );
define( 'SECURE_AUTH_SALT', 'gMpn/17~&ISK/+gZbIULFr%Z0|{`>}NiHdZzodi,,PM{swFn_$ria>IoLA%lxu e' );
define( 'LOGGED_IN_SALT',   '.G^U+f5VoXt;^nBF$8[-0DvY)LRcyH1g0}Msl[p^&O16G}A#?Y>q,~TBto+kQCxY' );
define( 'NONCE_SALT',       '&yuW=M|$S#36c9$4_xP.# zX=O|1I]EPKu?Xf$)/+84Ou!hw^le4U=8i~&g28{*j' );
/**#@-*/

/**
 * Préfixe de base de données pour les tables de WordPress.
 *
 * Vous pouvez installer plusieurs WordPress sur une seule base de données
 * si vous leur donnez chacune un préfixe unique.
 * N’utilisez que des chiffres, des lettres non-accentuées, et des caractères soulignés !
 */
$table_prefix = 'wp_';

/**
 * Pour les développeurs : le mode déboguage de WordPress.
 *
 * En passant la valeur suivante à "true", vous activez l’affichage des
 * notifications d’erreurs pendant vos essais.
 * Il est fortement recommandé que les développeurs d’extensions et
 * de thèmes se servent de WP_DEBUG dans leur environnement de
 * développement.
 *
 * Pour plus d’information sur les autres constantes qui peuvent être utilisées
 * pour le déboguage, rendez-vous sur le Codex.
 *
 * @link https://fr.wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* C’est tout, ne touchez pas à ce qui suit ! Bonne publication. */

/** Chemin absolu vers le dossier de WordPress. */
if ( ! defined( 'ABSPATH' ) )
  define( 'ABSPATH', dirname( __FILE__ ) . '/' );

/** Réglage des variables de WordPress et de ses fichiers inclus. */
require_once( ABSPATH . 'wp-settings.php' );
