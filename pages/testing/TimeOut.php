<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Inactivity Logout</title>
</head>
<body>
    <h1>User Inactivity Logout</h1>
    <p>This page will automatically log you out after a period of inactivity.</p>
    <button onclick="resetTimer()">Reset Timer</button>

    <script>
        // Set the timeout period in milliseconds (e.g., 10 minutes)
        const timeoutPeriod = 6 * 1000; // 10 minutes
        let logoutTimer;
        function startLogoutTimer() {
            logoutTimer = setTimeout(logout, timeoutPeriod);
        }
        function resetTimer() {
            clearTimeout(logoutTimer);
            startLogoutTimer();
        }
        function logout() {
            // Perform logout actions here, such as redirecting to logout page
            alert('You have been logged out due to inactivity.');
            window.location.href = 'logout.php'; // Replace 'logout.php' with your logout endpoint
        }

        // Start the logout timer when the page loads
        document.addEventListener('DOMContentLoaded', startLogoutTimer);

        // Reset the timer whenever there is user activity
        document.addEventListener('mousemove', resetTimer);
        document.addEventListener('keydown', resetTimer);
        document.addEventListener('click', resetTimer);
        // Add more events if needed, like touch events for touch devices
    </script>
</body>
</html>
