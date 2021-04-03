require('dotenv');
const { MongoClient } = require('mongodb');

function sambung(uri) {
  const client = new MongoClient(uri, {
    useUnifiedTopology: true
  });
  return client;
}
class db {
  constructor(uri) {
    this.uri = uri;
  }

  async putus() {
    const client = sambung(this.uri)
    await client.close()
  }

  async tambahPengguna(id, nama, username) {
    const client = sambung(this.uri);
    await client.connect();
    var database = client.db('userDB');
    const userDB = database.collection('userDB');
    const user = {
      user_id: Number(id),
      name: String(nama),
      username: String(username)
    };
    try {
      var data = await userDB.insert(user);
      console.log(data);
    } catch (e) {
      console.log(e);
    }
  }

  async users() {
    try {
      const client = sambung(this.uri);
      await client.connect();
      var database = client.db('userDB');
      const userDB = database.collection('userDB');
      var init = await userDB.find({});
      var hasil = await init.toArray();
      return hasil;
    } catch (e) {
      console.log(e);
    }
  }
}

exports.db = db;
