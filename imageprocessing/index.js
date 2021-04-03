require('dotenv');
const afk = require('./fungsi/afk.js');
var _afk = require('./fungsi/afk.json');
const { Telegraf } = require('telegraf');
const axios = require('axios');
const updateLogger = require('telegraf-update-logger');
const { Extra } = require('telegraf');
const os = require('os');
const moment = require(`moment-timezone`);
const speed = require(`performance-now`);
const fetch = require('node-fetch');
const tg = require('./fungsi/fungsi.js');
const fs = require('fs');
const {
	cariBrainly,
	prosesPesan,
	prosesTextMaker
} = require('./fungsi/prosesPesan.js');
const telegraph = require('telegraph-node');
const ytdl = require('ytdl-core');
const https = require('https');
const cheerio = require('cheerio');
const translate = require('@vitalets/google-translate-api');
let Utilities = tg.utils;
const Database = require('@replit/database');
const { getTextOCR } = require('./ocr/ocr.js');
const FormData = require('form-data');
const { textMaker } = require('./fungsi/textmaker.js');
const request = require('request');
const { db } = require('./mongo.js');
const database = new db(process.env.MONGO_URI);

// Load File

/* Bot */
const tele = new telegraph(
	'f2910040a7cb377ac7b5e933a6c44663d6c7c2eb146362300f3a9f5879ba',
	'Mencoba'
);
let { quote } = JSON.parse(fs.readFileSync('./quote.json', 'utf-8'));
const bot = new Telegraf(process.env.TOKEN_BOT);
const form = new FormData();
const tempat_boleh = [-1001310420564, -1001182246595, -1001209274058];
var quotes = quote.id;
/* Log Fungtion */
bot.use(async (ctx, next)=>{
  if(ctx.update.message){
   var msg = ctx.update.message 
   var check = afk.checkAfkUser(msg.from.id)
   if(msg.chat.type != 'private'){ 
     var pesans = ["Hai kawan, akhirnya kembali juga..", "Ngapiin balik? lebih baik hilang aja selamanya kalo gini :v", "Kamu kembali karena akukan?", "Jangan hilang lagi!! ok?", "Kamu kembali tapi sad, aku gak rindu muka jelekmu whahahah"]
     var pesan = pesans[Math.floor(Math.random()*pesans.length)]
     if(check){
     var posisi = Number(afk.getAfkPosition(msg.from.id))
     afk.unAfkUser(posisi)
     var dasar = await ctx.reply(pesan, {reply_to_message_id : msg.message_id})
     await Utilities.sleep(3000)
     ctx.deleteMessage(dasar.message_id)
   }
  if(msg.entities){
    var awal1 = []
    var ok = msg.entities
    ok.forEach((e)=>{
      var ty = e.type
     var aw = e.offset
     var ak = Number(e.length)+Number(aw)
      if(ty === "mention"){
      awal1.push(msg.text.substring(aw, ak).replace(/@/g, ''))
}

    })
    var uwu = false
    var tulis = ''
    awal1.forEach((e)=>{
    var aespa = afk.checkAfkUser(false, e)
    if(aespa){
      uwu = true
      tulis += afk.getAfkReason(false, e)
    }
    })
  }
  var reply_aja = false
  if(msg.reply_to_message){
  reply_aja = true
  }
    if(uwu||reply_aja){
      if(reply_aja){
  if(!afk.checkAfkUser(msg.reply_to_message.from.id)){
    return next()
      }
    if(!uwu){
        tulis = afk.getAfkReason(msg.reply_to_message.from.id)
      }
      }
      
      ctx.reply("User yg anda cari sedang menghilang ._.\nPesan terakhir : "+tulis, {reply_to_message_id : msg.message_id})
    }
  
  }
}

  next()
})

/* function */

bot.command('hilang', async ctx => {
	var msg = ctx.update.message;
	var reason = msg.text.split(' ');
	var alasan = [];
	if (reason.length < 2) var coba = true;
	for (var a = 1; a < reason.length; a++) {
		alasan.push(reason[a]);
	}
	var alasan = alasan.join(' ');
  var nama = msg.from.first_name
  if(msg.from.last_name) nama += ' '+msg.from.last_name
	var id = msg.from.id;
	var time = new Date().getHours();
	var cek = afk.checkAfkUser(id, _afk);
  var uname = msg.from.username
  if(!uname) uname = false
	if (!cek) {
    if(coba){
      ctx.reply('<a href="tg://user?id='+id+'">'+nama+'</a> menghilang tanpa alasan, pasti <a href="tg://user?id='+id+'">'+nama+'</a> sangat frustasi ::))', {reply_to_message_id : msg.message_id, parse_mode : 'HTML'})
      return afk.addAfkUser(id, time, false, uname)
    }else if(!coba){
		afk.addAfkUser(id, time, alasan, uname);
		return ctx.reply('<a href="tg://user?id='+id+'">'+nama+'</a> sedang menghilang!!, Dia meninggalkan pesan terakhir kepada saya,\n"'+ alasan+'" ~ <a href="tg://user?id='+id+'">'+nama+'</a>', {reply_to_message_id : msg.message_id, parse_mode : 'HTML'})
    }
	}
});


