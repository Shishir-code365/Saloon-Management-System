var appointments = document.querySelector('#appointments');
var customers = document.querySelector('.customers');
var services = document.querySelector('.services');
var settings = document.querySelector('.settings');
var content1 = document.querySelector('.content1');

var nav_item = document.querySelectorAll('.nav_item');

appointments.classList.add('active');

nav_item.forEach(function(item)
{
    item.addEventListener('click',function()
    {
        nav_item.forEach(function(navitems){
            navitems.classList.remove('active');
        });
        item.classList.add('active');
    })
});

