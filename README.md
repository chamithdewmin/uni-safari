# Safari Luxe - Luxury Safari Tour Website

A complete, professional safari tour website built with HTML5, CSS3, and Vanilla JavaScript. This project is designed for both academic evaluation and real-world client use.

## Project Overview

Safari Luxe is a premium safari tour booking website for Sri Lankan wildlife adventures. The site features a luxury black & white design theme with gold accents, showcasing safari packages in Yala, Wilpattu, and Udawalawe National Parks.

## Technology Stack

- **HTML5** - Semantic markup
- **CSS3** - Custom styling with CSS Grid and Flexbox
- **Vanilla JavaScript** - Form validation and interactive features

**No frameworks used** - Pure vanilla implementation.

## Project Structure

```
/
├── index.html          # Home page
├── about.html          # About Us page
├── packages.html       # Safari Packages page
├── gallery.html        # Gallery page
├── contact.html        # Booking form (HTML with JavaScript)
├── README.md           # This file
└── assets/
    ├── css/
    │   └── style.css   # Main stylesheet
    ├── images/         # Image assets (see below)
    └── icons/          # SVG icons (embedded in HTML)
```

## Image Requirements

The website uses high-quality images from Pexels (free stock photos). All images are loaded directly from Pexels CDN, so no local image files are required. However, if you want to use local images:

### Recommended Local Images (Optional):

1. **Hero Images:**
   - `hero-safari.jpg` - Main hero image for home page
   - `about-hero.jpg` - Hero image for About page
   - `packages-hero.jpg` - Hero image for Packages page
   - `gallery-hero.jpg` - Hero image for Gallery page
   - `contact-hero.jpg` - Hero image for Contact page

2. **Package Images:**
   - `yala-safari.jpg` - Yala National Park safari
   - `wilpattu-safari.jpg` - Wilpattu National Park safari
   - `udawalawe-safari.jpg` - Udawalawe National Park safari

3. **Gallery Images:**
   - `gallery-1.jpg` through `gallery-12.jpg` - Wildlife and safari photos

### Image Specifications:
- **Format:** JPG or PNG
- **Recommended Size:** 
  - Hero images: 1920x1080px or larger
  - Package images: 800x600px or larger
  - Gallery images: 1200x900px or larger
- **Style:** Black & white or grayscale preferred to match the luxury theme

**Note:** Currently, all images are loaded from Pexels CDN. To use local images, update the `src` attributes in the HTML files.

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

### Contact/Booking Page (contact.html)
- Professional booking form
- JavaScript validation for all fields
- Error handling and display
- Success message on submission
- Package pre-selection from URL parameters

## Setup Instructions

1. **Extract/Clone** the project files to your desired directory

2. **Open in Browser:**
   - Simply double-click `index.html` to open in your default browser
   - Or right-click and select "Open with" → Your preferred browser
   - All pages work without a web server!

3. **Test the Booking Form:**
   - Navigate to `contact.html`
   - Fill out and submit the booking form
   - Verify JavaScript validation works correctly
   - See success message on valid submission

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

## Design Features

- **Color Palette:** Black, white, charcoal, and soft gold accents
- **Typography:** Clean sans-serif fonts (Segoe UI, system fonts)
- **Animations:** Smooth fade-in, hover effects, and transitions
- **Images:** Premium black & white wildlife photography
- **Icons:** Minimalist black & white SVG icons

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
- Update package prices in `packages.html` and `contact.html`
- Modify contact information in footer sections

### Images:
- Currently using Pexels CDN images
- To use local images, replace `src` attributes in HTML files
- Place images in `assets/images/` directory

## JavaScript Features

The booking form (`contact.html`) includes:
- Client-side form validation
- Real-time error messages
- Date validation (future dates only)
- Email format validation
- Phone number validation
- Guest count validation (1-20)
- Package pre-selection from URL parameters
- Success message display

## Academic Project Notes

This project demonstrates:
- ✅ Semantic HTML5 structure
- ✅ Advanced CSS3 (Grid, Flexbox, animations)
- ✅ JavaScript form handling and validation
- ✅ Responsive web design
- ✅ UI/UX design principles
- ✅ SEO-friendly markup
- ✅ Accessibility considerations
- ✅ Clean, maintainable code

## Future Enhancements (Optional)

For production use, consider adding:
- Backend integration (PHP, Node.js, etc.) for form processing
- Database integration for booking storage
- Email notification system
- Payment gateway integration
- Admin panel for booking management
- Blog/news section
- Multi-language support

## License

This project is created for academic purposes. All images are from Pexels (free stock photos). Ensure proper licensing for any custom images or assets used.

## Contact

For questions about this project, refer to the contact information in the website footer.

---

**Built with ❤️ for Web Application Development**
