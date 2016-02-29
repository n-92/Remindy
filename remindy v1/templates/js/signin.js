//This is where the event handler would come in
var id_or_email = ".id_or_email";
var input_pass = ".input_password";

//Check if it is ok to send data
function okToSend(_id_or_email, _pass){
  if ( _id_or_email !== "" && _pass != "" )
    return true;

  return false;
}

function clearLabels(){
  $('.the-return').removeClass('.alert alert-success');
  $('.the-return').removeClass('.alert alert-danger');
  $('.the-return').empty();
}

$(".form-signin").submit(function(evt){
	
	evt.preventDefault();
  var _id_or_email = $(id_or_email).val();
  var _pass = $(input_pass).val();
	var data = {
	  "action": "login"
	};
  
  //JQuery form data validation code
  if (okToSend(_id_or_email, _pass)){
      	data = $(this).serialize() + "&" + $.param(data);
      	$.ajax({
      	  type: "POST",
      	  dataType:'json',
      	  url: "../login.php", //Relative or absolute path to response.php file
      	  data: data
        }).done( function(data) {	    	

            if (data['login_status'] === 'success' ){
              //Display success message banner 
               clearLabels();
               $('<div class="alert alert-success"> <strong>Login Successful!</strong> </div>').appendTo('.the-return');
               window.location.href = "../user_dashboard.php";

            }
            else{
              clearLabels();
              $('<div class="alert alert-danger"> <strong>Login Failed! Retry again! </strong> </div>').appendTo('.the-return');
            }
          });
  }
  else{
      clearLabels();
      $('<div class="alert alert-danger"> <strong> Please fill up all the fields !</strong> </div>').appendTo('.the-return');
  }
	
 });
