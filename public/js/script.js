const form = document.querySelector("form");
const emailInput = form.querySelector('input[name="email"]');
const confirmedPasswordInput = form.querySelector('input[name="confirmedPassword"]');

function isEmail(email)
{
    return /\S+@\S+\.\S+/.test(email)
}

function passwordEqual(password, confirmedPassword)
{
    return password === confirmedPassword;
}

function markValidation(element, condition){
    !condition ? element.classList.add('no-valid') : element.classList.remove('no-valid');
}

function validateEmail (){
    setTimeout(function()
        {
            markValidation(emailInput, isEmail(emailInput.value))
        },
        1000);
}

function validatePassword()
{
    const condition = passwordEqual(confirmedPasswordInput.previousElementSibling.value,confirmedPasswordInput.value)
    markValidation(confirmedPasswordInput, condition);
}

emailInput.addEventListener('keyup',validateEmail);

confirmedPasswordInput.addEventListener('keyup', function (){
    setTimeout(validatePassword,1000);
});