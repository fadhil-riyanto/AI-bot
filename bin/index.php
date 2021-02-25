<?php
require 'sumber.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />

  <title>Pasta sampah</title>
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/combine/
npm/bootstrap@4.4.1/dist/css/bootstrap-grid.min.css,
npm/slim-select@1.25.0/dist/slimselect.min.css,
npm/codemirror@5.58.1/lib/codemirror.min.css,
npm/codemirror@5.58.1/addon/scroll/simplescrollbars.css,
npm/codemirror@5.58.1/theme/dracula.min.css,
npm/microtip@0.2.2/microtip.min.css
" />
  <link rel="stylesheet" href="style.css" />
  <link href="favicon.ico" rel="icon" type="image/x-icon" />

</head>

<body class="m-0">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/highlightjs/cdn-release@10.5.0/build/styles/a11y-dark.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/10.5.0/highlight.min.js"></script>
  <!-- and it's easy to individually load additional languages -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/10.5.0/languages/go.min.js"></script>
  <script>
    hljs.initHighlightingOnLoad();
  </script>
  <div id="progress"></div>

  <div id="editor">
    <pre><code>
<?php
if (isset($_GET['id'])) {
  $id = $_GET['id'];
  echo htmlspecialchars(cari_data($id));
} else {
  echo 'root@Fadhil-Riyanto:/mnt/c/Users/Fadhil Riyanto$ echo \'404 not found\'' . PHP_EOL .
    '404 not found';
}
?>
</code></pre>
  </div>
  <footer id="footer" class="shadow-top container-fluid">
    <div class="row my-1">
      <div class="col mono hide-readonly" id="stats">&copy Fadhil Riyanto</div>

    </div>
  </footer>
</body>

</html>