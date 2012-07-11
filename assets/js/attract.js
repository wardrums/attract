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
				context: document.body,
				success: function(html){
					$("#shotlist").html(html);
				}
			});
		} else {
			console.log("No status or owner provided");
		}
	}
	
	$("#querymachine").on("click", function(){
		return;
	}).on("change", function(){
		var status = $("#status").val() || [];
		status = status.join();
		if (status === "") {status = "any";}
		
		var owner = $("#owner").val() || [];
		owner = owner.join();
		if (owner === "") {owner = "any";}
		queryShots(status, owner);
	});
	
	function makeNiceLabel(raw_string){
		raw_string = raw_string.split('_').join(' ');
    	raw_string = raw_string.charAt(0).toUpperCase() + raw_string.slice(1);
    	return raw_string;
    }


    
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
		
	}
	
	function editStatus(row_id, cell, value) {
		$.ajax({
			type: "POST",
			url: "table_edit_ajax.php",
			data: {id: row_id, cell: cell, value: value},
			cache: false,
			success: function(html){
				return;
			}
		});
	}
	
	$("ul.dropdown-menu li a").on("click", function(){
	    var href = $(this).attr("href");
	    var dropdown_label = $(this).parent().parent().prev();
	    var value = href.substring(1);
	    var label_text = makeNiceLabel(value);
	    
	    var row_id = $(this).closest("tr").attr("id");
	    var cell = $(this).closest("div").attr("class").split(' ')[0];
	    var btn_lastclass = $(this).parent().parent().prev().attr("class").split(' ')[3];
	    
	    console.log(btn_lastclass);
	    
	    $(this).parent().parent().prev().removeClass(btn_lastclass).addClass("btn-"+value);
	    
	    console.log(row_id + " " + cell + " " + value);
	    
	    
	    
	    dropdown_label.html(label_text + "<span class=\"caret\"></span>");
	    
	    editStatus(row_id, cell, value);
	    
	});
	
	
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
			$(".btn-group.open").removeClass("open");
		}
	});
	

	// Outside click action
	$(document).mouseup(function(){
		$(".editbox").hide();
		$(".text").show();
	});

	
});
