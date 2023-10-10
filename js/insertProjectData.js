jQuery('#projectform').validate({
  rules: {
      project_name: "required",
      project_number: "required",
      address: "required",
      uploadfile: {
          required: true,
          extension: "jpg|jpeg|png|gif" 
        },
        start_date: {
          required: true,
      },
      end_date: {
          required: true,
          endDateAfterStartDate: true 
      },
  },
  messages: {
      project_name: "Please enter your Project name",
      project_number: "Please enter your Project number",
      address: "Please enter your address",
      uploadfile: {
          required: "Please select an image to upload.",
        
          extension: "Please upload a valid image file (jpg, jpeg, png, gif)."
        },
        start_date: {
          required: "Please enter a start date"
        },
        end_date: {
          required: "Please enter an end date"
        }
      },
  submitHandler: function (form) {
      form.submit();
  }
});

