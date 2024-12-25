<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SweetAlert Example</title>
    <!-- Include SweetAlert CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10">
</head>
<body>

<button onclick="showSweetAlert()">Show SweetAlert</button>

<!-- Include SweetAlert JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script>
    function showSweetAlert() 
    {
        Swal.fire({
            title: 'Hello!',
            text: 'This is a SweetAlert example.',
            icon: 'success', // success, error, warning, info, question
            confirmButtonText: 'OK'
        });
    }
</script>

</body>
</html>
