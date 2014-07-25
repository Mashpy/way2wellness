<?php
function wpsc_check_ecom_subscribers(){
//default capabilities
	$array_capabilities = array('posts-base','posts-premium','forum-base');
	$userdata = get_userdata($value);
	foreach($array_capabilities as $capabilities){
		if(array_key_exists($capabilities, $userdata->wp_capabilities)){
			$subscriber[] = $userdata;
		}
	}	
}
function subscriber_row( $user_object, $style = '', $role = '', $numposts = 0 ) {

		
	global $wp_roles;
	if ( !( is_object( $user_object) && is_a( $user_object, 'WP_User' ) ) )
	
	$user_object = new WP_User( (int) $user_object );

		//this is statment prevents any general wp user being added to the view all section of the subscriber list
		if (count($user_object->caps) == 1 | count($user_object->caps) ==''){
		return;
		}
		
	//sets up the data to be displayed for the user in the row
	
	$user_object = sanitize_user_object($user_object, 'display');
	$edit_link = 'admin.php?page=wpsc_display_ecom_subscribers&action=removeall&user_id='.$user_object->ID ;
//	$edit = "<strong><a href=\"$edit_link\">$user_object->user_login</a></strong><br />";
	$edit = "<strong>$user_object->user_login</strong><br />";
	$actions['edit'] = '<a href="' . $edit_link . '" onclick=\"return conf();\">' . __('Remove Subscriptions') . '</a>';

	$actions = apply_filters('user_row_actions', $actions, $user_object);
	$action_count = count($actions);
	$i = 0;
	$edit .= '<div class="row-actions">';
	foreach ( $actions as $action => $link ) {
		++$i;
		( $i == $action_count ) ? $sep = '' : $sep = ' | ';
		$edit .= "<span class='$action'>$link$sep</span>";
	}
	$edit .= '</div>';
	$checkbox = "<input type='checkbox' name='users[]' id='user_{$user_object->ID}' value='{$user_object->ID}' />";
	$r = "<tr id='user-$user_object->ID'$style>";
	$columns = get_column_headers('subscribers');
	$hidden = get_hidden_columns('subscribers');
	$avatar = get_avatar( $user_object->ID, 32 );
	$length = get_usermeta( $user_object->ID,'_subscription_ends' );
	
	foreach ( $columns as $column_name => $column_display_name ) {
		$class = "class=\"$column_name column-$column_name\"";
		$style = '';
		if ( in_array($column_name, $hidden) )
			$style = ' style="display:none;"';
			$attributes = "$class$style";
		switch ($column_name) {
			case 'cb':
				$r .= "<th scope='row' class='check-column'>$checkbox</th>";
				break;
			case 'username':
					$r .= "<td $attributes>";
				if( $length ) {
					$r .= "<table>";
					$r .= $avatar . $edit;
					$r .= "</table>";
				}
				$r .= "</td>";
				break;
			case 'memname':
				$r .= "<td $attributes>$user_object->first_name $user_object->last_name</td>";
				break;
			case 'role':
				$r .= "<td $attributes>";
				$output = '';
				foreach ( $user_object->caps as $cap => $value ) {
					if ( !$wp_roles->is_role($cap) ) {
						if ( $output != '' )
							$output .= '<br />';
						$output .= $value ? $cap : "Denied: {$cap}";
					}
				}
				$r.= $output;
			$r.= "</td>";
				break;
			case 'subLength':
				$r .= "<td $attributes>";
				if( $length ) {
					$r .= "<table>";
						
					foreach( $length as $capability => $key ) {
						if( $capability ) {
							if (empty($key) || $key == 'never')
								$r .= "<tr> </tr> Permanent Subscription <br />";
							else
								$r .= "<tr>".vl_wpscsm_time_duration($key-time(),'yMw' )."</tr> <br />";
						}
					}
					$r .= "</table>";
				}
				$r .= "</td>";
				break;
			case 'expireDate':
			$r .= "<td $attributes>";
			if( $length ) {
				$r .= "<table>";

				foreach( $length as $capability => $key ) {
					if( $capability ) {
						if ( empty($key) || $key == 'never' )
							$r .= "<tr> </tr> <br />";
						else 
							$r .= "<tr>".date("F j, Y",$key)."</tr> <br />";
					}
				}
				$r .= "</table>";
			}
			$r .= "</td>";
			break;
			case 'status':
				$r .= "<td $attributes>";

				if( $length ) {
					$r .= "<table>";
					foreach( $user_object->caps as $cap => $value ) {
					if ( !$wp_roles->is_role($cap) ) {
					$edit_link2 = 'admin.php?page=wpsc_display_ecom_subscribers&action=edit&user_id='.$user_object->ID . '&cap_name=' .$cap;
					$edit2 = "<a class =\"edlink\" href=\"$edit_link2\">&nbsp; edit</a>";
						if( $cap < time() ) {
							$status = "Active";
						} else {
							$status = "Expired";
						}
						$r .= $status;
						$r .= $edit2 ."<br />";
						}
					}
					$r .= "</table>";
					
				}
				$r .= "</td>";
				break;
		}
	}
	$r .= '</tr>';
	return $r;
}
		
		
		
