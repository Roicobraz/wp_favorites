<?php 
/**
* Add-on Name: Favorites
* Add-on URI: https://github.com/Roicobraz/wp_favorites
* Description: add-on de favories
* Version: 1.0
* Author: VAVASSORI Justin
**/

require_once('assets/button.php');

require_once('include/css/style.css');

use favorite\button;

$favorites = new button;
$favorites->setField('favoris');
$favorites->setFav_user(get_user_meta( get_current_user_id(), $favorites->getField()));


/*-------------------------------------------------*/
/* Le code ci-dessous uniquement peut être modifié */
/*-------------------------------------------------*/

// -------{TEST PAGE FAVORIES------- //

// déclarer une page où mettre son listing des favoris
// ajouter un hook pour le listing
// shortcode à placer où on veut




/**
* Message s'il n'y a aucun favoris 
*/
$favorites->setFav_void('test void favorites');

/**
* Taille du <h> pour les titre des posts
*/
$favorites->setFav_msg_title_height('2');

/**
* Affichage du contenu soit en content ou en excerpt 
*/
$favorites->setFav_msg_content_type('content');

/**
* Affichage global du contenu classique ou personnalisé 
*/
//$favorites->setFav_msg_format_type('manual');

/**
* Ajout de classes CSS aux titres 
*/
//$favorites->setFav_msg_title_class('text-primary');
/**
* Contenu de l'affichage personnalisé 
*/
//$favorites->setFav_msg_format('format');

//$format = $favorites->getFav_msg_title().
//	$favorites->getFav_msg_thumbnail().'hruqibglierbgqlbvfqhcbjerh'.
//	$favorites->getSc().
//	$favorites->getFav_msg_content().
//	$favorites->getFav_msg_link();
$favorites->fav_hook_list(/*$format*/);

/**
* Initialisation du shortcode
*/

//$favorites->fav_sc_list($format);
// }

// -------{INITIALISATION DU BOUTTON------- //
/**
* domain_name pour le multilingue
*/
//$favorites->setDomaine_name('whundertheme');

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
$favorites->fav_button('&#x2B50;', '&#x1F6AB;'); // version filter
// }

//$favorites->fav_sc_list();