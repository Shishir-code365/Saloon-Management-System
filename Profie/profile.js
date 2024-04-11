const logout = document.querySelector('.logout');
logout.addEventListener('click',function(){
    window.location.href = '../logout/logout.php';
})

const error = document.querySelector('.errormsg');
const success_name = document.querySelector('.success_name');

const success_email = document.querySelector('.success_email');
const error_email = document.querySelector('.errormsg_email');

const success_username = document.querySelector('.success_username');
const error_username = document.querySelector('.errormsg_username');

const success_password = document.querySelector('.success_password');
const error_password = document.querySelector('.errormsg_password');

const success_phone = document.querySelector('.success_phone');
const error_phone = document.querySelector('.errormsg_phone');




const edit = document.getElementById('edit1');
const done = document.getElementById('done1');
const nameinput = document.getElementById('nameinput');

const edit2 = document.getElementById('edit2');
const done2 = document.getElementById('done2');
const emailinput = document.getElementById('emailinput');

const edit3 = document.getElementById('edit3');
const done3 = document.getElementById('done3');
const usernameinput = document.getElementById('usernameinput');


const edit4 = document.getElementById('edit4');
const done4 = document.getElementById('done4');
const passwordinput = document.getElementById('passwordinput');
const lock = document.querySelector('.lock');
const unlock = document.querySelector('.unlock');

