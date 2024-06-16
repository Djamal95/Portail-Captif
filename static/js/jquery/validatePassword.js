document.addEventListener('DOMContentLoaded', function () {
    var form = document.getElementById('authentification');
    var message = document.getElementById('pass');
    var passwordOne = document.getElementById('password_one');
    var passwordTwo = document.getElementById('password_two');
    form.addEventListener('submit', function (e) {
        var password = passwordOne.value;
        var confirmPassword = passwordTwo.value;
        if (password !== confirmPassword) {
            e.preventDefault();

            message.classList.add('alert-danger');
            passwordOne.classList.add('password');
            passwordTwo.classList.add('password');
            message.textContent = 'Les mots de passe ne correspondent pas !';
            passwordOne.value = '';
            passwordTwo.value = '';
            console.log('Bonjour !');
        } else {
            password.classList.remove('pass');
            console.log('Formulaire soumis avec succès !');
            form.submit();
        }
    });
});
