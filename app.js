const express = require('express');
const mysql = require('mysql')
const myconn = require('express-myconnection')
const routes = require('./routes')
const app = express();
//middlewares
app.set('port',process.env.PORT || 3000)
const dbOptions={
    host: '10.0.0.85',
    port: 3306,
    user: 'root',
    password: 'retgalsambop',
    database: 'gromitdata'
}
app.use(myconn(mysql, dbOptions,'single'))

//routes
app.get('/',(req,res)=>{
    res.send('welcome to apis')
})

app.use('/',routes)

//server running
app.listen(app.get('port'), ()=>{
    console.log('server running on port',3000)
})

