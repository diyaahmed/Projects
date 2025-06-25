<?php
// Connect to MySQL database on XAMPP
$conn = new mysqli("localhost", "root", "", "customplaylist");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// CRUD Operations

// CREATE
if (isset($_POST['add_user'])) {
    $name = $_POST['name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password']; // Add hashing for security

    $stmt = $conn->prepare("INSERT INTO users (name, username, email, password) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $username, $email, $password);
    $stmt->execute();
    $stmt->close();
}

if (isset($_POST['add_playlist'])) {
    $playlist_name = $_POST['playlist_name'];
    $user_id = $_POST['user_id'];

    $stmt = $conn->prepare("INSERT INTO playlists (name, user_id) VALUES (?, ?)");
    $stmt->bind_param("si", $playlist_name, $user_id);
    $stmt->execute();
    $stmt->close();
}

// UPDATE
if (isset($_POST['update_user'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $username = $_POST['username'];
    $email = $_POST['email'];

    $stmt = $conn->prepare("UPDATE users SET name = ?, username = ?, email = ? WHERE id = ?");
    $stmt->bind_param("sssi", $name, $username, $email, $id);
    $stmt->execute();
    $stmt->close();
}

if (isset($_POST['update_playlist'])) {
    $id = $_POST['id'];
    $playlist_name = $_POST['playlist_name'];

    $stmt = $conn->prepare("UPDATE playlists SET name = ? WHERE id = ?");
    $stmt->bind_param("si", $playlist_name, $id);
    $stmt->execute();
    $stmt->close();
}

// DELETE
if (isset($_GET['delete_user'])) {
    $id = $_GET['delete_user'];
    $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
}

if (isset($_GET['delete_playlist'])) {
    $id = $_GET['delete_playlist'];
    $stmt = $conn->prepare("DELETE FROM playlists WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
}

// Get all users
$users = $conn->query("SELECT * FROM users");

// Get all playlists
$playlists = $conn->query("SELECT p.id, p.name AS playlist_name, u.username FROM playlists p
                           JOIN users u ON p.user_id = u.id");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard - Mixtape</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #1c1c3c;
            color: #fff;
            padding: 20px;
        }
        h1 {
            color: #ffcc00;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background: #2e2e4d;
            margin-bottom: 40px;
        }
        th, td {
            border: 1px solid #444;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #3e3e5e;
        }
    </style>
</head>
<body>
    <h1>Admin Dashboard</h1>

    <h2>Users</h2>
    <table class="table table-dark">
        <tr><th>ID</th><th>Name</th><th>Username</th><th>Email</th><th>Actions</th></tr>
        <?php while ($row = $users->fetch_assoc()): ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['name'] ?></td>
            <td><?= $row['username'] ?></td>
            <td><?= $row['email'] ?></td>
            <td>
                <a href="?delete_user=<?= $row['id'] ?>" class="btn btn-danger">Delete</a> |
                <a href="update_user_form.php?id=<?= $row['id'] ?>" class="btn btn-primary">Edit</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>

    <h2>Add User</h2>
    <form method="POST" class="form-inline">
        <input type="text" name="name" class="form-control" placeholder="Name" required>
        <input type="text" name="username" class="form-control" placeholder="Username" required>
        <input type="email" name="email" class="form-control" placeholder="Email" required>
        <input type="password" name="password" class="form-control" placeholder="Password" required>
        <button type="submit" name="add_user" class="btn btn-success">Add User</button>
    </form>

    <h2>Playlists</h2>
    <table class="table table-dark">
        <tr><th>ID</th><th>Playlist Name</th><th>Owner</th><th>Actions</th></tr>
        <?php while ($row = $playlists->fetch_assoc()): ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['playlist_name'] ?></td>
            <td><?= $row['username'] ?></td>
            <td>
                <a href="?delete_playlist=<?= $row['id'] ?>" class="btn btn-danger">Delete</a> |
                <a href="update_playlist_form.php?id=<?= $row['id'] ?>" class="btn btn-primary">Edit</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>

    <h2>Add Playlist</h2>
    <form method="POST" class="form-inline">
        <input type="text" name="playlist_name" class="form-control" placeholder="Playlist Name" required>
        <select name="user_id" class="form-control" required>
            <?php
            $users = $conn->query("SELECT * FROM users");
            while ($user = $users->fetch_assoc()) {
                echo "<option value='{$user['id']}'>{$user['username']}</option>";
            }
            ?>
        </select>
        <button type="submit" name="add_playlist" class="btn btn-success">Add Playlist</button>
    </form>
</body>
</html>
