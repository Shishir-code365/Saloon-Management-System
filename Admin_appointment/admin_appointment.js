
const logout = document.querySelector('.logout');

logout.addEventListener('click', function(){
    window.location.href = '../logout/logout.php';
});
$(document).ready(function(){
    $('#filterForm').submit(function(event){
        event.preventDefault();
        var formData = $(this).serialize();
        $('#appointmentsTable').empty();
        const appointment = document.querySelector('#appointmentsTable');
        appointment.style.display = "block";

        $.ajax({
            type: 'POST',
            url: 'filter_appointments.php',
            data: formData,
            success: function(response){
                $('#appointmentsTable').html(response);
            }
        });
    });
});
