$(document).ready(function() {

	$("table").tablecloth({
		theme: "paper",
		striped: true,
		sortable: true,
		condensed: true
	});
	
	
	
	function displayVals() {
      var maxRows = $('#dd_menu').val();
      console.log(maxRows);
    }
    
    
    /*
    var maxRows = 100;
	$('.paginated').each(function() {
	    var cTable = $(this);
	    var cRows = cTable.find('tr:gt(0)');
	    var cRowCount = cRows.size();
	    
	    if (cRowCount < maxRows) {
	        return;
	    }
	
	    cRows.each(function(i) {
	        $(this).find('td:first').text(function(j, val) {
	           //return (i + 1) + " - " + val;
	           return val;
	        });
	    });
	
	    cRows.filter(':gt(' + (maxRows - 1) + ')').hide();
	
	
	    var cPrev = cTable.siblings('.prev');
	    var cNext = cTable.siblings('.next');
	
	    cPrev.addClass('disabled');
	
	    cPrev.click(function() {
	        var cFirstVisible = cRows.index(cRows.filter(':visible'));
	        
	        if (cPrev.hasClass('disabled')) {
	            return false;
	        }
	        
	        cRows.hide();
	        if (cFirstVisible - maxRows - 1 > 0) {
	            cRows.filter(':lt(' + cFirstVisible + '):gt(' + (cFirstVisible - maxRows - 1) + ')').show();
	        } else {
	            cRows.filter(':lt(' + cFirstVisible + ')').show();
	        }
	
	        if (cFirstVisible - maxRows <= 0) {
	            cPrev.addClass('disabled');
	        }
	        
	        cNext.removeClass('disabled');
	
	        return false;
	    });
	
	    cNext.click(function() {
	        var cFirstVisible = cRows.index(cRows.filter(':visible'));
	        
	        if (cNext.hasClass('disabled')) {
	            return false;
	        }
	        
	        cRows.hide();
	        cRows.filter(':lt(' + (cFirstVisible +2 * maxRows) + '):gt(' + (cFirstVisible + maxRows - 1) + ')').show();
	
	        if (cFirstVisible + 2 * maxRows >= cRows.size()) {
	            cNext.addClass('disabled');
	        }
	        
	        cPrev.removeClass('disabled');
	
	        return false;
	    });
	
	});	
	*/
			
	
	function editThis(aaa) {
		console.log("test");
		console.log(aaa);
	}
	
	
	$(".edit_td").click(function(){
		var ID = $(this).attr('class');
		editThis(ID);
	});
	


	$(".edit_tr").click(function() {
		var ID = $(this).attr('id');
		$("#number_"+ID).hide();
		$("#description_"+ID).hide();
		$("#number_input_"+ID).show();
		$("#description_input_"+ID).show();
	}).change(function(){
		var ID = $(this).attr('id');
		var number = $("#number_input_"+ID).val();
		var description = $("#description_input_"+ID).val();
		var dataString = 'id='+ ID +'&number='+number+'&description='+description;
		$("#number_"+ID).html('<img src="/assets/img/ajax-loader.gif" />'); // Loading image
		
		if(number.length > 0 && description.length>0) {
			$.ajax({
				type: "POST",
				url: "table_edit_ajax.php",
				data: dataString,
				cache: false,
				success: function(html){
					$("#number_"+ID).html(number);
					$("#description_"+ID).html(description);
					}
			});
		} else {
			alert('Enter something.');
		}
	});
		
	// Edit input box click action
	$(".editbox").mouseup(function() {
		return false
	});

	// Outside click action
	$(document).mouseup(function(){
		$(".editbox").hide();
		$(".text").show();
	});

	
});
