
<?php 
include 'config/db.php';
$filters = [];
$sql = "SELECT * FROM products WHERE 1=1";

if (isset($_GET['color'])) {
    $colors = $_GET['color'];
    $placeholders = implode(',', array_fill(0, count($colors), '?'));
    $sql .= " AND Color IN ($placeholders)";
    $filters = array_merge($filters, $colors);
}

if (isset($_GET['category'])) {
    $categories = $_GET['category'];
    $placeholders = implode(',', array_fill(0, count($categories), '?'));
    $sql .= " AND Category IN ($placeholders)";
    $filters = array_merge($filters, $categories);
}

if (isset($_GET['size'])) {
    $sizes = $_GET['size'];
    $placeholders = implode(',', array_fill(0, count($sizes), '?'));
    $sql .= " AND Size IN ($placeholders)";
    $filters = array_merge($filters, $sizes);
}

if (isset($_GET['brand'])) {
    $brands = $_GET['brand'];
    $placeholders = implode(',', array_fill(0, count($brands), '?'));
    $sql .= " AND Brand IN ($placeholders)";
    $filters = array_merge($filters, $brands);
}

$stmt = $conn->prepare($sql);

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($results) {
    foreach ($results as $row) {
        echo "Product: " . $row['ProductName'] . "<br>";
        echo "Color: " . $row['Color'] . "<br>";
        echo "Category: " . $row['Category'] . "<br>";
        echo "Size: " . $row['Size'] . "<br>";
        echo "Brand: " . $row['Brand'] . "<br><br>";
    }
} else {
    echo "No results found.";
}
?>