//sets up the data to be displayed for the user in the import row
function importer_row($user_object, $style = '', $role = '', $rowId =0, $SelectedUserIds){

	global $wp_roles;
	if ( !( is_object($user_object) && is_a( $user_object, 'WP_User' ) ) )
	
	$user_object = new WP_User( (int) $user_object );	
	$user_object = sanitize_user_object($user_object, 'display');
	
	for ($x=0; $x <= count ($SelectedUserIds) -1; $x++)
	{
		if ($SelectedUserIds[$x] == $user_object->ID){
		$ischecked = 'checked'; 
		}
	}
	
	$checkbox = "<input type='checkbox' $ischecked name='chkuser_$rowId' value='$rowId'  />
	<input type='hidden' name='userID_$rowId' value='{$user_object->ID}' />";
	
	$r = "<tr id='user-$user_object->ID'$style>";
	$columns = get_column_headers('subscribers');
	$hidden = get_hidden_columns('subscribers');
	$avatar = get_avatar( $user_object->ID, 32 );
	$length = get_usermeta( $user_object->ID,'_subscription_ends' );
	
	foreach ( $columns as $column_name => $column_display_name ) {
		$class = "class=\"$column_name column-$column_name\"";
		$style = '';
		if ( in_array($column_name, $hidden) )
			$style = ' style="display:none;"';
			$attributes = "$class$style";
		switch ($column_name) {
			case 'cb':
				$r .= "<th scope='row' class='check-column'>$checkbox</th>";
				break;
			case 'username':
				$r .= "<td $attributes>";
					$r .= "<table>";
					$r .= $avatar . $user_object->display_name;
					$r .= "</table>";
				$r .= "</td>";
				break;
			case 'memname':
				$r .= "<td $attributes>$user_object->first_name $user_object->last_name</td>";
				break;
			case 'role':
	$r .= "<td $attributes>";
				$output = '';
				foreach ( $user_object->caps as $cap => $value ) {
					if ( !$wp_roles->is_role($cap) ) {
						if ( $output != '' )
							$output .= '<br />';
						$output .= $value ? $cap : "Denied: {$cap}";
					}
				}
				$r.= $output;
			$r.= "</td>";
				break;
			
		}
	}
	$r .= '</tr>';
	return $r;
}

// Validates the bulk options returns the error messages
function wpsc_ValidiateOptions($UserId, $bulk_option, $length = '', $roles = '')
{
	switch($bulk_option)
	{
	case 1: //Add - Must select everything
			if ($UserId &&  ($length == '' | $roles == ''))
			{
				return "You must choose a subscription and length for all selected users";
			}
	break;

	case 2: //Remove all must select a user
	if (!$UserId)
			{
				return "You must select a user";
			}
	break;
	default:
				return "You must select a bulk option";
	break;
	}
	
}



