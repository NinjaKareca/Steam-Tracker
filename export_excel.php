<?php
require 'db.php';
require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$stmt = $pdo->query("SELECT * FROM games");
$games = $stmt->fetchAll();

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->fromArray(['Nome', 'Gênero', 'Preço', 'Tempo para terminar', 'Tempo total', 'Custo por hora'], NULL, 'A1');

$row = 2;
foreach ($games as $g) {
    $cph = $g['time_to_finish'] > 0 ? $g['price'] / $g['time_to_finish'] : 0;
    $sheet->fromArray([
        $g['name'], $g['genre'], $g['price'], $g['time_to_finish'], $g['total_playtime'], round($cph, 2)
    ], NULL, "A{$row}");
    $row++;
}

$writer = new Xlsx($spreadsheet);
$filename = 'steam_library_' . date('Ymd_His') . '.xlsx';
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header("Content-Disposition: attachment; filename="$filename"");
$writer->save('php://output');
exit;