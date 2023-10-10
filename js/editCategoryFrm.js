$(document).ready(function () {
    $("#editCategoryFrm").validate({
      rules: {
        category_name: {
          required: true,
        },
        
      },
       messages: {
        category_name: {
            required: "Please enter your Category",
        },
        
    },
      submitHandler: function (form) {
        form.submit();
      },
    });
  });

