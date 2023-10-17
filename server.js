const express = require('express');
const bodyParser = require('body-parser');
const fs = require('fs');

const app = express();
const port = process.env.PORT || 3000;

// Configura middleware para analizar solicitudes JSON
app.use(bodyParser.json());

// Maneja solicitudes POST para agregar nuevos ATMs
app.post('/add_atm', (req, res) => {
    // ... tu lógica existente para manejar las solicitudes de ATMs
});

// Ruta para servir el archivo HTML
app.get('/', (req, res) => {
    res.sendFile(__dirname + '/index.html');
});

// Ruta para servir otros archivos estáticos (CSS, JS, etc.)
app.use(express.static(__dirname));

// Inicia el servidor en el puerto especificado
app.listen(port, () => {
    console.log(`Servidor escuchando en http://localhost:${port}`);
});
