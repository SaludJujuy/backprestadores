const express = require('express')
const routes = express.Router()

/**
 *  TABLA ZONAS
 */
routes.get('/zona',(req,res)=>{
    req.getConnection((err,conn)=>{
        if(err) return res.send(err)
        conn.query('SELECT * FROM zonas',(err,rows)=>{
            if(err) return res.send(err)
            res.json(rows)
        })
    })
})

/**
 * TABLA PRESTADORES
 */
routes.get('/prestadores',(req,res)=>{
    req.getConnection((err,conn)=>{
        if(err) return res.send(err)
        conn.query('SELECT * FROM prestadores',(err,rows)=>{
            if(err) return res.send(err)
            res.json(rows)
        })
    })
})

routes.get('/prestadores/:numeroPrestador', (req, res) => {
    const numeroPrestador = req.params.numeroPrestador; // Obtiene el número de prestador de los parámetros de la URL
    req.getConnection((err, conn) => {
      if (err) return res.send(err);
      // Modifica la consulta SQL para filtrar por número de prestador
      conn.query('SELECT * FROM prestadores WHERE NroPrestador = ?', [numeroPrestador], (err, rows) => {
        if (err) return res.send(err);
        res.json(rows);
      });
    });
  });

/**
 * TABLA ESPECIALIDADES
 */
routes.get('/especialidades',(req,res)=>{
    req.getConnection((err,conn)=>{
        if(err) return res.send(err)
        conn.query('SELECT * FROM especialidades',(err,rows)=>{
            if(err) return res.send(err)
            res.json(rows)
        })
    })
})

/**
 * TABLA CONVENIO
 */
routes.get('/convenio',(req,res)=>{
    req.getConnection((err,conn)=>{
        if(err) return res.send(err)
        conn.query('SELECT * FROM convenio',(err,rows)=>{
            if(err) return res.send(err)
            res.json(rows)
        })
    })
})

/**
 * TABLA LOCALIDADES
 */
routes.get('/localidades',(req,res)=>{
    req.getConnection((err,conn)=>{
        if(err) return res.send(err)
        conn.query('SELECT * FROM localidades',(err,rows)=>{
            if(err) return res.send(err)
            res.json(rows)
        })
    })
})
module.exports = routes