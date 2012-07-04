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
		
	
	function selectThis(row_id, cell) {
		// Simple log print
		console.log("We are selecting the " + cell + " in row " + row_id);
		var item = $("#" + cell + "_" + row_id);
		var item_input = $("#" + cell + "_" + "input" + "_" + row_id);
		$(item).hide();
		$(item_input).show().focus();
	}
	
	function editThis(row_id, cell) {
		// Simple log print
		console.log("We are editing the " + cell + " in row " + row_id);
		var item = $("#" + cell + "_" + row_id);
		var item_input = $("#" + cell + "_" + "input" + "_" + row_id);
		var value = $("#" + cell + "_" + "input" + "_" + row_id).val();
		// We make the actual query
		if(value.length > 0) {
			$.ajax({
				type: "POST",
				url: "table_edit_ajax.php",
				data: {id: row_id, cell: cell, value: value},
				cache: false,
				success: function(html){
					$("#" + cell + "_" + row_id).html(value);
					$(item).show();
					$(item_input).hide();
					}
			});
		} else {
			alert('Enter something.');
		}
	}
	
	
	$(".edit_td").click(function(){
		var row_id = $(this).parent().attr('id');
		var cell = $(this).children().attr('class').split(' ')[0];
		selectThis(row_id, cell);
	}).change(function(){
		var row_id = $(this).parent().attr('id');
		var cell = $(this).children().attr('class').split(' ')[0];
		editThis(row_id, cell);
	});
	
		
	// Edit input box click action
	$(".editbox").mouseup(function() {
		return false
	});
	
	// Pressing escape key interrupts the action
	$(document).keypress(function(event){
		var keycode = (event.keyCode ? event.keyCode : event.which);
		if(keycode == '27' ){ //13 is code for Enter key
			$(".editbox").hide();
			$(".text").show();	
		}
	});
	

	// Outside click action
	$(document).mouseup(function(){
		$(".editbox").hide();
		$(".text").show();
	});

	
});
