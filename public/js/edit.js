window.addEventListener("load", function(){
    document.querySelector('#formular').addEventListener('submit', function(evt) {
        let name       = document.querySelector('#name').value;
        let email      = document.querySelector('#email').value;
        let telephone  = document.querySelector('#telephone').value;
        let returned = document.querySelector('#returned').value
        let movie      = document.querySelector('#movie').value;

        returned = returned.trim();

        const errors = validateInput(name,email,telephone,movie);

        if(returned !== "0" && returned !== "1"){
            console.log(returned)
            errors.push('Bitte wählen Sie ob das Video zurück gebracht wurde');
        }

        if(errors.length !== 0){
            alert(formatErrors(errors));
            evt.preventDefault();
        }
    });
});

function formatErrors(errors) {
    let formattedError = "";
    errors.forEach(function (error){
        formattedError += error + "\n";
    });
    return formattedError;
}
