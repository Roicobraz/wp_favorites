<?php 
/**
* Add-on Name: Favorites
* Add-on URI: https://github.com/Roicobraz/wp_favorites
* Description: add-on de favories
* Version: 1.0
* Author: VAVASSORI Justin
**/

require_once('assets/button.php');
require_once('assets/favorites_top.php');
require_once('assets/depedencies.php');

add_action( 'wp_enqueue_scripts', 'fav_styles' );
function fav_styles() {
    wp_enqueue_style( 'fav_style', get_theme_file_uri('/inc/favorite/include/css/style.css') );
}

use favorite\button;
use favorite\depedence;

$favorites = new button;
$favorites->setField('favoris');
$favorites->setFav_user(get_user_meta( get_current_user_id(), $favorites->getField()));


/*-------------------------------------------------*/
/* Le code ci-dessous uniquement peut être modifié */
/*-------------------------------------------------*/
/**
* domain_name pour le multilingue
*/
$favorites->setDomaine_name('whundertheme');
// -------{ PAGE FAVORIES------- //

/**
* Message s'il n'y a aucun favoris 
*/
$favorites->setFav_void(__('Vous n\'avez aucun favoris pour le moment.', $favorites->getDomain_name()));

/**
* Taille du <h> pour les titres des posts
*/
$favorites->setFav_msg_title_height('2');

/**
* Affichage du contenu soit en content ou en excerpt 
*/
$favorites->setFav_msg_content_type('excerpt');

/**
* Ajout de classes CSS aux titres 
*/
//$favorites->setFav_msg_title_class('text-primary');

/**
* Initialisation du shortcode
*/
$favorites->fav_sc_list();
// }

// -------{INITIALISATION DU BOUTTON------- //
/**
* nom du shortcode
*/
$favorites->setFav_sc_name('favorites');

/**
* initialisation des post-types visés
*/
//$favorites->setFav_type_post('favorites');
//}

// -------{AFFICHAGE DU BOUTTON------- //
/**
* initialisation du bouton 
* 1er param contenu du bouton d'ajout
* 2eme param contenu du bouton de suppression
*/
$favorites->fav_button_sc('&#x2B50;', '&#x1F6AB;'); // version shortcode
//$favorites->fav_button('&#x2B50;', '&#x1F6AB;'); // version filter
// }


/**
* Contenu de l'affichage personnalisé 
*/
//$favorites->setFav_msg_format('format');

//$favorites->fav_hook_list();

