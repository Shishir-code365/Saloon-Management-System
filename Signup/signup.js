
const username = document.querySelector('.username');
const enter = document.querySelector('.enter');
const nameError = document.querySelector('.nameError');
const passError = document.querySelector('.passError');
const emailError = document.querySelector('.emailError');
const phoneError = document.querySelector('.phoneError');

function validate_register()
{
    nameError.style.display = "none";
    phoneError.style.display = "none";
    passError.style.display = "none";
       
        const name = document.querySelector('.name').value;
        const password = document.querySelector('.password').value;
        const repass = document.querySelector('.repassword').value;
        const email = document.querySelector('.email').value;
        const phone = document.querySelector('.phone').value;

        if(!validateName(name))
        {
            nameError.style.display = "inline"; 
            nameError.innerHTML="";
            const nameMsg = document.createElement('p');
            nameMsg.innerHTML = "*Name must only contain letters!!";
            nameError.appendChild(nameMsg);
            return false;  
        }
        if(password!=repass)
        {
            passError.style.display = "inline";
            passError.innerHTML="";
            const PassMsg = document.createElement('p');
            PassMsg.innerHTML = "*Passwords don't match";
            passError.appendChild(PassMsg);
            return false;
        }
        if(!validatePhone(phone))
        {
            phoneError.style.display = "inline";
            phoneError.innerHTML="";
            const PhoneMsg = document.createElement('p');
            PhoneMsg.innerHTML = "*Must start from 98 and must be of 10 digit";
            phoneError.appendChild(PhoneMsg);
            return false;
        }
       return true;
       
       
}

function validateEmail(email) {
    // Email validation regex
    var emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    
    return emailRegex.test(email);
}

function validatePhone(phone) {
    // Phone number validation regex
    var phoneRegex = /^[9]\d{9}$/;
    return phoneRegex.test(phone);
}
 function validateName(name)
    {
        var nameRegex = /^[a-zA-Z]+(?: [a-zA-Z]+)?(?: [a-zA-Z]+)?$/;
        return nameRegex.test(name);
    }

    document.querySelector('form').addEventListener('submit', function(event) {
       
        if (!validate_register()) {
            event.preventDefault(); 
        }})