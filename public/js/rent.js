
function calcExpectedDate(){
    const membership = document.querySelector('#membership').value;
    const defaultLoanDays = 30;
    let extraDays = 0;
    switch (membership){
        case "1":
            extraDays = 0;
            break;
        case "2":
            extraDays = 10;
            break;
        case "3":
            extraDays = 20;
            break;
        case "4":
            extraDays = 40;
            break;
    }
    const loanDuration = defaultLoanDays + extraDays;
    const returnDay = new Date();
    returnDay.setDate(returnDay.getDate() + loanDuration);
    document.querySelector('#expectedDate').value = returnDay.toDateString();
}

window.addEventListener("load", function(){
    calcExpectedDate();
    document.querySelector('#formular').addEventListener('submit', function(evt) {
        let name       = document.querySelector('#name').value;
        let email      = document.querySelector('#email').value;
        let telephone  = document.querySelector('#telephone').value;
        let membership = document.querySelector('#membership').value
        let movie      = document.querySelector('#movie').value;
        const date       = new Date();

        name = name.trim();
        email = email.trim();
        telephone = telephone.trim();
        membership = membership.trim();
        movie = movie.trim();

        const errors = []

        if(name === ''){
            errors.push('Bitte geben Sie einen Namen an');
        }

        if(email === ''){
            errors.push('Bitte geben Sie eine Email an');
        } else if (/[^@]+@[^.]+\..+$/.test(email) == false) {
            errors.push('Bitte geben Sie eine gültige Email-Adress ein');
        }

        if (telephone !== '') {
            if(/^[0-9\-\(\)\/\+\s]+$/.test(telephone) == false){
                errors.push( 'Bitte geben Sie eine gültige Telefonnummer ein');
            }
        }


        if(membership === ''){
            errors.push('Bitte wählen Sie einen Mitgliedschaftsstatus aus');
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
