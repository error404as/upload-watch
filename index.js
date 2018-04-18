var watch = require('node-watch');
var path = require('path');
var fs = require('fs');
var opn = require('opn');

// https://github.com/request/request#forms
var request = require('request');

const U_ACTION = 'http://example.com/uploader.php';
const L_DIR = 'uploads';

if(!fs.existsSync(L_DIR)){
    fs.mkdirSync(L_DIR);
}


watch(L_DIR, {}, (ev, fn) => {
    console.log('\nFile changed: ' + fn);
    console.log('\nEvent: ' + ev);
    if(ev === 'update'){
        upload(path.basename(fn));
    }
});
console.log('Watching...');

function upload(fname) {
    var req = request.post(U_ACTION, (err, httpResponse, body) => {
        if (err) {
            return console.error('upload failed:', err);
        }
        try {
            console.log('Upload successful!  Server responded with:', body);
            var f = JSON.parse(body).file;
            if(f){
                opn(f);
            }
        } catch(e){
            console.error('Upload failed. Incorrect server response.');
        }

    });
    var form = req.form();
    form.append('upl', fs.createReadStream(path.join(__dirname, L_DIR, fname)));
}


