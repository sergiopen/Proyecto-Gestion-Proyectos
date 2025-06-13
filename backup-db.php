<?php
$dbHost = 'localhost';
$dbUser = 'root';
$dbPass = '';
$dbName = 'bd_gestion';

$conn = new mysqli($dbHost, $dbUser, $dbPass, $dbName);
if ($conn->connect_error) {
    die('Error conexión BD: ' . $conn->connect_error);
}
$conn->set_charset('utf8mb4');

$tables = [];
$result = $conn->query("SHOW TABLES");
while ($row = $result->fetch_array()) {
    $tables[] = $row[0];
}

$sqlDump = "-- Backup database: {$dbName}\n-- Fecha: " . date('Y-m-d H:i:s') . "\n\n";

foreach ($tables as $table) {
    $res = $conn->query("SHOW CREATE TABLE `$table`");
    $row = $res->fetch_assoc();
    $sqlDump .= "DROP TABLE IF EXISTS `$table`;\n";
    $sqlDump .= $row['Create Table'] . ";\n\n";

    $result = $conn->query("SELECT * FROM `$table`");
    while ($row = $result->fetch_assoc()) {
        $vals = array_map(function($val) use ($conn) {
            if (is_null($val)) return "NULL";
            return "'" . $conn->real_escape_string($val) . "'";
        }, array_values($row));
        $sqlDump .= "INSERT INTO `$table` VALUES(" . implode(", ", $vals) . ");\n";
    }
    $sqlDump .= "\n\n";
}

$filename = 'backup_' . date('Ymd_His') . '.sql';

header('Content-Type: application/sql');
header('Content-Disposition: attachment; filename="' . $filename . '"');
header('Content-Length: ' . strlen($sqlDump));
header('Cache-Control: no-cache, no-store, must-revalidate');
header('Pragma: no-cache');
header('Expires: 0');

echo $sqlDump;
exit;
