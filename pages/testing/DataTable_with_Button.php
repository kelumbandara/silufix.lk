<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DataTables Example</title>
    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- DataTables JS -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
</head>
<body>

<table id="example" class="display" style="width:100%">
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>John Doe</td>
            <td>john@example.com</td>
            <td><button class="btn" onclick="showAlert(this)">Click me</button></td>
        </tr>
        <tr>
            <td>Jane Doe</td>
            <td>jane@example.com</td>
            <td><button class="btn" onclick="showAlert(this)">Click me</button></td>
        </tr>
        <!-- Add more rows as needed -->
    </tbody>
</table>

<script>
$(document).ready(function() {
    // DataTable initialization
    $('#example').DataTable();
});

function showAlert(button) {
    // Get the DataTable row containing the clicked button
    var row = $(button).closest('tr');

    // Get the data from the second cell in the row (index 1)
    var email = row.find('td:eq(1)').text();

    // Display an alert with the email from the row
    alert('Email: ' + email);
}
</script>

</body>
</html>
