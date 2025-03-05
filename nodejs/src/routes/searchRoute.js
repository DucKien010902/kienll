const express = require('express');
const route = express.Router();
const searchcontroller = require('../app/controllers/searchController');
route.get('/duckien', searchcontroller.love);
route.get('/', searchcontroller.index);
module.exports = route;
