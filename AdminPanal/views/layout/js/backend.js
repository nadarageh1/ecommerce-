$(function(){
'use strict';
// Dashboard
   // to make design in users new item
$("#myTags").tagit();
	$.noConflict();
	// Fire Select Box here
  $('select').selectBoxIt({
  	autoWidth:false
  });
	 // Fire Select Box here
$('.toggle-info').click(function(){
$(this).toggleClass('selected').parent().next('.panel-body').fadeToggle(100);
if($(this).hasClass('selected')){
	$(this).html('<i class="fa fa-minus fa-lg"></i>');
}
else{
    $(this).html('<i class="fa fa-plus fa-lg"></i>');
}
});

// Hide placeholder when focus on input
// focus 
//blur go away
//[] mean selector placeholder
$('[placeholder]').focus(function(){
	// put in data-text the words in the placeholder
$(this).attr('data-text',$(this).attr('placeholder'));
	// donot put anything in placeholder 
$(this).attr('placeholder','');
}).blur(function(){
	// when mouse get away return the words again
	$(this).attr('placeholder',$(this).attr('data-text'));

});

// add astricks in required field
//all fields 
$('input').each(function(){
	//if this input is required 
	// that mean user must enter them 
 if($(this).attr('required') === "required"){
 	//put after this input mark *
 	$(this).after("<spam class='astricks'>*</spam>");
 }
});
// Convert Password field to text field on hover
// when close to the input work
// when go away work anoter work
var passField =$('.password');
$('.show-pass').hover(function(){
 passField.attr('type','text');
},function(){
passField.attr('type','password');
});
// confirmation buttun On buttun
$('.confirm').click(function(){
 return confirm("Are You Sure");
});
//Category View Option
$('.cat h3').click(function(){
$(this).next('.full-view').fadeToggle(500);
});
$('.option span').click(function(){
	/*siblings that is mean his brother
	 if you click in that span put in it 
	class active and remove it from his brother*/
$(this).addClass('active').siblings('span').removeClass('active');
if($(this).data('view')==="full"){
	$('.cat .full-view').fadeIn(200);
}
else{
	$('.cat .full-view').fadeOut(200);
}
});
/*
Show Delete Button On Child Cat
this show buttun that i stay in it only
*/
$('.child-link').hover(function(){
 $(this).find('.show-delete').fadeIn(200);
},function(){
 $('.show-delete').fadeOut(200);
});

});
