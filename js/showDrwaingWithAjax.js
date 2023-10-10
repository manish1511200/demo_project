function projectId() {
    var select = document.getElementById('select-project');
    var selectedValue = select.value;
        $.ajax({
            type: "POST",
            url: "drawingPageWithAjax.php", 
            data: { project_id: selectedValue },
            success: function(response) {
                $("#drawingPage").html(response); 
            },
        });
    }
///Function For Delete DrawingData 
function check_delete(id) {
    $.ajax({
        url: "delete.php",
        type: "GET",
        data: {id: id},
        success: function (response) {
            if (response == 1) {
                alert("Delete data successfully");
                $("#delete-row-" + id).remove();
            } else {
                alert("Data cannot be deleted");
            }
        },
    });
}