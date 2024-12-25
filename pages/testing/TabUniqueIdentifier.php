<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Unique Tab Identifier</title>
</head>
<body>

<script>
// Check if the unique identifier is already stored in localStorage
let tabId = localStorage.getItem('tabId');

// If not, generate a new one and store it
if (!tabId) {
    tabId = generateUniqueId();
    localStorage.setItem('tabId', tabId);
}

// Function to generate a unique identifier
function generateUniqueId() {
    // Generate a random string or use any other method to create a unique identifier
    return 'tab_' + Math.random().toString(36).substr(2, 9);
}

// Use the tabId as needed in your application
console.log('Tab ID:', tabId);
alert(tabId);
</script>

</body>
</html>
