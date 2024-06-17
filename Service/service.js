const logout = document.querySelector('.logout');
logout.addEventListener('click',function(){
    window.location.href = '../logout/logout.php';
})
  function redirectToBookAppointment(serviceName) {
    window.location.href = "../Appointment/book_appointment.php?service=" + encodeURIComponent(serviceName);
  }

