# Ajout et suppression de post favoris sous Wordpress.
_Développé avec Wordpress **6.5.3** et Advanced Custom Fields PRO **6.3.0.1**_

Seul le fichier index.php a besoin d'être modifié pour paramétrer les favoris.

Le bouton peut-être déclaré soit avec un add_filter(the_content) soit avec un shortcode.

- Pour le shortcode il faut utiliser la méthode ``fav_button_sc``
- Pour le add_filter() on utilise la méthode ``fav_button``