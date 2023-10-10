jQuery('#editProjectform').validate({
    rules: {
        project_name: "required",
        project_number : "required",
        address: "required",
        start_date : "required",
        end_date: "required",
    },
    messages: {
        project_name: "Please enter your Project Name",
        project_number: "Please enter your Project Number",
      
        address: "Please enter your address",
        start_date: "Please enter start date",
        end_date: "Please enter end date",
    },
    submitHandler: function (form) {
        form.submit();
    }
});
