var enter2 = document.querySelector('.enter2');
var enteruser2 = document.querySelector('.enteruser2');
var enterpass2 = document.querySelector('.enterpass2');
var enterrepass2 = document.querySelector('.enterrepass2');
var enteremail = document.querySelector('.enteremail');
var enterphone = document.querySelector('.enterphone');
var repassmatch = document.querySelector('.repassmatch');
var numberformat = document.querySelector('.numberformat');
var validemail = document.querySelector('.validemail');
var validuser2 = document.querySelector('.validuser2');
enter2.addEventListener('click',()=>{
    var username2 = document.querySelector('.username2').value;
    var password2 = document.querySelector('.password2').value;
    var repassword2 = document.querySelector('.repassword2').value;
    var email = document.querySelector('.email').value;
    var phone = document.querySelector('.phone').value;

    enteruser2.style.display = 'none';
    enterpass2.style.display = 'none';
    enterrepass2.style.display = 'none';
    enteremail.style.display = 'none';
    enterphone.style.display = 'none';
    repassmatch.style.display = 'none';
    validemail.style.display = 'none';
    numberformat.style.display = 'none'; 
    validuser2.style.display = 'none';

    if (!username2) {
        enteruser2.style.display = 'inline';
    }
    else if(!validateUsername(username2))
     {
        validuser2.style.display = 'inline';
     }
    if (!password2) {
        enterpass2.style.display = 'inline';
    }

    if (!repassword2) {
        enterrepass2.style.display = 'inline';
    }
    else if (password2!== repassword2) {
        repassmatch.style.display = 'inline';
    }
    if (!email) {
        enteremail.style.display = 'inline';
    }
    else if (!validateEmail(email)) {
        validemail.style.display = 'inline';
    }

    if (!phone) {
        enterphone.style.display = 'inline';
    }
    else if (!validatePhone(phone)) {
       numberformat.style.display = 'inline';
    }
    
})
function validate_register() {
    var username2 = document.querySelector('.username2').value;
    var password2 = document.querySelector('.password2').value;
    var repassword2 = document.querySelector('.repassword2').value;
    var email = document.querySelector('.email').value;
    var phone = document.querySelector('.phone').value;
    
    // Reset error messages
    enteruser2.style.display = 'none';
    enterpass2.style.display = 'none';
    enterrepass2.style.display = 'none';
    enteremail.style.display = 'none';
    enterphone.style.display = 'none';
    repassmatch.style.display = 'none';
    validemail.style.display = 'none';
    numberformat.style.display = 'none';
    validuser2.style.display ='none'; // Reset the 'password mismatch' error
    
    if (!username2) {
        enteruser2.style.display = 'inline';
    }
    else if(!validateUsername(username2))
    {
        validuser2.style.display = 'inline';
    }
    
    if (!password2) {
        enterpass2.style.display = 'inline';
    }

    if (!repassword2) {
        enterrepass2.style.display = 'inline';
    } else if (password2 !== repassword2) {
        enterrepass2.style.display = 'none'; // Clear 'enterrepass2' error
        repassmatch.style.display = 'inline';
    }
    
    if (!email) {
        enteremail.style.display = 'inline';
    } else if (!validateEmail(email)) {
        validemail.style.display = 'inline';
    }
    
    if (!phone) {
        enterphone.style.display = 'inline';
    } else if (!validatePhone(phone)) {
        numberformat.style.display = 'inline';
    }
    
    
    // Prevent form submission if any error is displayed
    if (
        enteruser2.style.display === 'inline' ||
        enterpass2.style.display === 'inline' ||
        enterrepass2.style.display === 'inline' ||
        repassmatch.style.display === 'inline' ||
        enteremail.style.display === 'inline' ||
        validemail.style.display === 'inline' ||
        enterphone.style.display === 'inline' ||
        numberformat.style.display === 'inline'||
        validuser2.style.display === 'inline'
        ) {
            return false;
        }
        else{
        
        alert("Signed Up Successfully!");
        return true;
    }
    
}

function validateEmail(email) {
    // Email validation regex
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}

function validatePhone(phone) {
    // Phone number validation regex
    var phoneRegex = /^[9]\d{9}$/;
    return phoneRegex.test(phone);
}
function validateUsername(username2)
{
    var username2Regex = /^[a-zA-Z][a-zA-Z]+( [a-zA-Z]+)?( [a-zA-Z]+)?[a-zA-Z]$/;
    return username2Regex.test(username2);
}