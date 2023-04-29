const express = require('express');
const router = express.Router();
const { initializeApp } = require('firebase/app');
const { getAuth, createUserWithEmailAndPassword, signInWithEmailAndPassword } = require('firebase/auth');

const firebaseConfig = {
  apiKey: "AIzaSyD5xjLl3K9zvHvEMsRFnN2SUuff8kVeQFM",
  authDomain: "hawkhack2023.firebaseapp.com",
  projectId: "hawkhack2023",
  storageBucket: "hawkhack2023.appspot.com",
  messagingSenderId: "524994973236",
  appId: "1:524994973236:web:7eb68e4784a1caaad74461",
  measurementId: "G-8JEBX41S7G"
};

const app = initializeApp(firebaseConfig);
const auth = getAuth(app);

// Register endpoint
router.post('/register', (req, res) => {
  const { email, password } = req.body;
  createUserWithEmailAndPassword(auth, email, password)
    .then(userCredential => {
      // User registered successfully
      const user = userCredential.user;
      res.send(user);
    })
    .catch(error => {
      // Registration failed
      const errorCode = error.code;
      const errorMessage = error.message;
      res.status(400).send({ errorCode, errorMessage });
    });
});

// Login endpoint
router.post('/login', (req, res) => {
  const { email, password } = req.body;
  signInWithEmailAndPassword(auth, email, password)
    .then(userCredential => {
      // User logged in successfully
      const user = userCredential.user;
      res.send(user);
    })
    .catch(error => {
      // Login failed
      const errorCode = error.code;
      const errorMessage = error.message;
      res.status(400).send({ errorCode, errorMessage });
    });
});

module.exports = router;
