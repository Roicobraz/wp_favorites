<?php 
/**
* Add-on Name: Favorites
* Add-on URI: https://github.com/Roicobraz/wp_favorites
* Description: Plugin de test
* Version: 1.0
* Author: VAVASSORI Justin
**/

require_once('assets/button.php');

require_once('include/css/style.css');

use favorite\button;

$favorites = new button;
//$favorites->setField('favoris');
$favorites->setFav_user(get_user_meta( get_current_user_id(), $favorites->getField() ));


/*-------------------------------------------------*/
/* Le code ci-dessous uniquement peut être modifié */
/*-------------------------------------------------*/


$favorites->fav_button('&#x2B50;', '&#x1F6AB;');
// multilingue
//__('test', 'domain_name')