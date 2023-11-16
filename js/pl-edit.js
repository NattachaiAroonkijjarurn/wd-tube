function editName() {
    document.getElementById("editBtn").style.display = "none";
    document.getElementById("plname").style.display = "none";
    document.getElementById("editplname").style.display = "block";
    document.getElementById("cancel").style.display = "block";
    document.getElementById("sub-editplname").style.display = "block";
    document.getElementById("deleteBtn").style.display="none";
}

function closeEdit() {
    document.getElementById("editBtn").style.display = "block";
    document.getElementById("plname").style.display = "block";
    document.getElementById("editplname").style.display = "none";
    document.getElementById("cancel").style.display = "none";
    document.getElementById("sub-editplname").style.display = "none";
    document.getElementById("deleteBtn").style.display="block";
}