bot.command('quote_acak', async ctx => {
	var quote = quotes[Math.floor(Math.random() * quotes.length)];
	var pesan = 'Quote bahasa english :\n\n';
	var by = quote.by;
	var init = quote.quote;
	pesan += `${init}
  
~> ${by}
`;
	ctx.reply(pesan);
});

bot.use(async (ctx, next) => {
	var msg = ctx.update.message;
	if (msg) {
		if (!tempat_boleh.includes(msg.chat.id)) {
			if (msg.chat.type !== 'private') {
				var pesan = `Maaf, saya bukanlah bot yang digunakan untuk grup....
Jika anda tetap ingin memasukan saya ke sebuah grup, coba bicara kepada saya secara private mungkin owner saya akan mengijinkannya... Kalo diijinkan nanti dikasi tau ^_^
`;
				ctx.reply(pesan);
				await Utilities.sleep(1000);
				ctx.leaveChat();
			}
		}
	}
	next();
});

bot.action('unmutedirimu', ctx => {
	var msg = ctx.callbackQuery.message;
	var dari = ctx.callbackQuery.from;
	var permisi = {
		can_send_messages: true,
		can_send_media_messages: true,
		can_send_polls: false,
		can_send_other_messages: true,
		can_change_info: false,
		can_pin_messages: false
	};
	ctx.telegram.restrictChatMember(msg.chat.id, dari.id, {
		permissions: permisi
	});
});

bot.command('/meme', ctx => {
	var meme = 'https://telegra.ph/file/a701c74cc69af36bf6014.jpg';
	return ctx.replyWithPhoto(meme);
});

bot.command('/getid', ctx => {
	var msg = ctx.update.message;
	var hasil = '';
	if (msg.chat.type == 'group' || 'supergroup') {
		hasil = `Get Id Command
Id grup : \`${msg.chat.id}\`
Id anda : \`${msg.from.id}\`
`;
	}
	if (msg.chat.type == 'private') {
		hasil = `Get Id Command
Id anda : ${msg.from.id}
`;
	}
	return ctx.reply(hasil, { parse_mode: 'markdown' });
});

function InipesanStart(ctx) {
	let tm = `[<code>${ctx.message.from.first_name}</code>]

❖Saya adalah bot yang bisa membantu loh...
❖Membantu membuat kamu menderita whahhaha
canda...

=> Mau tau apa saja command yang aku miliki??
👇👇Cek Docsku👇👇
`;
	// console.log(ctx)
	ctx.reply(tm, {
		reply_markup: {
			inline_keyboard: [[{ text: 'Docs📚', callback_data: 'menu' }]]
		},
		parse_mode: 'HTML',
		reply_to_message_id: ctx.message.message_id
	});
}

function sendMessageMenu(ctx) {
	const tmenu = `<==𝙋𝙞𝙡𝙞𝙝 𝙢𝙚𝙣𝙪 𝙙𝙤𝙘𝙨 𝙗𝙤𝙩 𝙙𝙞𝙗𝙖𝙬𝙖𝙝 𝙞𝙣𝙞==>
`;
	ctx.editMessageText(tmenu, {
		reply_markup: {
			inline_keyboard: [
				[
					{ text: 'Penolong', callback_data: 'penolong_menu' },
					{ text: 'Text Maker', callback_data: 'textmaker_menu' }
				],
				[
					{ text: 'Stalk', callback_data: 'stalk_menu' },
					{ text: 'Informasi', callback_data: 'info_menu' }
				],
				[{ text: 'Telegram', callback_data: 'telegram_menu' }]
			]
		},
		parse_mode: 'Markdown'
	});
}

/* Command */

bot.command('tod', ctx => {
	console.log(JSON.stringify(ctx, null, 2));
});

bot.command('pengguna', async ctx => {
	var pesan = 'Tekan tombol untuk mengetahui pengguna bot ^_^';
	var keypad = {
		inline_keyboard: [[{ text: '👥Pengguna Bot👥', callback_data: 'pengguna' }]]
	};
	ctx.reply(pesan, {
		reply_to_message_id: ctx.message.message_id,
		reply_markup: keypad
	});
});

bot.action('pengguna', async ctx => {
	var user = await database.users();
	return ctx.answerCbQuery('Pengguna bot ini ada ' + user.length, {
		show_alert: true
	});
});

bot.action('menu', ctx => {
	var cb = ctx.update.callback_query;
	var msg = cb.message;
	var dari = cb.from;
	if (dari.id != msg.reply_to_message.from.id) {
		ctx.answerCbQuery('Tombol ini bukan untuk anda...', { show_alert: true });
	} else sendMessageMenu(ctx);
});

bot.action('Tunggu', ctx => {
	ctx.answerCbQuery('Tunggu aja~', { show_alert: true });
});

