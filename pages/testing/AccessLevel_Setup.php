<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
  <title>Access Level Settings</title>
</head>
<body>

<div class="container mt-5">
  <h2>Access Level Settings</h2>
  <table id="accessTable" class="table table-striped table-bordered">
    <thead>
      <tr>
        <th>Item</th>
        <th>Access Level</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>Chart</td>
        <td><input type="checkbox" class="item-checkbox" data-item="chart"></td>
      </tr>
      <tr>
        <td>Report</td>
        <td><input type="checkbox" class="item-checkbox" data-item="report"></td>
      </tr>
      <tr>
        <td>Create User</td>
        <td><input type="checkbox" class="item-checkbox" data-item="create_user"></td>
      </tr>
      <tr>
        <td>Edit User</td>
        <td><input type="checkbox" class="item-checkbox" data-item="edit_user"></td>
      </tr>
      <!-- Add more items as needed -->
    </tbody>
  </table>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
  $(document).ready(function() {
    // Initialize DataTable
    var table = $('#accessTable').DataTable();

    // Handle checkbox changes
    $('#accessTable tbody').on('change', '.item-checkbox', function() {
      var item = $(this).data('item');
      var checked = $(this).prop('checked');

      // Handle the logic for saving the access level (send to server, update database, etc.)
      console.log('Item:', item, 'Access Level:', checked ? 'Enabled' : 'Disabled');
    });
  });
</script>

</body>
</html>
