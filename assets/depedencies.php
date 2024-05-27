<?php 

namespace favorite;
	
abstract class depedence
{
	// Properties
	
	// Methods
	public function __construct() {
		$this->getACFpro();	
	}
	
	
	/**
	* Vérification de la présence d'ACF Pro
	* protected bool getACFpro(void)
	*/
	protected function getACFpro() {
		try 
		{
			if ( !is_plugin_active('advanced-custom-fields-pro/acf.php') )
			{
				throw new \Exception(__("Erreur ACF Pro : <br>Le plugin ACF Pro n'est pas intallé/activé. <br>Les favoris ne peuvent s'initialiser."));	
			}
			return(true);
		}
		catch (\Exception $e) {
            $this->error($e->getMessage());
			return(false);
        }
	}
	
 	/**
	* Affiche les erreurs
	* protected void error(string)
	*/
    protected function error($msgError) {
        echo("<code><p>".$msgError."</p></code>");
    }
	
	public function fav_block() {
		if( function_exists('acf_register_block_type') ) 
		{
			add_action('acf/init', function () {
				acf_register_block_type(array(
					'name'              => 'favorites',
					'title'             => __('favorites'),
					'description'       => __('A favorite block.'),
					'render_template'   => '../include/block_list_favorites.php',
					'category'          => 'common',
					'icon'              => 'leftright',
					'keywords'          => array( 'favorites'),
				));
			});
		}
	}
	
	public function fav_shortcode() {
		add_shortcode('test', function () 
		{
			$code_html = "test";
			return($code_html);
		});
	}
}