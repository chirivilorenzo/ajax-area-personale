function salvaInfo(){
    let nome = $("#nome").val();
    let cognome = $("#cognome").val();
    let dataNascita = $("#dataNascita").val();
    let regione = $("#regione").val();
    let provincia = $("#provincia").val();
    let citta = $("#citta").val();

    //fare controlli se le cose che ha messo l'utente sono vuote o no

    $.ajax({
        type: "POST",
        url: "../PHP/salvaInfo.php",
        data: {nome: nome, cognome: cognome, dataNascita: dataNascita, regione: regione, provincia: provincia, citta: citta},
        success: function(response){
            if(response["status"] == "200"){
                alert("info salvate correttamente");
            }
            else{
                alert(response["status"] + ": " + response["message"]);
            }
        }
    })
}