<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Colorful Datetime Picker</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">

    <!-- FontAwesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <!-- Moment.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

    <!-- Bootstrap-datetimepicker CSS and JS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css">
</head>
<body>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-6">
            <label for="colorfulDatetimePicker">Pick a Date and Time:</label>
            <div class="input-group date" id="colorfulDatetimePicker" data-target-input="nearest">
                <input type="text" class="form-control datetimepicker-input" data-target="#colorfulDatetimePicker" />
                <div class="input-group-append" data-target="#colorfulDatetimePicker" data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="fas fa-calendar"></i></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS and Popper.js -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

<!-- Bootstrap-datetimepicker JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>

<script>
    $(function () {
        $('#colorfulDatetimePicker').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            // Add any additional options or customization here
        });
    });
</script>

</body>
</html>
