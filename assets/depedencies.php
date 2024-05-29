<?php 

namespace favorite;
	
abstract class depedence
{
	// Properties
	private $domain_name;
	
	// Methods
	public function __construct() {
		$this->getACFpro();	
	}
		
	/**
	* Getter du nom de domaine 
	* public string getDomain_name(void)
	*/
	protected function getDomain_name() {
		return($this->domain_name);
	}
	
	/**
	* Setter du nom de domaine 
	* public void setDomaine_name(string)
	*/
	protected function setDomaine_name($domain_name) {
		$this->domain_name = $domain_name;
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
	
	/**
	* str_contains qui est non disponible en-dessous de la 8.0 de php
	* protected string str_contains string, string
	*/
	protected function str_contains($haystack, $needle) {
        return $needle !== '' && mb_strpos($haystack, $needle) !== false;
	}
}