const edit5 = document.getElementById('edit5');
const done5 = document.getElementById('done5');
const phoneinput = document.getElementById('phoneinput');


    edit.addEventListener('click',function(){
        edit.style.display = 'none';
        done.style.display = 'inline';
        nameinput.style.color = 'black';
        nameinput.style.cursor = 'text';
        nameinput.removeAttribute('readonly');
        nameinput.focus();
        nameinput.selectionStart = nameinput.selectionEnd = nameinput.value.length;
       
    })
    done.addEventListener('click',function(){
        const nameinput_value = document.getElementById('nameinput').value;
        const nameinput = document.getElementById('nameinput');
        
        if(!validateName(nameinput_value))
        {
            error.style.display="inline";
            const msg = document.createElement('p');
            msg.innerHTML = "*Name cannot contain letters or symbols!!";
            msg.style.marginLeft="20px";
            msg.style.fontSize="small";
            error.appendChild(msg);
            error.classList.add('fade-in');
            setTimeout(function() {
                error.style.display = "none";
                error.innerHTML = '';
            
            }, 2000);
           
        }
        else{
            error.style.display = "none";
            nameinput.style.cursor = 'default';
            nameinput.setAttribute('readonly','true');
            edit.style.display = 'inline';
            done.style.display = 'none';
            nameinput.style.color = 'gray';

            $.ajax({
                type: 'post',
                url: 'name_edit.php',
                data:{ nameinput_value: nameinput_value },
                success: function(response)
                {
                    if(response==1)
                    {
                        // console.log("done");
                        $('.svg h4').text(nameinput_value);
                        success_name.style.display = "inline";
                        const msg = document.createElement('p');
                        msg.style.marginLeft="20px";
                        msg.style.fontSize="small";
                        msg.innerHTML = "Name updated successfully!!";
                        success_name.appendChild(msg);
                        success_name.classList.add('fade-in');
                        setTimeout(function() {
                            success_name.style.display = "none";
                            success_name.innerHTML = '';
                        
                        }, 2000);
                    }
                }
            })
            
        }
    })

 
    edit2.addEventListener('click', function() {
        edit2.style.display = 'none';
        done2.style.display = 'inline';
        emailinput.style.color = 'black';
        emailinput.style.cursor = 'text';
        emailinput.removeAttribute('readonly');
        emailinput.focus();
        emailinput.selectionStart = emailinput.selectionEnd = emailinput.value.length;
    });
    
    let initialEmail;

    
    done2.addEventListener('click', function() {
        const emailinput = document.getElementById('emailinput');
        const emailinput_value = emailinput.value;
    
        if (initialEmail !== undefined && emailinput_value !== initialEmail) {
            
            emailinput.style.cursor = 'default';
            error_email.style.display = "none";
            emailinput.setAttribute('readonly', 'true');
            edit2.style.display = 'inline';
            done2.style.display = 'none';
            emailinput.style.color = 'gray';
            
            if (!validateEmail(emailinput_value)) {
                
                error_email.style.display="inline";
                const msg = document.createElement('p');
                msg.innerHTML = "*Invalid Email";
                msg.style.marginLeft="20px";
                msg.style.fontSize="small";
                error_email.appendChild(msg);
                error_email.classList.add('fade-in');
                setTimeout(function() {
                    error_email.style.display = "none";
                    error_email.innerHTML = '';
                
                }, 2000);
                edit2.style.display = "none";
                done2.style.display = "inline";
                emailinput.removeAttribute('readonly');
                emailinput.style.color = "black";
            }
            else{
                
                error_email.style.display = "none";
                emailinput.style.cursor = 'default';
                emailinput.setAttribute('readonly','true');
                edit2.style.display = 'inline';
                done2.style.display = 'none';
                emailinput.style.color = 'gray';
                
                $.ajax({
                type: 'post',
                url: 'email_edit.php',
                data: { emailinput_value: emailinput_value },
                success: function(response) {
                    if(response==0)
                        {
                           console.log("response 0");
                            error_email.style.display = "inline";
                            const msg = document.createElement('p');
                            msg.style.marginLeft="20px";
                            msg.style.fontSize="small";
                            msg.innerHTML = "*Same email already exists please try other email!!";
                            error_email.appendChild(msg);
                            emailinput.removeAttribute('readonly');
                            emailinput.style.color= 'black';
                            done2.style.display = 'inline';
                            edit2.style.display = 'none';
                            
                        }
                        else if(response==1)
                        {
                            $('.svg p').text(emailinput_value);
                            success_email.style.display = "inline";
                            const msg = document.createElement('p');
                            msg.style.marginLeft="20px";
                            msg.style.fontSize="small";
                            msg.innerHTML = "E-mail updated successfully!!";
                            success_email.appendChild(msg);
                            success_email.classList.add('fade-in');
                            setTimeout(function() {
                                success_email.style.display = "none";
                                success_email.innerHTML = '';
                            
                            }, 2000);
                        }
                }
            });}
        
        } else {
    
            emailinput.style.cursor = 'default';
            error_email.style.display = "none";
            emailinput.setAttribute('readonly', 'true');
            edit2.style.display = 'inline';
            done2.style.display = 'none';
            emailinput.style.color = 'gray';
        }
    });



    edit3.addEventListener('click',function(){
        edit3.style.display = 'none';
        done3.style.display = 'inline';
        usernameinput.style.color = 'black';
        usernameinput.style.cursor = 'text';
        usernameinput.removeAttribute('readonly');
        usernameinput.focus();
        usernameinput.selectionStart = usernameinput.selectionEnd = usernameinput.value.length;
    })
    
    done3.addEventListener('click',function(){
        
        const usernameinput = document.getElementById('usernameinput');
        const usernameinput_value = document.getElementById('usernameinput').value;
        
        
        if(initialUsername !== undefined && usernameinput_value !== initialUsername)
        {

            usernameinput.style.cursor = 'default';
            error_username.style.display="none";
            usernameinput.setAttribute('readonly','true');
            edit3.style.display = 'inline';
            done3.style.display = 'none';
            usernameinput.style.color = 'gray';
            $.ajax({
                type: 'post',
                url: 'username_edit.php',
                data:{ usernameinput_value: usernameinput_value },
                success: function(response)
                {
                    if(response==0)
                    {
                       
                        error_username.style.display = "inline";
                        const msg = document.createElement('p');
                        msg.style.marginLeft="20px";
                        msg.style.fontSize="small";
                        msg.innerHTML = "*Same username already exists please try other username!!";
                        error_username.appendChild(msg);
                        usernameinput.removeAttribute('readonly');
                        usernameinput.style.color= 'black';
                        done3.style.display = 'inline';
                        edit3.style.display = 'none';
                        
                    }
                    else if(response==1)
                    {
                        // console.log("done");
                        success_username.style.display = "inline";
                        const msg = document.createElement('p');
                        msg.style.marginLeft="20px";
                        msg.style.fontSize="small";
                        msg.innerHTML = "Username updated successfully!!";
                        success_username.appendChild(msg);
                        success_username.classList.add('fade-in');
                        setTimeout(function() {
                            success_username.style.display = "none";
                            success_username.innerHTML = '';
                        
                        }, 2000);
                    }
                }
            })
        }
        else{
            usernameinput.style.cursor = 'default';
            error_username.style.display="none";
            usernameinput.setAttribute('readonly','true');
            edit3.style.display = 'inline';
            done3.style.display = 'none';
            usernameinput.style.color = 'gray';
        }
            
        
    })

    
    lock.addEventListener('click',function(){
        passwordinput.type = "text";
        unlock.style.display = "inline";
        lock.style.display = "none";
    })
    
    unlock.addEventListener('click',function(){
        passwordinput.type = "password";
        lock.style.display = "inline";
        unlock.style.display = "none";
    })
    
    edit4.addEventListener('click',function(){
        edit4.style.display = 'none';
        done4.style.display = 'inline';
        passwordinput.style.color = 'black';
        passwordinput.style.cursor = 'text';
        passwordinput.removeAttribute('readonly');
        passwordinput.focus();
        passwordinput.selectionStart = passwordinput.selectionEnd = passwordinput.value.length;
       
    })
    done4.addEventListener('click',function(){
        const passwordinput_value = document.getElementById('passwordinput').value;
        const passwordinput = document.getElementById('passwordinput');

            error_password.style.display = "none";
            passwordinput.style.cursor = 'default';
            passwordinput.setAttribute('readonly','true');
            edit4.style.display = 'inline';
            done4.style.display = 'none';
            passwordinput.style.color = 'gray';

            $.ajax({
                type: 'post',
                url: 'password_edit.php',
                data:{ passwordinput_value: passwordinput_value },
                success: function(response)
                {
                    if(response==1)
                    {
                        success_password.style.display = "inline";
                        const msg = document.createElement('p');
                        msg.style.marginLeft="20px";
                        msg.style.fontSize="small";
                        msg.innerHTML = "Password updated successfully!!";
                        lock.style.display = "inline";
                        unlock.style.display = "none";
                        passwordinput.type = "password";
                        success_password.appendChild(msg);
                        success_password.classList.add('fade-in');
                        setTimeout(function() {
                            success_password.style.display = "none";
                            success_password.innerHTML = '';
                        
                        }, 2000);
                    }
                }
            })
            

    })





