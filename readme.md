# Ajout et suppression de post favoris sous Wordpress.
_Développé avec Wordpress **6.5.3** et Advanced Custom Fields PRO **6.3.0.1**_

Seul le fichier index.php a besoin d'être modifié pour paramétrer les favoris.

## Dépendences
- [Wordpress 6.5.3](https://fr.wordpress.org/download/releases/)
- [Advanced Custom Fields 6.3.0.1](https://www.advancedcustomfields.com/)

## Paramétrage 
### La page des favoris


### Bouton d'ajout/suppression de favoris
Pour initialiser le shortcode du bouton d'ajout/suppression de favoris on utilise la méthode ``setFav_sc_name``, avec comme paramètre le nom qui seras attribuer au shortcode.

Pour déclarer quel post-type est visé on utilise ``setFav_type_post`` avec en paramètre le slug du post-type.
Il peut y en avoir plusieurs ils sont alors déclarer sous forme de tableau.

S'il y a du multilingue on peut alors faire appel à la méthode ``setDomaine_name`` et mettre en paramètre le nom du thème voulu.

## Affichage
Le bouton peut-être afficher soit avec un ``add_filter(the_content)`` soit avec un shortcode.

- Pour le **shortcode** il faut utiliser la méthode ``fav_button_sc``
- Pour le **add_filter()** on utilise la méthode ``fav_button``

Pour ces deux méthodes le 1<sup>er</sup> correspond au texte du bouton d'ajout, et le 2<sup>nd</sup> correspond au texte du bouton de suppression.



