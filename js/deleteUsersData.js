function check_delete(id) {
    $.ajax({
      url: "delete.php",
      type: "GET",
      data: {
        id: id,
      },
      success: function(response) {
        if (response == 1) {
          alert("Delete data successfully");
          $("#delete-row-" + id).remove();
        } else {
          alert("Data cannot be deleted");
        }
      }
    });
  }