bot.command('ping', ctx => {
	const timestamp = speed();
	const latensi = speed() - timestamp;
	const tutid = moment().millisecond();
	var pesan = `<b>(*_*)Pong Spesifikasi(*_*)</b>
📶Ping Bot = <i>${tutid} MS</i>
🏎Speed Bot = <i>${latensi.toFixed(3)}</i> Second
`;
	var adv = {};
	adv.parse_mode = 'HTML';
	ctx.reply(pesan, adv);
});

bot.command('daftar', async ctx => {
	try {
		if (ctx.message.chat.type != 'private') return false;
		var inti = ctx.message.from;
		var user = await database.users();
		var id = [];
		for (var a = 0; a < user.length; a++) {
			id.push(user[a].user_id);
		}
		if (!id.includes(inti.id)) {
			database.tambahPengguna(inti.id, inti.first_name, inti.username);
			ctx.reply('Anda Berhasil terdaftar!', {
				reply_to_message_id: ctx.message.message_id
			});
		} else
			ctx.reply('Anda sudar terdaftar!', {
				reply_to_message_id: ctx.message.message_id
			});
	} catch (e) {
		console.log(e);
	}
});

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

bot.telegram.leaveChat('-1001498192621');

/*async function autojawab(text){
  var url = 'https://sudarapi.herokuapp.com/simsimi?text='+String(text)
  var init = await fetch(url)
  var hasil = await init.json()
  return hasil.response
}*/

bot
	.use(async (ctx, next) => {
		try {
			var sudo = [1349919799];
			if (ctx.update.message) {
				/*if(ctx.message.reply_to_message){
        if(ctx.message.reply_to_message.from.id === 1651244392){
        if('text' in ctx.message){
        var hasil = await autojawab(ctx.message.text)
        if(hasil){
        ctx.reply(hasil, {reply_to_message_id : ctx.message.message_id})
        }
        }
      }
    }*/
				/*var inti = ctx.message.from
     var user = await database.users()
     var id = []
     for(var a =0;a < user.length;a++){
     id.push(user[a].user_id)
     }*/
				if (!sudo.includes(ctx.message.from.id)) {
					if (ctx.message.chat.type == 'private') {
						if (ctx.message.text) {
							/*if(!id.includes(inti.id)){
    return ctx.reply('Anda Belum terdaftar silakan kirim /daftar ke saya secara pribadi ya!!!!!', {reply_to_message_id : ctx.message.message_id})
          }*/
							ctx.telegram.sendMessage(
								-1001224010431,
								'<a href="tg://user?id=' +
									ctx.from.id +
									'">' +
									ctx.from.first_name +
									'</a> mengatakan: ' +
									ctx.message.text,
								{ parse_mode: 'HTML' }
							);
						}
					}
				}
			}

			next();
		} catch (e) {
			next();
		}
	})
	.catch(e => console.log(e));

//////////
bot.action('telegram_menu', ctx => {
	var pesan = `<==𝙏𝙀𝙇𝙀𝙂𝙍𝘼𝙈 𝙈𝙀𝙉𝙐==>
➪ /getadmin (username grup)
➪ /tofoto
`;
	var keypad = {
		inline_keyboard: [[{ text: '🔙Back', callback_data: 'menu' }]]
	};
	ctx.editMessageText(pesan, { reply_markup: keypad });
});

bot.action('penolong_menu', ctx => {
	var pesan = `<==𝙋𝙀𝙉𝙊𝙇𝙊𝙉𝙂 𝙈𝙀𝙉𝙐==>
➪ /tr (private only)
➪ /short
➪ /ocr
➪ /deldog
➪ /tgupload
`;
	var keypad = {
		inline_keyboard: [[{ text: '🔙Back', callback_data: 'menu' }]]
	};
	ctx.editMessageText(pesan, { reply_markup: keypad });
});

bot.action('textmaker_menu', ctx => {
	var pesan = `<==𝙏𝙀𝙓𝙏 𝙈𝘼𝙆𝙀𝙍 𝙈𝙀𝙉𝙐==>
➪ /px
`;
	var keypad = {
		inline_keyboard: [[{ text: '🔙Back', callback_data: 'menu' }]]
	};
	ctx.editMessageText(pesan, { reply_markup: keypad });
});

bot.action('info_menu', ctx => {
	var pesan = `<==𝙄𝙉𝙁𝙊𝙍𝙈𝘼𝙎𝙄 𝙈𝙀𝙉𝙐==>
➪ /corona
`;
	var keypad = {
		inline_keyboard: [[{ text: '🔙Back', callback_data: 'menu' }]]
	};
	ctx.editMessageText(pesan, { reply_markup: keypad });
});

bot.action('stalk_menu', ctx => {
	var pesan = `<==𝙎𝙏𝘼𝙇𝙆 𝙈𝙀𝙉𝙐==>
➪ /insta_p
`;
	var keypad = {
		inline_keyboard: [[{ text: '🔙Back', callback_data: 'menu' }]]
	};
	ctx.editMessageText(pesan, { reply_markup: keypad });
});

//////////

