
	$(document).ready(function () {
	  $('#drawingform').validate({
	      rules: {
	        project_id: {
	              required: true,
	          },
	          drawing_number: "required",
	          drawing_name: "required",
	          drawing_status: "required",
	          category_name: "required",
	          pdffile: {
	              required: true,
	              extension: "pdf|doc|docx" 
	          }
	      },
	      messages: {
	            project_id: {
	                required: "Please select a Project"
	            },
	          drawing_number: "Please enter your Drawing number",
	          drawing_name: "Please enter drawing name",
	          drawing_status: "Please enter your status",
	          category_name: "Please select category",
	          pdffile: {
	              required: "Please select a document to upload.",
	              extension: "Please upload a valid PDF, DOC, or DOCX file"
	          }
	      },
	      submitHandler: function (form) {
	          form.submit();
	      }
	  });
	});
	
