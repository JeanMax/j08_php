$( document ).ready(function() {
	var max = parseInt( $("#speed_max").text() );
    $(":input[type=number]").click(function (){
    	val = parseInt($(this).val());
    	if (val > 0)
    	{
	    	$("#speed_max").css("display", "none");
	    	if (max - val >= 0)
	    	{
	    		if (max - val == 0)
	    			$(this).attr("readonly", true);
		    	$("#new_val").remove();
		    	$('<span id="new_val">' + ( max - val )+ '</span>').insertAfter( $("#speed_max") );
	    	}
    	}
    });

    $( ":input[type=number]" ).mouseout(function() {
    	if ( parseInt( $("#new_val").text()) )
    		max = parseInt( $("#new_val").text() );
    	if (max == 0)
    	{
    	 	$( ":input[type=number]" ).attr("readonly", true);
    	}
	});

});