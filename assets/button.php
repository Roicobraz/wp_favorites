<?php

namespace favorite;

require_once('favorites.php');

use favorite\favorite;

class button extends favorite
{
	// Properties
	private $fav_btn_content_add = 'add to favorites';
	private $fav_btn_content_del = 'remove to favorites';
	private $fav_btn_class;
	private $fav_param = 'add_favorite';
	private $fav_type_post = 'offer';
	
	// Methods
	public function __construct() {
		if ($this->getACFpro())
		{
			$this->fav_action();	
		}
	}
	
	/**
	* Getter / Setter
	*/
	public function getFav_btn_content_add() {
		return($this->fav_btn_content_add);
	}
	
	public function setFav_btn_content_add($content) {
		$this->fav_btn_content_add = $content;
	}	
	
	public function getFav_btn_content_del() {
		return($this->fav_btn_content_del);
	}
	
	public function setFav_btn_content_del($content) {
		$this->fav_btn_content_del = $content;
	}
	
	public function getFav_btn_class() {
		return($this->fav_btn_class);
	}
	
	public function setFav_btn_class($content) {
		$this->fav_btn_class = $content;
	}
	
	public function getFav_param() {
		return($this->fav_param);
	}	
	
	public function setFav_param($content) {
		$this->fav_param = $content;
	}
	
	public function getFav_type_post() {
		return($this->fav_type_post);
	}	
	
	public function setFav_type_post($content) {
		$this->fav_type_post = $content;
	}
	
	
	/**
	* Vérifie si le post est en favori
	* public bool fav_is_favorite(int)
	*/
	public function fav_is_favorite($id) {
		if (!empty(get_field($this->getField(), 'user_'.get_current_user_id())))
		{
			if(in_array(get_permalink($id), get_field($this->getField(), 'user_'.get_current_user_id())))
			{
				return(true);
			}
		}
	}

	/**
	* Affichage des boutons en fonction de la présence ou non du post dans les favoris
	* public string fav_button(string, string)
	*/
	public function fav_button($btn_content_add = '', $btn_content_del = '') {
		if($btn_content_add)
		{
			$this->setFav_btn_content_add($btn_content_add);
		}	
		
		if($btn_content_del)
		{
			$this->setFav_btn_content_del($btn_content_del);
		}

		add_filter( 'the_content', 
			function ($content) 
			{
				if(in_the_loop() || !is_main_query())
				{

					if(is_array($this->getFav_type_post()))
					{
						foreach ($this->getFav_type_post() as $post_type)
						{
							if( $post_type == get_post_type() )
							{
								return($this->fav_form().$content);
							}
						}
					}
					else
					{
						if( $this->getFav_type_post() == get_post_type() )
						{
							if ($this->fav_is_favorite(get_the_ID()))
							{
								return($this->fav_form_del().$content);
							}
							else
							{	
								return($this->fav_form_add().$content);
							}
						}
					}
				}
			},
			99,
			1
		);
	}
	
	/**
	* Formulaire du bouton d'ajout 
	* private string fav_form_add(void)
	*/
	private function fav_form_add() {
		return('
		<form action="'.get_permalink().'?'.$this->getFav_param().'=true" method="post">
			<input type="number" hidden="true" name="fav" value="'.get_the_id().'">
			<button type="submit">'.__($this->getFav_btn_content_add()).'</button>
		</form>
		');
	}
	
	/**
	* Formulaire du bouton de suppression 
	* private string fav_form_del(void)
	*/
	private function fav_form_del() {
		return('
		<form action="'.get_permalink().'?'.$this->getFav_param().'=false" method="post">
			<input type="number" hidden="true" name="fav" value="'.get_the_id().'">
			<button type="submit">'.__($this->getFav_btn_content_del()).'</button>
		</form>
		');
	}
	
	/**
	* Effectue l'action du bouton en fonction de la valeur du paramètre et fais une redirection
	* private void fav_action(void)
	*/
	private function fav_action() {
		add_action( 'get_header', function () {		
			if (isset($_GET[$this->getFav_param()])) 
			{	
				$current_url = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
				if ($_GET[$this->getFav_param()] == 'true')
				{				
					$this->fav_action_button_add($_POST['fav']);
					wp_redirect(str_replace('?'.$this->getFav_param().'=true', '', $current_url));
				}
				else
				{			
					$this->fav_action_button_del($_POST['fav']);
					wp_redirect(str_replace('?'.$this->getFav_param().'=false', '', $current_url));
				}
	   		}
		}, 99);
	}
	
	/**
	* Action du boutton d'ajout 
	* private void fav_action_button_add(int)
	*/
	private function fav_action_button_add($new_value) {
		try
		{
			$initial_value = $this->getFav_user();
			$value = $this->getFav_user();
	
			if(empty($value[0]))
			{ 	
				$value = array(array($new_value));
			}
			else if (!in_array($new_value, $value[0]))
			{
				array_push($value[0], $new_value);
			}

			$this->setFav_user($value);

			if ($this->getFav_user() != $initial_value)
			{
				$this->setFav_user($value);

				if(is_array($this->getFav_user()))
				{
					if(!update_field( $this->getField(), $this->getFav_user()[0], 'user_'.get_current_user_id()))
					{
						throw new \Exception(__("Erreur d'ajout de favoris."));	
					}
				}
			}		
		}
		catch (\Exception $e) {
            $this->error($e->getMessage());
			return(false);
        }
	}
	
	/**
	* Action du boutton de suppression 
	* private void fav_action_button_del(int)
	*/
	private function fav_action_button_del($del_value) {
		try
		{
			$initial_value = $this->getFav_user();
			$value = $this->getFav_user();
	
			if (in_array($del_value, $value[0]))
			{
				if (($key = array_search($del_value, $value[0])) !== false) {
					unset($value[0][$key]);
				}
			}

			$this->setFav_user($value);

			if ($this->getFav_user() != $initial_value)
			{
				$this->setFav_user($value);

				if(is_array($this->getFav_user()))
				{
					if(!update_field( $this->getField(), $this->getFav_user()[0], 'user_'.get_current_user_id()))
					{
						throw new \Exception(__("Erreur de suppression de favoris."));	
					}
				}
			}		
		}
		catch (\Exception $e) {
            $this->error($e->getMessage());
			return(false);
        }
	}
}