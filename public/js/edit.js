window.addEventListener("load", function(){
    document.querySelector('#formular').addEventListener('submit', function(evt) {
        let name       = document.querySelector('#name').value;
        let email      = document.querySelector('#email').value;
        let telephone  = document.querySelector('#telephone').value;
        let returned = document.querySelector('#returned').value
        let movie      = document.querySelector('#movie').value;
        const date       = new Date();

        name = name.trim();
        email = email.trim();
        telephone = telephone.trim();
        returned = returned.trim();
        movie = movie.trim();

        const errors = []

        if(name === ''){
            errors.push('Bitte geben Sie einen Namen an');
        }

        if(email === ''){
            errors.push('Bitte geben Sie eine Email an');
        } else if (/[^@]+@[^.]+\..+$/.test(email) === false) {
            errors.push('Bitte geben Sie eine gültige Email-Adresse ein');
        }

        if (telephone !== '') {
            if(/^[0-9\-\(\)\/\+\s]+$/.test(telephone) === false){
                errors.push( 'Bitte geben Sie eine gültige Telefonnummer ein');
            }
        }


        if(returned !== "0" && returned !== "1"){
            console.log(returned)
            errors.push('Bitte wählen Sie ob das Video zurück gebracht wurde');
        }

        if(movie === ''){
            errors.push('Bitte wählen Sie ein Video aus');
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
