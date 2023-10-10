$(document).ready(function () {
    $('#editDrawingform').validate({
        rules: {
            drawing_number: "required",
            drawing_name: "required",
            drawing_status: "required",
            category_name: "required",
        },
        messages: {
            drawing_number: "Please enter your Drawing number",
            drawing_name: "Please enter drawing name",
            drawing_status: "Please enter your status",
            category_name: "Please enter category",
        },
        submitHandler: function (form) {
            form.submit();
        }
    });
  });
  