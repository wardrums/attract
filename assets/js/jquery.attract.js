$(document).ready(function() {
    /*
    $('.dd_status').click(function() {
        // Only call notifications when opening the dropdown
        if(!$(this).hasClass('open')) {
           console.log('open');
           $(this).children('.dropdown-menu').html('<li><a href="#">Option</a></li>');
        }
    });
    */
    
    $(".dd_status").on('click', function(e) {
	    console.log("savenewlang has been clicked");
	});
	
	$(".dd_status").on({
		click: function(){
			console.log("savenewlang has been clicked");
		}
	});
});