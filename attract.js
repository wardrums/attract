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
    
    function paginate(maxRows) {
	    console.log(maxRows);
    }

    
	//var maxRows = "hello";
	$('.paginated').each(function() {
		
		paginate(19);
		
		var maxRows = 10;
		console.log(maxRows);
	    var cTable = $(this);
	    var cRows = cTable.find('tr:gt(0)');
	    var cRowCount = cRows.size();
	    
	    $("select").change(displayVals);
	    displayVals();
	    
	    
	    
	    if (cRowCount < maxRows || maxRows === "hello") {
	        return;
	    }
	
	    cRows.each(function(i) {
	        $(this).find('td:first').text(function(j, val) {
	           return (i + 1) + " - " + val;
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
	
	


	$(".edit_tr").click(function() {
		var ID=$(this).attr('id');
		$("#first_"+ID).hide();
		$("#last_"+ID).hide();
		$("#first_input_"+ID).show();
		$("#last_input_"+ID).show();
	}).change(function(){
		var ID=$(this).attr('id');
		var first=$("#first_input_"+ID).val();
		var last=$("#last_input_"+ID).val();
		var dataString = 'id='+ ID +'&shot_number='+first+'&shot_status='+last;
		$("#first_"+ID).html('<img src="load.gif" />'); // Loading image
		
		if(first.length>0&& last.length>0) {
			$.ajax({
				type: "POST",
				url: "table_edit_ajax.php",
				data: dataString,
				cache: false,
				success: function(html){
					$("#first_"+ID).html(first);
					$("#last_"+ID).html(last);
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
