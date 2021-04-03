const {spawn} = require('child_process')
const fs = require('fs')

function menulis (ctx, ditulis){
  const kuTulis = ditulis
  const panjangKalimat = kuTulis.replace(/(\S+\s*){1,10}/g, '$&\n')
  let Textpanjang = ''
  var ngupas = ""
  lengthtext = 1
  for (var i = 0; i < panjangKalimat.length; i++) {
    if (i == 55 * lengthtext) {
      Textpanjang += '\n'
      lengthtext++
      Textpanjang += panjangKalimat[i]
    } else {
      Textpanjang += panjangKalimat[i]
    }
  }
  spawn('convert', [
                './nulis/hasil.jpg',
                '-font',
                './nulis/font.ttf',
                '-size',
                '1024x784',
                '-pointsize',
                '20',
                '-interline-spacing',
                '-7.5',
                '-annotate',
                '+344+142',
                "OkOkOk",
                './nulis/nulis.jpg'
            ])
  .on("error", (e)=>{
    console.log(e)
  })
  .on('exit', () => {
      fs.createReadStream('./nulis/hasil.jpg')    
    })
}
