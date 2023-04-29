const express = require('express');
const colors = require('colors');
const app = express();

const Auth = require('./routes/auth');

const POST = 3001;

app.use(express.json());
app.use('/auth', Auth);

app.use('/', (req, res) => {
  res.send({ping: "pong"});
});

app.listen(POST, () => {
  console.log(`Server started on http://localhost:${POST}`.blue);
});
