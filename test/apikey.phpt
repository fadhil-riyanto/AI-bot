<?php
$me = <<<EOF
wooden_board
3d_summer
wolf_metal
nature_3d
underwater
golden_rose
summer_nature
leaf
fall_leaves
neon
rainbow
army_camouflage_fabric
3d_glowing
vintage
candy_text
white_cube
green_leaves
avatar_gradient
glow_rainbow
stars
fur
flaming
chrome
embroidery
3d_rainbow_background
metalic
striking
watermelon
web_matrix
multi_material
butter_fly
wooden_3d
modern_metal
harry_poter
3bit
coffe_cup
luxury_royal
scary
woodblock
smoke
sweet_candy
silk
royal
orchids_flower
flower
party_neon
dark_metal
EOF;

$bB = explode(PHP_EOL, $me);
foreach ($bB as $b) {
    echo '{
        "namaapi": "' . $b . '",
        "metode": "GET",
        "param": "tidak ada",
        "linkapi": "text_maker/' . $b . '"
    },';
}
