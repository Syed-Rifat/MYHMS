
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Profile</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" rel="stylesheet">

    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="style.css">
</head>
<style>
    body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
}

header {
    background-color: #333;
    color: white;
    padding: 1rem;
}

header h1 {
    margin: 0;
    margin-left: 200px;
}

header p {
    margin: 0;
    padding: 0;
    margin-left: 200px;
}

footer {
    background-color: #333;
    color: white;
    padding: 1rem;
}

footer p {
    margin: 0;
    padding: 0;
    margin-left: 200px;
}

nav {
    background-color: #444;
    color: white;
    position: fixed;
    top: 0;
    left: 0;
    width: 200px;
    height: 100%;
    overflow-y: auto;
}

nav #nav-wrapper {
    height: 100%;
}

nav #nav-list {
    list-style: none;
    margin: 0;
    padding: 0;
    display: flex;
    flex-direction: column;
}

nav li {
    margin-top: 1rem;
}

nav a {
    color: white;
    text-decoration: none;
    padding: 0.5rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

nav a:hover {
    background-color: white;
    color: #333;
}

main {
    padding: 2rem;
    margin-left: 200px;
}

/* Adding the active class to the Menu link */
nav a.active {
    background-color: #555;
    color: yellow;
}


</style>

<body>
    <header>
        <h1>Restaurant Management System</h1>
        <p>Welcome, Guest</p>
    </header>

    <nav>
        <div id="nav-wrapper">
            <ul id="nav-list">
                <li><a href="http://localhost/RMS/customerDashboard/index.php"><span class="material-icons">restaurant_menu</span>Menu</a></li>
                <li><a href="http://localhost/RMS/Reservations/index.php"><span class="material-icons">event_seat</span>Reservations</a></li>
                <li><a href="#"><span class="material-icons">local_offer</span>Specials</a></li>
                <li><a href="http://localhost/RMS/Reviews/index.php"><span class="material-icons">rate_review</span>Reviews</a></li>
                <li><a href="http://localhost/RMS/Booked Events/index.php"><span class="material-icons">event</span>Event Booking</a></li>
                <li><a href="#"><span class="material-icons">help</span>Support</a></li>
                <li><a href="http://localhost/RMS/customerProfile/index.php" class="active"><span class="material-icons">account_circle</span>Profile</a></li>
                <li><a href="http://localhost/RMS/customerLogout/index.php"><span class="material-icons">exit_to_app</span>Logout</a></li>
            </ul>
        </div>
    </nav>
    
    <footer>
        <p>&copy; 2024 Restaurant Management System. All rights reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>