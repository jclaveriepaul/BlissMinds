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
    <div id="datepicker"></div>
</body>
</html>