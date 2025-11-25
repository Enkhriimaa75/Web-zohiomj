<?php
require_once 'db_connect.php';

echo "<h1>Database Test</h1>";
echo "<p>Testing connection and data...</p>";

try {
    $stmt = $conn->query("SELECT id, name, origin, size FROM breeds ORDER BY name ASC LIMIT 10");
    $breeds = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo "<h2>Found " . count($breeds) . " breeds</h2>";
    echo "<table border='1' style='border-collapse: collapse; width: 100%;'>";
    echo "<tr style='background: #9b59b6; color: white;'>";
    echo "<th style='padding: 10px;'>ID</th>";
    echo "<th style='padding: 10px;'>NAME</th>";
    echo "<th style='padding: 10px;'>ORIGIN</th>";
    echo "<th style='padding: 10px;'>SIZE</th>";
    echo "</tr>";
    
    foreach ($breeds as $breed) {
        echo "<tr>";
        echo "<td style='padding: 10px; border: 1px solid black;'>" . $breed['id'] . "</td>";
        echo "<td style='padding: 10px; border: 1px solid black; font-weight: bold;'>" . htmlspecialchars($breed['name']) . "</td>";
        echo "<td style='padding: 10px; border: 1px solid black;'>" . htmlspecialchars($breed['origin']) . "</td>";
        echo "<td style='padding: 10px; border: 1px solid black;'>" . htmlspecialchars($breed['size']) . "</td>";
        echo "</tr>";
    }
    echo "</table>";
    
    echo "<hr>";
    echo "<h3>Raw Data Check:</h3>";
    echo "<pre>";
    print_r($breeds);
    echo "</pre>";
    
} catch(PDOException $e) {
    echo "<p style='color: red;'>ERROR: " . $e->getMessage() . "</p>";
}
?>
