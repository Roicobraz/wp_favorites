<?php 

namespace favorite;

require_once('depedencies.php');

use favorite\depedence;

abstract class favorite extends depedence
{
	// Properties
	private $field = 'favoris';
	private $user_fav;
	
	// Methods
	/**
	* Getter du nom du champ visé
	* public string getField(void)
	*/
	public function getField() {
		return($this->field);
	}
	
	/**
	* Setter du nom du champ visé
	* public bool setField(string)
	*/
	public function setField($field) {
		$this->field = $field;
	}
	
	/**
	* Getter des favoris de l'utilisateur courrant
	* public array getFav_user(void)
	*/
	public function getFav_user() {	
		return($this->user_fav);
	}
	
	/**
	* Setter du nom du champ visé
	* public void setFav_user(array)
	*/
	public function setFav_user($fav) {	
		$this->user_fav = $fav; 
	}
}