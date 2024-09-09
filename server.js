const express = require('express');
const bodyParser = require('body-parser');
const fs = require('fs');
const path = require('path');

const app = express();
const PORT = 3000;

// إعداد body-parser لمعالجة JSON
app.use(bodyParser.json());

// مسار لمعالجة البيانات المرسلة من المتصفح
app.post('/saveData', (req, res) => {
    const data = req.body;
    const filePath = path.join(__dirname, 'user_data.json');

    // حفظ البيانات في ملف user_data.json
    fs.writeFile(filePath, JSON.stringify(data, null, 2), (err) => {
        if (err) {
            console.error('Error saving file:', err);
            return res.status(500).json({ message: 'Failed to save data' });
        }

        console.log('Data saved successfully to', filePath);
        res.json({ message: 'Data saved successfully' });
    });
});

app.listen(PORT, () => {
    console.log(`Server running on http://localhost:${PORT}`);
});
