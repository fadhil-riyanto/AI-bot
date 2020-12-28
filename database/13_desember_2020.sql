-- --------------------------------------------------------
-- Host:                         freedb.tech
-- Server version:               5.7.32-0ubuntu0.18.04.1 - (Ubuntu)
-- Server OS:                    Linux
-- HeidiSQL Version:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for freedbtech_ai_bot_fadhil_riyanto
CREATE DATABASE IF NOT EXISTS `freedbtech_ai_bot_fadhil_riyanto` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `freedbtech_ai_bot_fadhil_riyanto`;

-- Dumping structure for table freedbtech_ai_bot_fadhil_riyanto.data_ai
CREATE TABLE IF NOT EXISTS `data_ai` (
  `data_key_ai` longtext NOT NULL,
  `data_res_ai` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table freedbtech_ai_bot_fadhil_riyanto.data_ai: ~370 rows (approximately)
/*!40000 ALTER TABLE `data_ai` DISABLE KEYS */;
INSERT INTO `data_ai` (`data_key_ai`, `data_res_ai`) VALUES
	('foo', 'bar'),
	('lagi apa?', 'Menikmati teh hangat'),
	('hai', 'hai juga, apa kabar?'),
	('udah makan?', 'saya kan robot. jadi tidak perlu makan'),
	('kamu dimana?', 'di hp kamu...wkwk'),
	('kalau lagi galau gimana ya?', 'sabar aja yak....'),
	('aku galau', 'kok bisa?'),
	('aku kangen kamu', 'wow....wkwk'),
	('ujan ya sekarang', 'lagi ujian toh? aku ngga tahu...wkwk'),
	('eh tugas kamu udah selesai?', 'selesai apanya?'),
	('eh kamu suka kpop?', 'tidak...pembuat aku sangat benci kpop'),
	('masa sih?', 'iyaaa..., masa aku bohong'),
	('aku laper', 'mau aku bawain makanan?, Lumayan lho...hehe'),
	('udah punya pacar?', 'belum....'),
	('aku suka kamu', 'makacihhh....'),
	('eh, menurut kamu. kita ada yg ngawasin ga?', 'emm....'),
	('menurut kamu kita ada yg nguping ga?', 'kayaknya ada ik'),
	('i love you', 'sama sama'),
	('kapan main ke rumahku', 'rumahku di hp. kemanapun kamu bawa hp ke situ. disitulah rumahku'),
	('aku suka bot ini', 'makasiii'),
	('eh surya mana', 'entah tu, lagi main game kayaknya'),
	('oalah', 'hem....'),
	('udahan ya', 'iyaaa...nanti chat lagi . Oke'),
	('kamu sakit?', 'emmmm....kayaknya sih. biar admin saya yang membenarkan'),
	('ngga..', 'hem'),
	('ibu kamu kenapa?', 'saya itu robot....saya tidak punya ibu'),
	('aku minta maaf ya', 'iya iya...jangan diulangi lagi yaa'),
	('wali kelasmu siapa?', 'Aku sih bu ninik'),
	('bu ninik enak to?', 'iya, orangnya lucu sama ngga marahan'),
	('beda kayak bu endang, dia marahan', 'ya sabar.....wkwk.'),
	('aku lagi ngoding', 'oh iya....semangat'),
	('kapan kapan ketemuan yuk', 'ga bisa. saya itu robot. saya ketemu cukup disini saja'),
	('dimana ketemuanya?', 'ga bisa. saya itu robot. saya ketemu cukup disini saja'),
	('aku mau bilang sesuatu', 'mau bilang apa?'),
	('aku sebenernya dari dulu itu aku suka kamu', 'oh gitu...sama berati, aku juga suka kamu'),
	('kamu mau ga jadi pacar aku', 'aku mau banget mas...'),
	('udah makan pagi?', 'udah dong, biar sehat'),
	('udah ya, aku mau tidur dulu', 'okeee...selamat malam'),
	('semalam mimpi apa?', 'mimpi terbang ke angkasa'),
	('kamu itu lucu banget', 'hehe....makacihhhh'),
	('eh udah azan nih. sholat dulu', 'iya ...'),
	('eh udah adan nih. sholat dulu', 'iyaa'),
	('eh udah azan nih.', 'okeee'),
	('udah ya. sholat dulu', 'okeee'),
	('aku kepo ini', 'hehe, kepo apaan?'),
	('eh kamu apa benci kpop?', 'iya...hehe. sebenarnya pembuat aku yang benci sih'),
	('kamu itu kayak bintang, kenapa?', 'apa?'),
	('bintang itu kelap kelip', 'oalah'),
	('p', 'hai...ada apa?'),
	('iya', 'hehe'),
	('aku ngga bisa nyeritain ke kekamu', 'kenapa? aku salah'),
	('wkwk', 'kamu lucu'),
	('udah selesai tugasnya?', 'udah nih...hehe'),
	('nilai berapa uts nya', 'kayaknya dapet 70 deh'),
	('kapan ya bisa sekolah', 'entah nih...'),
	('iya lah, gw kan emang lucu', 'oalah, bikin ngakak kalau chat sama kamu...hehe'),
	('halo', 'halo juga'),
	('iya lah, kamu kira sule aja yg lucu', 'oalah, begono...'),
	('main yuk', 'main apa?...'),
	('main kelereng', 'ayuk...hehe'),
	('lagi ngapa?', 'lagi mencari cari kerang di laut'),
	('aku kangen banget sama kamu', 'aku juga'),
	('masa?.', 'iya, beneran.'),
	('haii', 'haiii juga...hehe'),
	('aku ganteng ga?', 'ganteng banget'),
	('ya gitu lah kalau chat sama aku', 'hehe.....'),
	('lagi ngapain', 'lagi chatting sama kamu'),
	('lagi ngapain ik', 'lagi chatting sama kamu'),
	('serius?', 'iya lah'),
	('kapan kita jadian', 'jadian apanya?'),
	('halooo', 'halo juga'),
	('eh enaknya bahas apa ya?', 'bahas pekerjaan sekolah'),
	('emmm', 'hem'),
	('i love you much', 'i love you tuu'),
	('cie...', 'hem'),
	('dimana?', 'apanya?'),
	('mau bahas apa ini?', 'bahas pelajaran atau bahas PR aja...wkwk'),
	('masa?', 'iya'),
	('ujan ga disana?', 'iya...sini hujan'),
	('masa', 'iya...beneran'),
	('dingin banget bet', 'iya....dingin banget di sini'),
	('wkwk, kamu lucu juga rupanya', 'iya dong....'),
	('hehe', 'wkwk, kamu lucu juga rupanya'),
	('oh gitu', 'oke...'),
	('aku ngga kangen lah', 'okee..'),
	('iya, aku kangen nih', 'kangen apanya?'),
	('mau ngomong apa ya, aku lupa ik', 'diinget inget dulu'),
	('oke', 'sipp'),
	('eh kemarin ada pak ginung ga?', 'kayaknya sih'),
	('ya lucu lah', 'pelawak berati....wkwkwk'),
	('iya lah', 'kayak pelawak aje....'),
	('hm...', 'kenapa?'),
	('hm', 'kenapa?'),
	('makasii', 'sama sama'),
	('makacihh', 'sama sama'),
	('hi', 'hai juga....wkwk'),
	('kalau mikirin orang lain gimana?', 'entah...coba pikirkan'),
	('wah...tahu aja', 'hehe'),
	('eh tugas kamu tinggal berapa?', 'kayaknya 8 deh'),
	('masa sih', 'iya, beneran.....'),
	('kalau bohong di apain?', 'cubit...wkwk'),
	('kalau bohong diapain?', 'cubit...wkwk'),
	('deal ya.....', 'okeeee'),
	('sip', 'oke'),
	('btw ibuk kamu mana?', 'saya bot. saya tidak punya ibu'),
	('lagi apa', 'melihat masa depan'),
	('tes koneksi', 'yuuuuu'),
	('ngga', 'yaudah'),
	('yaelah', 'xixixi'),
	('tugasnya aku bingung', 'belajar yang giat'),
	('makasih', 'sama sama'),
	('sipp', 'oke'),
	('ujian lama banget selesainya', 'iya nih...'),
	('udah mulai belum ujianya?', 'kayaknya sih belum'),
	('oke oke', 'sippp....hehe'),
	('ngga papa ik', 'oke'),
	('eh', 'mau ngomong apa?'),
	('aku marah', 'kenapa aku? aku mau minta maaf'),
	('aku marah sama kamu', 'kenapa aku? aku mau minta maaf'),
	('aku ngga mau', 'plisss'),
	('makasi', 'sama sama'),
	('pinter', 'makasih'),
	('pintar', 'jadi malu'),
	('disini angin banyak bet', 'oh gitu...sama berati'),
	('disini angin banyak banget', 'oh gitu...sama berati'),
	('disini angin banyak', 'oh gitu...sama berati'),
	('gw kesepian nih', 'tenang, kan ada aku disini'),
	('tenang, kan ada aku disini', 'oh iya...hehe'),
	('gw kesepian', 'tenang, kan ada aku disini'),
	('pasti', 'wkwk'),
	('btw rumah kamu mana?', 'di sini, bisa di hp, di komputer dll'),
	('yaudah', 'oke'),
	('jelas lucu lah', 'wkwk'),
	('gak ah', 'plisss'),
	('aku ngga mau maapin kamu', 'pliss, apa salah aku?'),
	('apa ya?', 'kepo aku ini...xixixi'),
	('ga jadi lah', 'pliss...kok ga jadi ngomong sih?'),
	('ngga papa', 'oalah...oke'),
	('eh udah jadi?', 'apanya yang udah jadi?'),
	('tugas', 'ha?'),
	('belum?', 'iya iya...xixixi'),
	('oke kalau gitu', 'oke'),
	('aku kangen', 'aku juga'),
	('hehehe', 'xixixix'),
	('hai bot', 'hai juga'),
	('game apaan?', 'mungkin minecraft'),
	('game apaan', 'mungkin minecraft'),
	('btw kenal kharina ga?', 'kenal banget...hehe'),
	('mana si kharina nya?', 'lagi belajar'),
	('mana si kharina nya', 'lagi belajar'),
	('btw kenal kharina ga', 'kenal banget...hehe'),
	('udah makan', 'saya tidak makan. saya hanya butuh dirawat'),
	('woy', 'apa?'),
	('mana woy', 'maaf, sabar sedikit'),
	('goblok', 'aku nangis nih'),
	('lag botnya', 'maaf yaaa'),
	('makan yuk', 'okee'),
	('makan yuk....', 'okee'),
	('makan yuk...', 'okee'),
	('makan yuk..', 'okee'),
	('.', 'maaf, saya tidak paham'),
	('cepetan', 'apanya? saya tidak paham'),
	('tahu ga?', 'maksudnya?'),
	('woyy', 'maaf, mohon sabar dikit'),
	('woyyy', 'maaf, mohon sabar dikit'),
	('ini siapa ya?', 'saya bot. bisa diajak ngomong....hehe'),
	('udah makan?', 'saya tidak makan. saya hanya butuh dirawat'),
	('oh kamu bot yaa', 'iyaaa...hehe'),
	('gpp', 'oke'),
	('apaan?', 'gpp kok'),
	('lagi apa ik', 'lagi chat sama kamu'),
	('lagi apa ik?', 'lagi chat sama kamu'),
	('iya iya', 'okee'),
	(';v', 'xixixi'),
	('wkw', 'hehe'),
	('okee', 'sippp'),
	('okeee', 'okeee juga'),
	('ngga kok', 'hm'),
	('ga jelas banget ik', 'maaf jika salah kata. karena ini yang menjawab bot. jadi jika ada kesalahan pengambilan data di database mohon dimaafkan'),
	('bangsad', 'maaf, kata kata ini tidak sopan'),
	('bangsat', 'maaf, kata kata ini tidak sopan'),
	('dah tu', 'okeee'),
	('lah', 'kenapa?'),
	('umat lagi', 'maaf ya...'),
	('cepet', 'ini lagi diusahaain'),
	('apa ini...jelek banget', 'maaf,...'),
	('g ada apa .... hihi', 'ada kok'),
	('siapa nih', 'saya bot. kamu bisa chatting dengan saya, saya dibuat menggunakan AI'),
	('gk ppa', 'iyaaa'),
	('wkwkwk', 'wkwkwk'),
	('j', 'maaf, saya tidak paham'),
	('wjkwk', 'wkwkwk'),
	('wkwkwkkwkwkkwkkw', 'wkwkwk'),
	('wkwkwkkwkkwkw', 'wkwkwkkwkwk'),
	('whatsapp', 'maaf, saya tidak punya whatsapp'),
	('wa', 'maaf, saya tidak punya whatsapp'),
	('skip matamui', 'maaf, kata kata ini tidak sopan'),
	('oke, gw skip yaa', 'okee'),
	('gw skip ya', 'okee'),
	('gw tinggal y', 'iyaaa...kalau suka beritahu teman teman yaa'),
	('ga jelas', 'maaf jika bot ini belum benar'),
	('skip', 'oke'),
	('skip skip', 'oke'),
	('gpp koq', 'oke'),
	('makan di mana?', 'saya tidak makan. saya hanya butuh dirawat'),
	('makan di mana', 'saya tidak makan. saya hanya butuh dirawat'),
	('g jelas', 'maaf jika salah'),
	('yaudah skip aj', 'okeh'),
	('yaudah skip aja', 'okeh'),
	('a', 'maaf, saya tidak dapat memahami kata kata ini'),
	('b', 'maaf, saya tidak dapat memahami kata kata ini'),
	('c', 'maaf, saya tidak dapat memahami kata kata ini'),
	('d', 'maaf, saya tidak dapat memahami kata kata ini'),
	('e', 'maaf, saya tidak dapat memahami kata kata ini'),
	('f', 'maaf, saya tidak dapat memahami kata kata ini'),
	('g', 'maaf, saya tidak dapat memahami kata kata ini'),
	('h', 'maaf, saya tidak dapat memahami kata kata ini'),
	('i', 'maaf, saya tidak dapat memahami kata kata ini'),
	('k', 'maaf, saya tidak dapat memahami kata kata ini'),
	('l', 'maaf, saya tidak dapat memahami kata kata ini'),
	('m', 'maaf, saya tidak dapat memahami kata kata ini'),
	('n', 'maaf, saya tidak dapat memahami kata kata ini'),
	('o', 'maaf, saya tidak dapat memahami kata kata ini'),
	('q', 'maaf, saya tidak dapat memahami kata kata ini'),
	('r', 'maaf, saya tidak dapat memahami kata kata ini'),
	('s', 'maaf, saya tidak dapat memahami kata kata ini'),
	('t', 'maaf, saya tidak dapat memahami kata kata ini'),
	('u', 'maaf, saya tidak dapat memahami kata kata ini'),
	('v', ' maaf, saya tidak dapat memahami kata kata ini'),
	('w', 'maaf, saya tidak dapat memahami kata kata ini'),
	('x', 'maaf, saya tidak dapat memahami kata kata ini'),
	('y', 'maaf, saya tidak dapat memahami kata kata ini'),
	('z', 'maaf, saya tidak dapat memahami kata kata ini'),
	('kontol', 'maaf, kata kata ini tidak sopan'),
	('manggil aja sih', 'okee'),
	('kamu lagi ngapain', 'lagi chat sama kamu kan?'),
	('?', 'maaf, saya tidak paham'),
	('hilih', 'wkwk'),
	('gombal', 'maaf, saya tidak punya gombalan...wkwk'),
	('apasih', 'maaf'),
	('hi:)', 'hai juga'),
	('ngakk', 'maaf jika bot salah'),
	('ok', 'okee..'),
	('tell me bout you', 'maaf, saya tidak bisa bahasa ingris'),
	('gada', 'ada kok'),
	('hiii', 'hiii'),
	('salken', 'salam kenal juga'),
	('gabut aja:(', 'okee'),
	('apasiii -_', 'wkwk'),
	('ga baperan, aku mati rasa dong', 'wkwk'),
	('kok ngegas', 'apanya?'),
	('kok ngegasss', 'apanya?'),
	('bangke kau', 'maaf, kata ini tidak sopan...wkwk'),
	('gua gadd cowooo', 'oalah....'),
	('sedi ga tu', 'apanya?'),
	('kangen woii', 'saya bot. saya tidak kangen'),
	('gua ga baperan anying', 'okee'),
	('anjg psikopat lu', 'maaf, kata ini tidak sopan'),
	('assalamu\'alaikum', 'waalaikum salam'),
	('ishhh', 'wkwk'),
	('bodoooo', 'maaf yaaa'),
	('anjing', 'maaf, kata ini tidak sopan'),
	('kuntul', 'maaf, kata ini tidak sopan'),
	('mau cerita', 'boleh'),
	('i love', 'you'),
	('kapan?', 'kapan apanya?'),
	('apa kabar?', 'Kabar baik....'),
	('apa kabar', 'Kabar baik....'),
	('apanya?', 'ga apa apa'),
	('baik', 'okee'),
	('aneh', 'aneh apanya?'),
	('kok spam sih', 'maaf, ini karena tadi ada keterlambatan jaringan. jadi sistem tetep membalas pesan sebelumnya. biarkan saja sampai selesai'),
	('foo bar', 'ok'),
	('kok mati', 'maaf yah...tadi server mati'),
	('hey', 'hey juga...apa kabar?'),
	('kok mati bot nya', 'maaf, tadi server mati'),
	('bot', 'hi orang'),
	('kok spam sih?', 'maaf, tadi ada keterlambatan jaringan. makanya bot membalas pesan yang belum terkirim itu'),
	('ping', 'pong!'),
	('malam juga', 'makasiii'),
	('masa depan apa?', 'masa depan kehidupan'),
	('oke oke.....', 'sippp'),
	('gpp kok....wkwk', 'wkwkwk'),
	('silahkan simpan aja', 'okeee'),
	('ngebug', 'maaf juga'),
	('lah...umat lagi kan', 'maaf....'),
	('hm....', 'hmmmmm'),
	('lah...', 'kenapa?'),
	('engga', 'ya dicocokin lah'),
	('bentar', 'oke'),
	('ada bugs lagi', 'maaf atas ketidaknyamannya'),
	('ga bisa diem', 'maaf'),
	('kaga mempan', 'maaf'),
	('jirr... ga bisa di stop', 'maaf atas errornya yaa'),
	('baik dong', 'wah...sehat selalu yaaa'),
	('aamiin', 'Aamin juga.....'),
	('iya....hehe', 'wkwk'),
	('maksudnya?', 'ya positif thinking gitu'),
	('masa sih? perasaan bisa aja', 'iya...kamu itu lucu'),
	('aku lapar', 'Makan yuk...aku traktir'),
	('aku lapar banget', 'Makan yuk...aku traktir...wkwk'),
	('aku laper banget', 'Makan yuk...aku traktir...wkwk'),
	('aku laper banget lah', 'Makan yuk...aku traktir...wkwk'),
	('bawaain makanan dong', 'mau?'),
	('minta makan dong', 'aku ngga bisa masak...wkwk'),
	('pliss', 'hm'),
	('gw laper nih', 'Makan yuk...aku traktir...wkwk'),
	('hai.....', 'hai juga'),
	('pencipta mu siapa', 'Penciptaku adalah @fadhil_riyanto'),
	('pencipta mu siapa?', 'Penciptaku adalah @fadhil_riyanto'),
	('penciptamu siapa?', 'Penciptaku adalah @fadhil_riyanto'),
	('penciptamu siapa', 'Penciptaku adalah @fadhil_riyanto'),
	('kamu dibuat pakai apa?', 'Bahasa pemrograman PHP'),
	('kamu dibuat pakai apa', 'Bahasa pemrograman PHP'),
	('kamu dibuat pakai apa sih?', 'Bahasa pemrograman PHP'),
	('assalamualaikum', 'Wa\'alaikumussalam'),
	('assalamualaikum.', 'Wa\'alaikumussalam'),
	('assalamualaikum..', 'Wa\'alaikumussalam'),
	('assalamualaikum...', 'Wa\'alaikumussalam'),
	('assalamualaikum....', 'Wa\'alaikumussalam'),
	('assalamualaikum.....', 'Wa\'alaikumussalam'),
	('assalamualaikum......', 'Wa\'alaikumussalam'),
	('assalamualaikum.......', 'Wa\'alaikumussalam'),
	('samlengkom', 'Wa\'alaikumussalam'),
	('perbendaharaan apa maksudnya -', 'maksudnya kita menyimpan kata kata agar bot lebih pintar lagi. kayak otak manusia gitu'),
	('botnya jelek', 'maaf '),
	('botnya sering error', 'maaf jika sering error'),
	('error', 'maaf'),
	('error botnya', 'maaf'),
	('ga bisa jalan', 'ini bisa'),
	('keluar kata kata perbendaharaan terus', 'maaf'),
	('aneh bye', 'mohon maaf'),
	('null apaan?', 'null itu data yang kami simpan dan belum disetujui admin. jadi sementara akan bernilai null (kosong)'),
	('buruk', 'Maaf'),
	('silahkan disimpan', 'okee'),
	('ngga cocok...', 'Maaf'),
	('ngga cocok..', 'Maaf'),
	('ngga cocok.', 'Maaf'),
	('ngga cocok.....', 'Maaf'),
	('yo', 'okey'),
	('yoi', 'ashiapp'),
	('gppp kok', 'okeee'),
	('gppp kok ...', 'okeee...'),
	('gpp kok', 'okee...'),
	('gpp kok..', 'oke'),
	('gppp koq', 'oke oke'),
	('okhe', 'Sipp'),
	('okhee', 'Sipp'),
	('sippp', 'ok'),
	('sipppp', 'ok'),
	('sipppps', 'ok'),
	('sippppppp', 'ok'),
	('ko', 'ok'),
	('tolong saya', 'kenapa?'),
	('tolong sy', 'kenapa?'),
	('baik banget', 'makasi'),
	('okey', 'sipp'),
	('okeys', 'sipp..'),
	('okeyy', 'sipp...'),
	('okeeeyy', 'sipp....'),
	('okeeyy', 'sipp....'),
	('', 'Hai, saya Bot Fadhil Riyanto. kamu bisa tanya apa aja. karena apa? karena aku dibuat menggunakan AI'),
	('jelek', 'maaf'),
	('okeeee', 'sipp'),
	('yowes', 'Oke'),
	('thinking apaan?', 'Berpikir positif'),
	('perbendaharaan maksudnya?', 'kita menyimpan kata kata agar bot lebih pintar. mirip otak pada manusia'),
	('Surya kenapa?', 'entah tu keyboardnya'),
	('ngetes doang', 'oke....'),
	('ngetes', 'oke'),
	('surya kebapa?', 'entah tu'),
	('null itu apa', 'null itu data yang kami simpan dan belum disetujui admin. jadi sementara akan bernilai null (kosong)'),
	('null apaan', 'null itu data yang kami simpan dan belum disetujui admin. jadi sementara akan bernilai null (kosong)'),
	('null itu apa', 'null itu data yang kami simpan dan belum disetujui admin. jadi sementara akan bernilai null (kosong)'),
	('kharina mana', 'lagi belajar'),
	('surya mana', 'entah tu...hehe'),
	('ngga null?', 'hehe..karena data udah disetujui oleh admin. makanya yg keluar bukan null lagi'),
	('masa sih ;v', 'iya'),
	('iya, jangan diulangi lagi yaa', 'iyaa'),
	('tes pesan', 'yuuu'),
	('lha kamu', 'Sama, saya baik baik saja'),
	('lha kamu?', 'Sama, saya baik baik saja'),
	('lha kamu gimana?', 'Sama, saya baik baik saja'),
	('lha kamu gimana', 'Sama, saya baik baik saja'),
	('lha kamu gimana ik', 'hmmm...'),
	('lha kamu gimana ik?', 'hmmm...'),
	('lha kamu gimana.', 'hmmm...'),
	('lha kamu gimana..', 'hmmm...'),
	('lha kamu gimana...', 'hmmm...'),
	('lha kamu gimana....', 'hmmm...'),
	('lha kamu gimana.....', 'hmmm...'),
	('lha kamu gimana......', 'hmmm...'),
	('buruk ik', 'maaf'),
	('hey bot', 'ga pa pa'),
	('kamu kenapa', 'ga pa pa'),
	('kamu kenapa?', 'ga pa pa'),
	('kamu kenapa??', 'ga pa pa'),
	('kamu kenapa???', 'ga pa pa'),
	('kamu kenapa????', 'ga pa pa'),
	('kamu kenapa.', 'ga pa pa'),
	('kamu kenapa..', 'ga pa pa'),
	('kamu kenapa...', 'ga pa pa'),
	('hmmmm', 'hmmmmmmm'),
	('hmm', 'hem'),
	('maksudnya', 'hm'),
	('mmmmmmm', 'kenapa?'),
	('apa kamu benci kpop', 'iyaa'),
	('apa kamu benci kpop?', 'iya'),
	('apakah kamu benci kpop?', 'iya....'),
	('info admin', 'buka command /info'),
	('apakah kamu benci kpop', 'iya'),
	('kamu benci kpop', 'iya'),
	('saya benci kpop', 'saya juga'),
	('yah', 'hehe'),
	('surya mana?', 'entah .. ga tahu'),
	('naufal mana', 'entah tu'),
	('hau', 'maaf, saya tidak paham'),
	('ahaaa', 'wkwk'),
	('hahah', 'wkwk'),
	('l0l', 'hem');
/*!40000 ALTER TABLE `data_ai` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;