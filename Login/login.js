var enter = document.querySelector('.enter');
var enteruser = document.querySelector('.enteruser');
var enterpass = document.querySelector('.enterpass');
var enter2 = document.querySelector('.enter2');
var enteruser2 = document.querySelector('.enteruser2');
var enterpass2 = document.querySelector('.enterpass2');
var container = document.querySelector('.container');
var container2 = document.querySelector('.container2');
var btn = document.querySelector('.Btn');
var btn2 = document.querySelector('.Btn2');

//login


enter.addEventListener('click',function(){
    var username = document.querySelector('.username').value;
    var password = document.querySelector('.password').value;
    
if(!username  && !password)
{
   enteruser.style.display = 'inline';
   enterpass.style.display = 'inline';
   
}
else if(!username)
{
    enteruser.style.display = 'inline';
    enterpass.style.display = 'none';
    
}
else if(!password)
{
    enterpass.style.display = 'inline';
    enteruser.style.display = 'none';
}
else
{
    enteruser.style.display = 'none';
        enterpass.style.display = 'none';
}

})
