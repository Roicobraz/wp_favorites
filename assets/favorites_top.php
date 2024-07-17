<?php

function sc_test()
{
	$user = wp_get_current_user(); 
	$user_role = $user->roles[0];
	if($user_role == "administrator" || $user_role == "editor")
	{
		$user_query = new WP_User_Query( array( 
			'meta_query' => array(
					array(
						'key'     => 'favoris',
						'value'   => null,
						'compare' => '!='
					)
			) ) );
		$user_query = $user_query->get_results();
		$favorites = array();
		
		foreach($user_query as $user)
		{
			$user_id = $user->data->ID;
			$user_favorite = get_field("favoris" , "user_".$user_id );
			foreach($user_favorite as $favorite)
			{
				$user_link = get_edit_user_link($user_id);
				
				if(!array_key_exists($favorite, $favorites))
				{
					$favorites[$favorite]["count"] = 1;
				}
				else
				{
					$favorites[$favorite]["count"]++;
				}
				
				if(empty($favorites[$favorite]["user"]))
				{
					$favorites[$favorite]["user"] = "<div class='mail'><a href='".$user_link."'>".$user->data->user_email."</a></div>";
				}
				else
				{
					$favorites[$favorite]["user"] .= "<div class='mail'><a href='".$user_link."'>".$user->data->user_email."</a></div>"; 
				}
			}
		}
		
		$columns = array_column($favorites, 'count');
		array_multisort($columns, SORT_DESC, $favorites);
				
		wp_reset_query();
		
		$elements = '';
		
		foreach(array_keys($favorites) as $favorite)
		{	
			$current_post = get_post(url_to_postid($favorite));
			$elements .= '
				<tr>
					<td class="product"><a href="'.$favorite.'">'.$current_post->post_title.'</a></td>
					<td class="count">'.$favorites[$favorite]["count"].'</td>
				</tr>
				<tr>
					<td colspan="2" class="mails">'.$favorites[$favorite]["user"].'</td>
				</tr>';
		}
		
		$code_html = '<div class="topfav_container"><table><tbody>'.$elements.'</tbody></table></div>';
//		print_r($favorites);
		
		return($code_html);
	}
}
add_shortcode('top_favorites', 'sc_test');