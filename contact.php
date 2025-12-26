<?php
session_start();

/**
 * CONTACT / BOOKING FORM PAGE
 * Handles safari tour booking form submissions with PHP validation
 * 
 * Form Processing Logic:
 * 1. Checks if form was submitted via POST method
 * 2. Validates all required fields (name, email, phone, package, date, guests)
 * 3. Sanitizes input data to prevent XSS attacks
 * 4. Validates email format and phone number
 * 5. Validates date is in the future
 * 6. Validates number of guests is reasonable (1-20)
 * 7. On successful validation, redirects to success.php
 * 8. On validation errors, displays errors to user
 */

// Initialize variables
$errors = [];
$form_data = [];
$success = false;

// Package options
$packages = [
    'yala' => 'Yala Premium Safari - $299',
    'wilpattu' => 'Wilpattu Adventure - $279',
    'udawalawe' => 'Udawalawe Elephant Safari - $249',
    'yala-morning' => 'Yala Morning Safari - $199',
    'wilpattu-full' => 'Wilpattu Full Day Experience - $349',
    'udawalawe-full' => 'Udawalawe Full Day Safari - $299'
];

// Get package from URL parameter if present
$selected_package = isset($_GET['package']) ? htmlspecialchars($_GET['package']) : '';

// Process form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and validate input data
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $package = trim($_POST['package'] ?? '');
    $date = trim($_POST['date'] ?? '');
    $guests = trim($_POST['guests'] ?? '');
    $message = trim($_POST['message'] ?? '');

    // Store form data for repopulation
    $form_data = [
        'name' => $name,
        'email' => $email,
        'phone' => $phone,
        'package' => $package,
        'date' => $date,
        'guests' => $guests,
        'message' => $message
    ];

    // Validation: Full Name
    if (empty($name)) {
        $errors['name'] = 'Full name is required.';
    } elseif (strlen($name) < 2) {
        $errors['name'] = 'Name must be at least 2 characters long.';
    } elseif (!preg_match("/^[a-zA-Z\s'-]+$/", $name)) {
        $errors['name'] = 'Name can only contain letters, spaces, hyphens, and apostrophes.';
    }

    // Validation: Email
    if (empty($email)) {
        $errors['email'] = 'Email address is required.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Please enter a valid email address.';
    }

    // Validation: Phone
    if (empty($phone)) {
        $errors['phone'] = 'Phone number is required.';
    } elseif (!preg_match("/^[\d\s\-\+\(\)]+$/", $phone)) {
        $errors['phone'] = 'Please enter a valid phone number.';
    } elseif (strlen($phone) < 10) {
        $errors['phone'] = 'Phone number must be at least 10 digits.';
    }

    // Validation: Safari Package
    if (empty($package)) {
        $errors['package'] = 'Please select a safari package.';
    } elseif (!array_key_exists($package, $packages)) {
        $errors['package'] = 'Invalid package selected.';
    }

    // Validation: Preferred Date
    if (empty($date)) {
        $errors['date'] = 'Preferred date is required.';
    } else {
        $selected_date = strtotime($date);
        $today = strtotime('today');
        if ($selected_date === false) {
            $errors['date'] = 'Please enter a valid date.';
        } elseif ($selected_date < $today) {
            $errors['date'] = 'Please select a future date.';
        }
    }

    // Validation: Number of Guests
    if (empty($guests)) {
        $errors['guests'] = 'Number of guests is required.';
    } elseif (!is_numeric($guests) || $guests < 1 || $guests > 20) {
        $errors['guests'] = 'Number of guests must be between 1 and 20.';
    }

    // Validation: Message (optional but sanitize if provided)
    if (!empty($message) && strlen($message) > 1000) {
        $errors['message'] = 'Message must be less than 1000 characters.';
    }

    // If no errors, store in session and redirect to confirmation page
    if (empty($errors)) {
        session_start();
        $_SESSION['booking_data'] = [
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'package' => $package,
            'date' => $date,
            'guests' => $guests,
            'message' => $message
        ];
        header('Location: confirm.php');
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Book your luxury safari tour in Sri Lanka. Contact us to reserve your wildlife adventure in Yala, Wilpattu, or Udawalawe National Parks.">
    <meta name="keywords" content="book safari, safari booking, contact safari tours, reserve safari">
    <title>Book Your Safari | Safari Luxe - Contact & Booking</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <!-- Header & Navigation -->
    <header>
        <nav>
            <div class="logo">SAFARI LUXE</div>
            <button class="menu-toggle" aria-label="Toggle menu">☰</button>
            <ul class="nav-links">
                <li><a href="index.html">Home</a></li>
                <li><a href="about.html">About Us</a></li>
                <li><a href="packages.html">Packages</a></li>
                <li><a href="gallery.html">Gallery</a></li>
                <li><a href="contact.php" class="active">Book Now</a></li>
            </ul>
        </nav>
    </header>

    <!-- Contact Hero -->
    <section class="hero" style="min-height: 300px;">
        <img src="https://images.pexels.com/photos/2901209/pexels-photo-2901209.jpeg?auto=compress&cs=tinysrgb&w=1920" alt="Book Your Safari" class="hero-image">
        <div class="hero-content">
            <h1>Book Your Safari</h1>
            <p>Reserve your luxury wildlife adventure today</p>
        </div>
    </section>

    <!-- Contact Form Section -->
    <section class="contact-section">
        <div class="container">
            <div class="contact-container">
                <div class="section-title">
                    <h2>Booking Form</h2>
                    <p>Fill out the form below to reserve your safari experience. We'll confirm your booking within 24 hours.</p>
                </div>

                <form method="POST" action="contact.php" class="contact-form" novalidate>
                    <!-- Full Name -->
                    <div class="form-group <?php echo isset($errors['name']) ? 'error' : ''; ?>">
                        <label for="name">Full Name <span style="color: #d32f2f;">*</span></label>
                        <input 
                            type="text" 
                            id="name" 
                            name="name" 
                            required
                            value="<?php echo htmlspecialchars($form_data['name'] ?? ''); ?>"
                            placeholder="Enter your full name"
                        >
                        <?php if (isset($errors['name'])): ?>
                            <span class="error-message"><?php echo htmlspecialchars($errors['name']); ?></span>
                        <?php endif; ?>
                    </div>

                    <!-- Email -->
                    <div class="form-group <?php echo isset($errors['email']) ? 'error' : ''; ?>">
                        <label for="email">Email Address <span style="color: #d32f2f;">*</span></label>
                        <input 
                            type="email" 
                            id="email" 
                            name="email" 
                            required
                            value="<?php echo htmlspecialchars($form_data['email'] ?? ''); ?>"
                            placeholder="your.email@example.com"
                        >
                        <?php if (isset($errors['email'])): ?>
                            <span class="error-message"><?php echo htmlspecialchars($errors['email']); ?></span>
                        <?php endif; ?>
                    </div>

                    <!-- Phone -->
                    <div class="form-group <?php echo isset($errors['phone']) ? 'error' : ''; ?>">
                        <label for="phone">Phone Number <span style="color: #d32f2f;">*</span></label>
                        <input 
                            type="tel" 
                            id="phone" 
                            name="phone" 
                            required
                            value="<?php echo htmlspecialchars($form_data['phone'] ?? ''); ?>"
                            placeholder="+94 77 123 4567"
                        >
                        <?php if (isset($errors['phone'])): ?>
                            <span class="error-message"><?php echo htmlspecialchars($errors['phone']); ?></span>
                        <?php endif; ?>
                    </div>

                    <!-- Safari Package -->
                    <div class="form-group <?php echo isset($errors['package']) ? 'error' : ''; ?>">
                        <label for="package">Safari Package <span style="color: #d32f2f;">*</span></label>
                        <select id="package" name="package" required>
                            <option value="">-- Select a Package --</option>
                            <?php foreach ($packages as $key => $label): ?>
                                <option value="<?php echo htmlspecialchars($key); ?>" 
                                    <?php echo (($form_data['package'] ?? $selected_package) === $key) ? 'selected' : ''; ?>>
                                    <?php echo htmlspecialchars($label); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <?php if (isset($errors['package'])): ?>
                            <span class="error-message"><?php echo htmlspecialchars($errors['package']); ?></span>
                        <?php endif; ?>
                    </div>

                    <!-- Preferred Date -->
                    <div class="form-group <?php echo isset($errors['date']) ? 'error' : ''; ?>">
                        <label for="date">Preferred Date <span style="color: #d32f2f;">*</span></label>
                        <input 
                            type="date" 
                            id="date" 
                            name="date" 
                            required
                            value="<?php echo htmlspecialchars($form_data['date'] ?? ''); ?>"
                            min="<?php echo date('Y-m-d', strtotime('tomorrow')); ?>"
                        >
                        <?php if (isset($errors['date'])): ?>
                            <span class="error-message"><?php echo htmlspecialchars($errors['date']); ?></span>
                        <?php endif; ?>
                    </div>

                    <!-- Number of Guests -->
                    <div class="form-group <?php echo isset($errors['guests']) ? 'error' : ''; ?>">
                        <label for="guests">Number of Guests <span style="color: #d32f2f;">*</span></label>
                        <input 
                            type="number" 
                            id="guests" 
                            name="guests" 
                            required
                            min="1" 
                            max="20"
                            value="<?php echo htmlspecialchars($form_data['guests'] ?? ''); ?>"
                            placeholder="1-20"
                        >
                        <?php if (isset($errors['guests'])): ?>
                            <span class="error-message"><?php echo htmlspecialchars($errors['guests']); ?></span>
                        <?php endif; ?>
                    </div>

                    <!-- Message -->
                    <div class="form-group <?php echo isset($errors['message']) ? 'error' : ''; ?>">
                        <label for="message">Additional Message (Optional)</label>
                        <textarea 
                            id="message" 
                            name="message" 
                            rows="5"
                            placeholder="Any special requests or questions..."
                            maxlength="1000"
                        ><?php echo htmlspecialchars($form_data['message'] ?? ''); ?></textarea>
                        <?php if (isset($errors['message'])): ?>
                            <span class="error-message"><?php echo htmlspecialchars($errors['message']); ?></span>
                        <?php endif; ?>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary" style="width: 100%; font-size: 1.1rem; padding: 1.25rem;">
                        Submit Booking Request
                    </button>
                </form>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <h3>SAFARI LUXE</h3>
                    <p>Premium safari tours in Sri Lanka. Experience wildlife like never before with our luxury safari packages.</p>
                </div>
                <div class="footer-section">
                    <h3>Quick Links</h3>
                    <a href="index.html">Home</a>
                    <a href="about.html">About Us</a>
                    <a href="packages.html">Safari Packages</a>
                    <a href="gallery.html">Gallery</a>
                    <a href="contact.php">Book Now</a>
                </div>
                <div class="footer-section">
                    <h3>Contact Us</h3>
                    <p>
                        <svg class="social-icon" style="width: 16px; height: 16px; display: inline; vertical-align: middle; margin-right: 8px;" viewBox="0 0 24 24">
                            <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                        </svg>
                        Colombo, Sri Lanka
                    </p>
                    <p>
                        <svg class="social-icon" style="width: 16px; height: 16px; display: inline; vertical-align: middle; margin-right: 8px;" viewBox="0 0 24 24">
                            <path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/>
                        </svg>
                        +94 77 123 4567
                    </p>
                    <p>
                        <svg class="social-icon" style="width: 16px; height: 16px; display: inline; vertical-align: middle; margin-right: 8px;" viewBox="0 0 24 24">
                            <path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/>
                        </svg>
                        info@safariluxe.lk
                    </p>
                </div>
                <div class="footer-section">
                    <h3>Follow Us</h3>
                    <div class="social-icons">
                        <a href="#" aria-label="Facebook">
                            <svg class="social-icon" viewBox="0 0 24 24">
                                <path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"/>
                            </svg>
                        </a>
                        <a href="#" aria-label="Instagram">
                            <svg class="social-icon" viewBox="0 0 24 24">
                                <rect x="2" y="2" width="20" height="20" rx="5" ry="5" fill="none" stroke="currentColor" stroke-width="2"/>
                                <path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37z" fill="none" stroke="currentColor" stroke-width="2"/>
                                <line x1="17.5" y1="6.5" x2="17.51" y2="6.5" stroke="currentColor" stroke-width="2"/>
                            </svg>
                        </a>
                        <a href="#" aria-label="Twitter">
                            <svg class="social-icon" viewBox="0 0 24 24">
                                <path d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2025 Safari Luxe. All rights reserved. | Academic Web Application Development Project</p>
            </div>
        </div>
    </footer>

    <!-- Mobile Menu Script -->
    <script>
        const menuToggle = document.querySelector('.menu-toggle');
        const navLinks = document.querySelector('.nav-links');

        menuToggle.addEventListener('click', () => {
            navLinks.classList.toggle('active');
        });

        document.querySelectorAll('.nav-links a').forEach(link => {
            link.addEventListener('click', () => {
                navLinks.classList.remove('active');
            });
        });
    </script>
</body>
</html>

