<?php
include "koneksi.php";

$tables = '*'; //semua tabel

if ($tables == '*') {
    $tables = array();
    $result = mysqli_query($con, 'SHOW TABLES');
    while ($row = mysqli_fetch_row($result)) {
        $tables[] = $row[0];
    }
} else {
    $tables = is_array($tables) ? $tables : explode(',', $tables);
}

$return = "SET FOREIGN_KEY_CHECKS = 0;\n\n";
foreach ($tables as $table) {
    $result = mysqli_query($con, 'SELECT * FROM ' . $table);
    $num_fields = mysqli_num_fields($result);

    $return .= 'DROP TABLE ' . $table . ';';
    $row2 = mysqli_fetch_row(mysqli_query($con, 'SHOW CREATE TABLE ' . $table));
    $return .= "\n\n" . $row2[1] . ";\n\n";

    for ($i = 0; $i < $num_fields; $i++) {
        while ($row = mysqli_fetch_row($result)) {
            $return .= 'INSERT INTO ' . $table . ' VALUES(';
            for ($j = 0; $j < $num_fields; $j++) {
                $row[$j] = addslashes($row[$j]);
                $row[$j] = str_replace("\n", "\\n", $row[$j]);
                if (isset($row[$j])) {
                    $return .= '"' . $row[$j] . '"';
                } else {
                    $return .= '""';
                }
                if ($j < ($num_fields - 1)) {
                    $return .= ',';
                }
            }
            $return .= ");\n";
        }
    }
    $return .= "\n\n\n";
}
$return .= "SET FOREIGN_KEY_CHECKS = 1;";

$tgl = date("dmy");
$file_name = 'db-backup-' . $tgl . '-' . time() . '.sql';

$handle = fopen(__DIR__ . '/backup/' . $file_name, 'w');
fwrite($handle, $return);
fclose($handle);

header('Content-Description: File Transfer');
header('Content-Disposition: attachment; filename=' . basename(__DIR__ . '/backup/' . $file_name));
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
header('Content-Length: ' . filesize(__DIR__ . '/backup/' . $file_name));
header("Content-Type: text/plain");
readfile(__DIR__ . '/backup/' . $file_name);
