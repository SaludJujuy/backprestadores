const { validationResult } = require('express-validator');
exports.signup = async(req,res,next)=>{
    const errros = validationResult(req);
    if(error.isEmpty()){
        
    }
}