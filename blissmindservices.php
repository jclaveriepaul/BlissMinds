<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking</title>
    <style>
        body {
            background-color: #FFF0EC;
        }

        h1 {
            color: #000;
            /* Dark text for the main heading */
        }

        h2 {
            font-size: larger;
            font-weight: bold;
            /* Larger and bold font for the 'Our Services' heading */
        }

        .book-now-btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #008080;
            color: #fff;
            text-decoration: none;
        }

        .services {
            display: flex;
            justify-content: center;
            flex-direction: column;
            align-items: center;
            align-content: center;
        }

        .service {
            display: flex;
            justify-content: space-between;
            width: 50%;
        }
    </style>
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
            <a class="book-now-btn" href="pspbook.php">Book Now</a>
        </div>
        <hr>
        <div class="service">
            <p>Individual Therapy</p>
            <p>1hr</p>
            <a class="book-now-btn" href="itbook.php">Book Now</a>
        </div>
        <hr>
        <div class="service">
            <p>Virtual Consultation</p>
            <p>1hr</p>
            <a class="book-now-btn" href="vcbook.php">Book Now</a>
        </div>
        <hr>
        <div class="service">
            <p>Relaxation Techniques</p>
            <p>1hr</p>
            <a class="book-now-btn" href="rtbook.php">Book Now</a>
        </div>
        <hr>
    </div>
    <script>
    document.querySelectorAll('.book-now-btn').forEach(function(button) {
        button.addEventListener('click', function() {
            var service = this.previousElementSibling.previousElementSibling.textContent;
            var url = this.dataset.url;

            fetch('store_service.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'service=' + encodeURIComponent(service),
            })
            .then(function() {
                window.location.href = url;
            });
        });
    });
</script>
</body>

</html>