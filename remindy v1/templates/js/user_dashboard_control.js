var calendar_button = "#calendar_button";
var backup_button = "#backup_button";
var restore_button = "#restore_button";
var htmlObject;


$(calendar_button).click(function() {
	$(this).attr({
		class: "active"  
	});

	clearActive(backup_button, restore_button);
	loadPages();


});

$(backup_button).click(function() {

	$(this).attr({
		class: "active"  
	});

	clearActive(calendar_button, restore_button);
});

$(restore_button).click(function() {

	$(this).attr({
		class: "active"  
	});

	clearActive(calendar_button, backup_button);

});

//This function is to clear out the active highlight for the 
//selected button in the side bar
function clearActive(first_button, second_button){
	$(first_button).attr({
		class: ""  
	});
	$(second_button).attr({
		class: ""  
	});

}

function loadPages(){
	if ( htmlObject ) {
		htmlObject.appendTo( "body" );
		htmlObject = null;
	} else {
		htmlObject = $( ".main" ).detach();
		console.log(htmlObject);
	}	
}

