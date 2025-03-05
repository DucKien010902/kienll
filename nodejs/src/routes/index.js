const New = require('./newRoute');
// import New from './newRoute';
const Search = require('./searchRoute');
function route(app) {
  app.use('/new', New);

  app.use('/search', Search);
}
module.exports = route;
