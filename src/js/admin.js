function deleteUser(username){

    var modal = document.getElementById("confirmModal");
    var modalContent = document.getElementById("modalContent");
    var modalLink = document.getElementById("modalLink");

    modalContent.innerHTML = "Really delete user " + username + "?";

    modalLink.href = "admin.php?delete=" + username;

    modal.classList.add("is-active");
}

function unauthorizeGuest(mac){

    var modal = document.getElementById("confirmModal");
    var modalContent = document.getElementById("modalContent");
    var modalLink = document.getElementById("modalLink");

    modalContent.innerHTML = "Really kick user " + mac + "?";

    modalLink.href = "admin.php?unauthorize_guest=" + mac;

    modal.classList.add("is-active");
}

function hideModal(){
    
    var modal = document.getElementById("confirmModal");
    var modalContent = document.getElementById("modalContent");
    var modalLink = document.getElementById("modalLink");

    modal.classList.remove("is-active");
    modalContent.innerHTML = "";
    modalLink.href = "";

}