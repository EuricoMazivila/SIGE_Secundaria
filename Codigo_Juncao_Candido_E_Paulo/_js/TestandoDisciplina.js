(function($){
	$.fn.styleddropdown = function(){
		return this.each(function(){
			var obj = $(this)
			var conta = 1;

			$( 'td' ).click(function( event ) {
			obj.find('.list').fadeIn(400);

  				obj.css({
					'left':(event.pageX-700)+'px',
					'top':(event.pageY-200)+'px'});
					
			$(document).keyup(function(event) { //keypress event, fadeout on 'escape'
				if(event.keyCode == 27) {
				obj.find('.list').fadeOut(400);
				}
			});
			
			obj.find('.list').hover(function(){ },
				function(){
					$(this).fadeOut(400);
			});

			});
		});
	};
})(jQuery);

