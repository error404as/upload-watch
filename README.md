# Sending new local files to server

- NodeJS script (`index.js`) is watching `L_DIR` local directory for updates.
- If there any new file in it, it'll be sent to `U_ACTION` URL on your remote server (PHP version for it is `uploader.php`).
- Remote server will be save file to `U_DIR` directory (set it in uploader.php file) and return path to the file.
- If upload is successfull, URL of the uploaded file will be opened in your browser.

## Use cases

- Safe quick sharing of screenshots. You have full control of shared files life cycle: deleting, renaming, giving special permissions. Files are on your server, not on some public server that is used by your screenshot tool by default.
