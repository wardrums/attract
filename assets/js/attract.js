$(document).ready(function() {

	// Enabling plugins

	$('#statsModal').modal({
		show: false
	});

	$("#shotlist").tablecloth({
		theme: "paper",
		striped: true,
		sortable: true,
		condensed: true
	});
	
	
	$("#stats").tablecloth({
		theme: "paper",
		striped: true,
		sortable: true,
		condensed: true
	});
	
	$(".chzn-select").chosen({no_results_text: "Select owner..."}); 
	
	
	
	// Functions
	
	function queryShots(status, owner) {
		// Simple log print
		// console.log(owner);
		// We make the actual query
		if(status.length > 0) {
			$.ajax({
				type: "POST",
				url: "table_query_ajax.php",
				data: {status: status, owner: owner},
				cache: false,
				success: function(html){
					$("#shotlist").html(html);
					}
			});
		} else {
			alert('Enter something.');
		}
	}
	
	$("#querymachine").click(function(){
		return;
	}).change(function(){
		var status = $("#status").val() || [];
		status = status.join();
		if (status === "") {status = "any";}
		
		var owner = $("#owner").val() || [];
		owner = owner.join();
		if (owner === "") {owner = "any";}
		queryShots(status, owner);
	});

    
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
