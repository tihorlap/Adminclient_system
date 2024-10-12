<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dasos Company</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: white;
            color: #4A00E0;
        }

        .navbar {
            background-color: #4A00E0;
        }

        .navbar-brand {
            font-size: 24px;
            font-weight: bold;
            color: white;
        }

        .navbar-nav .nav-link {
            color: white;
            font-weight: 500;
        }

        .search-bar input {
            border-radius: 30px;
            padding: 10px;
            width: 100%;
            border: none;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .main-content {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 80vh;
            text-align: center;
        }

        .main-content h1 {
            font-size: 48px;
            color: #4A00E0;
            margin-bottom: 20px;
        }

        .main-content p {
            font-size: 18px;
            color: #4A00E0;
        }

        .search-container {
            width: 100%;
        }

        .search-container input {
            width: 60%;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <!-- Company Name on Left -->
            <a class="navbar-brand" href="#">DASOS COMPANY</a>

            <!-- Middle Search Bar -->
            <div class="search-container mx-auto">
                <input type="text" class="form-control" placeholder="Search...">
            </div>

            <!-- Right Side Links -->
            <div class="collapse navbar-collapse justify-content-end">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">Register</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="main-content">
        <h1>Welcome to Dasos Company</h1>
        <p>Leading Software Services for Your Business</p>
    </main>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
