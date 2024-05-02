<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
    $( function() {
        $.getJSON('fetch_dates.php', function(bookedDates) {
            $( "#datepicker" ).datepicker({
                beforeShowDay: function(date){
                    var string = jQuery.datepicker.formatDate('yy-mm-dd', date);
                    return [ bookedDates.indexOf(string) == -1 ]
                },
                minDate: 0
            });
        });
    } );
    </script>
</head>
<body>
<form action="book_appointment.php" method="post">
        <label for="clientname">Name:</label><br>
        <input type="text" id="clientname" name="clientname" required><br>
        <label for="clientemail">Email:</label><br>
        <input type="email" id="clientemail" name="clientemail" required><br>
        <label for="clientphonenumber">Phone (optional):</label><br>
        <input type="tel" id="clientphonenumber" name="clientphonenumber"><br>
        <label for="clientrequests">Specific requests (optional):</label><br>
        <textarea id="clientrequests" name="clientrequests"></textarea><br>
        <label for="date">Date:</label><br>
        <input type="text" id="datepicker" name="date" required><br>
        <input type="submit" value="Book Appointment">
    </form>
</body>
</html>