bot.start(async ctx => {
	if (/^\/start((@TembakSajaBot)?)$/i.exec(ctx.message.text))
		if (ctx.message.chat.type != 'private') return false;
	return InipesanStart(ctx);
});

var adv = {};

bot.command('getadmin', async ctx => {
	var msg = ctx.message;
	var teks = msg.text;
	var coba = teks.split(/^\/getadmin\s+/i);
	var crt = '👑Creator grup👑 : ';
	var adm = '👮‍♂️Admin grup👮‍♂️ : ';
	try {
		var tempat = coba[1];
		if (!/^@/g.exec(tempat)) tempat = '@' + coba[1];
		if (coba.length < 2 && msg.chat.type != 'private') tempat = msg.chat.id;
		if (!tempat) return false;
		var pencarian = await ctx.telegram.getChatAdministrators(String(tempat));
		pencarian.forEach(o => {
			var status = o.status;
			var user = o.user;
			var id = user.id;
			var nama1 = user.first_name;
			var nama2 = user.last_name;
			var nama = nama1;
			if (nama2) {
				nama = nama1 + ' ' + nama2;
			}
			var mention =
				'<a href="tg://user?id=' +
				id +
				'">' +
				Utilities.clearHTML(nama) +
				'</a>';
			if (o.custom_title) {
				mention += ' [' + Utilities.clearHTML(o.custom_title) + ']';
			}
			if (/^creator$/i.exec(status)) {
				crt += '\n' + mention;
			} else if (/^administrator$/i.exec(status)) {
				adm += '\n⤷' + mention;
			}
		});
		var pesan = crt + '\n\n' + adm;
		ctx.reply(pesan, {
			parse_mode: 'html',
			reply_to_message_id: ctx.message.message_id
		});
	} catch (e) {
		ctx.reply('Tidak ditemukan grup atau mungkin terjadi kesalahan sistem', {
			parse_mode: 'html',
			reply_to_message_id: ctx.message.message_id
		});
	}
});

bot.command('deldog', async ctx => {
	var msg = ctx.message;
	var msgr = msg.reply_to_message;
	if (/^\/deldog((@TembakSajaBot)?)/i.exec(msg.text) && !msg.reply_to_message) {
		var pesan =
			'Gunakan command ini sambil mereply pesan teks untuk mengirimnya ke deldog';
		return ctx.reply(pesan, { reply_to_message_id: msg.message_id });
	} else {
		let tunggu = await ctx.reply('Menulis ke deldog...', {
			reply_to_message_id: ctx.message.message_id
		});
		var text = msgr.text || msgr.caption;
		var pes = await Utilities.paste(text, true);
		var pesan = `<b>Link Deldog</b> : ${pes.url}
<b>Link Raw</b> : ${pes.raw}

<code>Gak tau masa aktif linknya ampe kapan hehe</code>
`;
		ctx.deleteMessage(tunggu.message_id);
		return ctx.reply(pesan, {
			parse_mode: 'HTML',
			disable_web_page_preview: true
		});
	}
});

bot.command('bitly', async ctx => {
	return ctx.reply(
		'Command ini sedang down sampai waktu yang tidak kuketahui',
		{ reply_to_message_id: ctx.message.message_id }
	);
	if (/^\/bitly((@TembakSajaBot)?)$/i.exec(ctx.update.message.text)) {
		var pesan = 'Coba /bitly (link url) jika ingin menggunakan command ini';
		return ctx.reply(pesan, {
			reply_to_message_id: ctx.update.message.message_id
		});
	} else if (/(^\/bitly((@TembakSajaBot)?))/i.exec(ctx.update.message.text)) {
		if ((cocok = /^\/bitly (.*)/i.exec(ctx.update.message.text))) {
			let tunggu = await ctx.reply('Mencoba mengshort link ....', {
				reply_to_message_id: ctx.message.message_id
			});
			var nyari = cocok[1];
			if (/^https?\:\/\//g.exec(cocok[1])) {
				nyari = cocok[1];
			} else if (!/^https?\:\/\//g.exec(cocok[1])) {
				nyari = 'https://' + cocok[1];
			}
			var url = 'https://afara.my.id/api/bitly-shortener?url=' + String(nyari);
			var you = await fetch(url);
			var results = await you.json();
			var hasil = results.link;
			var awal = results.long_url;
			var jawaban = `🔗Ini adalah hasil short url anda
<b>Short Url</b> : ${hasil}
<b>Long Url</b> : ${awal}
`;
			await tg.utils.sleep(1000);
			ctx.reply(jawaban, {
				parse_mode: 'HTML',
				reply_to_message_id: ctx.update.message.message_id,
				disable_web_page_preview: true
			});
			ctx.deleteMessage(tunggu.message_id);
		}
	}
});

