<?php
$a = array(
    '/assembly' => 'https://glot.io/api/run/assembly:::asm',
    '/ats' => 'https://glot.io/api/run/ats:::ats',
    '/bash' => 'https://glot.io/api/run/bash:::sh',
    '/c' => 'https://glot.io/api/run/c:::c',
    '/clojure' => 'https://glot.io/api/run/clojure:::clj',
    '/cobol' => 'https://glot.io/api/run/cobol:::cbl',
    '/coffeescript' => 'https://glot.io/api/run/coffeescript:::coffee',
    '/cpp' => 'https://glot.io/api/run/cpp:::cpp',
    '/crystal' => 'https://glot.io/api/run/crystal:::cr',
    '/csharp' => 'https://glot.io/api/run/csharp:::cs',
    '/d' => 'https://glot.io/api/run/d:::d',
    '/elixir' => 'https://glot.io/api/run/elixir:::ex',
    '/elm' => 'https://glot.io/api/run/elm:::elm',
    '/erlang' => 'https://glot.io/api/run/erlang:::erl',
    '/fsharp' => 'https://glot.io/api/run/fsharp:::fs',
    '/go' => 'https://glot.io/api/run/go:::go',
    '/groovy' => 'https://glot.io/api/run/groovy:::groovy',
    '/haskell' => 'https://glot.io/api/run/haskell:::hs',
    '/idris' => 'https://glot.io/api/run/idris:::idr',
    '/java' => 'https://glot.io/api/run/java:::java',
    '/javascript' => 'https://glot.io/api/run/javascript:::js',
    '/julia' => 'https://glot.io/api/run/julia:::jl',
    '/kotlin' => 'https://glot.io/api/run/kotlin:::kt',
    '/lua' => 'https://glot.io/api/run/lua:::lua',
    '/mercury' => 'https://glot.io/api/run/mercury:::m',
    '/nim' => 'https://glot.io/api/run/nim:::nim',
    '/nix' => 'https://glot.io/api/run/nix:::nix',
    '/ocaml' => 'https://glot.io/api/run/ocaml:::ml',
    '/perl' => 'https://glot.io/api/run/perl:::pl',
    '/php' => 'https://glot.io/api/run/php:::php',
    '/python' => 'https://glot.io/api/run/python:::py',
    '/raku' => 'https://glot.io/api/run/raku:::raku',
    '/ruby' => 'https://glot.io/api/run/ruby:::rb',
    '/rust' => 'https://glot.io/api/run/rust:::rs',
    '/scala' => 'https://glot.io/api/run/scala:::scala',
    '/swift' => 'https://glot.io/api/run/swift:::swift',
    '/typescript' => 'https://glot.io/api/run/typescript:::ts'
);

$a = array_keys($a);
echo implode(PHP_EOL, $a);
