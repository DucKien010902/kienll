const { createUser, getUserByEmail } = require('../model/course');

class NewController {
  index(req, res) {
    user
      .findOne({ email: 'kienn8438@gmail.com' })
      .lean()
      .then(function (user) {
        res.send(typeof user.password);
      })
      .catch(function () {
        res.status(400).json({ error: 'ERROR' });
      });
    //        res.render('new')
  }
  check(req, res) {
    const { email, password } = req.body; // Lấy email và password từ body

    // Kiểm tra nếu thiếu thông tin
    if (!email || !password) {
      return res
        .status(400)
        .json({ message: 'Email and password are required' });
    }

    // Tìm người dùng trong cơ sở dữ liệu theo email
    getUserByEmail(email, (err, foundUser) => {
      if (err) {
        return res.status(500).json({ error: 'Database error' });
      }

      if (!foundUser) {
        // Nếu không tìm thấy người dùng
        return res.status(404).json({ message: 'Account not found' });
      }
      // So sánh mật khẩu (Nếu mật khẩu là plain-text)
      else {
        if (foundUser[0].password == password) {
          // Nếu mật khẩu khớp
          return res.status(200).json({ message: 'Account found' });
        } else {
          // Nếu mật khẩu không khớp
          return res.status(401).json({ message: 'Invalid password' });
        }
      }
    });
  }
  creat(req, res) {
    const { email, password } = req.body;

    // Kiểm tra email đã tồn tại
    getUserByEmail(email, (err, result) => {
      if (err) {
        return res.status(500).send('Lỗi hệ thống');
      }

      if (result.length > 0) {
        return res.status(400).send('Email đã tồn tại');
      }

      // Nếu chưa có email, tạo mới người dùng
      createUser(email, password, (err, result) => {
        if (err) {
          return res.status(500).send('Lỗi khi tạo tài khoản');
        }
        return res.status(201).send('Tạo tài khoản thành công');
      });
    });
  }
  profile(req, res) {
    const email = req.query.email;
    getUserByEmail(email, (err, foundUser) => {
      if (err) {
        return res.status(500).json({ error: 'Database error' });
      } else {
        return res.status(200).json(foundUser[0]);
      }
    });
  }
}
module.exports = new NewController();