bot.command('short', async ctx => {
	if (/^\/short((@TembakSajaBot)?)$/i.exec(ctx.update.message.text)) {
		var pesan = 'Coba /short (link url) jika ingin menggunakan command ini';
		return ctx.reply(pesan, {
			reply_to_message_id: ctx.update.message.message_id
		});
	} else if (/(^\/short((@TembakSajaBot)?))/i.exec(ctx.update.message.text)) {
		if ((cocok = /^\/short (.*)/i.exec(ctx.update.message.text))) {
			let tunggu = await ctx.reply('Mencoba mengshort link ....', {
				reply_to_message_id: ctx.message.message_id
			});
			var nyari = cocok[1];
			var url =
				'https://sudarapi.herokuapp.com/shortlink/v1?url=' + String(nyari);
			var you = await fetch(url);
			var results = await you.json();
			var hasil = results.short;
			var awal = results.long_url;
			var jawaban = `🔗Ini adalah hasil short url anda
<b>Short Url</b> : ${hasil}
<b>Long Url</b> : ${awal}
`;
			await tg.utils.sleep(1000);
			ctx.reply(jawaban, {
				parse_mode: 'HTML',
				reply_to_message_id: ctx.update.message.message_id,
				disable_web_page_preview: true
			});
			ctx.deleteMessage(tunggu.message_id);
		}
	}
});

async function filePath(ctx, file_id) {
	var init = await ctx.telegram.getFile(file_id);
	var url =
		'https://api.telegram.org/file/bot' +
		process.env.TOKEN_BOT +
		'/' +
		init.file_path;
	return url;
}

bot.command('tofoto', async ctx => {
	if (
		/^\/tofoto((@TembakSajaBot)?)$/i.exec(ctx.message.text) &&
		!ctx.message.reply_to_message
	) {
		var pesan =
			'Silakan gunakan command ini dengan mereply sticker... bot akan mencoba mengubahnya jadi gambar ^_^';
		return ctx.reply(pesan, { reply_to_message_id: ctx.message.message_id });
	}

	if ('sticker' in ctx.message.reply_to_message) {
	  var sticker = ctx.message.reply_to_message.sticker
	  if(sticker.is_animated){
	    return ctx.reply("Sticker yg anda reply adalah sticker animasi!! saya tidak bisa mengubahnya wokwowowk", {reply_to_message_id : ctx.message.message_id})
	  }
		var loading = await ctx.reply('Mengubah..', {
			reply_to_message_id: ctx.message.message_id
		});
		var url = await ctx.telegram.getFileLink(
			ctx.message.reply_to_message.sticker.file_id
		);
		ctx.replyWithPhoto(
			{ url: url },
			{
				caption: 'Sticker -> Foto (jpg)\nby @TembakSajaBot',
				reply_to_message_id: ctx.message.message_id
			}
		);
		return ctx.deleteMessage(loading.message_id);
	}

	if (
		'photo' ||
		'text' ||
		'video' ||
		'video_note' in ctx.message.reply_to_message
	) {
		var pesan = 'Command ini digunakan sambil mereply sticker!!';
		return ctx.reply(pesan, { reply_to_message_id: ctx.message.message_id });
	}
});

bot.command('ocr', async ctx => {
	var arrays = ['1', '2', '3', '4', '5'];
	var angka = arrays[Math.floor(Math.random() * arrays.length)];
	var msg = ctx.update.message;

	if (!ctx.message.reply_to_message) {
		var pesan =
			'Silakan gunakan command ini dengan mereply photo... bot akan mencoba mengubah tulisan pada gambar menjadi pesan.. ^_^';
		return ctx.reply(pesan, { reply_to_message_id: ctx.message.message_id });
	}

	if (msg.reply_to_message) {
		var msgr = msg.reply_to_message;
		if ('photo' in msgr) {
			var tunggu = await ctx.reply('Membaca gambar...', {
				reply_to_message_id: msg.message_id
			});
			var awal = await filePath(ctx, msgr.photo[msgr.photo.length - 1].file_id);
			var dapet = await https.get(awal, async res => {
				let membuat = fs.createWriteStream('./ocr/gambar' + angka + '.jpg');
				res.pipe(membuat);
				membuat.on('finish', async function() {
					var gambar = './ocr/gambar' + angka + '.jpg';
					var hasil = await getTextOCR(gambar);
					var teks = 'Hasil ocr bot ini :\n' + hasil;
					ctx.reply(teks, { reply_to_message_id: msg.message_id });
					ctx.deleteMessage(tunggu.message_id);
					await fs.unlinkSync('./ocr/gambar' + angka + '.jpg');
				});
			});
		} else if ('sticker' || 'text' || 'video' || 'video_note' in msgr) {
			var pesan = 'Command ini digunakan sambil mereply photo/gambar!!';
			return ctx.reply(pesan, { reply_to_message_id: ctx.message.message_id });
		}
	}
});

