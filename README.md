# Safari Luxe - Luxury Safari Tour Website

A complete, professional safari tour website built with HTML5, CSS3, Vanilla JavaScript, and PHP. This project is designed for both academic evaluation and real-world client use.

## Project Overview

Safari Luxe is a premium safari tour booking website for Sri Lankan wildlife adventures. The site features a luxury black & white design theme with gold accents, showcasing safari packages in Yala, Wilpattu, and Udawalawe National Parks.

## Technology Stack

- **HTML5** - Semantic markup
- **CSS3** - Custom styling with CSS Grid and Flexbox
- **Vanilla JavaScript** - Minimal JavaScript for mobile menu
- **PHP** - Form handling and validation

**No frameworks used** - Pure vanilla implementation as per requirements.

## Project Structure

```
/
├── index.html          # Home page
├── about.html          # About Us page
├── packages.html       # Safari Packages page
├── gallery.html        # Gallery page
├── contact.php         # Booking form (PHP)
├── success.php         # Thank you page (PHP)
├── README.md           # This file
└── assets/
    ├── css/
    │   └── style.css   # Main stylesheet
    ├── images/         # Image assets (see below)
    └── icons/          # SVG icons (embedded in HTML)
```

## Image Requirements

The website requires the following images in the `assets/images/` directory. All images should be high-quality, preferably in black & white or grayscale to match the luxury theme.

### Required Images:

1. **Hero Images:**
   - `hero-safari.jpg` - Main hero image for home page (full-screen safari scene)
   - `about-hero.jpg` - Hero image for About page
   - `packages-hero.jpg` - Hero image for Packages page
   - `gallery-hero.jpg` - Hero image for Gallery page
   - `contact-hero.jpg` - Hero image for Contact page

2. **Package Images:**
   - `yala-safari.jpg` - Yala National Park safari
   - `wilpattu-safari.jpg` - Wilpattu National Park safari
   - `udawalawe-safari.jpg` - Udawalawe National Park safari
   - `yala-morning.jpg` - Yala morning safari
   - `wilpattu-full.jpg` - Wilpattu full day
   - `udawalawe-full.jpg` - Udawalawe full day

3. **Guide Images:**
   - `guide-1.jpg` - Safari guide photo
   - `guide-2.jpg` - Safari guide photo
   - `guide-3.jpg` - Safari guide photo

4. **Gallery Images (12 images):**
   - `gallery-1.jpg` through `gallery-12.jpg` - Wildlife and safari photos

### Image Specifications:
- **Format:** JPG or PNG
- **Recommended Size:** 
  - Hero images: 1920x1080px or larger
  - Package/Guide images: 800x600px or larger
  - Gallery images: 1200x900px or larger
- **Style:** Black & white or grayscale preferred
- **Content:** Wildlife (lions, elephants, leopards), safari jeeps, natural landscapes

### Image Sources:
You can use:
- Unsplash (unsplash.com) - Search for "safari", "wildlife", "elephant", "leopard"
- Pexels (pexels.com) - Free stock photos
- Your own photography
- Professional stock photo services

**Note:** Ensure you have proper licensing for all images used.

## Features

### Home Page (index.html)
- Full-screen hero section with call-to-action buttons
- Featured safari packages section
- "Why Choose Us" section with icons
- Testimonials section
- Responsive navigation

### About Us Page (about.html)
- Company story and mission
- Expert guide profiles
- Trust-building content

### Packages Page (packages.html)
- Complete list of safari packages
- Package details with pricing
- "Book Now" buttons linking to contact form
- Package information section

### Gallery Page (gallery.html)
- Black & white image grid
- Hover effects on images
- Responsive layout

### Contact/Booking Page (contact.php)
- Professional booking form
- PHP validation for all fields
- Error handling and display
- Form data sanitization
- Redirects to success page on valid submission

### Success Page (success.php)
- Thank you message
- Booking confirmation details
- Navigation back to home

## PHP Form Processing

The booking form (`contact.php`) includes comprehensive PHP validation:

### Validation Features:
1. **Server-side validation** for all required fields
2. **Input sanitization** to prevent XSS attacks
3. **Email format validation** using PHP filter
4. **Phone number validation** (format and length)
5. **Date validation** (must be future date)
6. **Guest count validation** (1-20 guests)
7. **Package selection validation**
8. **Error display** with user-friendly messages

### Form Processing Flow:
1. Form submitted via POST method
2. All inputs are sanitized using `htmlspecialchars()` and `trim()`
3. Each field is validated according to business rules
4. Errors are collected in an array
5. If no errors: redirect to `success.php` with user data
6. If errors: display form with error messages and repopulate fields

### Security Features:
- Input sanitization prevents XSS attacks
- Server-side validation (cannot be bypassed)
- HTML5 validation as additional layer
- Prepared for database integration (commented in code)

## Setup Instructions

1. **Extract/Clone** the project files to your web server directory

2. **Add Images:**
   - Place all required images in `assets/images/` directory
   - Ensure filenames match exactly as listed above

3. **PHP Server:**
   - Requires PHP 7.0 or higher
   - Can be run on:
     - XAMPP / WAMP / MAMP (local development)
     - Apache with PHP (production)
     - Any PHP-enabled web server

4. **Test the Form:**
   - Navigate to `contact.php`
   - Fill out and submit the booking form
   - Verify validation works correctly
   - Confirm redirect to `success.php`

## Browser Compatibility

- Chrome (latest)
- Firefox (latest)
- Safari (latest)
- Edge (latest)
- Mobile browsers (iOS Safari, Chrome Mobile)

## Responsive Design

The website is fully responsive with breakpoints at:
- Desktop: 1200px and above
- Tablet: 768px - 1199px
- Mobile: Below 768px

## Customization

### Colors:
Edit CSS variables in `assets/css/style.css`:
```css
:root {
    --color-black: #000000;
    --color-white: #ffffff;
    --color-charcoal: #2c2c2c;
    --color-gold: #d4af37;
}
```

### Content:
- Edit HTML files directly to update text content
- Update package prices in `packages.html` and `contact.php`
- Modify contact information in footer sections

## Academic Project Notes

This project demonstrates:
- ✅ Semantic HTML5 structure
- ✅ Advanced CSS3 (Grid, Flexbox, animations)
- ✅ PHP form handling and validation
- ✅ Server-side security practices
- ✅ Responsive web design
- ✅ UI/UX design principles
- ✅ SEO-friendly markup
- ✅ Accessibility considerations

## Future Enhancements (Optional)

For production use, consider adding:
- Database integration (MySQL/PostgreSQL)
- Email notification system
- Payment gateway integration
- Admin panel for booking management
- Image upload functionality
- Blog/news section
- Multi-language support

## License

This project is created for academic purposes. Ensure proper licensing for all images and assets used.

## Contact

For questions about this project, refer to the contact information in the website footer.

---

**Built with ❤️ for Web Application Development**

