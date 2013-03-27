jQuery(function($){
	// use jQuery to wire up dropdown menu using bootstrap classes
	var $dropdowns = $('#primary-navigation > ul > li').on('mouseenter', function(e){
		$dropdowns.removeClass('open');
		$self = $(this);
		if ($self.hasClass('dropdown')) {
			$(this).addClass('open');
		}
		e.stopPropagation();
	}).find('ul.dropdown-menu').on('mouseleave',function(e){
		$dropdowns.removeClass('open');
		e.stopPropagation();
	}).attr({role:'menu'}).siblings().filter('a').attr({'data-toggle':'dropdown',role:'button',class:'dropdown-toggle'}).append(' <b class="caret"></b>').parent().addClass('dropdown');

	if (document.createElement("input").webkitSpeech !== undefined) {
		$('#search_term').attr('x-webkit-speech','x-webkit-speech');
	}
})