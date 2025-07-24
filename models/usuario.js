const connection = require('../util/database');
const { Sequelize, DataTypes } = require('sequelize');
const sequelize = new Sequelize(connection);

const Usuario = sequelize.define('Usuario', {
  usuario: {
    type: DataTypes.STRING,
    allowNull: false
  },
  password: {
    type: DataTypes.STRING,
    allowNull: false
  },
});

// Sincroniza el modelo con la base de datos
Usuario.sync();