// Javascript
console.info('JS geladen.');

window.addEventListener("load", function(){
    document.querySelector('formular').addEventListener('submit', function(evt) {

        evt.preventDefault();
    });
});