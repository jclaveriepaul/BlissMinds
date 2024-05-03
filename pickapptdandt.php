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
                console.log(bookedDatesAndTimes);  // Log the data returned by the PHP script

                $("#datepicker").datepicker({
                    beforeShowDay: function (date) {
                        var string = jQuery.datepicker.formatDate('yy-mm-dd', date);
                        return [!(string in bookedDatesAndTimes && bookedDatesAndTimes[string].length >= 12)];
                    },
                    minDate: 0,
                    onSelect: function (dateText) {
                        var bookedTimes = bookedDatesAndTimes[dateText] || [];
                        $('#timepicker').timepicker('option', 'disableTimeRanges', bookedTimes.map(function (time) {
                            // Parse the time into hours and minutes
                            var parts = time.split(':');
                            var hours = parseInt(parts[0]);
                            var minutes = parseInt(parts[1]);

                            // Calculate the end time as one hour later
                            var endTime = (hours + 1) % 24 + ':' + minutes;

                            return [time, endTime];
                        }));

                        // Calculate the number of available sessions
                        var availableSessions = 12 - bookedTimes.length;

                        // Update the content of the 'availableSessions' element
                        $('#availableSessions').text('Available sessions: ' + availableSessions);
                    },
                    dateFormat: 'yy-mm-dd'
                });
            });

            $('#timepicker').timepicker({
                'scrollDefault': 'now',
                'minTime': '08:00am',
                'maxTime': '07:00pm',
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
        <p id="availableSessions"></p>
        <input type="hidden" name="appointmenttype" value="<?php echo $_SESSION['appointmenttype']; ?>">
        <input type="submit" value="Book Appointment">
    </form>
    <a href="fetch_datesandtimes.php">click here for test</a>
</body>

</html>