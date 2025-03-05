class NewController {
  index(req, res) {
    res.send('<h1>ANH YEU EM</h1>');
  }
  love(req, res) {
    const numtext = req.query.num;
    const num = Number(numtext);
    const result = num + 7;
    return res.status(200).json({ message: result });
    //res.send('thu anh');
  }
}
module.exports = new NewController();
