<?php
/**
 * BOOKING CONFIRMATION PAGE
 * Displays booking details for user confirmation before payment
 */

session_start();

// Check if booking data exists in session
if (!isset($_SESSION['booking_data'])) {
    header('Location: contact.php');
    exit();
}

$booking = $_SESSION['booking_data'];

// Package labels and prices
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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Confirm your safari booking details">
    <title>Confirm Booking | Safari Luxe</title>
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
                <li><a href="contact.php">Book Now</a></li>
            </ul>
        </nav>
    </header>

    <!-- Confirmation Section -->
    <section class="contact-section">
        <div class="container">
            <div class="contact-container">
                <div class="section-title">
                    <h2>Confirm Your Booking</h2>
                    <p>Please review your booking details before proceeding to payment</p>
                </div>

                <div class="contact-form" style="max-width: 800px; margin: 0 auto;">
                    <div style="background-color: var(--color-gray-light); padding: 2rem; border-radius: 8px; margin-bottom: 2rem;">
                        <h3 style="margin-bottom: 1.5rem; color: var(--color-gold); border-bottom: 2px solid var(--color-gold); padding-bottom: 0.5rem;">Booking Summary</h3>
                        
                        <div style="display: grid; gap: 1.5rem;">
                            <div>
                                <strong style="color: var(--color-black); display: block; margin-bottom: 0.5rem;">Guest Name:</strong>
                                <p style="color: var(--color-charcoal);"><?php echo htmlspecialchars($booking['name']); ?></p>
                            </div>
                            
                            <div>
                                <strong style="color: var(--color-black); display: block; margin-bottom: 0.5rem;">Email:</strong>
                                <p style="color: var(--color-charcoal);"><?php echo htmlspecialchars($booking['email']); ?></p>
                            </div>
                            
                            <div>
                                <strong style="color: var(--color-black); display: block; margin-bottom: 0.5rem;">Phone:</strong>
                                <p style="color: var(--color-charcoal);"><?php echo htmlspecialchars($booking['phone']); ?></p>
                            </div>
                            
                            <div>
                                <strong style="color: var(--color-black); display: block; margin-bottom: 0.5rem;">Safari Package:</strong>
                                <p style="color: var(--color-charcoal); font-size: 1.1rem; font-weight: 600;"><?php echo htmlspecialchars($package_info['name']); ?></p>
                            </div>
                            
                            <div>
                                <strong style="color: var(--color-black); display: block; margin-bottom: 0.5rem;">Preferred Date:</strong>
                                <p style="color: var(--color-charcoal);"><?php echo date('F j, Y', strtotime($booking['date'])); ?></p>
                            </div>
                            
                            <div>
                                <strong style="color: var(--color-black); display: block; margin-bottom: 0.5rem;">Number of Guests:</strong>
                                <p style="color: var(--color-charcoal);"><?php echo htmlspecialchars($booking['guests']); ?> person(s)</p>
                            </div>
                            
                            <?php if (!empty($booking['message'])): ?>
                            <div>
                                <strong style="color: var(--color-black); display: block; margin-bottom: 0.5rem;">Special Requests:</strong>
                                <p style="color: var(--color-charcoal);"><?php echo nl2br(htmlspecialchars($booking['message'])); ?></p>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div style="background-color: var(--color-black); color: var(--color-white); padding: 2rem; border-radius: 8px; margin-bottom: 2rem;">
                        <h3 style="margin-bottom: 1.5rem; color: var(--color-gold);">Payment Summary</h3>
                        
                        <div style="display: flex; justify-content: space-between; margin-bottom: 1rem; padding-bottom: 1rem; border-bottom: 1px solid rgba(255,255,255,0.2);">
                            <span><?php echo htmlspecialchars($package_info['name']); ?> × <?php echo htmlspecialchars($booking['guests']); ?></span>
                            <span style="font-weight: 600;">$<?php echo number_format($package_info['price'], 2); ?> × <?php echo htmlspecialchars($booking['guests']); ?></span>
                        </div>
                        
                        <div style="display: flex; justify-content: space-between; font-size: 1.5rem; font-weight: 700; color: var(--color-gold); margin-top: 1rem;">
                            <span>Total Amount:</span>
                            <span>$<?php echo number_format($total_amount, 2); ?></span>
                        </div>
                    </div>

                    <div style="display: flex; gap: 1rem; flex-wrap: wrap;">
                        <a href="contact.php" class="btn btn-secondary" style="flex: 1; min-width: 150px; text-align: center;">Edit Booking</a>
                        <form method="POST" action="payment.php" style="flex: 1; min-width: 150px;">
                            <button type="submit" class="btn btn-primary" style="width: 100%;">Proceed to Payment</button>
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