//function displays the users in the rows
function wpsc_display_ecom_subscribers() {
	global $wpdb;
	$action = $_POST['action'];
	if( !$action ) {
		$action = $_GET['action'];
	} ?>
<div class="wrap">
<?php

	switch( $action ) {
	//this case process the add new capability save
		case 'save':
				if( $_POST['user'] && $_POST['length'] && $_POST['roles']) {
					$user_id = $_POST['user'];
					$length = $_POST['length'];
					$role = $_POST ['roles'];
					
					wpsc_save_user($user_id, $length, $role);
					wpsc_display_update('Subscription created');
					wpscsm_sort_users_page();
				} else {
					echo '<h3>Add Subscriber</h3>';
					wpsc_display_error('User, Length and subscription type must be provided.');
					wpscsm_add_subscriber_page();
				}
				break;
				//form to add new user
		case 'new':
			//echo '<div id="icon-tools" class="icon32"></div><h2>Add Subscriber</h2>';		
				echo '<div id="col-container" class="">';
				echo '<div id="poststuff" class="col-wrap">';
				wpsc_display_tabs();
				echo '<div id="pad-left">';
				echo '<h3>WP e-Commerce Subscribers: Add Subscriber <a href="admin.php?page=wpsc_display_ecom_subscribers&action=import" class="button add-new-h2">Import</a></h3>';
				echo '<p> Select a WordPress user and the details that you want to apply.<br /> Use the import button if you want to apply the same subscription to more than one user or Delete multiple users.</p>';
				echo '<div id="custom-m-small">';
				add_meta_box("your-profile-form", __('Add a subscription to a user', 'wpsc'), "wpscsm_add_subscriber_page", "wpsc");
				do_meta_boxes('wpsc','advanced',null); 
				echo '</div>'; //close custom m small
				echo '</div>'; //close pad-left
				echo '</div>'; //close post stuff
				echo '</div>'; //close col container
				//wpscsm_add_subscriber_page();
			break;
			///edit user
		case 'edit':
	
				echo '<div id="col-container" class="">';
				echo '<div id="poststuff" class="col-wrap">';
				wpsc_display_tabs();
				echo '<div id="pad-left">';
				echo '<h3>WP e-Commerce Subscribers: Edit Subscriber</h3><br />';
				//echo '<p>Fill out all the details to edit a subscriber </p>';
				echo '<div id="custom-m-small">';
				add_meta_box("edit-profile", __('Edit Subscription', 'wpsc'), "wpscsm_edit_subscriber_page", "wpsc");
				do_meta_boxes('wpsc','advanced',null); 
				echo '</div>'; //close custom m small
				echo '</div>'; //close pad-left
				echo '</div>'; //close post stuff
				echo '</div>'; //close col container
				//wpscsm_edit_subscriber_page();
			break;
			//sorts user catagories
		case 'sort':
				wpscsm_sort_users_page();
			break;
			//imports all wordpress users
		case 'import':
				wpscsm_import_subscriber_page(null);
			break;
				case 'removeall':
				$sid = $_GET['id'];
				$uid = $_GET['user_id'];
	
				if( $uid ) {
					wpsc_remove_all($uid);
				}
			wpscsm_sort_users_page(null);
			break;
		case 'bulksave':

		///bulk option value 1 = add sub 2 = remove sub 3=remove allcapabilities else = 'no bulk option chosen'
		$bulk_option = $_POST['bulkchange'];
				
				$UserIds = array();
				$arrItem = 0;
				for ($x=0; $x <= $_POST['hdnTotalRows']-1; $x++)
				{
				
					if (isset($_POST['chkuser_' . $x]))
					{
						$UserId = $_POST['userID_' . $x];
						
						$validationMessage = wpsc_ValidiateOptions($UserId, $bulk_option, $_POST['length'], $_POST['roles']);
						//adding all users that were previously selected
						//these are passed back into function incase there's an error
						// and then they don't need to reselect them.
						//Validation is checked below... 
						//if it passes it saves, if it doesn't it passes the selected users to the function
						// and prompts the user to enter or select more options
						$UserIds[$arrItem] = $UserId;
						$arrItem++;						
					}
				}
				
				if (!$validationMessage){
					for ($i = 0; $i <= count ($UserIds) -1; $i++)
					{
						if ($bulk_option == 1)
						{
							wpsc_save_user($UserIds[$i],  $_POST['length'], $_POST['roles']);
								
						}
						else if ($bulk_option == 2)
						{
							wpsc_remove_all($UserIds[$i]);
						}	
					}	
					wpscsm_sort_users_page(); 
				}
				
				else
				{
					wpsc_display_error($validationMessage);
					wpscsm_import_subscriber_page($UserIds);
				
				}
				
			break;
		case 'update': 
				if($_POST['length'] && $_POST['roles'] ) {
					
					$length = $_POST['length'];
					$user_id = $_POST['user_id'];
					///this is the name of the cap that was getting edited
					$capabilityName= $_GET['cap_name'] ;
					////this is the new capability.
					$role = $_POST ['roles'];

					$add_user = new WP_User($user_id);
					
					$members_lengths = get_user_meta($user_id, '_subscription_ends',true);
					$future_time = mktime(date('h'),date('m'),date('s')+$length,date('m'),(date('d')),date('Y'));						          		          
					///remove the old capability and add the new one
					$add_user->remove_cap($capabilityName);
					$add_user->add_cap($role, true);	
	
					$subscription_lengths = get_user_meta($user_id, '_subscription_length',true);
					//unset the old values - this is very important!
					unset($subscription_lengths[$capabilityName]);
					unset($members_lengths[$capabilityName]);
					
					$members_lengths[$role] = $future_time;
					
					$subscription_lengths[$role]= $length;
				
					update_user_meta($user_id,'_subscription_ends', $members_lengths);
					update_user_meta($user_id,'_subscription_length', $subscription_lengths);
					
					wpsc_display_update('Subscription Edited.');
					wpscsm_sort_users_page();
				} else {
					echo '<h3>Edit Subscriber</h3>';
					wpsc_display_error('Please Update all the subscription information correctly');
					wpscsm_edit_subscriber_page();
				}
			break;
		default: 
		wpscsm_sort_users_page();
			break;
	
	} ?>
</div>
<?php 
}

