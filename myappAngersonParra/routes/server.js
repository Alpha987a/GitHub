const express = require('express');
const mongoose = require('mongoose');
const bodyParser = require('body-parser');
const cors = require('cors');
const path = require('path');

const app = express();
const PORT = 3000;

// Middlewares
app.use(bodyParser.json());
app.use(cors());

// Configuración para servir archivos estáticos
app.use(express.static(path.join(__dirname, 'public')));

// Conectar a MongoDB
mongoose.connect('mongodb://localhost:27017/librosDB', {
    useNewUrlParser: true,
    useUnifiedTopology: true,
    useFindAndModify: false,
});

const db = mongoose.connection;
db.on('error', console.error.bind(console, 'Error de conexión a MongoDB:'));
db.once('open', () => {
    console.log('Conectado a MongoDB');
});

// Definir el modelo de Libro
const libroSchema = new mongoose.Schema({
    titulo: String,
    autor: String,
    fechaPublicacion: Date,
    paginas: Number,
});

const Libro = mongoose.model('Libro', libroSchema);

// Rutas de la API
// Obtener todos los libros
app.get('/api/libros', async (req, res) => {
    try {
        const libros = await Libro.find();
        res.json(libros);
    } catch (error) {
        res.status(500).json({ message: error.message });
    }
});

// Crear un nuevo libro
app.post('/api/libros', async (req, res) => {
    const libro = new Libro({
        titulo: req.body.titulo,
        autor: req.body.autor,
        fechaPublicacion: req.body.fechaPublicacion,
        paginas: req.body.paginas,
    });

    try {
        const nuevoLibro = await libro.save();
        res.status(201).json(nuevoLibro);
    } catch (error) {
        res.status(400).json({ message: error.message });
    }
});

// Obtener un libro por ID
app.get('/api/libros/:id', getLibro, (req, res) => {
    res.json(res.libro);
});

// Actualizar un libro
app.put('/api/libros/:id', getLibro, async (req, res) => {
    if (req.body.titulo != null) {
        res.libro.titulo = req.body.titulo;
    }
    if (req.body.autor != null) {
        res.libro.autor = req.body.autor;
    }
    if (req.body.fechaPublicacion != null) {
        res.libro.fechaPublicacion = req.body.fechaPublicacion;
    }
    if (req.body.paginas != null) {
        res.libro.paginas = req.body.paginas;
    }

    try {
        const libroActualizado = await res.libro.save();
        res.json(libroActualizado);
    } catch (error) {
        res.status(400).json({ message: error.message });
    }
});

// Eliminar un libro
app.delete('/api/libros/:id', getLibro, async (req, res) => {
    try {
        await res.libro.remove();
        res.json({ message: 'Libro eliminado' });
    } catch (error) {
        res.status(500).json({ message: error.message });
    }
});

// Middleware para obtener un libro por ID
async function getLibro(req, res, next) {
    let libro;
    try {
        libro = await Libro.findById(req.params.id);
        if (libro == null) {
            return res.status(404).json({ message: 'No se puede encontrar el libro' });
        }
    } catch (error) {
        return res.status(500).json({ message: error.message });
    }

    res.libro = libro;
    next();
}

// Iniciar el servidor
app.listen(PORT, () => {
    console.log(`Servidor escuchando en http://localhost:${PORT}`);
});