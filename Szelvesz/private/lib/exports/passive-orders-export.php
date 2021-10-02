<?php

require_once 'private/lib/config.php';
require_once 'private/lib/database.php';

$data = db_fetchall('SELECT order_id, username, car_id, order_date, arrived_at FROM orders WHERE is_arrived = 1');
exportCSV($data);

function exportCSV(array $array){

    header('Content-Encoding: UTF-8');
    header(header: 'Content-Type: application/csv; charset=UTF-8');
    header(header: 'Content-Disposition: attachment; filename="activeOrders.csv"');
    echo "\xEF\xBB\xBF"; // UTF-8 BOM

    $fields = array_keys($array[0]);
    $f = fopen(filename:'php://output', mode:'w');
    fputcsv(stream:$f, fields:$fields, separator: ';');
    foreach ($array as $line) {
        fputcsv(stream:$f, fields:$line, separator: ';');

    }
}
