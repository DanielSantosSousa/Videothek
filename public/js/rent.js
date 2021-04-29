
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
    /*document.querySelector('formular').addEventListener('submit', function(evt) {

        evt.preventDefault();
    });*/
});