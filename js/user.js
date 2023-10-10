$(document).ready(function () {
    $("#usermanagementform").validate({
      rules: {
        first_name: {
          required: true,
        },
        last_name: {
          required: true,
        },
        email: {
          required: true,
          email: true,
        },
        password: {
          required: true,
          minlength: 6,
        },
       
        address: "required",
        date_of_birth: "required",
        user_type: {
          required: true,
        },
        uploadfile: {
          required: true,
          extension: "jpg|jpeg|png|gif",
        },
      },
       messages: {
        first_name: {
            required: "Please enter your first name",
            letterswithbasicpunc: "First name can only contain letters and basic punctuation"
        },
        last_name: {
            required: "Please enter your last name",
            letterswithbasicpunc: "Last name can only contain letters and basic punctuation"
        },
        email: {
            required: "Please enter your email",
            email: "Please enter a valid email"
        }, 
        password: {
            required: "Please enter a password",
            minlength: "Password must be at least {0} characters long"
        },
       
        date_of_birth: "Please enter your date of birth",
        address: "Please enter your address",
        user_type: {
            required: "Please select User Type",
        },
          uploadfile: {
            required: "Please select an image to upload.",
          
            extension: "Please upload a valid image file (jpg, jpeg, png, gif)."
          }
    },
      submitHandler: function (form) {
        form.submit();
      },
    });
  });


//code for unique email
function click_here(){
     var email = $("#email").val();
     var password = document.getElementById("password").value;
     var confirm_password = document.getElementById("confirm_password").value;
     var messages = document.getElementById("password_match_message");
 if(email == ""){
    alert("Please Fill All fields");
  }else{
  $.ajax({
  url: "email.php",
  type: "POST",
  data:{
  email:email,password:password,confirm_password :confirm_password ,user_type :user_type},
  success: function(response){
  alert(response);  
  }}
)}

if (password === confirm_password) {
      messages.textContent = "Password matches.";
      messages.style.color = "green";
  } else {
      messages.textContent = "Password does not match.";
      messages.style.color = "red";
  }}