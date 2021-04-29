
function validateInput(name, email, telephone, movie) {
        name = name.trim();
        email = email.trim();
        telephone = telephone.trim();
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

        if(movie === ''){
            errors.push('Bitte wählen Sie ein Video aus');
        }

        return errors;
}