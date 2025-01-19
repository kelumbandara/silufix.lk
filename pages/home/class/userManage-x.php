<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "user_management";

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["deleteId"])) {
        // Process form data and delete a user
        $deleteId = $_POST["deleteId"];

        $stmt = $conn->prepare("DELETE FROM user_table WHERE ID = ?");
        $stmt->bind_param("i", $deleteId);

        if ($stmt->execute()) {
            echo "User deleted successfully";
        } else {
            echo "Error deleting user: " . $stmt->error;
        }

        $stmt->close();
    } else {
        // Process form data and insert or update a user
        $epf = $_POST["epf"];
        $name = $_POST["name"];
        $age = $_POST["age"];
        $contact = $_POST["contact"];

        if (!empty($_POST["id"])) {
            // Update existing user if ID is provided
            $updateId = $_POST["id"];
            $stmt = $conn->prepare("UPDATE user_table SET EPF = ?, Name = ?, Age = ?, Contact = ? WHERE ID = ?");
            $stmt->bind_param("ssisi", $epf, $name, $age, $contact, $updateId);
        } else {
            // Insert new user if ID is not provided
            $stmt = $conn->prepare("INSERT INTO user_table (EPF, Name, Age, Contact) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssis", $epf, $name, $age, $contact);
        }

        if ($stmt->execute()) {
            echo "User added/updated successfully";
        } else {
            echo "Error adding/updating user: " . $stmt->error;
        }

        $stmt->close();
    }
} elseif ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["editId"])) {
    // Fetch user details for editing
    $editId = $_GET["editId"];

    $result = $conn->query("SELECT * FROM user_table WHERE ID = $editId");
    if ($result->num_rows == 1) {
        $userDetails = $result->fetch_assoc();
        echo json_encode($userDetails);
    } else {
        echo "User not found for editing";
    }
} else {
    // Display Users Table
    $result = $conn->query("SELECT * FROM user_table");
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["ID"] . "</td>";
            echo "<td>" . $row["EPF"] . "</td>";
            echo "<td>" . $row["Name"] . "</td>";
            echo "<td>" . $row["Age"] . "</td>";
            echo "<td>" . $row["Contact"] . "</td>";
            echo "<td><button class='btn btn-warning btn-sm' onclick='editUser(" . $row["ID"] . ")'>Edit</button> <button class='btn btn-danger btn-sm' onclick='deleteUser(" . $row["ID"] . ")'>Delete</button></td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='6'>No users found</td></tr>";
    }
}

// Close the database connection
$conn->close();
?>
