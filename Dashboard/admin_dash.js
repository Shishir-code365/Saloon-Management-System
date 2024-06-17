
const logout = document.querySelector('.logout');
logout.addEventListener('click',function(){
    window.location.href = '../logout/logout.php';
})
const card3 = document.querySelector('.card3');
card3.addEventListener('click',function(){
    window.location.href = '../Admin_customer/customer.php'
})
const uname = document.querySelector('.uname');

const card1 = document.querySelector('.card1');
const card2 = document.querySelector('.card2');

card1.addEventListener('click',()=>{
    window.location.href = "../Admin_appointment/admin_appointment.php";
})
card2.addEventListener('click',()=>{
    window.location.href = "../Admin_appointment/admin_appointment.php";
})
$(".change-btn").click(function() {
    console.log("Clicked");

    const $row = $(this).closest('tr');
    const status = $row.find('.status').text().trim();
    const phone = $row.find('.phone').text().trim();
    const time = $row.find('.time').text().trim();
    const date = $row.find('.date').text().trim();
    let finalStatus;

    if (status === "unpaid") {
        finalStatus = "paid";
    } else {
        finalStatus = "unpaid";
    }

    if (confirm("Are you sure you want to change the status to " + finalStatus + "?")) {
        $.ajax({
            type: 'post',
            url: 'statusChange.php',
            data: { status: status, phone: phone, time: time, date: date },
            success: function(response) {
                console.log(response);
                if (response === "paid" || response === "unpaid") {
                    alert("Status Changed Successfully!!");
                    $row.find('.status').text(response);
                    $row.find('.status').css('color', response === "paid" ? 'green' : 'red');
                } else if (response === "failure") {
                    alert("Failed to change the status!!");
                    location.reload();
                }
            },
            error: function() {
                alert("An error occurred while processing your request.");
            }
        });
    }
});



$(".view-button").click(function(){
    const appointmentDate = $(this).closest('tr').find('.date').text();
    console.log(appointmentDate);
    const appointmentTime = $(this).closest('tr').find('.time').text();
    console.log(appointmentTime);
    const service = $(this).closest('tr').find('.service').text();
    console.log(service);

    $.ajax({
                type: 'post',
                url: './invoice-admin.php',
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