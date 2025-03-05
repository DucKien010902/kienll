const express = require('express');
const route = express.Router();
const newcontroller = require('../app/controllers/newController');
route.post('/check', newcontroller.check);
route.post('/creat', newcontroller.creat);
route.get('/profile', newcontroller.profile);
module.exports = route;
// export default route;
