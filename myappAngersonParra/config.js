const mongoose = require('mongoose');
mongoose.connect('mongodb+srv://alphapapa987:SExhDCtDl0bZ9nLK@devcam.tocgzoc.mongodb.net/?retryWrites=true&w=majority&appName=devcam').then(() => {
    console.log('Connected to MongoDB');
}).catch((err) => {
    console.error('Error connecting to MongoDB:', err);
});

module.exports = mongoose;