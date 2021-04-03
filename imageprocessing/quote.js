const fetch = require('node-fetch')
const { utils } = require('./fungsi/fungsi.js')
const translate = require('@vitalets/google-translate-api');
const fs = require('fs')

async function quote() {
  try {
    var url = "https://quotes.cwprojects.live/random"
    let database = JSON.parse(fs.readFileSync("./quote.json", "utf8"))
    let save = () => {
      fs.writeFileSync("./quote.json", JSON.stringify(database, null, 2))
    }
    var oks = []
    for (var b = 0; b < database.quote.length; b++) {
      oks.push(database.quote.id[b].text)
    }
    var cek = []
    for (var a = 0; a < 5; a++) {

      var iu = await fetch(url)
      var hai = await iu.json()
      var ok = {
        author: String(hai.author), text: String(hai.text)
      }
      cek.push(ok)
      await utils.sleep(100)
    }
    //console.log('work')
    cek.forEach(async (e, i) => {
      var teks = e.text.split('―')
      var hasil = teks[0].trim()
      var author = e.author
      var teks2 = oks[i]
      var ok = {
        by: String(author), quote: String(hasil)
      }
      if (teks !== teks2) {
        database.quote.id.push(ok)
        save()
      }
    })
    console.log("Selesai")
  } catch (e) {
    console.log("gagagl")
  }
}

(async () => {
  for (var x = 0; x < 40; x++) {
    await quote()
  }
})()