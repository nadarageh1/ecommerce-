$(function(){

'use strict';
   // to make design in users new item
$("#myTags").tagit();
	$.noConflict();
	 // Fire Select Box here
  $("select").selectBoxIt({
  	autoWidth:false
  });
  
$('input').each(function(){
	//if this input is required 
	// that mean user must enter them 
 if($(this).attr('required') === "required"){
 	//put after this input mark *
 	$(this).after("<spam class='astricks'>*</spam>");
 }
});

// Switch Between Login And Sign up
$('.login-page h1 span').click(function(){
 $(this).addClass('selected').siblings().removeClass('selected');
 $('.login-page form').hide();
  $('.'+$(this).data('class')).fadeIn(100); 
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

// confirmation buttun On buttun
$('.confirm').click(function(){
 return confirm("Are You Sure");
});
// page Ads in user to add item
$('.live').keyup(function(){
 $($(this).data('class')).text($(this).val());
});

});
// Function to preview image after validation
$(function() {
$("#file").change(function() {
$("#message").empty(); // To remove the previous error message
var file = this.files[0];
var imagefile = file.type;
var match= ["image/jpeg","image/png","image/jpg"];
if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2])))
{
$("#message").html("<div id='error'>That is Not Image</div>");
return false;
}
else
{
// to read the file 
var reader = new FileReader();
reader.onload = imageIsLoaded;
reader.readAsDataURL(this.files[0]);
}
});
});
// load image
function imageIsLoaded(e) {
$("#file").css("color","green");
$('#image_preview').css("display", "block");
$('#previewing').attr('src', e.target.result);
$('#previewing').attr('width', '300px');
$('#previewing').attr('height', '300px');
};

