var clicked_entity_path = "";
var clicked_entity_props = "";

$(function() {$('#search-result').hide();});

// bind the search event to search button
$('#search-btn').bind('click', function() {
	$('#search-result').hide();
	var command = buildFindCommand();
	var data = { command : command };
	var url = 'processes/shell_commands_exec.php';
	performAjaxPost(url, data, function(data) {
		if (data === null) {
			alert('File was not found');
			return;
		}
		$('#result-path').children().remove().end().append('<option value="other" selected="selected"></option>');
		$('#search-result').show();
		var select_values = data.split("\n");
		$.each(select_values, function(key, value) {   
			if (value == '') {
				return;
			}
		     $('#result-path')
		         .append($("<option></option>")
		         .attr("value",value)
		         .text(value)); 
		});
	});
});

// bind the paste event to button
$('#paste-btn').bind('click', function() {
	var copy = $('#copied-entity').val();
	var cut = $('#cut-entity').val();
	var current_folder = $('#current-folder').text();
	
	// First check if its copy then if its cut
	if (copy) {
		copyEntity(copy, current_folder);
		$('#copied-entity').val('');
		$('#cut-entity').val('');
	} else if (cut) {
		moveEntity(cut, current_folder);
		$('#cut-entity').val('');
	}
});

//bind event to open directory of the search result
$('#result-path').change(function() {
	var selected_path = $('#result-path').val();
	if (selected_path == 'other') {
		return;
	}
	var folder_url = selected_path.substring(0,selected_path.lastIndexOf("/")) + '/';
	showFolders(folder_url);
});


// include hidden files event
$('#show-hidden-files').click(function() {
    var $this = $(this);
      
    if ($this.is(':checked')) {
    	$('#folder-option').val('-al');
        showFolders($('#current-folder').text());
    } else {
    	$('#folder-option').val('-l');
    	showFolders($('#current-folder').text());
    }
});


// Trigger action when the contexmenu is about to be shown
$(document).on('contextmenu', '.btn-folder', function (event) {
    // Avoid the real one
    event.preventDefault();
    
    // Update clicked value
    clicked_entity_path = $(this).attr('data-path');
    clicked_entity_props = $(this).attr('data-props');
    
    // Show contextmenu
    $('#folder-menu').finish().toggle(100).
    
    // In the right position (the mouse)
    css({
        top: event.pageY + 'px',
        left: event.pageX + 'px'
    });
});

//Trigger action when the contexmenu is about to be shown
$(document).on('contextmenu', '.btn-file', function (event) {
    // Avoid the real one
    event.preventDefault();
    
    // Update clicked value
    clicked_entity_path = $(this).attr('data-path');
    clicked_entity_props = $(this).attr('data-props');
    
    // Show contextmenu
    $('#file-menu').finish().toggle(100).
    
    // In the right position (the mouse)
    css({
        top: event.pageY + 'px',
        left: event.pageX + 'px'
    });
});

//Trigger action when the contexmenu is about to be shown
$(document).on('contextmenu', '.btn-file-special', function (event) {
    // Avoid the real one
    event.preventDefault();
    
    // Update clicked value
    clicked_entity_path = $(this).attr('data-path');
    clicked_entity_props = $(this).attr('data-props');
    
    // Show contextmenu
    $('#special-file-menu').finish().toggle(100).
    
    // In the right position (the mouse)
    css({
        top: event.pageY + 'px',
        left: event.pageX + 'px'
    });
});


// If the document is clicked somewhere
$(document).bind('mousedown', function (e) {
    
    // If the clicked element is not the menu
    if (!$(e.target).parents('.custom-menu').length > 0) {
        
        // Hide it
        $('.custom-menu').hide(100);
    }
});


// If the menu element is clicked
$('#file-menu li').click(function(){
    
    // This is the triggered action name
    switch($(this).attr('data-action')) {
        
        // A case for each action. Your actions here
        case "view": 
        	document.location.href = "/UnixLinuxProject/UnixPhpProject/file_editor.php?option=view&path=" + clicked_entity_path;
        	break;
        case "edit": 
        	document.location.href = "/UnixLinuxProject/UnixPhpProject/file_editor.php?option=edit&path=" + clicked_entity_path;
        	break;
        case "copy": 
        	$('#copied-entity').val(clicked_entity_path);
        	break;
        case "move":
        	$('#cut-entity').val(clicked_entity_path);
        	break;
        case "delete": 
        	deleteEntity(clicked_entity_path);
        	break;
        case "change_permissions": 
        	document.location.href = "/UnixLinuxProject/UnixPhpProject/commands-admin/change_permissions.php?path=" + clicked_entity_path;
        	break;
        case "properties":
        	alert(getPrintedProperties(clicked_entity_props, clicked_entity_path));
    		break;
    }
  
    // Hide it AFTER the action was triggered
    $('#file-menu').hide(100);
  });


