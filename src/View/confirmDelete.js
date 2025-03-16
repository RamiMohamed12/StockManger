function confirmDelete(id) {
    var modal = document.getElementById("confirmModal");
    var confirmBtn = document.getElementById("confirmBtn");
    var cancelBtn = document.getElementById("cancelBtn");
    var span = document.getElementsByClassName("close")[0];
    
    // Determine which page we're on to set the correct delete URL
    var currentPage = window.location.pathname;
    var deleteUrl = '';
    
    if (currentPage.includes('employee.php')) {
        deleteUrl = '../Controller/delete_employee.php?id=' + id;
    } else {
        deleteUrl = '../Controller/delete.php?id=' + id;
    }

    modal.style.display = "block";

    confirmBtn.onclick = function() {
        window.location.href = deleteUrl;
    }

    cancelBtn.onclick = function() {
        modal.style.display = "none";
    }

    span.onclick = function() {
        modal.style.display = "none";
    }

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
}