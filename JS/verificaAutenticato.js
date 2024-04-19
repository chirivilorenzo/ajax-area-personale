function verificaAutenticato(){
    $.ajax({
        type: "POST",
        url: "../PHP/verificaAutenticato.php",
        success: function(response){
            if(response["status"] == "200"){
                visualizzaTutto();
            }
            else{
                alert(response["status"] + ": " + response["message"]);
                window.location.href = "../HTML/login.html";
            }
        }
    })
}