$(function() {
	
	$.get('login/verifyCookie',function(o){	
		if(o == 'ajax') {
			document.location.href = 'dashboard/';	
		}
	});

	
});