bot.command('tgupload', async ctx => {
	let tgu = new FormData();
	let urlrumah = 'https://telegra.ph';
	var arrays = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11'];
	var angka = arrays[Math.floor(Math.random() * arrays.length)];
	var msg = ctx.update.message;
	var url = '';

	if (
		/^\/tgupload((@TembakSajaBot)?)$/i.exec(ctx.message.text) &&
		!ctx.message.reply_to_message
	) {
		var pesan =
			'Silakan gunakan command ini dengan mereply photo... bot akan mencoba menguaploadnya ke telegraph gambar ^_^';
		return ctx.reply(pesan, { reply_to_message_id: ctx.message.message_id });
	}

	if (msg.reply_to_message) {
		var msgr = msg.reply_to_message;
		if ('photo' in msgr) {
			if (msgr.photo[msgr.photo.length - 1].file_size <= 5242880) {
				var tunggu = await ctx.reply('Mengupload....', {
					reply_to_message_id: msg.message_id
				});
				var p_id = msgr.photo[msgr.photo.length - 1].file_id;
				url = await filePath(ctx, p_id);
			}
			var dapet = await https.get(url, async res => {
				let membuat = fs.createWriteStream('./upload/file' + angka + '.jpg');
				res.pipe(membuat);
				membuat.on('finish', async function() {
					let jadi = fs.readFileSync('./upload/file' + angka + '.jpg');
					let fileName = 'file' + angka + '.jpg';
					tgu.append('file', jadi, {
						contentType: 'file' + angka + '.jpg',
						name: 'file',
						filename: fileName
					});
					var hasils = await fetch('https://telegra.ph/upload', {
						method: 'POST',
						body: tgu
					});
					var hasil = await hasils.json();
					var pesan = 'Berhasil mengupload photo...';
					pesan += '\n\nHasil upload photo : ' + urlrumah + hasil[0].src;
					ctx.reply(pesan, {
						reply_to_message_id: msg.message_id,
						disable_web_page_preview: true
					});
					await fs.unlinkSync('./upload/file' + angka + '.jpg');
					return ctx.deleteMessage(tunggu.message_id);
				});
			});
		} else if ('sticker' || 'text' || 'video' || 'video_note' in msgr) {
			var pesan = 'Command ini digunakan sambil mereply photo/gambar!!';
			return ctx.reply(pesan, { reply_to_message_id: ctx.message.message_id });
		}
	}
});

bot.command('corona', async ctx => {
	let input = ctx.message.text;
	let inputArray = input.split(' ');
	let message = '';

	if (inputArray.length == 1) {
		var tunggu = await ctx.reply('Menjelajahi infiormasi corona....', {
			reply_to_message_id: ctx.message.message_id
		});
		var url = 'https://sudarapi.herokuapp.com/123/corona';
		var init = await fetch(url);
		var respon = await init.json();
		var kasus = respon.results[0].jumblah;
		var mati = respon.results[1].jumblah;
		var sembuh = respon.results[2].jumblah;
		var messages = `「 Kasus corona yang ada saat ini di Dunia 」
> Jumblah Kasus : <i>${kasus}</i> Jiwa
> Jumlah sembuh : <i>${sembuh}</i> Jiwa
> Jumlah mati : <b>${mati}</b> Jiwa

SUMBER : <a href="https://www.worldometers.info/coronavirus/">Worldometer</a>

<i>Untuk melihat kasus corona ditempat lainnya bisa dicek dengan /corona (negara)</i>
`;
		ctx.reply(messages, { parse_mode: 'HTML', disable_web_page_preview: true });
		ctx.deleteMessage(tunggu.message_id);
	} else {
		var tunggu = await ctx.reply('Menjelajahi infiormasi corona....', {
			reply_to_message_id: ctx.message.message_id
		});
		inputArray.shift();
		messager = inputArray.join(' ');
		var url = 'https://sudarapi.herokuapp.com/123/corona/' + messager;
		var init = await fetch(url);
		var respon = await init.json();
		var kasus = respon.results[0].jumblah;
		var mati = respon.results[1].jumblah;
		var sembuh = respon.results[2].jumblah;
		var messageg = `「 Kasus corona yang ada saat ini di ${respon.negara} 」
> Jumblah Kasus : <i>${kasus}</i> Jiwa
> Jumlah sembuh : <i>${sembuh}</i> Jiwa
> Jumlah mati : <b>${mati}</b> Jiwa

SUMBER : <a href="https://www.worldometers.info/coronavirus/">Worldometer</a>
`;

		ctx.reply(messageg, { parse_mode: 'HTML', disable_web_page_preview: true });
		ctx.deleteMessage(tunggu.message_id);
	}
});

bot.command('contoh', async ctx => {
	let input = ctx.message.text;
	let inputArray = input.split(' ');
	let message = '';

	if (inputArray.length == 1) {
		message = 'masuin text';
		ctx.reply(message);
	} else {
		sendProses(ctx);
		inputArray.shift();
		messager = inputArray.join(' ');
		ctx.reply(messager);
		await tg.utils.sleep(2000);
		ctx.reply('Tersleep');
	}
});

bot.command('nodejs', async ctx => {
	var boleh = [1349919799];
	var msg = ctx.message;
	var test = ctx.telegram;
	var pola = /(^\/nodejs)/i.exec(ctx.message.text);
	var init = ctx.message.text.replace(pola[1], '');
	if (!boleh.includes(ctx.message.from.id)) {
		return false//ctx.reply('Anda tidak diijinkan memakai command ini!!');
	} else {
		try {
			await eval(`(async ()=>{ ${init} })()`);
		} catch (err) {
			ctx.reply(String(err));
		}
	}
});

