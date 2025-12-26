# How to Run the Safari Luxe Website

## Important: PHP Files Need a Web Server

PHP files cannot be opened directly in a browser using the `file://` protocol. You **MUST** run them through a PHP web server.

## Quick Start (Recommended)

### Option 1: Using PHP Built-in Server (Easiest)

1. **Make sure PHP is installed** on your computer
   - Download from: https://www.php.net/downloads.php
   - Or use XAMPP/WAMP which includes PHP

2. **Open Command Prompt or Terminal** in this project folder (`D:\uni web`)

3. **Run this command:**
   ```bash
   php -S localhost:8000
   ```

4. **Open your browser** and go to:
   ```
   http://localhost:8000/index.html
   ```

5. **Or use the batch file:**
   - Double-click `start-server.bat` (Windows)
   - Your website will start automatically

### Option 2: Using XAMPP (Windows)

1. **Download and install XAMPP**: https://www.apachefriends.org/

2. **Copy your project folder** to `C:\xampp\htdocs\`
   - Copy `uni web` folder to `C:\xampp\htdocs\uni web\`

3. **Start XAMPP Control Panel**

4. **Start Apache** (click Start button)

5. **Open your browser** and go to:
   ```
   http://localhost/uni web/index.html
   ```

### Option 3: Using WAMP (Windows)

1. **Download and install WAMP**: https://www.wampserver.com/

2. **Copy your project folder** to `C:\wamp64\www\`
   - Copy `uni web` folder to `C:\wamp64\www\uni web\`

3. **Start WAMP** (click Start WAMP icon)

4. **Open your browser** and go to:
   ```
   http://localhost/uni web/index.html
   ```

## Testing the Booking Flow

Once your server is running, test the complete booking flow:

1. Go to: `http://localhost:8000/index.html` (or your server URL)
2. Click "Book Now" button
3. Fill out the booking form
4. Submit → Confirmation page → Payment page → Success page

## Troubleshooting

### "PHP is not recognized as an internal or external command"
- PHP is not installed or not in your PATH
- Install PHP or use XAMPP/WAMP instead

### "Page shows PHP code instead of website"
- You're opening files directly (file://)
- You MUST use a web server (localhost)

### "404 Page Not Found"
- Make sure you're using the correct URL
- Check that your server is running
- Verify file names match exactly (case-sensitive on some servers)

## File Structure Should Be:

```
uni web/
├── index.html
├── about.html
├── packages.html
├── gallery.html
├── contact.php
├── confirm.php
├── payment.php
├── success.php
├── start-server.bat
└── assets/
    ├── css/
    │   └── style.css
    ├── images/
    └── icons/
```

## Notes

- PHP files (.php) **require** a web server to work
- HTML files can be opened directly, but PHP won't work
- Always access the website through `http://localhost` (not `file://`)
- The booking form uses PHP sessions, which require a server

