<?php

// echo robot_artificial_intelegence('fia');
simi:
echo 'kamu  :  ';
$input_chat = fopen("php://stdin", "r");
$out = strtolower(trim(fgets($input_chat)));

require_once __DIR__ . '/vendor/autoload.php';


$koneksi = @mysqli_connect(
    'freedb.tech',
    'freedbtech_ai_bot_fadhil_riyanto',
    '789b697698hyufijbbiub*&^BO&it87tbn7to&^7896',
    'freedbtech_ai_bot_fadhil_riyanto'
);
// $stringPertama = substr($text, 0, 1); //untuk command  slash dan karakter seru
// $stringKedua = substr($text, 0, 2); // untuk command dengan 2 karakter, biasa di cctip

// if ($stringPertama == '/') {
// 	// Jika ditemukan data dengan awalan coommand telegram, maka dia ngga akan diinsert ke database
// 	// kita menggunakan exit agar dia keluar dari konsol
// 	exit;
// }

$stemmerFactory = new \Sastrawi\Stemmer\StemmerFactory();
$stemmer  = $stemmerFactory->createStemmer();



$teksTerfilter_kata_jorok = kata_kata_jorok($out);
$stemmer_hasil   = $stemmer->stem($out);
$teksTerfilter = hyphenize($stemmer_hasil);


$q = mysqli_query($koneksi, "SELECT * FROM `data_ai` WHERE `data_key_ai` SOUNDS LIKE _utf8 '$teksTerfilter' ");
$tes_jumlah_row = @mysqli_affected_rows($koneksi);
$dataAI = mysqli_fetch_assoc($q);


