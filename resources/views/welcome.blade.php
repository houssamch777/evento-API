<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Evento - Coming Soon</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(to right, #5c5edc, #e66e97);
            color: white;
            text-align: center;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            flex-direction: column;
        }
        h1 {
            font-size: 4rem;
            margin-bottom: 1rem;
        }
        .timer {
            font-size: 2rem;
            margin-bottom: 1rem;
        }
        .social-icons a {
            color: white;
            font-size: 1.5rem;
            margin: 0 10px;
        }
        .footer {
            margin-top: 2rem;
            font-size: 0.875rem;
        }
        .progress-container {
            width: 80%;
            margin: 1.5rem auto;
        }
        .progress-bar {
            width: 0;
            height: 10px;
            background-color: #fff;
        }
        @media (min-width: 768px) {
            h1 {
                font-size: 6rem;
            }
            .timer {
                font-size: 2.5rem;
            }
        }
    </style>
</head>
<body>
    <div>
        <img src="{{asset('logo/1.png')}}" alt="Evento Logo" width="300">
        <h2>Something Awesome is Coming</h2>
        <p>Keep waiting to get more awesome things</p>
        
        <div class="timer" id="timer">
            <span id="days">00</span> Days
            <span id="hours">00</span> Hours
            <span id="minutes">00</span> Minutes
            <span id="seconds">00</span> Seconds
        </div>

        <div class="progress-container">
            <div class="progress">
                <div class="progress-bar" id="progress-bar"></div>
            </div>
        </div>

        <div class="social-icons">
            <a href="#"><i class="bi bi-facebook"></i></a>
            <a href="#"><i class="bi bi-twitter"></i></a>
            <a href="#"><i class="bi bi-linkedin"></i></a>
        </div>
        <div class="footer">
            <p>Copyright ©2024 Eventen. All Rights Reserved</p>
        </div>
    </div>

    <script>
        // Set the launch date
        const launchDate = new Date('October 7, 2024 00:00:00').getTime();

        // Update the countdown every 1 second
        const countdown = setInterval(() => {
            const now = new Date().getTime();
            const distance = launchDate - now;

            const days = Math.floor(distance / (1000 * 60 * 60 * 24));
            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);

            document.getElementById('days').textContent = days.toString().padStart(2, '0');
            document.getElementById('hours').textContent = hours.toString().padStart(2, '0');
            document.getElementById('minutes').textContent = minutes.toString().padStart(2, '0');
            document.getElementById('seconds').textContent = seconds.toString().padStart(2, '0');

            // Calculate the progress
            const totalDuration = launchDate - new Date('August 29, 2024 00:00:00').getTime();
            const progress = (totalDuration - distance) / totalDuration * 100;
            document.getElementById('progress-bar').style.width = `${progress}%`;

            // If the countdown is finished
            if (distance < 0) {
                clearInterval(countdown);
                document.getElementById('timer').textContent = "Launched!";
                document.getElementById('progress-bar').style.width = '100%';
            }
        }, 1000);
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
