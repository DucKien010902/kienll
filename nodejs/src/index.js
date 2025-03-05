const express = require('express');
// import express from 'express';
// const exphbs = require('express-handlebars');
const path = require('path');
const app = express();

// const db = require('./config/db/index');
// db.connect();

app.use(express.static(path.join(__dirname, 'public')));
app.use(
  express.urlencoded({
    extended: true,
  })
);
app.use(express.json());
// app.engine('handlebars', exphbs.engine());
// app.set('view engine', 'handlebars');
// app.set('views', 'src/resource/views');

const route = require('./routes/index');
route(app);
app.listen(5000, '0.0.0.0');