bot.command('brainly', async ctx => {
	return ctx.reply(
		'Command ini sedang down sampai waktu yang tidak kuketahui',
		{ reply_to_message_id: ctx.message.message_id }
	);
	let pesanhelp = 'Silakan kirim /brainly sambil mereply soal (HARUS TEKS)';
	let pesan = '';
	if (!ctx.message.reply_to_message) {
		ctx.reply(pesanhelp);
	} else if (ctx.message.reply_to_message.text) {
		var tunggu = await ctx.reply('Menjelajahi brainly...', {
			reply_to_message_id: ctx.message.message_id
		});
		pesan = await cariBrainly(ctx.message.reply_to_message.text);
		ctx.reply(pesan, { parse_mode: 'HTML' });
		ctx.deleteMessage(tunggu.message_id);
	}
});

bot.command(
	['px', 'px_naruto', 'px_candy', 'px_grass', 'px_aov'],
	async ctx => {
		return await prosesTextMaker(ctx);
	}
);

bot.command('insta_p', async ctx => {
	var init = ctx.message.text.split(/^\/insta_p\s+@?/i);
	var tunggu = await ctx.reply('Mengambil data....', {
		reply_to_message_id: ctx.message.message_id
	});

	if (init.length < 2) {
		ctx.deleteMessage(tunggu.message_id);
		return ctx.reply(
			'Username tidak ditemukan atau mungkin terjadi error sistem',
			{ reply_to_message_id: ctx.message.message_id }
		);
	}
	try {
		var user = init[1];
		//return ctx.reply(init.length)
		var keypad = {
			inline_keyboard: [
				[{ text: 'Insta ' + user, url: 'https://www.instagram.com/' + user }]
			]
		};
		var pesan = String(await Utilities.igp(user));
		var photo = String(await Utilities.igp(user, true));
		ctx.replyWithPhoto(photo, {
			caption: pesan,
			reply_to_message_id: ctx.message.message_id,
			reply_markup: keypad
		});
		return ctx.deleteMessage(tunggu.message_id);
	} catch (e) {
		ctx.deleteMessage(tunggu.message_id);
		return ctx.reply(
			'Username tidak ditemukan atau mungkin terjadi error sistem',
			{ reply_to_message_id: ctx.message.message_id }
		);
	}
});

bot.command('qua', async ctx => {
	var by = ctx.message.from.first_name;
	var split = ctx.message.text.split(/^\/qua\s+/i);
	if (split.length > 1) split = split[1];
	var url = 'https://index.sudarsanaantara.repl.co/quote?text=';
	if (split) {
		var url = url + split + '::' + by;
	}
	https.get(url);
});

const aud = require('./berytdl.js').ytdl;
bot.command('yta', async ctx => {
	aud.audio(ctx);
});

