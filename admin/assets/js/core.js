jQuery(function($) {

	// return to top of page
	$("#top-of-page").click(function(e){
		$("html,body").animate({scrollTop:0}, "slow");
		e.preventDefault();	
	});
	
	$(".alert").alert();
	
	// toggle meta tag form fields
	$('#meta_generated').click(function() {
	    if( $(this).is(':checked')) {
	        $("#meta_tags").slideUp();
	    } else {
	        $("#meta_tags").slideDown();
	    }
	});

});