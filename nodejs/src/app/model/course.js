// const mongoose = require('mongoose');

// const Schema = mongoose.Schema;

// const user = new Schema({
//   email: String,
//   password: String,
// });

// module.exports = mongoose.model('user', user);
// userModel.js
const db = require('../../config/db'); // Sử dụng kết nối từ config.js

// Tạo người dùng mới
const createUser = (email, password, callback) => {
  const query = 'INSERT INTO users (email, password) VALUES (?, ?)';
  db.execute(query, [email, password], (err, result) => {
    if (err) {
      return callback(err);
    }
    callback(null, result);
  });
};

// Kiểm tra người dùng theo email
const getUserByEmail = (email, callback) => {
  const query = 'SELECT * FROM users WHERE email = ?';
  db.execute(query, [email], (err, result) => {
    if (err) {
      return callback(err);
    }
    callback(null, result);
  });
};

module.exports = { createUser, getUserByEmail };
