const express = require('express');
const bodyParser = require('body-parser');
const fs = require('fs');

const app = express();
const port = 3000;

// Configura middleware para analizar solicitudes JSON
app.use(bodyParser.json());

// Maneja solicitudes POST para agregar nuevos ATMs
app.post('/add_atm', (req, res) => {
    try {
        const newATM = req.body;
        
        // Lee el contenido actual de locations.json
        const currentData = JSON.parse(fs.readFileSync('locations.json', 'utf-8'));

        // Agrega el nuevo ATM al array existente
        currentData.push(newATM);

        // Escribe el contenido actualizado de vuelta a locations.json
        fs.writeFileSync('locations.json', JSON.stringify(currentData, null, 2), 'utf-8');

        res.status(200).json({ message: 'ATM agregado con éxito.' });
    } catch (error) {
        console.error('Error al agregar ATM:', error);
        res.status(500).json({ error: 'Error interno del servidor.' });
    }
});

// Inicia el servidor en el puerto especificado
app.listen(port, () => {
    console.log(`Servidor escuchando en http://localhost:${port}`);
});
