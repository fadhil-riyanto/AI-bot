<?php
$a = '
[
  {
    "url": "https://glot.io/api/run/assembly",
    "name": "assembly"
  },
  {
    "url": "https://glot.io/api/run/ats",
    "name": "ats"
  },
  {
    "url": "https://glot.io/api/run/bash",
    "name": "bash"
  },
  {
    "url": "https://glot.io/api/run/c",
    "name": "c"
  },
  {
    "url": "https://glot.io/api/run/clojure",
    "name": "clojure"
  },
  {
    "url": "https://glot.io/api/run/cobol",
    "name": "cobol"
  },
  {
    "url": "https://glot.io/api/run/coffeescript",
    "name": "coffeescript"
  },
  {
    "url": "https://glot.io/api/run/cpp",
    "name": "cpp"
  },
  {
    "url": "https://glot.io/api/run/crystal",
    "name": "crystal"
  },
  {
    "url": "https://glot.io/api/run/csharp",
    "name": "csharp"
  },
  {
    "url": "https://glot.io/api/run/d",
    "name": "d"
  },
  {
    "url": "https://glot.io/api/run/elixir",
    "name": "elixir"
  },
  {
    "url": "https://glot.io/api/run/elm",
    "name": "elm"
  },
  {
    "url": "https://glot.io/api/run/erlang",
    "name": "erlang"
  },
  {
    "url": "https://glot.io/api/run/fsharp",
    "name": "fsharp"
  },
  {
    "url": "https://glot.io/api/run/go",
    "name": "go"
  },
  {
    "url": "https://glot.io/api/run/groovy",
    "name": "groovy"
  },
  {
    "url": "https://glot.io/api/run/haskell",
    "name": "haskell"
  },
  {
    "url": "https://glot.io/api/run/idris",
    "name": "idris"
  },
  {
    "url": "https://glot.io/api/run/java",
    "name": "java"
  },
  {
    "url": "https://glot.io/api/run/javascript",
    "name": "javascript"
  },
  {
    "url": "https://glot.io/api/run/julia",
    "name": "julia"
  },
  {
    "url": "https://glot.io/api/run/kotlin",
    "name": "kotlin"
  },
  {
    "url": "https://glot.io/api/run/lua",
    "name": "lua"
  },
  {
    "url": "https://glot.io/api/run/mercury",
    "name": "mercury"
  },
  {
    "url": "https://glot.io/api/run/nim",
    "name": "nim"
  },
  {
    "url": "https://glot.io/api/run/nix",
    "name": "nix"
  },
  {
    "url": "https://glot.io/api/run/ocaml",
    "name": "ocaml"
  },
  {
    "url": "https://glot.io/api/run/perl",
    "name": "perl"
  },
  {
    "url": "https://glot.io/api/run/php",
    "name": "php"
  },
  {
    "url": "https://glot.io/api/run/python",
    "name": "python"
  },
  {
    "url": "https://glot.io/api/run/raku",
    "name": "raku"
  },
  {
    "url": "https://glot.io/api/run/ruby",
    "name": "ruby"
  },
  {
    "url": "https://glot.io/api/run/rust",
    "name": "rust"
  },
  {
    "url": "https://glot.io/api/run/scala",
    "name": "scala"
  },
  {
    "url": "https://glot.io/api/run/swift",
    "name": "swift"
  },
  {
    "url": "https://glot.io/api/run/typescript",
    "name": "typescript"
  }
]';

$b = json_decode($a);
foreach ($b as $bb) {
    echo '\'' . $bb->name . '\' => \'' . $bb->url . '\',' . PHP_EOL;
}
