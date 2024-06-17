const logout = document.querySelector('.logout');
logout.addEventListener('click',function(){
    window.location.href = '../logout/logout.php';
})
const book = document.querySelector('.book');
book.addEventListener('click',function(){
    window.location.href = '../Appointment/book_appointment.php';
})


$(".view-button").click(function(){
    const appointmentDate = $(this).closest('tr').find('.appointmentDate').text();
    console.log(appointmentDate);
    const appointmentTime = $(this).closest('tr').find('.appointmentTime').text();
    console.log(appointmentTime);
    const service = $(this).closest('tr').find('.service').text();
    console.log(service);

    $.ajax({
                type: 'post',
                url: './invoice-db.php',
                data: {appointmentDate:appointmentDate,appointmentTime:appointmentTime,service:service},
                xhrFields: {
                    responseType: 'blob'
                },
                success: function(response) {
                    console.log(response);
                    let blobUrl = URL.createObjectURL(response);
                    window.open(blobUrl);
                },
                error: function(xhr, status, error) {
                    console.log('Error:', error);
                }
            });

})
$(".delete-button").click(function(){
    const appointmentDate = $(this).closest('tr').find('.appointmentDate').text();
    console.log(appointmentDate);
    const appointmentTime = $(this).closest('tr').find('.appointmentTime').text();
    console.log(appointmentTime);
    const service = $(this).closest('tr').find('.service').text();
    if(confirm("Are you sure you want to delete the booked appointment?"))
        {
            $.ajax({
                type: 'post',
                url:'./deleteAppointment.php',
                data:{appointmentTime:appointmentTime,appointmentDate:appointmentDate,service:service},
                success: function(response){
                    console.log(response);
                    if(response == "success")
                        {

                            alert ("Appointment Deleted Successfully!!")
                            location.reload();
                        }
                    else if(response == "failure")
                        {
                            alert ("Failed to delete appointment. The appointment may not be deletable because it is scheduled within 1 hour from now, or the appointment time has already passed. ")
                        }
                }
            })
        }
   

})
$(document).ready(function(){
    $('#filterForm').submit(function(event){
        event.preventDefault();
        var formData = $(this).serialize();
        $('#appointmentsTable').empty();
        const appointment = document.querySelector('#appointmentsTable');
        appointment.style.display = "block";

        $.ajax({
            type: 'POST',
            url: 'appointmentFilter.php',
            data: formData,
            success: function(response){
                $('#appointmentsTable').html(response);
            }
        });
    });
});