bot.on('message', async update => {
	var ctx = update;
	var msg = update.message;

	var keypad = [
		[
			{
				text: 'Kode bahasa tersedia',
				url: 'https://telegra.ph/oneGoogleTranslate-02-11'
			}
		]
	];
	if (msg.chat.type === 'private') {
		if (/^[\/!](tr|tl|trans|translate)((@TembakSajaBot)?)$/i.exec(msg.text)) {
			var pesan = `<b>Tutorial translate command</b>
Ada 2 cara menggunakan command ini

Cara 1 : Dengan mereply pesan/caption
-> Reply pesan atau caption
-> Kirim ${msg.text} (code bahasa)
-> Bot akan mencoba translate

Cara 2 : Tanpa reply pesan (Tidak bisa digunakan di caption)
-> Kirim ${msg.text} (code bahasa) (Kalimat)
-> Bot akan mencoba translate

Alias command ini : tr, tl, translate, trans

<i>Note : Maybe translateannya salah :V</i>
`;
			return ctx.reply(pesan, {
				parse_mode: 'HTML',
				reply_markup: {
					inline_keyboard: keypad
				}
			});
		}

		// pola 3
		// format: [REPLY]-> !(tr/tl/trans/translate) (bahasaSumber),(bahasaTujuan)
		var pola = /^[\/!](?:tr|tl|trans|translate) ([\w-]{2,5}),\s*([\w-]{2,5})$/i;
		if ((cocok = pola.exec(msg.text))) {
			// periksa ada reply nya kah
			if (msg.reply_to_message) {
				// sederhanakan variable
				var msgr = msg.reply_to_message;
				// jika yang di reply adalah text
				if (msgr.text) {
					var kalimat = msgr.text;
					var pesans = await translate(kalimat.trim(), {
						from: cocok[1],
						to: cocok[2]
					});
					var pesan = Utilities.clearHTML(pesans.text);
					return ctx.reply('<code>' + pesan + '</code>', {
						parse_mode: 'HTML',
						reply_to_message_id: msgr.message_id
					});
				} else if (msgr.caption) {
					var kalimat = msgr.caption;
					var pesans = await translate(kalimat.trim(), {
						from: cocok[1],
						to: cocok[2]
					});
					var pesan = Utilities.clearHTML(pesans.text);
					return ctx.reply('<code>' + pesan + '</code>', {
						parse_mode: 'HTML',
						reply_to_message_id: msgr.message_id
					});
				}
			}
		}

		// pola 4
		// format: [REPLY]-> !(tr/tl/trans/translate) (bahasaTujuan)
		else var pola = /^[\/!](?:tr|tl|trans|translate) ([\w-]{2,5})$/i;
		if ((cocok = pola.exec(msg.text))) {
			// periksa ada reply nya kah
			if (msg.reply_to_message) {
				// sederhanakan variable
				var msgr = msg.reply_to_message;
				// jika yang di reply adalah text
				if (msgr.text) {
					var kalimat = msgr.text;
					var pesans = await translate(kalimat.trim(), { to: cocok[1] });
					var pesan = Utilities.clearHTML(pesans.text);
					return ctx.reply('<code>' + pesan + '</code>', {
						parse_mode: 'HTML',
						reply_to_message_id: msgr.message_id
					});
				} else if (msgr.caption) {
					var kalimat = msgr.caption;
					var pesans = await translate(kalimat.trim(), { to: cocok[1] });
					var pesan = Utilities.clearHTML(pesans.text);
					return ctx.reply('<code>' + pesan + '</code>', {
						parse_mode: 'HTML',
						reply_to_message_id: msgr.message_id
					});
				}
			}
		}

		// pola 1
		// format: !(tr/tl/trans/translate) (bahasaSumber),(bahasaTujuan) (teks)
		else
			var pola = /^([\/!](tr|tl|trans|translate) ([\w-]{2,5}),\s*([\w-]{2,5}) ).+/i;
		if ((cocok = pola.exec(msg.text))) {
			var kalimat = msg.text.replace(cocok[1], '');
			var pesans = await translate(kalimat.trim(), {
				from: cocok[3],
				to: cocok[4]
			});
			var pesan = Utilities.clearHTML(pesans.text);
			return ctx.reply('<code>' + pesan + '</code>', {
				parse_mode: 'HTML',
				reply_to_message_id: msg.message_id
			});
		}
		// pola 2
		// format: !(tr/tl/trans/translate) (bahasaTujuan) (teks)
		else var pola = /^([\/!](tr|tl|trans|translate) ([\w-]{2,5}) ).+/i;
		if ((cocok = pola.exec(msg.text))) {
			var kalimat = msg.text.replace(cocok[1], '');
			var pesans = await translate(kalimat.trim(), { to: cocok[3] });
			var pesan = Utilities.clearHTML(pesans.text);
			return ctx.reply('<code>' + pesan + '</code>', {
				parse_mode: 'HTML',
				reply_to_message_id: msg.message_id
			});
		}
	}
});

bot.command('tes', async ctx => {
	let input = ctx.message.text;
	const peak = input.trim().substring(input.indexOf(' ') + 1);
	if (peak.length >= 2) {
		const pais = peak.split(`|`)[0];
		const gans = peak.split(`|`)[1];
	}
});
//ctx.reply(`err`)
//Webhook

const express = require('express');
const app = express();
bot.telegram.setWebhook('https://TembakSaja.sudarsanaantara.repl.co');
app.use(bot.webhookCallback('/'));
app.set('title', 'TembakSajaBot');
app.get('title');
app.get('/salam', (req, res) => {
	res.send('Hello World');
});

app.get('/arti-nama', async (req, res) => {
	if (req.query.nama) {
		var url =
			'https://www.primbon.com/arti_nama.php?nama1=' +
			String(req.query.nama) +
			'&proses=+Submit%21+';
		var init = await fetch(url);
		var json = await init.text();
		var $ = cheerio.load(json);
		var inist = $('#body').html();
		var sp = json.split('<div id="body" class="width">');
		var sp1 = sp[1].split('<TABLE>');
		var hpsbr = sp1[0]
			.replace(/[<]br[^>]*[>]/gi, '')
			.replace(/\n+/g, '')
			.replace(/\s\s+/g, '')
			.replace(/[<\/]b[^>]*[>]/gi, '')
			.replace(/[<\/]i[^>]*[>]/gi, '')
			.replace(/[<]b[^>]*[>]/gi, '')
			.replace(/[<]i[^>]*[>]/gi, '')
			.replace(/ARTI NAMA/, '');
		var hps = hpsbr.replace('<!-- BEGIN: CONTENT -->', '');
		var hasil = hps.split('arti: ');
		res.send({ nama: String(req.query.nama), arti_nama: hasil[1] });
	}
});

app.get('/upload', async (req, res) => {
	const Uploader = require('imgbb-uploader');
	var coba = await Uploader({
		apiKey: '1d5cc1ebdc56b764a01da4156545433a',
		imagePath: './ocr/gambar4.jpg',
		name: 'tes.png'
	});
	res.send(coba);
});

//kode bot kamu
app.listen(process.env.PORT);