//If the menu element is clicked
$('#folder-menu li').click(function(){
    
    // This is the triggered action name
    switch($(this).attr('data-action')) {
        
        // A case for each action. Your actions here
    	case "open":
    		showFolders(clicked_entity_path);
    		break;
    	case "copy":
    		$('#copied-entity').val(clicked_entity_path);
    		break;
    	case "move":
    		$('#cut-entity').val(clicked_entity_path);
    		break;
    	case "delete":
        	deleteEntity(clicked_entity_path);
    		break;
    	case "change_permissions": 
    		document.location.href = "/UnixLinuxProject/UnixPhpProject/commands-admin/change_permissions.php?path=" + clicked_entity_path;
         	break;
    	case "properties":
    		alert(getPrintedProperties(clicked_entity_props, clicked_entity_path));
    		break;
    }
  
    // Hide it AFTER the action was triggered
    $("#folder-menu").hide(100);
  });

//If the menu element is clicked
$('#special-file-menu li').click(function(){
    
    // This is the triggered action name
    switch($(this).attr('data-action')) {
        
        // A case for each action. Your actions here
    	case "properties":
    		alert(getPrintedProperties(clicked_entity_props, clicked_entity_path));
    		break;
    }
  
    // Hide it AFTER the action was triggered
    $("#folder-menu").hide(100);
  });


// Perform enter folder event
function showFolders(path) {
	var $option = $('#folder-option').val();
	var url = 'processes/perl_commands_exec.php';
	
	var data = { page : 'ls', option : $option, path : path };
	performAjaxPost(url, data, function(data) {
		
		var test_result = data[0].split(/\s/);
		if (test_result[0] != 'total') {
			alert('Cannot access directory. Please check your permissions');
			return;
		}
		
		//update prev folder
		var temp_path = path.substring(0, path.length - 1);
		temp_path = temp_path.substring(0, temp_path.lastIndexOf("/")) + '/';
		$('#prev-folder').val(temp_path);
		$('#current-folder').text(path);
		
		data.shift(); //remove the total bytes from result
		
		if (data[0].charAt(data[0].length - 1) == '.') {
			data.shift(); //remove the one dot folder
		}
		
		if (data.length == 0) {
			alert('Cannot access directory');
			return;
		}
		$('#file-browser').empty();
		
		// print first in array then sort it
		var line = data[0].split(",");
		var file_name = line[line.length-1];
		var file_type = line[0].charAt(0); 
		$('#file-browser').append(getFolderString(path, file_name, data[0]));
		data.shift();
		data.sort();
		data.reverse();
		
		var new_file;
		var props;
		$.each(data, function(key, value) {
			line = value.split(",");
			file_name = line[line.length-1];
			file_type = line[0].charAt(0); 
			new_file = '';
			switch (file_type) {
		    case '-':
		    	new_file = getFileString(path, file_name, value);
		        break;
		    case 'l':
		    	new_file = getSymbolicFileString(path, file_name, value);
		        break;
		    case 'd':
		    	new_file = getFolderString(path, file_name, value);
		        break;
		    default:
		    	new_file = getSpecialFileString(path, file_name, value);
			}
			
			if (new_file != '') {
				$('#file-browser').append(new_file);
			}
		});
	});
}

// Delete an entity
function deleteEntity(path) {
	var url = 'processes/perl_commands_exec.php';
	var data = { page : 'rm', option : '-r', path : path };
	performAjaxPost(url, data, function (data) {
		alert(data);
		showFolders($('#current-folder').text());
		
	});
}

function copyEntity(path_from, path_to) {
	var url = 'processes/perl_commands_exec.php';
	var data = { page : 'cp', option : path_from, path : path_to };
	performAjaxPost(url, data, function (data) {
		alert(data);
		showFolders(path_to);
		
	});
}

function moveEntity(path_from, path_to) {
	var url = 'processes/perl_commands_exec.php';
	var data = { page : 'mv', option : path_from, path : path_to };
	performAjaxPost(url, data, function (data) {
		alert('file ' + path_from + ' moved');
		showFolders(path_to);
		
	});
}

//************** getters for files divs *******************//

function getFolderString(path, folder_name, props) {
	var folder = '<div class="folder col-md-1">';
	if (folder_name == '.') {
		return '';
	} else if (folder_name == '..') {
		var prev_path = $('#prev-folder').val();
		folder += '<input type="image" src="images/fileicons/_Documents.png" ondblclick="showFolders(\'' + prev_path + '\');" class="btn-folder" data-path="' + prev_path + '" data-props="' + props + '">';
	} else {
		folder += '<input type="image" src="images/fileicons/_Documents.png" ondblclick="showFolders(\'' + path + folder_name + '/\');" class="btn-folder" data-path="' + path + folder_name + '/" data-props="' + props + '">';
	}
	folder += '<label class="text-center">' + folder_name + '</label>';
	folder += '</div>';

	return folder;
}


