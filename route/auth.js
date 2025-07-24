const express = require('express');

const {body} = require('express-validator');

const router = express.Router();

const User = require('../models/usuario');

router.post(
    '/signup',
    [
        body('Nombre').trim().not().isEmpty()
        .custom(async(nombre)=>{
            const user = await User.find(nombre);
            if(user[0].length > 0){
                return Promise.reject("user exist");
            }
        }),
        body('password').trim().isLength({min: 2})
    ], authController.signup
)

module.exports = router;