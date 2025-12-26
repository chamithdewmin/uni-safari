# ⚠️ IMPORTANT: How to View Your Website Correctly

## The Problem

If you're seeing **PHP code** instead of a webpage, it means you're opening files directly (using `file://` protocol). PHP files **MUST** be run through a web server!

## ✅ Solution: Install and Run a PHP Server

### **EASIEST METHOD: Install XAMPP (Recommended for Windows)**

1. **Download XAMPP** (Free):
   - Go to: https://www.apachefriends.org/download.html
   - Download the Windows version (PHP 8.x)
   - Install it (usually to `C:\xampp`)

2. **Copy Your Project**:
   - Copy your entire `uni web` folder
   - Paste it into: `C:\xampp\htdocs\`
   - So it should be: `C:\xampp\htdocs\uni web\`

3. **Start XAMPP**:
   - Open "XAMPP Control Panel"
   - Click "Start" button next to **Apache**
   - Wait until it turns green

4. **Open Your Website**:
   - Open your web browser
   - Go to: `http://localhost/uni web/index.html`
   - Or: `http://localhost/uni web/contact.php`

### **Alternative: Install PHP and Use Built-in Server**

1. **Download PHP**:
   - Go to: https://windows.php.net/download/
   - Download "VS16 x64 Non Thread Safe" (ZIP file)
   - Extract to `C:\php`

2. **Add PHP to PATH**:
   - Press `Win + R`, type `sysdm.cpl`, press Enter
   - Click "Environment Variables"
   - Under "System Variables", find "Path", click "Edit"
   - Click "New" and add: `C:\php`
   - Click OK on all windows

3. **Restart Command Prompt**, then:
   ```bash
   cd "d:\uni web"
   php -S localhost:8000
   ```

4. **Open Browser**: `http://localhost:8000/index.html`

---

## 🚀 Quick Test

Once your server is running, test these URLs:

- Home Page: `http://localhost/uni web/index.html`
- About: `http://localhost/uni web/about.html`
- Packages: `http://localhost/uni web/packages.html`
- Gallery: `http://localhost/uni web/gallery.html`
- **Book Now (Contact Form)**: `http://localhost/uni web/contact.php` ⬅️ This is the one you need!

---

## 📋 Complete Booking Flow Test

1. Start at: `http://localhost/uni web/index.html`
2. Click "Book Now" button → Should show booking form (NOT PHP code!)
3. Fill out the form → Submit
4. Review on confirmation page
5. Enter payment details
6. See success page with "Booking Successfully Completed!"

---

## ❌ What NOT to Do

- ❌ Don't double-click `contact.php` to open it
- ❌ Don't use `file:///D:/uni web/contact.php`
- ❌ Don't open PHP files directly in browser

## ✅ What TO Do

- ✅ Always use `http://localhost/...` URLs
- ✅ Make sure Apache/PHP server is running
- ✅ Use XAMPP Control Panel to start Apache

---

## Need Help?

If you still see PHP code:
1. Make sure Apache is running in XAMPP (green status)
2. Check the URL starts with `http://localhost` (not `file://`)
3. Verify files are in `C:\xampp\htdocs\uni web\`
4. Try restarting Apache in XAMPP

