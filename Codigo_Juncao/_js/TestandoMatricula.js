
(function($){
	$.fn.styleddropdown = function(){
		return this.each(function(){
			var obj = $(this)
			$('td').click(function() { //onclick event, 'list' fadein
			obj.find('.lista').fadeIn(400);

				obj.css({
					'left':(event.pageX-700)+'px',
					'top':(event.pageY)+'px'});
			
			$(document).keyup(function(event) { //keypress event, fadeout on 'escape'
				if(event.keyCode == 27) {
				obj.find('.lista').fadeOut(400);
				}
			});
			
			obj.find('.lista').hover(function(){ },
				function(){
					$(this).fadeOut(400);
				});
			});
			
			obj.find('.lista li').click(function() { //onclick event, change field value with selected 'list' item and fadeout 'list'
			$('td')
				.val($(this).html())
				.css({
					'background':'#fff',
					'color':'#333'
				});
			obj.find('.lista').fadeOut(400);
			});
		});
	};
})(jQuery);