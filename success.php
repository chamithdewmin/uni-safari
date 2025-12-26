<?php
/**
 * SUCCESS / THANK YOU PAGE
 * Displays confirmation message after successful booking and payment
 */

session_start();

// Check if booking data exists in session
if (!isset($_SESSION['booking_data']) || !isset($_SESSION['booking_ref'])) {
    header('Location: contact.php');
    exit();
}

$booking = $_SESSION['booking_data'];
$booking_ref = $_SESSION['booking_ref'];

// Package labels
$packages = [
    'yala' => 'Yala Premium Safari',
    'wilpattu' => 'Wilpattu Adventure',
    'udawalawe' => 'Udawalawe Elephant Safari',
    'yala-morning' => 'Yala Morning Safari',
    'wilpattu-full' => 'Wilpattu Full Day Experience',
    'udawalawe-full' => 'Udawalawe Full Day Safari'
];

$package_name = isset($packages[$booking['package']]) ? $packages[$booking['package']] : 'your selected safari package';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Thank you for booking with Safari Luxe. Your safari adventure booking has been received.">
    <title>Booking Successfully Completed | Safari Luxe</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        @keyframes checkmark {
            0% {
                transform: scale(0);
                opacity: 0;
            }
            50% {
                transform: scale(1.1);
            }
            100% {
                transform: scale(1);
                opacity: 1;
            }
        }
        @keyframes scaleIn {
            from {
                transform: scale(0);
                opacity: 0;
            }
            to {
                transform: scale(1);
                opacity: 1;
            }
        }
        .success-icon {
            animation: checkmark 0.6s ease 0.5s both;
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

    <!-- Success Page Content -->
    <section class="success-page">
        <div class="container">
            <div class="success-content" style="animation: fadeInUp 0.8s ease;">
                <div style="animation: scaleIn 0.6s ease 0.3s both;">
                    <svg class="success-icon" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="50" cy="50" r="40" fill="none" stroke="currentColor" stroke-width="3"/>
                        <path d="M30 50 L45 65 L70 35" fill="none" stroke="currentColor" stroke-width="5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                
                <h1 style="animation: fadeInUp 0.6s ease 0.4s both;">Booking Successfully Completed!</h1>
                
                <div style="background-color: var(--color-gray-light); padding: 2rem; border-radius: 8px; margin: 2rem 0; text-align: left; max-width: 600px; animation: fadeInUp 0.6s ease 0.6s both;">
                    <div style="text-align: center; margin-bottom: 1.5rem;">
                        <div style="font-size: 0.9rem; color: var(--color-charcoal); margin-bottom: 0.5rem;">Booking Reference</div>
                        <div style="font-size: 1.5rem; font-weight: 700; color: var(--color-gold); letter-spacing: 2px;"><?php echo htmlspecialchars($booking_ref); ?></div>
                    </div>
                    
                    <div style="border-top: 2px solid #ddd; padding-top: 1.5rem; margin-top: 1.5rem;">
                        <p style="margin-bottom: 1rem;"><strong>Guest Name:</strong> <?php echo htmlspecialchars($booking['name']); ?></p>
                        <p style="margin-bottom: 1rem;"><strong>Safari Package:</strong> <?php echo htmlspecialchars($package_name); ?></p>
                        <p style="margin-bottom: 1rem;"><strong>Date:</strong> <?php echo date('F j, Y', strtotime($booking['date'])); ?></p>
                        <p style="margin-bottom: 1rem;"><strong>Guests:</strong> <?php echo htmlspecialchars($booking['guests']); ?> person(s)</p>
                        <p><strong>Email:</strong> <?php echo htmlspecialchars($booking['email']); ?></p>
                    </div>
                </div>
                
                <div style="background-color: #4caf50; color: white; padding: 1.5rem; border-radius: 8px; margin-bottom: 2rem; animation: fadeInUp 0.6s ease 0.8s both;">
                    <p style="font-size: 1.1rem; margin: 0; font-weight: 600;">✓ Payment received successfully!</p>
                </div>
                
                <p style="margin-bottom: 2rem; color: var(--color-charcoal); animation: fadeInUp 0.6s ease 1s both;">
                    A confirmation email has been sent to <strong><?php echo htmlspecialchars($booking['email']); ?></strong> with your booking details and itinerary. 
                    Our team will contact you within 24 hours to finalize any additional arrangements.
                </p>
                
                <div style="margin-top: 3rem; animation: fadeInUp 0.6s ease 1.2s both;">
                    <a href="index.html" class="btn btn-primary">Return to Home</a>
                    <a href="packages.html" class="btn btn-secondary" style="margin-left: 1rem;">View More Packages</a>
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