edit5.addEventListener('click', function() {
    edit5.style.display = 'none';
    done5.style.display = 'inline';
    phoneinput.style.color = 'black';
    phoneinput.style.cursor = 'text';
    phoneinput.removeAttribute('readonly');
    phoneinput.focus();
    phoneinput.selectionStart = phoneinput.selectionEnd = phoneinput.value.length;
});

let initialPhone;
window.onload = function() {
    initialPhone = document.getElementById('phoneinput').value;
    initialEmail = document.getElementById('emailinput').value;
};

done5.addEventListener('click', function() {
    const phoneinput = document.getElementById('phoneinput');
    const phoneinput_value = phoneinput.value;

    if (initialPhone !== undefined && phoneinput_value !== initialPhone) {
        phoneinput.style.cursor = 'default';
        error_phone.style.display = "none";
        phoneinput.setAttribute('readonly', 'true');
        edit5.style.display = 'inline';
        done5.style.display = 'none';
        phoneinput.style.color = 'gray';

        if (!validatePhone(phoneinput_value)) {
            error_phone.style.display="inline";
            const msg = document.createElement('p');
            msg.innerHTML = "*Phone number must start from '9' and must be of 10 digits!!";
            msg.style.marginLeft="20px";
            msg.style.fontSize="small";
            error_phone.appendChild(msg);
            error_phone.classList.add('fade-in');
            setTimeout(function() {
                error_phone.style.display = "none";
                error_phone.innerHTML = '';
            
            }, 2000);
            edit5.style.display = "none";
            done5.style.display = "inline";
            phoneinput.removeAttribute('readonly');
            phoneinput.style.color = "black";
        }
        else{
            
            error_phone.style.display = "none";
            phoneinput.style.cursor = 'default';
            phoneinput.setAttribute('readonly','true');
            edit5.style.display = 'inline';
            done5.style.display = 'none';
            phoneinput.style.color = 'gray';
            
            $.ajax({
            type: 'post',
            url: 'phone_edit.php',
            data: { phoneinput_value: phoneinput_value },
            success: function(response) {
                if(response==0)
                    {
                       
                        error_phone.style.display = "inline";
                        const msg = document.createElement('p');
                        msg.style.marginLeft="20px";
                        msg.style.fontSize="small";
                        msg.innerHTML = "*Same phone number already exists please try other phone number!!";
                        error_phone.appendChild(msg);
                        phoneinput.removeAttribute('readonly');
                        phoneinput.style.color= 'black';
                        done5.style.display = 'inline';
                        edit5.style.display = 'none';
                        
                    }
                    else if(response==1)
                    {
                        // console.log("done");
                        success_phone.style.display = "inline";
                        const msg = document.createElement('p');
                        msg.style.marginLeft="20px";
                        msg.style.fontSize="small";
                        msg.innerHTML = "Phone number updated successfully!!";
                        success_phone.appendChild(msg);
                        success_phone.classList.add('fade-in');
                        setTimeout(function() {
                            success_phone.style.display = "none";
                            success_phone.innerHTML = '';
                        
                        }, 2000);
                    }
            }
        });}
    
    } else {

        phoneinput.style.cursor = 'default';
        error_phone.style.display = "none";
        phoneinput.setAttribute('readonly', 'true');
        edit5.style.display = 'inline';
        done5.style.display = 'none';
        phoneinput.style.color = 'gray';
    }
});





$(document).ready(function() {
    $(".delete").click(function() {
        if (confirm("Are you sure you want to delete your account?")) {
            $.ajax({
                type: "POST",
                url: "delete_profile.php",
                data: {},
                success: function(response) {
                    if (response === "success") {
                        alert("Your account has been deleted successfully.");
                        window.location.href = "../index.php"; 
                    } else {
                        alert("Failed to delete your account. Please try again later.");
                    }
                },
                error: function() {
                    alert("Error: Unable to process the request.");
                }
            });
        }
    });
});




    function validateName(nameinput)
    {
        var nameRegex = /^[a-zA-Z]+(?: [a-zA-Z]+)?(?: [a-zA-Z]+)?$/;
        return nameRegex.test(nameinput);
    }
    function validateEmail(emailinput) {
        var emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

        return emailRegex.test(emailinput);
    }
    function validatePhone(phoneinput) {
        // Phone number validation regex
        var phoneRegex = /^[9]\d{9}$/;
        return phoneRegex.test(phoneinput);
    }