function wpsc_display_tabs()
{
echo '<div id="icon-users" class="icon32"><br /></div><h2><a href="admin.php?page=wpsc_display_ecom_subscribers" class="nav-tab nav-tab-active"> Manage Users</a> <a href="admin.php?page=wpsc-purchasable-capabilities" class="nav-tab">Manage Subscriptions</a></h2>';
}


///this function removes all the user meta and capabilities for the user, it then add the subscriber role back
///need to put a check in here to make sure all other users that are not subscribers dont get removed, or we could excluded all users from the table that are not subscribers
function wpsc_remove_all($user_id){
	global $wp_roles;
	$remove_user = new WP_User($user_id);
	$remove_user = sanitize_user_object($remove_user, 'display');
//	$remove_user->remove_all_caps($user_id); - better to only remove members&capabilities caps...
//	$remove_user->add_role( 'subscriber' );
	foreach ($remove_user->caps as $cap => $value ) {
		if (!$wp_roles->is_role($cap)) {
			$remove_user->remove_cap($cap);
		};
	};

	if (count($remove_user->caps) > 1) {
		$remove_user->remove_role( 'subscriber' );
	} elseif (count($remove_user->caps) < 1) {
		$remove_user->add_role( 'subscriber' );
	};

	delete_user_meta( $user_id, '_subscription_ends' );
	delete_user_meta( $user_id, '_subscription_length' );
	delete_user_meta( $user_id, '_subscription_starts' );
	wpsc_display_update('User\'s Subscriptions Removed');	

}
// Function Saves the capabilitites to the user (Both bulk add and single add)
function wpsc_save_user($user_id, $length, $role)
{
		$add_user = new WP_User($user_id);
		
		//$members_lengths = array();
		$members_lengths = get_user_meta($user_id, '_subscription_ends',true);
		$members_starts = get_user_meta($user_id, '_subscription_starts',true);

		$future_time = mktime(date('h'),date('m'),date('s')+$length,date('m'),(date('d')),date('Y'));	
		$current_time = time();
				           
		$members_lengths[$role]= $future_time;	
		$members_starts[$role]= $current_time;
		$add_user->add_cap($role, true);					
		
		//$subscription_lengths = array();
		$subscription_lengths = get_user_meta($user_id, '_subscription_length');	
		$subscription_lengths[$role]= $length;
		
		$add_user->add_role( 'subscriber' );
		update_user_meta($user_id,'_subscription_ends', $members_lengths);
		update_user_meta($user_id,'_subscription_length', $subscription_lengths);
		update_user_meta($user_id,'_subscription_starts', $members_starts);
}

