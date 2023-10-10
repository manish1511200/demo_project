$(document).ready(function () {
    // Initialize form validation
    $("#subcategoryFrm").validate({
      rules: {
        subCategory: {
          required: true,
        },
        
      },
       messages: {
        subCategory: {
            required: "Please Add  SubCategory",
        },
        
    },
      submitHandler: function (form) {
        form.submit();
      },
    });
  });