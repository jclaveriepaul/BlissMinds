<?php
session_start();
$_SESSION['appointmenttype'] = $_SESSION['appointmenttype'] ?? 'Unknown';
?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.13.18/jquery.timepicker.min.js"></script>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.13.18/jquery.timepicker.min.css">
    <script>
        $(function () {
            var bookedDatesAndTimes = {};

            $.getJSON('fetch_datesandtimes.php', function (data) {
                bookedDatesAndTimes = data;

                $("#datepicker").datepicker({
                    beforeShowDay: function (date) {
                        var string = jQuery.datepicker.formatDate('dd-mm-yy', date);
                        return [!(string in bookedDatesAndTimes)];
                    },
                    minDate: 0,
                    onSelect: function(dateText) {
                        var bookedTimes = bookedDatesAndTimes[dateText] || [];
                        $('#timepicker').timepicker('option', 'disableTimeRanges', bookedTimes.map(function(time) {
                            return [time, time];
                        }));
                    }
                });
            });

            $('#timepicker').timepicker({
                'scrollDefault': 'now',
                'minTime': '08:00am',
                'maxTime': '08:00pm',
                'timeFormat': 'H:i',
                'step': 60,
            });
        });
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
        <label for="time">Time:</label><br>
        <input type="text" id="timepicker" name="appointmenttime" required><br>
        <input type="hidden" name="appointmenttype" value="<?php echo $_SESSION['appointmenttype']; ?>">
        <input type="submit" value="Book Appointment">
    </form>

</body>

</html>