//creates the update css for all updates messages
function wpsc_display_update($message)
{
	echo '<div class="updated"><p>'. $message .'</p></div>';
}

///used to display the css for all error messages
function wpsc_display_error($message)
{
	echo '<div class="error"><p>'. $message .'</p></div>';
}

function wpscsm_import_subscriber_page($selectedUserIds){

	global $wpdb;
		$currentPage = $_GET['showpage'];
	   $wp_user_search = new WP_User_Search('', $currentPage, '');  
			$wp_user_search->users_per_page = 20; //change this to display more users
			$wp_user_search->prepare_query();
	      	$wp_user_search->query();
			$wp_user_search->do_paging();
			$paging = str_replace('users.php', 'admin.php?page=wpsc_display_ecom_subscribers&action=import', $wp_user_search->paging_text);
			$paging = str_replace('?userspage','&userspage',$paging);
			
			wpsc_display_tabs();?>
	
	
	<div id="pad-left">
	<h3>Import your WordPress users</h3>
	Use the bulk options to add subscriptions to your WordPress users, this will import them  your WP-e-Commerce subscribers <br />
	<br />
	<div class='tablenav'>
	<form id="bulk_updates" method="post" action="">
	<select name="bulkchange">
		<option value="0" selected="selected">Bulk Actions</option>
		<option value="1">Add Subscription</option>
		<option value="2">Remove all Subscriptions</option>
	</select>
	
<select name="roles">
	<option value="">Select a Subscription</option>
		<?php			
		$roles = get_option( 'wpsc_product_capability_list' ); 
			foreach( $roles as $role => $key ) { 
				?> <option value="<?php echo $role  ?>"><?php echo $role  ?></option><?php
			}?>
</select>

<select name="length">
	<option value="">Choose a Length</option>
	<option value="63113852">2 years</option>
	<option value="31556926">12 months</option>
	<option value="15778463">6 months</option>
	<option value="7889231">3 months</option>
	<option value="2629743">1 month</option>
	<option value="657436">1 week</option>
</select><?php

	
	function wpsc_get_users() {
	      $wp_user_search = new WP_User_Search('', '','');
	    
	      return $wp_user_search->get_results();
	}	   
		$users = wpsc_get_users();
		$columns = array( 
		'cb' => '<input type="checkbox"/>',
		'username' => 'Username', 
		'memname' => 'Name', 
		'role' => 'Current Subscriptions'
		 );
		register_column_headers( 'subscribers',$columns ); ?>		
		
		
	<input type="submit" value="Apply" class="button-secondary" />
	<input type="hidden" name="action" value="bulksave" />
	<input name="hdnTotalRows" type="hidden" value="<?php echo count(wpsc_get_users()); ?>"></input>
<?php echo " <div class='tablenav-pages'>" . $paging . "</div></div>"; ?>

	<table class="widefat fixed" cellspacing="0">
		<thead>
			<tr class="thead">
				<?php print_column_headers('subscribers'); ?>
			</tr>
		</thead>
		<tfoot>
			<tr class="thead">
				<?php print_column_headers('subscribers', false); ?>
			</tr>
		</tfoot>
		
		<tbody id="users" class="list:user user-list">
<?php	

			$style = '';
			$rowId = 0;
				foreach($users as $iUserID){
			
					$user_object = new WP_User($iUserID);
					
					//we don't want to display admin in the import list as they can view all posts anyway
					if($user_object->has_cap('administrator'))
						continue;

				$style = ( ' class="alternate"' == $style ) ? '' : ' class="alternate"';
				echo "\n\t", importer_row( $user_object, $style, '', $rowId, $selectedUserIds);
				$rowId++;
				} ?>
		</tbody>
	</table>
</form>
</div>
<?php
}

