function logout(){
    $.ajax({
        type: "GET",
        url: "../PHP/logout.php",
        success: function(){
            window.location.href="login.html";
        }
    });
}