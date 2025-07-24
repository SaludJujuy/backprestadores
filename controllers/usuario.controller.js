const Usuario = require('../models/usuario');
const UsuarioCtrl = {}
usuarioCtrl.getUsuarios = async (req, res) => {
    usuarios = await Usuario.find();
    res.json(usuarios);
}

usuarioCtrl.loginUsuario = async (req, res)=>{
    const criteria = {
        usuario: req.body.usuario,
        password: req.body.password
    }
    Usuario.findOne(criteria, function (err, user) {
        if (err) {
            res.json({
                status: 0,
                message: 'error'
            })
        };
        if (!user) {
            res.json({
                status: 0,
                message: "not found"
            })
        }else {
            res.json({
                status: 1,
                message: "success",
                usuario: user.usuario,
                perfil: user.perfil
            });
        };
        
    })
}