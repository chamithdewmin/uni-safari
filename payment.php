<?php
/**
 * PAYMENT PAGE
 * Handles payment form submission for safari booking
 */

session_start();

// Check if booking data exists in session
if (!isset($_SESSION['booking_data'])) {
    header('Location: contact.php');
    exit();
}

$booking = $_SESSION['booking_data'];

// Package information
$packages = [
    'yala' => ['name' => 'Yala Premium Safari', 'price' => 299],
    'wilpattu' => ['name' => 'Wilpattu Adventure', 'price' => 279],
    'udawalawe' => ['name' => 'Udawalawe Elephant Safari', 'price' => 249],
    'yala-morning' => ['name' => 'Yala Morning Safari', 'price' => 199],
    'wilpattu-full' => ['name' => 'Wilpattu Full Day Experience', 'price' => 349],
    'udawalawe-full' => ['name' => 'Udawalawe Full Day Safari', 'price' => 299]
];

$package_info = isset($packages[$booking['package']]) ? $packages[$booking['package']] : ['name' => 'Selected Package', 'price' => 0];
$total_amount = $package_info['price'] * (int)$booking['guests'];

$errors = [];
$form_data = [];

// Process payment form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $card_name = trim($_POST['card_name'] ?? '');
    $card_number = trim($_POST['card_number'] ?? '');
    $expiry_month = trim($_POST['expiry_month'] ?? '');
    $expiry_year = trim($_POST['expiry_year'] ?? '');
    $cvv = trim($_POST['cvv'] ?? '');

    $form_data = [
        'card_name' => $card_name,
        'card_number' => $card_number,
        'expiry_month' => $expiry_month,
        'expiry_year' => $expiry_year,
        'cvv' => $cvv
    ];

    // Validation
    if (empty($card_name)) {
        $errors['card_name'] = 'Cardholder name is required.';
    }

    if (empty($card_number)) {
        $errors['card_number'] = 'Card number is required.';
    } elseif (!preg_match("/^\d{13,19}$/", str_replace(' ', '', $card_number))) {
        $errors['card_number'] = 'Please enter a valid card number (13-19 digits).';
    }

    if (empty($expiry_month) || empty($expiry_year)) {
        $errors['expiry'] = 'Expiry date is required.';
    }

    if (empty($cvv)) {
        $errors['cvv'] = 'CVV is required.';
    } elseif (!preg_match("/^\d{3,4}$/", $cvv)) {
        $errors['cvv'] = 'Please enter a valid CVV (3-4 digits).';
    }

    // If no errors, process payment and redirect to success
    if (empty($errors)) {
        // In a real application, you would:
        // 1. Process payment through payment gateway (Stripe, PayPal, etc.)
        // 2. Save booking to database
        // 3. Send confirmation email
        
        // Generate booking reference
        $booking_ref = 'SL' . date('Ymd') . rand(1000, 9999);
        
        // Store booking reference in session
        $_SESSION['booking_ref'] = $booking_ref;
        
        // Redirect to success page
        header('Location: success.php');
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Complete your safari booking payment">
    <title>Payment | Safari Luxe</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        .payment-summary {
            background-color: var(--color-gray-light);
            padding: 2rem;
            border-radius: 8px;
            margin-bottom: 2rem;
        }
        .card-input-group {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }
        .card-input-group-3 {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 1rem;
        }
        @media (max-width: 768px) {
            .card-input-group,
            .card-input-group-3 {
                grid-template-columns: 1fr;
            }
        }
        .secure-badge {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--color-gold);
            font-weight: 600;
            margin-bottom: 1.5rem;
        }
    </style>
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
                <li><a href="contact.php">Book Now</a></li>
            </ul>
        </nav>
    </header>

    <!-- Payment Section -->
    <section class="contact-section">
        <div class="container">
            <div class="contact-container">
                <div class="section-title">
                    <h2>Payment Information</h2>
                    <p>Complete your booking by entering payment details</p>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; max-width: 1200px; margin: 0 auto;">
                    <!-- Payment Summary -->
                    <div class="payment-summary">
                        <h3 style="margin-bottom: 1.5rem; color: var(--color-black); border-bottom: 2px solid var(--color-gold); padding-bottom: 0.5rem;">Booking Summary</h3>
                        
                        <div style="margin-bottom: 1.5rem;">
                            <strong style="display: block; margin-bottom: 0.5rem;">Package:</strong>
                            <p><?php echo htmlspecialchars($package_info['name']); ?></p>
                        </div>
                        
                        <div style="margin-bottom: 1.5rem;">
                            <strong style="display: block; margin-bottom: 0.5rem;">Date:</strong>
                            <p><?php echo date('F j, Y', strtotime($booking['date'])); ?></p>
                        </div>
                        
                        <div style="margin-bottom: 1.5rem;">
                            <strong style="display: block; margin-bottom: 0.5rem;">Guests:</strong>
                            <p><?php echo htmlspecialchars($booking['guests']); ?> person(s)</p>
                        </div>
                        
                        <div style="border-top: 2px solid var(--color-charcoal); padding-top: 1rem; margin-top: 1.5rem;">
                            <div style="display: flex; justify-content: space-between; margin-bottom: 1rem;">
                                <span>Subtotal:</span>
                                <span>$<?php echo number_format($total_amount, 2); ?></span>
                            </div>
                            <div style="display: flex; justify-content: space-between; font-size: 1.5rem; font-weight: 700; color: var(--color-gold);">
                                <span>Total:</span>
                                <span>$<?php echo number_format($total_amount, 2); ?></span>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Form -->
                    <div class="contact-form">
                        <div class="secure-badge">
                            <svg style="width: 20px; height: 20px; fill: currentColor;" viewBox="0 0 24 24">
                                <path d="M18 8h-1V6c0-2.76-2.24-5-5-5S7 3.24 7 6v2H6c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V10c0-1.1-.9-2-2-2zm-6 9c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2zm3.1-9H8.9V6c0-1.71 1.39-3.1 3.1-3.1 1.71 0 3.1 1.39 3.1 3.1v2z"/>
                            </svg>
                            Secure Payment
                        </div>

                        <form method="POST" action="payment.php" novalidate>
                            <!-- Cardholder Name -->
                            <div class="form-group <?php echo isset($errors['card_name']) ? 'error' : ''; ?>">
                                <label for="card_name">Cardholder Name <span style="color: #d32f2f;">*</span></label>
                                <input 
                                    type="text" 
                                    id="card_name" 
                                    name="card_name" 
                                    required
                                    value="<?php echo htmlspecialchars($form_data['card_name'] ?? ''); ?>"
                                    placeholder="John Doe"
                                >
                                <?php if (isset($errors['card_name'])): ?>
                                    <span class="error-message"><?php echo htmlspecialchars($errors['card_name']); ?></span>
                                <?php endif; ?>
                            </div>

                            <!-- Card Number -->
                            <div class="form-group <?php echo isset($errors['card_number']) ? 'error' : ''; ?>">
                                <label for="card_number">Card Number <span style="color: #d32f2f;">*</span></label>
                                <input 
                                    type="text" 
                                    id="card_number" 
                                    name="card_number" 
                                    required
                                    maxlength="19"
                                    value="<?php echo htmlspecialchars($form_data['card_number'] ?? ''); ?>"
                                    placeholder="1234 5678 9012 3456"
                                >
                                <?php if (isset($errors['card_number'])): ?>
                                    <span class="error-message"><?php echo htmlspecialchars($errors['card_number']); ?></span>
                                <?php endif; ?>
                            </div>

                            <!-- Expiry and CVV -->
                            <div class="card-input-group-3">
                                <div class="form-group <?php echo isset($errors['expiry']) ? 'error' : ''; ?>">
                                    <label for="expiry_month">Month <span style="color: #d32f2f;">*</span></label>
                                    <select id="expiry_month" name="expiry_month" required>
                                        <option value="">MM</option>
                                        <?php for ($i = 1; $i <= 12; $i++): ?>
                                            <option value="<?php echo sprintf('%02d', $i); ?>" <?php echo (($form_data['expiry_month'] ?? '') === sprintf('%02d', $i)) ? 'selected' : ''; ?>>
                                                <?php echo sprintf('%02d', $i); ?>
                                            </option>
                                        <?php endfor; ?>
                                    </select>
                                </div>
                                <div class="form-group <?php echo isset($errors['expiry']) ? 'error' : ''; ?>">
                                    <label for="expiry_year">Year <span style="color: #d32f2f;">*</span></label>
                                    <select id="expiry_year" name="expiry_year" required>
                                        <option value="">YYYY</option>
                                        <?php for ($i = date('Y'); $i <= date('Y') + 10; $i++): ?>
                                            <option value="<?php echo $i; ?>" <?php echo (($form_data['expiry_year'] ?? '') === (string)$i) ? 'selected' : ''; ?>>
                                                <?php echo $i; ?>
                                            </option>
                                        <?php endfor; ?>
                                    </select>
                                    <?php if (isset($errors['expiry'])): ?>
                                        <span class="error-message"><?php echo htmlspecialchars($errors['expiry']); ?></span>
                                    <?php endif; ?>
                                </div>
                                <div class="form-group <?php echo isset($errors['cvv']) ? 'error' : ''; ?>">
                                    <label for="cvv">CVV <span style="color: #d32f2f;">*</span></label>
                                    <input 
                                        type="text" 
                                        id="cvv" 
                                        name="cvv" 
                                        required
                                        maxlength="4"
                                        value="<?php echo htmlspecialchars($form_data['cvv'] ?? ''); ?>"
                                        placeholder="123"
                                    >
                                    <?php if (isset($errors['cvv'])): ?>
                                        <span class="error-message"><?php echo htmlspecialchars($errors['cvv']); ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div style="margin-top: 2rem;">
                                <button type="submit" class="btn btn-primary" style="width: 100%; font-size: 1.1rem; padding: 1.25rem;">
                                    Pay $<?php echo number_format($total_amount, 2); ?> & Complete Booking
                                </button>
                            </div>

                            <div style="margin-top: 1rem; text-align: center;">
                                <a href="confirm.php" class="btn btn-secondary" style="width: 100%;">Back to Confirmation</a>
                            </div>
                        </form>
                    </div>
                </div>
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

