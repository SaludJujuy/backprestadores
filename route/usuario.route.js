const express = require('express');
const router = express.Router();
const usuarioCtrl = require('../controllers/usuario.controller');

router.get('/usuarios', usuarioCtrl.getUsuarios);

module.exports = router;