<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tesdb";

$conn = new mysqli($servername, $username, $password, $dbname);

// konek db
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// parameter pencarian
$search = isset($_GET['search']) ? $_GET['search'] : '';

// Query ke database
$sql = "SELECT hobi, COUNT(DISTINCT person_id) AS jumlah_person
        FROM hobi
        WHERE hobi LIKE ?
        GROUP BY hobi
        ORDER BY jumlah_person DESC";
$stmt = $conn->prepare($sql);
$search_param = "%" . $search . "%";
$stmt->bind_param("s", $search_param);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Hobi</title>
</head>
<body>
    <h1>Laporan Hobi</h1>
    <form method="GET" action="">
        <label for="search">Search by Hobi:</label>
        <input type="text" id="search" name="search" value="<?php echo htmlspecialchars($search); ?>">
        <button type="submit">Search</button>
    </form>

    <table border="1">
        <thead>
            <tr>
                <th>Hobi</th>
                <th>Jumlah Person</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['hobi']); ?></td>
                        <td><?php echo htmlspecialchars($row['jumlah_person']); ?></td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="2">No results found</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>

<?php
// Tutup koneksi
$conn->close();
?>
