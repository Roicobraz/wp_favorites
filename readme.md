# Ajout et suppression de post favoris sous Wordpress.
_Développé en **PHP 7.4** avec Wordpress **6.5.3** et Advanced Custom Fields PRO **6.3.0.1**_

Seul le fichier index.php a besoin d'être modifié pour paramétrer les favoris.

## Dépendences
- PHP 7.4
- [Wordpress 6.5.3](https://fr.wordpress.org/download/releases/)
- [Advanced Custom Fields 6.3.0.1](https://www.advancedcustomfields.com/)

## Paramétrage 
### La page des favoris
Dans le cas où il n'y a aucun favori le shortcode affiche un message qui peut-être initialisé avec la méthode ``setFav_void``.

Le style des titre des posts passe par les méthodes : 
- ``setFav_msg_title_class`` cela permet d'ajouter des class aux titres
- ``setFav_msg_title_height`` cela permet de définir de quelle taille est la balise <hx>

Pour choisir l'affichage du post nous avons la possibilité de passer par le content ou l'excerpt avec ``setFav_msg_content_type`` en entrant comme paramètre l'un ou l'autre. 
_Si aucune paramètre n'est entré alors le content sera pris comme paramètre_

### Bouton d'ajout/suppression de favoris
Pour initialiser le shortcode du bouton d'ajout/suppression de favoris on utilise la méthode ``setFav_sc_name``, avec comme paramètre le nom qui seras attribuer au shortcode.

Pour déclarer quel post-type est visé on utilise ``setFav_type_post`` avec en paramètre le slug du post-type.
Il peut y en avoir plusieurs ils sont alors déclarer sous forme de tableau.

S'il y a du multilingue on peut alors faire appel à la méthode ``setDomaine_name`` et mettre en paramètre le nom du thème voulu.

Et pour gérer le style la méthode ``setFav_btn_class`` permet d'ajouter des classes CSS au bouton

## Affichage
Le bouton peut-être afficher soit avec un ``add_filter(the_content)`` soit avec un shortcode.

- Pour le **shortcode** il faut utiliser la méthode ``fav_button_sc``
- Pour le **add_filter()** on utilise la méthode ``fav_button``

Pour ces deux méthodes le 1<sup>er</sup> correspond au texte du bouton d'ajout, et le 2<sup>nd</sup> correspond au texte du bouton de suppression.