function getFileString(path, file_name, props) {
	var folder = '<div class="file col-md-1">';
	folder += '<input type="image" src="images/fileicons/default.png" ondblclick="document.location.href = \'/UnixLinuxProject/UnixPhpProject/file_editor.php?option=view&path=' + path + file_name + '\';" class="btn-file" data-path="' + path + file_name + '" data-props="' + props + '">';
	folder += '<label class="text-center">' + file_name + '</label>';
	folder += '</div>';

	return folder;
}

function getSpecialFileString(path, file_name, props) {
	var folder = '<div class="file col-md-1">';
	folder += '<input type="image" src="images/fileicons/dll.png" ondblclick="aler("This file can\'t be opened");" class="btn-file-special" data-path="' + path + file_name + '" data-props="' + props + '">';
	folder += '<label class="text-center">' + file_name + '</label>';
	folder += '</div>';

	return folder;
}

function getSymbolicFileString(path, file_name, props) {
	var folder = '<div class="file col-md-1">';
	folder += '<input type="image" src="images/fileicons/symbolic.jpeg" ondblclick="aler("This file can\'t be opened");" class="btn-file-special" data-path="' + path + file_name + '" data-props="' + props + '">';
	folder += '<label class="text-center">' + file_name + '</label>';
	folder += '</div>';

	return folder;
}

//*********************************************************//

// get the line as shown in LS and the file path
// create a printable properties from it
function getPrintedProperties(line_data, file_path) {
	var line = line_data.split(",");
	var file_name = line[line.length-1];
	var file_type = line[0].charAt(0);

	var props = "Properties:\n\n";
	props += 'Name: ' + file_name + "\n";
	props += 'Type: ' + getFullTypeName(file_type) + "\n";
	props += "\n";
	props += 'Location: ' + file_path + "\n";
	props += "\n";
	props += 'Size: ' + line[4] + ' Bytes' + "\n";
	props += 'Modified: ' + line[5] + "\n";
	props += "\n\n\n";
	
	props += 'Permissions:\n\n';
	props += 'Owner: ' + line[2] + "\n";
	props += 'Access: ' + line[0].charAt(1) + line[0].charAt(2) + line[0].charAt(3) + "\n";
	props += "\n";
	props += 'Group: ' + line[3] + "\n";
	props += 'Access: ' + line[0].charAt(4) + line[0].charAt(5) + line[0].charAt(6) + "\n";
	props += "\n";
	props += 'Others:' + "\n";
	props += 'Access: ' + line[0].charAt(7) + line[0].charAt(8) + line[0].charAt(9) + "\n";
	
	return props;
}

// map file type to full type name
function getFullTypeName(file_type) {
	var full_type;
	switch (file_type) {
    case '-':
    	full_type = 'Regular File';
        break;
    case 'l':
    	full_type = 'Symbolic Link';
        break;
    case 'd':
    	full_type = 'Folder';
        break;
    case 'b':
    	full_type = 'Block File';
        break;
    case 'c':
    	full_type = 'Character device File';
        break;
    case 'c':
    	full_type = 'Named pipe';
        break;
    case 's':
    	full_type = 'Socket';
        break;
    default:
    	full_type = '';
	}
	
	return full_type;
}


// Help function
function performAjaxPost(url, data, callBackFunc) {
	$.ajax({
		type : 'POST',
		url : url,//proccess - server
		data : data,
		dataType : 'json',
		success : callBackFunc 
	});
}

// Build find command
function buildFindCommand() {
	var $current_folder = $('#current-folder').text();
	var command = 'find ' + $current_folder; // build the basic find command
	
	// search by file name
	var search = $('#search-folder').val();
	if (search) {
		command += ' -name ' + search;
	}
	
	// add modified since
	var days = $('#search-days').val();
	if (days) {
		command += ' -mtime -' + days;
	}

	// search by file type
	var file_type = $('#search-type').val();
	if (file_type) {
		command += ' -iname "*.' + file_type + '"';
	}

	// search for files only or dirs only or both
	var $file_only = $('#files-only');
	var $dir_only = $('#dir-only');
	if ($file_only.is(':checked') && !$dir_only.is(':checked')) {
		command += ' -type f';
	} else if (!$file_only.is(':checked') && $dir_only.is(':checked')) {
		command += ' -type d';
	}
	
	return command;
}
