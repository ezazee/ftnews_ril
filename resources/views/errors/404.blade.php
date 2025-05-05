<!-- resources/views/error/404.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Not Found</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        /* Reset default margin and padding */
        body, html {
            margin: 0;
            padding: 0;
            height: 100%;
            font-family: 'Poppins', sans-serif;
            background-color: #f9f9f9;
        }

        /* Center all elements using Flexbox */
        #wrapper {
            display: flex;
            justify-content: center; /* Horizontal center */
            align-items: center; /* Vertical center */
            height: 100vh; /* Full viewport height */
        }

        .error-section {
            text-align: center;
        }

        .h1 {
            font-size: 80px;
            font-weight: 600;
            color: #206bc4;
        }

        .h6 {
            font-size: 18px;
            color: #666;
            margin-bottom: 20px;
        }

        .btn-primary {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            color: #fff;
            background-color: #206bc4;
            text-decoration: none;
            border-radius: 5px;
        }

        .btn-primary:hover {
            background-color: #206bc4;
        }
    </style>
</head>
<body>
    <div id="wrapper">
        <!-- Error Section -->
        <section class="error-section">
            <div class="container max-w-lg">
                <div class="error-container">
                    <div>
                        <!-- Cute SVG Illustration -->
                        <img src="{{ asset('frontend/images/404_ftnews_2.gif') }}" alt="" width="500" height="350">
                    </div>
                    <div>
                        <a href="{{ url('/') }}" class="btn btn-primary mt-3">Kembali ke Beranda</a>
                    </div>
                </div>
            </div>
        </section>
    </div>
</body>
</html>
