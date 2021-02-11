<?php
require __DIR__ . '/../vendor/autoload.php';
$azanHilangcommand = str_replace($adanParse_plain[0], '', $text_plain);
$udahDiparse = str_replace($adanParse_plain[0] . ' ', '', $text_plain);
$udahDiparse_hash = str_replace($adanParse_plain[0] . ' ', '', $text_plain_nokarakter);
$sourceCodeexec = str_replace($adanParse_plain_nokarakter[0] . ' ' . $adanParse_plain_nokarakter[1] . ' ', null, $text_plain_nokarakter);

function langProgrammingindex($string)
{
    $string = strtolower($string);
    $dict = array(
        'c#' => '1',
        'csharp' => '1',
        'vb_net' => '2',
        'vb' => '2',
        'visual_basic_dotnet' => '2',
        'f#' => '3',
        'fsharp' => '3',
        'java' => '4',
        'python' => '5',
        'python2' => '5',
        'py2' => '5',
        'c_gcc' => '6',
        'c' => '6',
        'gcc' => '6',
        'cplusplus_gcc' => '7',
        'cplusplus' => '7',
        'g++' => '7',
        'c++' => '7',
        'cpp_gcc' => '7',
        'cpp' => '7',
        'php' => '8',
        'pascal' => '9',
        'pas' => '9',
        'fpc' => '9',
        'objective_c' => '10',
        'objective-c' => '10',
        'objc' => '10',
        'haskell' => '11',
        'ruby' => '12',
        'perl' => '13',
        'lua' => '14',
        'nasm' => '15',
        'sql_server' => '16',
        'javascript' => '17',
        'v8' => '17',
        'lisp' => '18',
        'prolog' => '19',
        'go' => '20',
        'golang' => '20',
        'scala' => '21',
        'scheme' => '22',
        'node_js' => '23',
        'node.js' => '23',
        'node' => '23',
        'js' => '23',
        'python_3' => '24',
        'python3' => '24',
        'py3' => '24',
        'octave' => '25',
        'c_clang' => '26',
        'clang' => '26',
        'c++_clang' => '27',
        'c++_vc++' => '28',
        'visual_cplusplus' => '28',
        'visual_cpp' => '28',
        'vc++' => '28',
        'msvc' => '28',
        'c_vc' => '29',
        'visual_c' => '29',
        'd' => '30',
        'r' => '31',
        'tcl' => '32',
        'mysql' => '33',
        'postgresql' => '34',
        'oracle' => '35',
        'swift' => '37',
        'bash' => '38',
        'ada' => '39',
        'erlang' => '40',
        'elixir' => '41',
        'ocaml' => '42',
        'kotlin' => '43',
        'brainfuck' => '44',
        'fortran' => '45',
        'rust' => '46',
        'clojure' => '47'
    );
    if (isset($dict[$string])) {
        return $dict[$string];
    } else {
        return false;
    }
}

if ($azanHilangcommand == null) {
    $reply = 'Hai ' . $username . PHP_EOL . 'Untuk menjalankan kode, anda harus memasukkan kode bahasa pemrograman. contoh :' . PHP_EOL .
        '<pre>/run php {source code kamu}</pre>' . PHP_EOL . PHP_EOL .
        'untuk melihat list bahasa pemrograman, kamu bisa tulis' . PHP_EOL .
        '<pre>/run list</pre>';
    $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
    $telegram->sendMessage($content);
} else {
    // $languangeProgrammingparse = explode(' ', $udahDiparse_hash);
    // $sourceCodetoexec = str_replace($languangeProgrammingparse[1] . ' ', '', $udahDiparse_hash);
    if (strtolower($adanParse_plain[1]) == 'list') {
        $reply = 'List bahasa pemrograman yang disupport' . PHP_EOL . PHP_EOL .
            'c#' . PHP_EOL .
            'vb_net' . PHP_EOL .
            'f#' . PHP_EOL .
            'java' . PHP_EOL .
            'python' . PHP_EOL .
            'c_gcc' . PHP_EOL .
            'c++_gcc' . PHP_EOL .
            'php' . PHP_EOL .
            'pascal' . PHP_EOL .
            'objective_c' . PHP_EOL .
            'haskell' . PHP_EOL .
            'ruby' . PHP_EOL .
            'perl' . PHP_EOL .
            'lua' . PHP_EOL .
            'nasm' . PHP_EOL .
            'sql_server' . PHP_EOL .
            'javascript' . PHP_EOL .
            'lisp' . PHP_EOL .
            'prolog' . PHP_EOL .
            'go' . PHP_EOL .
            'scala' . PHP_EOL .
            'scheme' . PHP_EOL .
            'node_js' . PHP_EOL .
            'python_3' . PHP_EOL .
            'octave' . PHP_EOL .
            'c_clang' . PHP_EOL .
            'c++_clang' . PHP_EOL .
            'c++_vc++' . PHP_EOL .
            'c_vc' . PHP_EOL .
            'd' . PHP_EOL .
            'r' . PHP_EOL .
            'tcl' . PHP_EOL .
            'mysql' . PHP_EOL .
            'postgresql' . PHP_EOL .
            'oracle' . PHP_EOL .
            'swift' . PHP_EOL .
            'bash' . PHP_EOL .
            'ada' . PHP_EOL .
            'erlang' . PHP_EOL .
            'elixir' . PHP_EOL .
            'ocaml' . PHP_EOL .
            'kotlin' . PHP_EOL .
            'brainfuck' . PHP_EOL .
            'fortran' . PHP_EOL .
            'rust' . PHP_EOL .
            'clojure' . PHP_EOL;
        $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
        $telegram->sendMessage($content);
    } else {
        $progralng = langProgrammingindex($adanParse_plain_nokarakter[1]);
        $compileArgs = json_decode(file_get_contents(__DIR__ . '/../json_data/rextester/compilerArgs.json'));
        if ($progralng === false) {
            $reply = 'ups, bahasa pemrograman tidak ditemukan, coba tulis <pre>/run list</pre>';
            $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
            $telegram->sendMessage($content);
        } else {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://rextester.com/rundotnet/api");
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt(
                $ch,
                CURLOPT_POSTFIELDS,
                "LanguageChoice=" . $progralng . "&Program=" . urlencode($sourceCodeexec) . "&Input=&CompilerArgs=" . $compileArgs->$progralng
            );
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $server_output_rextester = curl_exec($ch);
            $extractHasilRundotnetApi = json_decode($server_output_rextester);
            $warningProgram = $extractHasilRundotnetApi->Warnings;
            $errorProgram = $extractHasilRundotnetApi->Errors;
            $resultProgram = $extractHasilRundotnetApi->Result;
            if ($extractHasilRundotnetApi->Warnings == null) {
                $warningProgram = 'tidak ada warning';
            }
            if ($extractHasilRundotnetApi->Errors == null) {
                $errorProgram = 'tidak ada error';
            }
            if ($extractHasilRundotnetApi->Result == null) {
                $resultProgram = 'kosong';
            }
            $reply = 'Warning : ' . $warningProgram . PHP_EOL .
                'Error : ' . $errorProgram . PHP_EOL .
                'hasil : ' . $resultProgram;
            $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'disable_web_page_preview' => true);
            $telegram->sendMessage($content);
        }
    }
}
