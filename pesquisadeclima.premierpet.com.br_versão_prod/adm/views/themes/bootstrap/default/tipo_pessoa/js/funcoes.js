$(function() {
	
	$.get('dashboard/xhrGetListings',function(o){
							
		for(var i = 0;  i < o.length; i++) {
			$("#listInserts").append('<div>' + o[i].texto + '<a class="del" rel="'+ o[i].id +'" href="javascript:void(0)">X</a></div>');
		}
				
	}, 'json');
	
	$('#randomInsert').submit(function() {
		
		var url = $(this).attr('action');		
		var data = $(this).serialize();
				
		$.post(url, data, function(o) {
			$("#listInserts").append('<div>' + o.texto + '<a class="del" rel="' + o.id + '" href="javascript:void(0)">X</a></div>');
		}, 'json');
				
		return false;
		
	});
	
	
	$(document).on("click",".del", function() {    					
		var del = $(this); 	
		var id  = $(this).attr('rel');
				
		$.post('user/delete', {id : id}, function(o) {
			del.parent().remove();
		});
		
		return false;   
	});
	
});