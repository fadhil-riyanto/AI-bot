<?php
function downloadUrlToFile($url, $outFileName)
{
    if (is_file($url)) {
        copy($url, $outFileName);
    } else {
        $options = array(
            CURLOPT_FILE    => fopen($outFileName, 'w'),
            CURLOPT_TIMEOUT =>  28800, // set this to 8 hours so we dont timeout on big files
            CURLOPT_URL     => $url
        );

        $ch = curl_init();
        curl_setopt_array($ch, $options);
        curl_exec($ch);
        curl_close($ch);
    }
}


$result = $telegram->getData();
$fileid = $result['message']['reply_to_message']['document']['file_id'];

if (isset($fileid)) {
    $getinfoDir = $telegram->getFile($fileid);
    $dirTgid = $getinfoDir['result']['file_path'];
    $downloadingimg = downloadUrlToFile('https://api.telegram.org/file/bot' . TG_HTTP_API . '/' . $dirTgid, 'tmp/data_xslx_to_json.xlsx');

    // $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xlsx');
    // $reader->setReadDataOnly(TRUE);

    // // setting nama file yg akan dibaca
    // $spreadsheet = $reader->load("tmp/data_xslx_to_json.xlsx");

    // // data worksheet yg akan dibaca ada di active sheet
    // $worksheet = $spreadsheet->getActiveSheet();

    // // mendapatkan maks nomor baris data
    // $highestRow = $worksheet->getHighestRow();
    // // mendapatkan maks kolom data
    // $highestColumn = $worksheet->getHighestColumn();

    // // mendapatkan nama-nama kolom data 
    // // membaca value yang ada di cell: A1, B1, ..., E1
    // // dan simpan ke dalam array $colsName
    // $colsName = array();
    // for ($col = 'A'; $col <= $highestColumn; $col++) {
    //     $colsName[] =  $worksheet->getCell($col . 1)->getValue();
    // }

    // // inisialisasi array untuk menampung semua data
    // $dataAll = array();

    // // proses membaca data baris-perbaris 
    // // dimulai dari baris ke-2, karena baris ke-1 berisi nama kolom tabel

    // for ($row = 2; $row <= $highestRow; $row++) {
    //     // inisialisasi array untuk data perbaris
    //     $dataRow = array();

    //     $i = 0;
    //     // untuk setiap baris data, baca value tiap kolom cell
    //     // misal untuk baris ke-2, cell yang dibaca: A2, B2, ..., E2
    //     // misal untuk baris ke-3, cell yang dibaca: A3, B3, ..., E3
    //     // dst ...
    //     for ($col = 'A'; $col <= $highestColumn; $col++) {
    //         // setiap value digabung menjadi satu
    //         // dan tambahkan ke array $dataRow
    //         $dataRow += array($colsName[$i] => $worksheet->getCell($col . $row)->getValue());
    //         $i++;
    //     }
    //     // setelah didapat data array perbaris
    //     // tambahkan ke $dataAll 
    //     $dataAll[] = $dataRow;
    // }
    require __DIR__ . '/../include/simple_excel.php';
    if ($xlsx = SimpleXLSX::parse('tmp/data_xslx_to_json.xlsx')) {
        $dataAll = json_encode($xlsx->rows());
    } else {
        $reply = SimpleXLSX::parseError();
        $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
        $telegram->sendMessage($content);
    }

    file_put_contents('tmp/xlsx_to_json.json', $dataAll);

    $bot_url    = "https://api.telegram.org/bot" . TG_HTTP_API . "/";
    $url        = $bot_url . "sendDocument?chat_id=" . $chat_id;

    $post_fields = array(
        'chat_id'   => $chat_id,
        'reply_to_message_id' => $message_id,
        'document'     => new CURLFile(realpath('tmp/xlsx_to_json.json'))
    );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        "Content-Type:multipart/form-data"
    ));
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields);
    $output = curl_exec($ch);


    // convert ke json lalu tampilkan

} else {
    $reply = 'Hai ' . $username . ', untuk menggunakan xlsx_to_json. anda harus mereply file xlsx dengan command /xlsx_to_json';
    $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
    $telegram->sendMessage($content);
}
