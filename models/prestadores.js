const db = require('../util/database');

module.exports = class Prestadores{
    constructor(idPrestado,idLocalidad,idZona,nombre,tipo,nroPrestador,cuil,convenioCamara,convenioSaludJujuy){
        this.idPrestado = idPrestado;
        this.idLocalidad = idLocalidad;
        this.idZona = idZona;
        this.nombre = nombre;
        this.tipo = tipo;
        this.nroPrestador = nroPrestador;
        this.cuil = cuil;
        this.convenioCamara = convenioCamara;
        this.convenioSaludJujuy = convenioSaludJujuy
    }

    static find(nombre){
        return db.execute(
            'SELECT * FROM prestadores WHERE Nombre = ?',[nombre]
        );
    }
}