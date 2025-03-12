$(document).ready(function() {

	$('body').addClass($.cookie('menu'));
	if($.cookie('smenu') != ''){
		//abreMenu($.cookie('smenu'));
	}

	$('.sidebar-toggle').click(function(r){
		if($( "body" ).hasClass( "sidebar-collapse" )){
			$.cookie('menu', '');
		} else {
			$.cookie('menu', 'sidebar-collapse');
		}
	});


	$('.treeview-menu li').click(function(r){

		//abreMenu($(this));

	});

});

function abreMenu(se){

	$('.treeview').removeClass('active');
	$('.treeview-menu').removeClass('menu-open');
	$('.treeview-menu li').removeClass('active');
	$.cookie('smenu', se);

	se.addClass('active');
	se.parent().addClass('menu-open');
	se.parent().parent().addClass('active');
}