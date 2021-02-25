<?php

require_once __DIR__ . "\mesin\SleekDB.php";
$dataDir = __DIR__ . "\paste";
$newsStore = \SleekDB\SleekDB::store('bin', $dataDir);

function masukkan_data($key, $res)
{
  global $newsStore;
  $newsInsertable = [
    "key" => $key,
    "res" => $res
  ];
  $results = $newsStore->insert($newsInsertable);
  return $results;
}
function hapus_data($key)
{
  global $newsStore;
  $a = $newsStore->where('key', '=', $key)->delete();
  return $a;
}
function cari_data($key)
{
  global $newsStore;
  $a = $newsStore->where('key', '=', $key)->fetch();
  foreach ($a as $b) {
    return $b['res'];
  }
}
function update_data($key, $res)
{
  global $newsStore;
  $newsUpdatetable = [
    "key" => $key,
    "res" => $res
  ];
  $results = $newsStore->update($newsUpdatetable);
  return $results;
}

//masukkan_data('2', '<?php echo "okok";