///function to sort user links
function wpscsm_sort_users_page() { 
	global $wpdb, $wpsc_product_capability_list, $user_ID;
	$cap= $_GET['cap_name'];
	$currentPage = $_GET['userspage'];
	wpsc_display_tabs(); ///displays user tabs
		
?>
		
		


	<div id="pad-left">
	
	<h3>WP e-Commerce Subscribers: <strong> <?php echo $cap; ?> </strong> <a href="admin.php?page=wpsc_display_ecom_subscribers&action=new" class="button add-new-h2">Add New</a> <a href="admin.php?page=wpsc_display_ecom_subscribers&action=import" class="button add-new-h2">Import</a></h3>
		
		<?php if ($cap){
				echo "<p>You are currently viewing users subscribed to <strong>" .$cap. "</strong></p>";
			}else{
				echo "<p>Use the Import button to apply bulk options to your subscribers and WordPress users.</p>";
			}
	
	function wpsc_get_users_with_role($cap, $currentPage) {
		global $wpsc_product_capability_list, $user_ID;
	      $wp_user_search = new WP_User_Search('', $currentPage, $cap);
	      $wp_user_search->users_per_page = 20; 
	      $wp_user_search->prepare_query();
	      $wp_user_search->query();
	      $wp_user_search->do_paging();
			
			$paging = str_replace('users.php', 'admin.php?page=wpsc_display_ecom_subscribers', $wp_user_search->paging_text);
//			if($wp_user_search->paging_text == '?')
//				$paging = substr($paging,0, strlen($paging)-1);
			
			
			$paging = str_replace('?userspage','&userspage',$paging);
			$paging = str_replace('?role','&cap_name', $paging);
			
			echo "<div class='tablenav'>";
			echo "<ul class='subsubsub'>";
//			$roles = get_option( 'wpsc_product_capability_list' );
			echo '<li><label for="capabilities">Filter:</label>
    <select name="capabilities_dropdown" style="width:200px" onchange="location.href=\'admin.php?page=wpsc_display_ecom_subscribers&cap_name=\'+document.getElementById(\'capabilities_dropdown\').value;" id="capabilities_dropdown">';
      echo '<option ' . $selected . ' value="">All</option>';
		foreach ((array)$wpsc_product_capability_list as $capability => $key) {
			$capability_data = $wpsc_product_capability_list[$capability];
//	    foreach( $roles as $role => $key ) {
			if (current_user_can('administrator') or !$capability_data['owner'] or ($capability_data['owner'] == $user_ID)) {
			$selected='';
			if( $capability == $cap )
				$selected="selected='selected'";
			echo '<option ' . $selected . ' value="' . $capability . '">' . htmlentities(stripslashes($capability_data['name']), ENT_QUOTES, 'UTF-8') . '</option>';
			}
		}
		echo '</select></li>';
		echo '</ul>';						
		echo "<div class='tablenav-pages'>" . $paging . "</div></div>"; ///pagination for import page
	  return $wp_user_search->get_results();		
	}	   
			
		if(!$cap)
		{
			$wp_user_search = new WP_User_Search('', $currentPage, '');
			$wp_user_search->users_per_page = 20; 
			$wp_user_search->prepare_query();
	      	$wp_user_search->query();
			$wp_user_search->do_paging();
			$paging = str_replace('users.php', 'admin.php?page=wpsc_display_ecom_subscribers', $wp_user_search->paging_text);
			$paging = str_replace('?userspage','&userspage',$paging);
			
			echo "<div class='tablenav'>";
			echo "<ul class='subsubsub'>";
			echo '<li><label for="capabilities">Filter:</label>
    <select name="capabilities_dropdown" style="width:200px" onchange="location.href=\'admin.php?page=wpsc_display_ecom_subscribers&cap_name=\'+document.getElementById(\'capabilities_dropdown\').value;" id="capabilities_dropdown">';
      echo '<option ' . $selected . ' value="">All</option>';
		foreach ((array)$wpsc_product_capability_list as $capability => $key) {
			$capability_data = $wpsc_product_capability_list[$capability];
			if (current_user_can('administrator') or !$capability_data['owner'] or ($capability_data['owner'] == $user_ID)) {
			$selected='';
			if( $capability == $cap )
				$selected="selected='selected'";
			echo '<option ' . $selected . ' value="' . $capability . '">' . htmlentities(stripslashes($capability_data['name']), ENT_QUOTES, 'UTF-8') . '</option>';
			}
		}
		echo '</select></li>';

	echo '</ul>';			
			echo "<div class='tablenav-pages'>" . $paging . "</div></div>"; ///this echos the pagintation for main user page
			$users = $wp_user_search->get_results();
		}
		else
		{
			$users = wpsc_get_users_with_role($cap,$currentPage);
		}
		

		if (count($users) == 0)
		{
		echo '<br /> <div class="error"><p>You have no users with the subscription type ' . $cap . '</p></div>';
		}else{
		$columns = array( 
		'cb' => '',
		'username' => 'Username', 
		'memname' => 'Name', 
		'role' => 'Subscription',
		'subLength' => 'Subscription Length',
		'expireDate' => 'Expiry Date',
		'status' => 'Status' );
		register_column_headers( 'subscribers',$columns ); ?>
	<table class="widefat fixed" cellspacing="0">
		<thead>
			<tr class="thead">
				<?php print_column_headers('subscribers'); ?>
			</tr>
		</thead>
		<tfoot>
			<tr class="thead">
				<?php print_column_headers('subscribers', false); ?>
			</tr>
		</tfoot>
		
		<tbody id="users" class="list:user user-list">
<?php	
			$style = '';
			
						foreach($users as $userid){	
							$user_object = new WP_User($userid);
							$roles = $user_object->roles;
							$role = array_shift($roles);
						if ( is_multisite() && empty( $role ) )
							continue;
						$style = ( ' class="alternate"' == $style ) ? '' : ' class="alternate"';
						echo "\n\t", subscriber_row( $user_object, $style, $role);
						}
					

				?>
		</tbody>
	</table>
	</div>
<?php

	}
}

