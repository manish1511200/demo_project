jQuery('#login').validate({
	rules:{
		email :{
              required:true,
              email :true,
           },
       password:{
            required:true,
            password:true
         }
       }, 

messages:{
         email:{
             required:"Please enter email",
             email:"Please enter valid email",
            },
         password:{
             required:"Please enter password",
             }, 
         },
   submitHandler:function(form){
    form.submit();
    } 
});
 