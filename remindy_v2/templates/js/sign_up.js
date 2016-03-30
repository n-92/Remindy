//Check if it is ok to send data
function clearLabels(){
  $('.the-return').removeClass('.alert alert-success');
  $('.the-return').removeClass('.alert alert-danger');
  $('.the-return').empty();
}

$(".form-signin").submit(function(evt){
	
	evt.preventDefault();
	var data = {
	  "action": "register"
	};
  
  //JQuery form data validation code  
	data = $(this).serialize() + "&" + $.param(data);
	$.ajax({
	  type: "POST",
	  dataType:'json',
	  url: "../register.php", //Relative or absolute path to register.php file
	  data: data
  }).done( function(data) {	    	

      if (data['registration_status'] === 'success' ){
        //Display success message banner 
        alert("Registered Successfully");
      }
      else{
       alert("Registration Failure"); 
        
      }
    });
	
 });
