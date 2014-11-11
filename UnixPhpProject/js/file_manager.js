var clickedEntity = "";

// Trigger action when the contexmenu is about to be shown
$(document).on('contextmenu', '.btn-folder', function (event) {
    // Avoid the real one
    event.preventDefault();
    
    // Update clicked value
    clickedEntity = $(this).attr('data-path');
    
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
    clickedEntity = $(this).attr('data-path');
    
    // Show contextmenu
    $('#file-menu').finish().toggle(100).
    
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
        	document.location.href = "/UnixLinuxProject/UnixPhpProject/file_editor.php?option=view&path=" + clickedEntity;
        	break;
        case "edit": 
        	document.location.href = "/UnixLinuxProject/UnixPhpProject/file_editor.php?option=edit&path=" + clickedEntity;
        	break;
        case "copy": 
        	$('#copied-entity').val(clickedEntity);
        	break;
        case "move":
        	$('#copied-entity').val(clickedEntity);
        	break;
        case "delete": 
        	deleteEntity(clickedEntity);
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
    		showFolders(clickedEntity);
    		break;
    	case "copy":
    		$('#copied-entity').val(clickedEntity);
    		break;
    	case "move":
    		$('#copied-entity').val(clickedEntity);
    		break;
    	case "delete":
        	deleteEntity(clickedEntity);
    		break;
    }
  
    // Hide it AFTER the action was triggered
    $("#folder-menu").hide(100);
  });


// Perform enter folder event
function showFolders(path) {
	var $option = $('#folder-option').val();
	var url = 'processes/perl_commands_exec.php';
	
	performAjaxPost(url, 'ls', $option, path, function(data) {
		//update prev folder
		var temp_path = path.substring(0, path.length - 1);
		temp_path = temp_path.substring(0, temp_path.lastIndexOf("/")) + '/';
		$('#prev-folder').val(temp_path);
		$('#current-folder').val(path);
		
		data.shift(); //remove first from result
		$('#file-browser').empty();
		
		$.each(data, function(key, value) {
			var line = value.split(",");
			var file_name = line[line.length-1];
			var file_type = line[0].charAt(0); 
			var new_file = '';
			
			switch (file_type) {
		    case '-':
		    	new_file = getFileString(path, file_name);
		        break;
		    case 'l':
		    	new_file = getFolderString(path, file_name);
		        break;
		    case 'd':
		    	new_file = getFolderString(path, file_name);
		        break;
		    case 'p':
		        break;
		    case 's':
		        break;
		    case 'c':
		        break;
		    case 'b':
		        break;
		    case 'D':
		        break;
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
	performAjaxPost(url, 'rm', '-r', path, function (data) {
		alert(data);
		showFolders($('#current-folder').val());
		
	});
}


function getFolderString(path, folder_name) {
	var folder = '<div class="folder col-md-1">';
	if (folder_name == '.') {
		return '';
	} else if (folder_name == '..') {
		var prev_path = $('#prev-folder').val();
		folder += '<input type="image" src="images/fileicons/_Documents.png" ondblclick="showFolders(\'' + prev_path + '\');" class="btn-folder" data-path="' + prev_path + '">';
	} else {
		folder += '<input type="image" src="images/fileicons/_Documents.png" ondblclick="showFolders(\'' + path + folder_name + '/\');" class="btn-folder" data-path="' + path + folder_name + '/">';
	}
	folder += '<label class="text-center">' + folder_name + '</label>';
	folder += '</div>';

	return folder;
}


function getFileString(path, file_name) {
	var folder = '<div class="file col-md-1">';
	folder += '<input type="image" src="images/fileicons/default.png" ondblclick="document.location.href = \'/UnixLinuxProject/UnixPhpProject/file_editor.php?option=view&path=' + path + file_name + '\';" class="btn-file" data-path="' + path + file_name + '">';
	folder += '<label class="text-center">' + file_name + '</label>';
	folder += '</div>';

	return folder;
}


// Help function
function performAjaxPost(url, command, option, path, callBackFunc) {
	var data = { page : command, option : option, path : path };
	$.ajax({
		type : 'POST',
		url : url,//proccess - server
		data : data,
		dataType : 'json',
		success : callBackFunc 
	});
}


