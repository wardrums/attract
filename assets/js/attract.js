$(document).ready(function() {

	// Enabling plugins

	$('#statsModal').modal({
		show: false
	});
	
	$('#manageUsersModal').modal({
		show: false
	});
	
	$('#manageScenesModal').modal({
		show: true
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
	
	$("#users").tablecloth({
		theme: "paper",
		striped: true,
		sortable: true,
		condensed: true
	});
	
	$("#scenes").tablecloth({
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
				url: "app/table_query_ajax.php",
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


    
	function selectThis(table, row_id, cell) {
		// Simple log print
		console.log("We are selecting the " + cell + " in row " + row_id+ " in the table " + table);
		var item = $("#" + cell + "_" + row_id);
		var item_input = $("#" + cell + "_" + "input" + "_" + row_id);
		$(item).hide();
		$(item_input).show().focus();
	}
	
	function editThis(table, row_id, cell) {
		// Simple log print
		console.log("We are editing the " + cell + " in row " + row_id + " in the table " + table);
		var item = $("#" + cell + "_" + row_id);
		var item_input = $("#" + cell + "_" + "input" + "_" + row_id);
		var value = $("#" + cell + "_" + "input" + "_" + row_id).val();
		
		// We make the actual query
		$.ajax({
			type: "POST",
			url: "app/table_edit_ajax.php",
			data: {table: table, id: row_id, cell: cell, value: value},
			cache: false,
			success: function(html){
				$("#" + cell + "_" + row_id).html(value);
				$(item).show();
				$(item_input).hide();
			}
		});
	}
	
	function deleteRow(table, row_id) {
		// Simple log print
		console.log("We are deleting row " + row_id + " in the table " + table);
				
		// We make the actual query
		$.ajax({
			type: "POST",
			url: "app/ajax/delete_row.php",
			data: {table: table, id: row_id},
			cache: false,
			success: function(html){
				return;
			}
		});
	}
	
	
	function editStatus(row_id, cell, value) {
		$.ajax({
			type: "POST",
			url: "app/table_edit_ajax.php",
			data: {id: row_id, cell: cell, value: value},
			cache: false,
			success: function(html){
				return;
			}
		});
	}
	
	$(".edit_tr ul.dropdown-menu li a").on("click", function(){
	    var href = $(this).attr("href");
	    var dropdown_label = $(this).parent().parent().prev();
	    var value = href.substring(1);
	    var label_text = makeNiceLabel(value);
	    
	    var row_id = $(this).closest("tr").attr("id");
	    var cell = $(this).closest("div").attr("class").split(' ')[0];
	    var btn_lastclass = $(this).parent().parent().prev().attr("class").split(' ')[3];
	    var stage = $(this).closest("td").next().children("div");
	    
	    // console.log(btn_lastclass);
	    
	    $(this).parent().parent().prev().removeClass(btn_lastclass).addClass("btn-"+value);
	    
	    console.log(row_id + " " + cell + " " + value);
	    
	    if(value === "in_progress") {
			console.log(stage);
			stage.fadeIn(300);
		} else {
			stage.fadeOut(300);
		}
	    
	    dropdown_label.html(label_text + "<span class=\"caret\"></span>");
	    
	    editStatus(row_id, cell, value);
	    
	});
	
	
	$(".edit_td").click(function(){
		var table = $(this).closest("table").attr("class").split(' ')[0];
		var row_id = $(this).parent().attr('id').split('_')[1];
		var cell = $(this).children().attr('class').split(' ')[0];
		selectThis(table, row_id, cell);
	}).change(function(){
		var table = $(this).closest("table").attr("class").split(' ')[0];
		var row_id = $(this).parent().attr('id').split('_')[1];;
		var cell = $(this).children().attr('class').split(' ')[0];
		editThis(table, row_id, cell);
	});
	
	$(".delete_row").click(function(){
		var table = $(this).closest('table').attr('class').split(' ')[0];
		var row = $(this).closest('tr');
		var row_id = row.attr('id').split('_')[1];
		deleteRow(table, row_id);
		row.hide();
	});
	
	
	
	function addUser(username, name, surname) {
		$.ajax({
			type: "POST",
			url: "app/ajax/add_user.php",
			data: {username: username, name: name, surname: surname},
			cache: false,
			success: function(){
				$('#user_input_form').after('<tr><td>' + username + '</td><td>' + name + '</td><td>' + surname + '</td><td></td></tr>');
				$('#new_user_username').val('');
				$('#new_user_name').val('');
				$('#new_user_surname').val('');
			}
		});
	}
	
	
	$("#addUser").click(function(){
		var username = $('#new_user_username').val();
		var name = $('#new_user_name').val();
		var surname = $('#new_user_surname').val();
		if (username.length > 0) {
			addUser(username, name, surname);
		} else {
			console.log("Error: please specify at least a username!");
		}
	});
	
	
	
		
	// Edit input box click action
	$(".editbox").mouseup(function() {
		return false;
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
