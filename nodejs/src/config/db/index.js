// // config.js
const mysql = require('mysql2');

// Tạo kết nối duy nhất
const db = mysql.createConnection({
  host: 'localhost',
  user: 'root', // Thông tin kết nối của bạn
  password: '', // Mật khẩu MySQL của bạn
  database: 'app', // Tên database của bạn
});

// Kiểm tra kết nối chỉ một lần khi ứng dụng bắt đầu
db.connect((err) => {
  if (err) {
    console.error('Lỗi kết nối:', err.message);
    process.exit(1); // Dừng ứng dụng nếu kết nối thất bại
  }
  console.log('Kết nối MySQL thành công!');
});

// Export kết nối để sử dụng ở các file khác
module.exports = db;
