<?php 

namespace favorite;

require_once('depedencies.php');

use favorite\depedence;

abstract class favorite extends depedence
{
	public function __construct() {
		if ($this->getACFpro())	
		{
			
		}
	}
	
	private $field = 'favoris';
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
	
	private $user_fav;
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
	
// {------ MESSAGE ------ //
	private $fav_void;
		/**
		* Getter du message d'absence de favoris
		* public string getFav_user(void)
		*/
		public function getFav_void() {	
			return($this->fav_void);
		}

		/**
		* Setter du message d'absence de favoris
		* public void setFav_void(string)
		*/
		public function setFav_void($msg_void) {	
			$this->fav_void = $msg_void; 
		}	
	
	// {------ TITLE ------ //
		private $fav_msg_title_height = "2";
			/**
			* Getter de la taille du titre du post
			* public string getFav_msg_title_height(void)
			*/
			public function getFav_msg_title_height() {	
				return($this->fav_msg_title_height);
			}

			/**
			* Setter de la taille du titre du post
			* public void setFav_msg_title_height(string)
			*/
			public function setFav_msg_title_height($title) {	
				$this->fav_msg_title_height = $title; 
			}

		private $fav_msg_title;
			/**
			* Getter du titre du post
			* public string getFav_msg_title(void)
			*/
			public function getFav_msg_title() {	
				return($this->fav_msg_title);
			}

			/**
			* Setter du titre du post
			* public void setFav_msg_title(string)
			*/
			public function setFav_msg_title($title) {	
				$this->fav_msg_title = $title; 
			}
	
		private $fav_msg_title_class = "";
			/**
			* Getter des classes du titre du post
			* public string getFav_msg_title_class(void)
			*/
			public function getFav_msg_title_class() {	
				return($this->fav_msg_title_class);
			}

			/**
			* Setter des classes du titre du post
			* public void setFav_msg_title_class(string)
			*/
			public function setFav_msg_title_class($class) {	
				$this->fav_msg_title_class = $class; 
			}
	
		public function save_title($content_post)
		{
			$this->setFav_msg_title('<h'.$this->getFav_msg_title_height().' class="'.$this->getFav_msg_title_class().'">'.$content_post->post_title.'</h'.$this->getFav_msg_title_height().'>');

		}
	//}	

	// {------ LINK ------ //
		private $fav_msg_link;
			public function getFav_msg_link() {
				return($this->fav_msg_link);
			}	
	
			private function setFav_msg_link($link) {
				$this->fav_msg_link = $link;
			}
			
			public function save_link($idpost, $content = 'En savoir plus') {
				$this->setFav_msg_link('<div><a href="'.get_permalink($idpost).'">'.__($content).'</a></div>');
			}
	//}	
	
	// {------ THUMBNAIL ------ //
		private $fav_msg_thumbnail;
			public function getFav_msg_thumbnail() {
				return($this->fav_msg_thumbnail);
			}	
	
			private function setFav_msg_thumbnail($link) {
				$this->fav_msg_thumbnail = $link;
			}
			
			public function save_thumbnail($idpost) {
				$this->setFav_msg_thumbnail(get_the_post_thumbnail($idpost, 'medium'));
			}
	
	//}	
	
	// {------ CONTENT ------ //
		private $fav_msg_content;
			/**
			* Getter de contenu du post
			* public string getFav_msg_content(void)
			*/
			public function getFav_msg_content() {	
				return($this->fav_msg_content);
			}

			/**
			* Setter de contenu du post
			* public void setFav_msg_content(string)
			*/
			public function setFav_msg_content($content) {	
				$this->fav_msg_content = $content; 
			}	

		private $fav_msg_content_type = "content";
			/**
			* Getter du type de contenu du post
			* public string getFav_msg_content_type(void)
			*/
			public function getFav_msg_content_type() {	
				return($this->fav_msg_content_type);
			}

			/**
			* Setter du type de contenu du post
			* public void setFav_msg_content_type(string)
			*/
			public function setFav_msg_content_type($content) {	
				$this->fav_msg_content_type = $content; 
			}
	
		public function save_content($content_post) {	
			try {
				if($this->getFav_msg_content_type() == "excerpt")
				{
					$this->setFav_msg_content($content_post->post_excerpt);
				}
				else if($this->getFav_msg_content_type() == "content")
				{
					$this->setFav_msg_content($content_post->post_content);
				}
				else 
				{
					throw new \Exception(__("Erreur du type de contenu entrée : ".$this->getFav_msg_content_type().". <br>Il doit être soit \"content\" soit \"excerpt\".", $this->getDomain_name()));
				}
			}
			catch (\Exception $e) 
			{
				$this->error($e->getMessage());
				return;
			}
		}

	//}
	
	private $sc;
		public function getSc()
		{
			return($this->sc);
		}
		
		public function save_sc($string)
		{
			$this->sc = $string;
		}	
// }
	
	
	private $fav_archive;
		/**
		* Getter du nom du champ visé
		* public string getField(void)
		*/
		public function getFav_archive() {
			return($this->fav_msg_id);
		}

		/**
		* Setter du nom du champ visé
		* public bool setField(string)
		*/
		public function setFav_archive($id) {
			$this->fav_archive = $id;
		}
	
	public function save_archive($format = '') {
		$code_html = '<div class="fav_container">';
		if($this->getFav_user()[0])
		{
			foreach($this->getFav_user()[0] as $idpost)
			{	
				$content_post = get_post($idpost);
				
				$this->save_title($content_post);
				$this->save_content($content_post);
				$this->save_thumbnail($idpost);
				$this->save_link($idpost);
				$this->save_sc('[favorites id="'.$idpost.'"]');

				if($format !== '')
				{
					$code_html .= $format;
				}
				else
				{ 
					if ($idpost != '')
					{
						// Si besoin modifiez le code si dessous ceci est l'affichage dans la page des favoris
						$code_html .= "<article class='item_fav product_".$idpost."'>";
						$code_html .= $this->getFav_msg_title();
						$code_html .= $this->getFav_msg_thumbnail();
						$code_html .= $this->getSc();
						$code_html .= $this->getFav_msg_content();
						$code_html .= $this->getFav_msg_link();
						$code_html .= "</article>";
					}
					else
					{
						$code_html .=$this->getFav_void();
					}
				}
			}
		}
		else
		{
			$code_html .=$this->getFav_void();
		}
		$code_html .= "</div>";
		return($code_html);
	}
	
	/**
	* Affichage du shortcode du listing des favories
	* public string fav_sc_list(void)
	*/
	public function fav_sc_list() {
		add_shortcode($this->getField(),  function () 
			{	
				return(do_shortcode($this->save_archive()));
			}
		);
	}
	
	public function fav_hook_list() {
		add_action('fav_listing', function ()
			{
				return(do_shortcode($this->save_archive()));
			}
		);
	}
}