// Jika ternyata ada kata kata jorok 
if ($tes_jumlah_row > 0) {
    // Jika ternyata kata ada di database (ditemukan)
    // $arrayres = array('respon' => @hyphenize($dataAI['data_res_ai']), 'normalisasi_tulisan' => @$teksTerfilter, 'bad_word' => @$teksTerfilter_kata_jorok, 'stemmer' => $stemmer_hasil, 'affected' => $tes_jumlah_row);
    // return json_encode($arrayres);

    echo 'simi  :  ' . hyphenize($dataAI['data_res_ai']) . PHP_EOL;
} else {
    //kalau ngga nemu alternatif pakai API
    //Yg ini

    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://wsapi.simsimi.com/190410/talk/",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => "{\n\t\"utext\": \". $teksTerfilter .\", \n\t\"lang\": \"id\" \n}",
        CURLOPT_HTTPHEADER => array(
            "Content-Type: application/json",
            "x-api-key: X9QTrw5PpgtPTFZwS1PgR95JbYUvSJqCh03nRHim"
        ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    $simi = json_decode($response);
    // echo 'simi :  ' . $simi->atext . PHP_EOL;
    //tapi kalau ternyta ip gw kena limit query maka
    if (@$simi->message == 'Limit Exceeded Exception') {
        //kita pakai api yg ini lah bang
        echo 'simi  :  prebarui api key!' . PHP_EOL;
        goto simi;
    } else {
        $data_filetr_sim = hyphenize($simi->atext);
        //kalau ternyata belum kena limit, maka langsung aja insert
        echo 'simi  :  ' . $data_filetr_sim . PHP_EOL;
        mysqli_query($koneksi, "INSERT INTO `data_ai` (`data_key_ai`, `data_res_ai`) VALUES ('$teksTerfilter', '$data_filetr_sim')");
        goto simi;
    }
}
goto simi;
function hyphenize($string)
{
    $dict = array(
        'simi' => 'kamu',
        'simsimi' => 'kamu',
        'knp' => 'kenapa',
        'bokep' => 'nonton drakor',
        'bokepan' => 'nonton drakor',
        'yg' => 'yang',
        '?' => null,
        '*' => null,
        '@' => null,
        '!' => null,
        '-' => null,
        'yoi' => 'iya'

        // replace teks lainnya disini
    );
    return strtolower(
        preg_replace(
            array('#[\\s-]+#', '#[^A-Za-z0-9. -]+#'),
            array(' ', ''),

            cleanString(
                str_replace(
                    array_keys($dict),
                    array_values($dict),
                    urldecode($string)
                )
            )
        )
    );
}
function cleanString($text)
{
    $utf8 = array(
        '/[áàâãªä]/u'   =>   'a',
        '/[ÁÀÂÃÄ]/u'    =>   'A',
        '/[ÍÌÎÏ]/u'     =>   'I',
        '/[íìîï]/u'     =>   'i',
        '/[éèêë]/u'     =>   'e',
        '/[ÉÈÊË]/u'     =>   'E',
        '/[óòôõºö]/u'   =>   'o',
        '/[ÓÒÔÕÖ]/u'    =>   'O',
        '/[úùûü]/u'     =>   'u',
        '/[ÚÙÛÜ]/u'     =>   'U',
        '/ç/'           =>   'c',
        '/Ç/'           =>   'C',
        '/ñ/'           =>   'n',
        '/Ñ/'           =>   'N',
        '/–/'           =>   '-',
        '/[’‘‹›‚]/u'    =>   ' ',
        '/[“”«»„]/u'    =>   ' ',
        '/ /'           =>   ' ',
    );
    return preg_replace(array_keys($utf8), array_values($utf8), $text);
}
function kata_kata_jorok($text)
{
    $daftar = array(
        'bokong', 'ass', 'Anjing', 'Babi', 'Monyet', 'Kunyuk', 'Bajingan', 'Asu', 'Bangsat', 'Kampret',
        'Kontol', 'Memek', 'Ngentot', 'Ngewe', 'Jembod', 'Jembud', 'Perek', 'Pecun', 'Bencong', 'Banci',
        'Jablay', 'Maho', 'Bego', 'Goblok', 'Idiot', 'Geblek', 'Orang Gila', 'Gila', 'Sinting', 'Tolol', 'Sarap',
        'Udik', 'Kampungan', 'Kamseupay', 'Buta', 'Budek', 'Bolot', 'Jelek', 'Setan', 'Iblis', 'Jahannam',
        'Dajjal', 'Jin Tomang', 'Keparat', 'Bejad', 'Gembel', 'Brengsek', 'Tai', 'Sompret',
        'Anjing', 'Babi', 'Kunyuk', 'Bajingan', 'Asu', 'Bangsat', 'Kampret', 'Kontol', 'Memek', 'Ngentot', 'Pentil', 'Perek',
        'Pepek', 'Pecun', 'Bencong', 'Banci', 'Maho', 'Gila', 'Sinting', 'Tolol', 'Sarap', 'Setan', 'Lonte', 'Hencet', 'Taptei',
        'Kampang', 'Pilat', 'Keparat', 'Bejad', 'Gembel', 'Brengsek', 'Tai', 'Anjrit', 'Bangsat', 'Fuck', 'Tetek', 'Ngulum', 'Jembut',
        'Totong', 'Kolop', 'Pukimak', 'Bodat', 'Heang', 'Jancuk', 'Burit', 'Titit', 'Nenen', 'Bejat', 'Silit', 'Sempak', 'Fucking',
        'Asshole', 'Bitch', 'Penis', 'Vagina', 'Klitoris', 'Kelentit', 'Borjong', 'Dancuk', 'Pantek', 'Taek', 'Itil', 'Teho', 'Bejat',
        'Pantat', 'Bagudung', 'Babami', 'Kanciang', 'Bungul', 'Idiot', 'Kimak', 'Henceut', 'Kacuk', 'Blowjob', 'Pussy',
        'Dick', 'Damn', '3some', '4some', '17 tahun', '17tahun', '*damn', '*dyke', '*fuck*', '*shit*', '@$$', 'adult', 'ahole',
        'akka', 'amcik', 'anal', 'anal-play', 'analingus', 'analplay', 'androsodomy', 'andskota', 'anilingus', 'anjing', 'anjrit',
        'anus', 'arschloch', 'arse', 'arse*', 'arsehole', 'ash0le', 'ash0les', 'asholes', 'ass', 'ass', 'ass monkey',
        'ass-playauto-eroticism', 'asses', 'assface', 'assh0le', 'assh0lez', 'asshole', 'asshole', 'assholes', 'assholz',
        'asslick', 'assplay', 'assrammer', 'asswipe', 'asu', 'autofellatio', 'autopederasty', 'ayir', 'azzhole', 'b00b',
        'b00b*', 'b00bs', 'b1tch', 'b17ch', 'b!+ch', 'b!tch', 'babami', 'babes', 'babi', 'bagudung', 'bajingan', 'ball-gag',
        'ballgag', 'banci', 'bangla', 'bangsat', 'bareback', 'barebacking', 'bassterds', 'bastard', 'bastards', 'bastardz', 'basterds',
        'basterdz', 'bdsm', 'beastilaity', 'bejad', 'bejat', 'bencong', 'bestiality', 'bi7ch', 'bi+ch', 'biatch', 'bikini', 'birahi', 'bitch',
        'bitch', 'bitch*', 'bitches', 'blow job', 'blow-job', 'blowjob', 'blowjob', 'blowjobs', 'bodat', 'boffing', 'bogel', 'boiolas', 'bokep',
        'bollock', 'bollock*', 'bondage', 'boner', 'boob', 'boobies', 'boobs', 'borjong', 'breas', 'breasts', 'brengsek', 'buceta', 'bugger', 'buggery',
        'bugil', 'bukake', 'bukakke', 'bull-dyke', 'bull-dykes', 'bulldyke', 'bulldykes', 'bungul', 'burit', 'butt', 'butt-pirate', 'butt-plug',
        'butt-plugs', 'butthole', 'buttplug', 'buttplugs', 'butts', 'buttwipe', 'c0ck', 'c0cks', 'c0k', 'cabron', 'cameltoe', 'cameltoes',
        'carpet muncher', 'cawk', 'cawks', 'cazzo', 'cerita dewasa', 'cerita hot', 'cerita panas', 'cerita seru', 'chick', 'chicks', 'chink',
        'choda', 'chraa', 'chudai', 'chuj', 'cipa', 'cipki', 'clit', 'clit', 'clitoris', 'clits', 'cnts', 'cntz', 'cock', 'cock*', 'cock-head',
        'cock-sucker', 'cockhead', 'cocks', 'cocksucker', 'coli', 'coprophagy', 'coprophilia', 'cornhole', 'cornholes', 'corpophilia', 'corpophilic',
        'crack', 'crackz', 'crap', 'cream-pie', 'creampie', 'creamypie', 'cum', 'cumming', 'cumpic', 'cumshot', 'cumshots', 'cunilingus', 'cunnilingus',
        'cunt', 'cunt*', 'cunts', 'cuntz', 'd4mn', 'damn', 'dancuk', 'daniel brou', 'david neil wallace', 'daygo', 'deepthroat', 'defecated',
        'defecating', 'defecation', 'dego', 'desnuda', 'dick', 'dick', 'dick*', 'dicks', 'dike', 'dike*', 'dild0', 'dild0s', 'dildo', 'dildoes',
        'dildos', 'dilld0', 'dilld0s', 'dirsa', 'dnwallace', 'doggystyle', 'dominatricks', 'dominatrics', 'dominatrix', 'douche', 'douches', 'douching',
        'dupa', 'dyke', 'dykes', 'dziwka', 'ejackulate', 'ekrem', 'ekrem*', 'ekto', 'ekto', 'enculer', 'enema', 'enemas', 'erection',
        'erections', 'erotic', 'erotica', 'f u c k', 'f u c k e r', 'facesit', 'facesitting', 'facial', 'facials', 'faen', 'fag', 'fag1t', 'fag*',
        'faget', 'fagg0t', 'fagg1t', 'faggit', 'faggot', 'fagit', 'fags', 'fagz', 'faig', 'faigs', 'fanculo', 'fanny', 'fart', 'farted', 'farting',
        'fatass', 'fcuk', 'feces', 'feg', 'felch', 'felcher', 'felcher', 'felching', 'fellatio', 'fetish', 'fetishes', 'ficken', 'fisting', 'fitt*',
        'flikker', 'flikker', 'flipping the bird', 'footjob', 'foreskin', 'fotze', 'fotze', 'foursome', 'fu(*', 'fuck', 'fuck', 'fucker', 'fuckin',
        'fucking', 'fucking', 'fucks', 'fudge packer', 'fuk', 'fuk*', 'fukah', 'fuken', 'fuker', 'fukin', 'fukk', 'fukkah', 'fukken', 'fukker', 'fukkin',
        'futkretzn', 'fux0r', 'g00k', 'g-spot', 'gag', 'gang-bang', 'gangbang', 'gay', 'gayboy', 'gaygirl', 'gays', 'gayz', 'gembel', 'genital',
        'genitalia', 'genitals', 'gila', 'girl', 'glory-hole', 'glory-holes', 'gloryhole', 'gloryholes', 'god-damned', 'gook', 'groupsex', 'gspot',
        'guiena', 'h0ar', 'h0r', 'h0re', 'h00r', 'h4x0r', 'hand-job', 'handjob', 'hardcore', 'hate', 'heang', 'hell', 'hells', 'helvete', 'hencet',
        'henceut', 'hentai', 'hitler', 'hoar', 'hoer', 'hoer*', 'homosexual', 'honkey', 'hoor', 'hoore', 'hore', 'horny', 'hot girl', 'hot video',
        'hubungan intim', 'huevon', 'huevon', 'hui', 'idiot', 'incest', 'injun', 'intercourse', 'interracial', 'itil', 'jackass', 'jackoff', 'jancuk',
        'jap', 'japs', 'jebanje', 'jembut', 'jerk-off', 'jisim', 'jism', 'jiss', 'jizm', 'jizz', 'joanne yiokaris', 'kacuk', 'kampang', 'kampret',
        'kanciang', 'kanjut', 'kanker*', 'kankerkinky', 'kawk', 'kelamin', 'kelentit', 'keparat', 'kike', 'kimak', 'klimak', 'klimax', 'klitoris',
        'klootzak', 'knob', 'knobs', 'knobz', 'knulle', 'kolop', 'kontol', 'kontol', 'kraut', 'kripalu', 'kuk', 'kuksuger', 'kunt', 'kunts', 'kuntz',
        'kunyuk', 'kurac', 'kurac', 'kurwa', 'kusi', 'kusi*', 'kyrpa', 'kyrpa*', 'l3i+ch', 'l3itch', 'labia', 'labial', 'lancap', 'lau xanh', 'lesbi',
        'lesbian', 'lesbians', 'lesbo', 'lezzian', 'lipshits', 'lipshitz', 'lolita', 'lolitas', 'lonte', 'lucah', 'maho', 'malam pengantin',
        'malam pertama', 'mamhoon', 'maria ozawa', 'masochism', 'masochist', 'masochistic', 'masokist', 'massterbait', 'masstrbait', 'masstrbate',
        'masterbaiter', 'masterbat3', 'masterbat*', 'masterbate', 'masterbates', 'masturbat', 'masturbat*', 'masturbate', 'masturbation', 'memek',
        'memek', 'merd*', 'mesum', 'mibun', 'mofo', 'monkleigh', 'motha fucker', 'motha fuker', 'motha fukkah', 'motha fukker', 'mother fucker',
        'mother fukah', 'mother fuker', 'mother fukkah', 'mother fukker', 'mother-fucker', 'motherfisher', 'motherfucker', 'mouliewop', 'muff',
        'muie', 'mujeres', 'mulkku', 'muschi', 'mutha fucker', 'mutha fukah', 'mutha fuker', 'mutha fukkah', 'mutha fukker', 'n1gr', 'naked', 'nastt',
        'nazi', 'nazis', 'necrophilia', 'nenen', 'nepesaurio', 'ngecrot', 'ngegay', 'ngentot', 'ngentot', 'ngewe', 'ngocok', 'ngulum', 'nigga', 'nigger',
        'nigger*', 'nigger;', 'niggers', 'nigur;', 'niiger;', 'niigr;', 'nipple', 'nipples', 'no cd', 'nocd', 'nude', 'nudes', 'nudity', 'nutsack',
        'nympho', 'nymphomania', 'nymphomaniac', 'orafis', 'orgasim;', 'orgasm', 'orgasms', 'orgasum', 'orgies', 'orgy', 'oriface', 'orifice', 'orifiss',
        'orospu', 'p0rn', 'packi', 'packie', 'packy', 'paki', 'pakie', 'paky', 'pantat', 'pantek', 'paska', 'paska*', 'pecker', 'pecun', 'pederast',
        'pederasty', 'pedophilia', 'pedophiliac', 'pee', 'peeenus', 'peeenusss', 'peeing', 'peenus', 'peinus', 'pemerkosaan', 'pen1s', 'penas',
        'penetration', 'penetrations', 'penis', 'penis', 'penis-breath', 'pentil', 'penus', 'penuus', 'pepek', 'perek', 'perse', 'pervert', 'perverted',
        'perverts', 'pg ishazamuddin', 'phuc', 'phuck', 'phuck', 'phuk', 'phuker', 'phukker', 'picka', 'pierdol', 'pierdol*', 'pilat', 'pillu', 'pillu*',
        'pimmel', 'pimpis', 'piss', 'piss*', 'pizda', 'polac', 'polack', 'polak', 'poonani', 'poontsee', 'poop', 'porn', 'pr0n', 'pr1c', 'pr1ck', 'pr1k',
        'precum', 'preteen', 'prick', 'pricks', 'prostitute', 'prostituted', 'prostitutes', 'prostituting', 'puki', 'pukimak', 'pula', 'pule', 'pusse',
        'pussee', 'pussies', 'pussy', 'pussy', 'pussylips', 'pussys', 'puta', 'puto', 'puuke', 'puuker', 'qahbeh', 'queef', 'queef*', 'queer', 'queers',
        'queerz', 'qweef', 'qweers', 'qweerz', 'qweir', 'racist', 'rape', 'raped', 'rapes', 'rapist', 'rautenberg', 'recktum', 'rectum', 'retard',
        'rimjob', 's.o.b.', 'sabul', 'sadism', 'sadist', 'sarap', 'scank', 'scat', 'schaffer', 'scheiss', 'scheiss*', 'schlampe', 'schlong', 'schmuck',
        'school', 'screw', 'screwing', 'scrotum', 'sekolah menengah shan tao', 'seks', 'semen', 'sempak', 'senggama', 'sepong', 'setan', 'setubuh', 'sex',
        'sexy', 'sh1t', 'sh1ter', 'sh1ts', 'sh1tter', 'sh1tz', 'sh!+', 'sh!t', 'sh!t', 'sh!t*', 'sharmuta', 'sharmute', 'shemale', 'shi+', 'shipal',
        'shit', 'shits', 'shitter', 'shitty', 'shity', 'shitz', 'shiz', 'shyt', 'shyte', 'shytty', 'shyty', 'silit', 'sinting', 'sixty-nine', 'sixtynine',
        'skanck', 'skank', 'skankee', 'skankey', 'skanks', 'skanky', 'skribz', 'skurwysyn', 'slag', 'slut', 'sluts', 'slutty', 'slutty', 'slutz', 'smut',
        'sodomi', 'sodomize', 'sodomy', 'softcore', 'son-of-a-bitch', 'spank', 'spanked', 'spanking', 'sperm', 'sphencter', 'spic', 'spierdalaj',
        'splooge', 'squirt', 'squirted', 'squirting', 'strap-on', 'strapon', 'submissive', 'suck', 'suck-off', 'sucked', 'sucking', 'sucks', 'suicide',
        'taek', 'tai', 'tanpa busana', 'taptei', 'teets', 'teez', 'teho', 'telanjang', 'testical', 'testicle', 'testicle*', 'testicles', 'tetek',
        'tetek', 'threesome', 'tit', 'titit', 'tits', 'titt', 'titt*', 'titties', 'titty', 'tittys', 'togel', 'toket', 'tolol', 'topless', 'totong',
        'tranny', 'transsexual', 'transvestite', 'tukar istri', 'tukar pasangan', 'turd', 'tusbol', 'twat', 'twats', 'twaty', 'twink', 'upskirt',
        'urinated', 'urinating', 'urination', 'va1jina', 'vag1na', 'vagiina', 'vagina', 'vagina', 'vaginas', 'vaj1na', 'vajina', 'vibrator', 'vittu',
        'vullva', 'vulva', 'w0p', 'w00se', 'wank', 'wank*', 'wanking', 'warez', 'watersports', 'wetback*', 'wh0re', 'wh00r', 'whoar', 'whore', 'whores',
        'wichser', 'wop*', 'x-girl', 'x-rated', 'xes', 'xrated', 'xxx', 'yed', 'zabourah',
    );
    foreach ($daftar as $filters) {
        if (stristr($text, $filters)) {
            return true;
        }
    }
    return false;
}

// X9QTrw5PpgtPTFZwS1PgR95JbYUvSJqCh03nRHim
// fAwvrgiIEL.F~k2~.-tXYQPtTgvA0JSqiWuFVbp9
// LMDTrTgTgqN3U8uKWWRAToems3..2wAaSJCeXnKW
// sc5W7p64_P_d2OPln-8s5f8.hQ.InTBI5qGXLV43
