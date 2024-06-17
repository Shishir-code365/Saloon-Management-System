const addbtn = document.querySelector('.add');
const servicebtn = document.querySelector('.button');
const add_service = document.querySelector('.add-service')
const container = document.querySelector('.container');
const fullscreen = document.querySelector('.full-screen');
const exit = document.querySelector('.exit');

 const logout = document.querySelector('.logout');

 logout.addEventListener('click', function(){
     window.location.href = '../logout/logout.php';
 });

servicebtn.addEventListener('click',function(){
    fullscreen.style.display = "inline";
    add_service.style.display = "inline";
})

exit.addEventListener('click',function(){
    add_service.style.display = "none";
    fullscreen.style.display = "none";
})

document.addEventListener('DOMContentLoaded', (event) => {
    const deleteButtons = document.querySelectorAll('.delete-btn');
    deleteButtons.forEach(button => {
        button.addEventListener('click', function() {
            const serviceId = this.getAttribute('data-id');
            console.log('Service ID to delete:', serviceId);
            if(confirm("Are you sure you want to delete the service?")){
                $.ajax({
                    method: "post",
                    url: "./admin_servicedel.php",
                    data:{serviceId: serviceId},
                    success: function(response){
                        if(response=="success"){
                            alert ("Service Deleted Successfully!!")
                            location.reload();
                        }
                        else if(response == "failure")
                            {
                                alert ("Failed to delete service")
                            }
                    }
                })
            }
            
        });
    });
});
