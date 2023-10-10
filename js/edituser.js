
    jQuery('#edituserform').validate({
        rules: {
            first_name: "required",
            last_name: "required",
            address: "required",
            date_of_birth: "required",
            user_type: {
                required: true,
            },
        },
        messages: {
            first_name: "Please enter your first name",
            last_name: "Please enter your last name",
            address: "Please enter your address",
            date_of_birth: "Please enter your date of birth",
            user_type: "Please select a user type",
        },
        submitHandler: function (form) {
            form.submit();
        }
    });
