<?php
function langProgrammingindex($string)
{
    $string = strtolower($string);
    $dict = array(
        'c#' => '1',
        'vb.net' => '2',
        'f#' => '3',
        'java' => '4',
        'python' => '5',
        'c_gcc' => '6',
        'c++_gcc' => '7',
        'c' => '6',
        'c++' => '7',
        'php' => '8',
        'pascal' => '9',
        'objective_c' => '10',
        'haskell' => '11',
        'ruby' => '12',
        'perl' => '13',
        'lua' => '14',
        'nasm' => '15',
        'sql server' => '16',
        'javascript' => '17',
        'lisp' => '18',
        'prolog' => '19',
        'go' => '20',
        'scala' => '21',
        'scheme' => '22',
        'node.js' => '23',
        'python 3' => '24',
        'octave' => '25',
        'c_clang' => '26',
        'c++_clang' => '27',
        'c++_vc++' => '28',
        'c_vc' => '29',
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

var_dump(langProgrammingindex('pHdp'));