//This function displays edit form
function wpscsm_edit_subscriber_page() {
	$sid = $_GET['id'];
	$uid = $_GET['user_id'];
	
	if( $uid ) {
		global $wpdb;
		$length = get_user_meta($uid,'_subscription_ends');
		$subscription_length = get_user_meta($uid,'_subscription_length'); 
		$user_info = get_userdata($uid);?>

		<form id="edit-profile" method="post" action="">
			<table class="form-table">
			<tr>
				<th scope="row"><label for="role">User Name:</label></th>
					<td>
						<strong><?php echo($user_info->first_name .  " " . $user_info->last_name . "\n"); ?></strong>
					</td>
				</tr>
			<tr>
				<th scope="row"><label for="role">Subscription Type:</label></th>
					<td>
						<select name="roles">
			<?php			
			$roles = get_option( 'wpsc_product_capability_list' ); 
			
			foreach( $roles as $role => $key ) { // key is becauyse it retrieves the first role array from roles.
				if ($_GET['cap_name'] == $role){
					?> <option selected="selected" value="<?php echo $role  ?>"><?php echo $role  ?></option><?php
				}else{
					?> <option value="<?php echo $role  ?>"><?php echo $role  ?></option><?php
				}
			}?>

					</select>
				</td>
			</tr>
			<tr>
				<th scope="row"><label for="length">Subscription Length:</label></th>
				<td>
					<select name="length">
						<option <?php if( $subscription_length[0][$_GET['cap_name']] == "63113852") { echo "selected=\"selected\""; } ?> value="63113852">2 years</option>
						<option <?php if( $subscription_length[0][$_GET['cap_name']] == "31556926") { echo "selected=\"selected\""; } ?> value="31556926">12 months</option>
						<option <?php if( $subscription_length[0][$_GET['cap_name']] == "15778463") { echo "selected=\"selected\""; } ?> value="15778463">6 months</option>
						<option <?php if( $subscription_length[0][$_GET['cap_name']] == "7889231") { echo "selected=\"selected\""; } ?> value="7889231">3 months</option>
						<option <?php if( $subscription_length[0][$_GET['cap_name']] == "2629743") { echo "selected=\"selected\""; } ?> value="2629743">1 month</option>
						<option <?php if( $subscription_length[0][$_GET['cap_name']] == "0") { echo "selected=\"selected\""; } ?> value="0">Deactivate</option>
					</select>
				</td>
			</tr>
		</table>
		
		<p class="submit">
		<input type="submit" value="Update Subscription" class="button-primary" /></p>
		<input type="hidden" name="action" value="update" />
		<input type="hidden" name="user_id" value="<?php echo $uid ?>" />
		<input type="hidden" name="sid" value="<?php echo $_GET['id']; ?>" />
	</form>
<?php
	}

}

