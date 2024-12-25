<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tab Example</title>
</head>
<body>
    <h1>Tab Example</h1>
    <button onclick="setTabIdentifier('1')">Set Tab 1 Identifier</button>
    <button onclick="setTabIdentifier('2')">Set Tab 2 Identifier</button>
    <button onclick="getTabIdentifier()">Get Tab Identifier</button>
    
    <script>
        // Function to set the tab identifier in local storage
        function setTabIdentifier(tabId) {
            localStorage.setItem('tab', tabId);
            alert('Tab identifier set to ' + tabId);
        }

        // Function to get the tab identifier from local storage
        function getTabIdentifier() {
            const tabId = localStorage.getItem('tab');
            if (tabId) {
                alert('Tab identifier: ' + tabId);
            } else {
                alert('Tab identifier not set');
            }
        }
    </script>
</body>
</html>
