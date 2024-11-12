// server.js
const express = require('express');
const cors = require('cors');
const app = express();
const PORT = 3000;

app.use(cors());
app.use(express.json());

let books = [
    { id: 1, title: "Buch 1", author: "Autor 1" },
    { id: 2, title: "Buch 2", author: "Autor 2" },
    { id: 3, title: "Buch 3", author: "Autor 3" }
];

// Route, um alle Bücher zu bekommen
app.get('/api/books', (req, res) => {
    res.json(books);
});

// Route, um ein Buch zu löschen
app.delete('/api/books/:id', (req, res) => {
    const { id } = req.params;
    books = books.filter(book => book.id != id);
    res.sendStatus(204);
});

// Route, um ein Buch zu aktualisieren
app.put('/api/books/:id', (req, res) => {
    const { id } = req.params;
    const updatedBook = req.body;
    books = books.map(book => (book.id == id ? updatedBook : book));
    res.sendStatus(204);
});

app.listen(PORT, () => {
    console.log(`Server läuft auf http://localhost:${PORT}`);
});
