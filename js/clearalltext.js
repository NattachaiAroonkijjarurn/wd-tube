function eraseText() {
    document.getElementById("autoresizing").value = "";
}

function reraseText() {
    document.getElementById("rautoresizing").value = "";
}

function controlShow() {
    document.getElementById("cancel").style.display = "block";
    document.getElementById("subcom").style.display = "block";
}

function controlHide() {
    document.getElementById("cancel").style.display = "none";
    document.getElementById("subcom").style.display = "none"; 
}

function controlShowre() {
    document.getElementById("recancel").style.display = "block";
    document.getElementById("subre").style.display = "block";
}

function controlHidere() {
    document.getElementById("recancel").style.display = "none";
    document.getElementById("subre").style.display = "none";
}

function showReply() {
    document.getElementById("openreply").style.display = "block";
}

function hideReply() {
    document.getElementById("openreply").style.display = "none";
}