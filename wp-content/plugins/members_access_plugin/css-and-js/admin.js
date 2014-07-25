
function suspendmembers(id,capability){
jQuery(document).ready(function(){
	var comm =jQuery("#"+capability+id).attr("checked");

	alert(comm);
	if (comm == true){
		jQuery.post("index.php","admin=true&ajax=true&members_caps=true&suspend=true&value=1&id="+id);
	} else {		
		jQuery.post("index.php","admin=true&ajax=true&members_caps=true&suspend=true&value=2&id="+id);
	}
	//	jQuery.post('index.php?wpsc_admin_action=check_form_options',post_values, function(returned_data){
	return false;
	});
}

jQuery(document).ready(function() {
	 // hides the slickbox as soon as the DOM is ready
	  jQuery('#hide-recurring-billing').hide();

	 // displays extra options if wordpress theme selected
	  jQuery('radio-recurring-y').click(function() {
		jQuery('#hide-recurring-billing').slideDown(400);
		return false;
	  });
	  
	  
	// hides the extra options if theme is apple
	  jQuery('radio-recurring-n').click(function() {
		jQuery('#hide-recurring-billing').slideUp(400);
		return false;
	  });


});
