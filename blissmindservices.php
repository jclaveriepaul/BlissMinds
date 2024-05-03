<?
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Booking</title>
</head>

<body>

    <h1>Book an online appointment</h1>
    <p>Fill in the form below to book an online appointment with us.</p>
    <div class="services">
        <h2>Our Services</h2>
        <hr>
        <div class="service">
            <p>Peer Support Network</p>
            <p>1hr</p>
            <a class="book-now-btn" href="pickapptdandt.php">Book Now</a>
        </div>
        <hr>
        <div class="service">
            <p>Individual Therapy</p>
            <p>1hr</p>
            <a class="book-now-btn" href="pickapptdandt.php">Book Now</a>
        </div>
        <hr>
        <div class="service">
            <p>Virtual Consultation</p>
            <p>1hr</p>
            <a class="book-now-btn" href="pickapptdandt.php">Book Now</a>
        </div>
        <hr>
        <div class="service">
            <p>Relaxation Techniques</p>
            <p>1hr</p>
            <a class="book-now-btn" href="pickapptdandt.php">Book Now</a>
        </div>
        <hr>
    </div>
    <script>
        document.querySelectorAll('.book-now-btn').forEach(function (button) {
            button.addEventListener('click', function (event) {
                event.preventDefault(); // prevent the default action (redirect)
                var service = this.parentElement.querySelector('p').textContent;
                var url = this.getAttribute('href');

                fetch('store_service.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: 'service=' + encodeURIComponent(service) + '&appointmenttype=' + encodeURIComponent(service),
                })
                    .then(function () {
                        window.location.href = url;
                    });
            });
        });
    </script>
</body>

</html>