//displays add user form
function wpscsm_add_subscriber_page() {
	global $wpdb;
	
	$users_sql = "SELECT * FROM ".$wpdb->prefix."users";
	$users = $wpdb->get_results( $users_sql ); ?>

	<form id="your-profile-form" enctype="multipart/form-data" method="post" action="">
		<table class="form-table">
			<tr>
				<th scope="row"><label for="user">User:</label></th>
				<td>
					<select name="user"> 
<?php 
		$i = 0;
		foreach( $users as $user ) {
		
		$user_object = new WP_User($user->ID);
		//don't want to display admin users
		if($user_object->has_cap('administrator'))
				continue;
	
			$user->first_name = get_usermeta( $user->ID,'first_name' );
			$user->last_name = get_usermeta( $user->ID,'last_name' ); ?>
						<option value="<?php echo $user->ID; ?>"><?php if( $user->first_name && $user->last_name ) { echo $user->first_name." ".$user->last_name; } else { echo '-'; } ?> (<?php echo $user->user_login; ?>)</option>
<?php
			$i++;
			//}
		}?>
					</select>
					<br/>&nbsp;(<?php echo $i; ?> users available)
				</td>
			</tr>
			<tr>
				<th scope="row"><label for="role">Subscription Type:</label></th>
				<td>
					<select name="roles">
			<?php			
			$roles = get_option( 'wpsc_product_capability_list' ); 
			
			foreach( $roles as $role => $key ) { 
				?> <option value="<?php echo $role  ?>"><?php echo $role  ?></option><?php
			}?>
					</select>
				</td>
			</tr>
			<tr>
				<th scope="row"><label for="length">Subscription Length:</label></th>
				<td>
				<select name="length">
						<option value="63113852">2 years</option>
						<option value="31556926">12 months</option>
						<option value="15778463">6 months</option>
						<option value="7889231">3 months</option>
						<option value="2629743">1 month</option>
					</select>
				</td>
			</tr>
		</table>
		<p class="submit">
		<input type="submit" value="Create Subscription" class="button-primary" /></p>
		<input type="hidden" name="action" value="save" />
	</form>

<?php
	}

/**
 * A function for making time periods readable
 *
 * @author      Aidan Lister <aidan@php.net>
 * @version     2.0.1
 * @link        http://aidanlister.com/2004/04/making-time-periods-readable/
 * @param       int     number of seconds elapsed
 * @param       string  which time periods to display
 * @param       bool    whether to show zero time periods
 */
 /// this function needs to be deleted and mktime used or at least use one function or the other!
function vl_wpscsm_time_duration($seconds, $use = null, $zeros = false) {
  $periods = array (
      'years'     => 31556926,
      'Months'    => 2629743,
      'weeks'     => 604800,
      'days'      => 86400,
      'hours'     => 3600,
      'minutes'   => 60,
      'seconds'   => 1
      );
  $seconds = (float) $seconds;
  $segments = array();
  foreach ($periods as $period => $value) {
      if ($use && strpos($use, $period[0]) === false) {
          continue;
      }
      $count = floor($seconds / $value);
      if ($count == 0 && !$zeros) {
          continue;
      }
      $segments[strtolower($period)] = $count;
      $seconds = $seconds % $value;
  }
  $string = array();
  foreach ($segments as $key => $value) {
      $segment_name = substr($key, 0, -1);
      $segment = $value . ' ' . $segment_name;
      if ($value != 1) {
          $segment .= 's';
      }
      $string[] = $segment;
  }
  return implode(', ', $string);
}

?>
