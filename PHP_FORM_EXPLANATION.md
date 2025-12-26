# PHP Booking Form - Technical Explanation

## Overview

The booking form (`contact.php`) is a server-side PHP application that handles safari tour booking submissions with comprehensive validation and security measures.

## How the Form Works Internally

### 1. Form Initialization

```php
// Initialize error and form data arrays
$errors = [];
$form_data = [];
```

When the page loads, PHP initializes empty arrays to store validation errors and form data for repopulation.

### 2. Package Configuration

```php
$packages = [
    'yala' => 'Yala Premium Safari - $299',
    // ... more packages
];
```

A PHP array defines all available safari packages. This centralizes package management and ensures consistency across the form.

### 3. URL Parameter Handling

```php
$selected_package = isset($_GET['package']) ? htmlspecialchars($_GET['package']) : '';
```

If a user clicks "Book Now" from a package card, the package is pre-selected via URL parameter. The value is sanitized using `htmlspecialchars()` to prevent XSS attacks.

### 4. Form Submission Detection

```php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Process form
}
```

PHP checks if the form was submitted using the POST method (more secure than GET for form data).

### 5. Input Sanitization

```php
$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
// ... etc
```

All form inputs are:
- Retrieved from `$_POST` superglobal
- Trimmed to remove whitespace
- Using null coalescing operator (`??`) to provide default empty string if field is missing

### 6. Data Storage for Repopulation

```php
$form_data = [
    'name' => $name,
    'email' => $email,
    // ... store all fields
];
```

Form data is stored in an array so that if validation fails, the form can be repopulated with user's input (better UX).

### 7. Validation Process

The form validates each field with specific rules:

#### Name Validation:
```php
if (empty($name)) {
    $errors['name'] = 'Full name is required.';
} elseif (strlen($name) < 2) {
    $errors['name'] = 'Name must be at least 2 characters long.';
} elseif (!preg_match("/^[a-zA-Z\s'-]+$/", $name)) {
    $errors['name'] = 'Name can only contain letters, spaces, hyphens, and apostrophes.';
}
```
- Checks if empty
- Validates minimum length
- Uses regex to allow only valid characters (prevents injection attacks)

#### Email Validation:
```php
if (empty($email)) {
    $errors['email'] = 'Email address is required.';
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = 'Please enter a valid email address.';
}
```
- Uses PHP's built-in `filter_var()` with `FILTER_VALIDATE_EMAIL` for proper email format validation

#### Phone Validation:
```php
if (empty($phone)) {
    $errors['phone'] = 'Phone number is required.';
} elseif (!preg_match("/^[\d\s\-\+\(\)]+$/", $phone)) {
    $errors['phone'] = 'Please enter a valid phone number.';
} elseif (strlen($phone) < 10) {
    $errors['phone'] = 'Phone number must be at least 10 digits.';
}
```
- Validates format using regex
- Checks minimum length

#### Date Validation:
```php
$selected_date = strtotime($date);
$today = strtotime('today');
if ($selected_date < $today) {
    $errors['date'] = 'Please select a future date.';
}
```
- Converts date string to timestamp
- Compares with today's date to ensure future booking

#### Guests Validation:
```php
if (!is_numeric($guests) || $guests < 1 || $guests > 20) {
    $errors['guests'] = 'Number of guests must be between 1 and 20.';
}
```
- Validates numeric input
- Checks range (1-20 guests)

### 8. Success Handling

```php
if (empty($errors)) {
    header('Location: success.php?name=' . urlencode($name) . '&package=' . urlencode($package));
    exit();
}
```

If validation passes:
- Uses `header()` function to redirect to success page
- Passes user name and package via URL parameters (URL-encoded for safety)
- `exit()` prevents any code after redirect from executing

### 9. Error Display

In the HTML form:
```php
<div class="form-group <?php echo isset($errors['name']) ? 'error' : ''; ?>">
    <input ... value="<?php echo htmlspecialchars($form_data['name'] ?? ''); ?>">
    <?php if (isset($errors['name'])): ?>
        <span class="error-message"><?php echo htmlspecialchars($errors['name']); ?></span>
    <?php endif; ?>
</div>
```

- Adds 'error' class to form group if error exists (for CSS styling)
- Repopulates input with sanitized user data
- Displays error message below field
- All output is escaped with `htmlspecialchars()` to prevent XSS

### 10. Security Features

1. **XSS Prevention:**
   - All user input is sanitized with `htmlspecialchars()` before display
   - URL parameters are sanitized

2. **Input Validation:**
   - Server-side validation (cannot be bypassed by disabling JavaScript)
   - Regex patterns prevent malicious input

3. **SQL Injection Prevention:**
   - While no database is used in this project, the code is structured to easily integrate prepared statements

4. **Form Repopulation:**
   - User data is safely repopulated on validation errors
   - Prevents data loss and improves UX

## Form Flow Diagram

```
User visits contact.php
    ↓
Form displays (GET request)
    ↓
User fills form and submits (POST request)
    ↓
PHP validates all fields
    ↓
    ├─→ Errors found?
    │   ├─→ YES: Display form with errors + repopulate fields
    │   └─→ NO: Redirect to success.php
    ↓
Success page displays confirmation
```

## Key PHP Functions Used

- `trim()` - Removes whitespace from strings
- `htmlspecialchars()` - Escapes HTML special characters (XSS prevention)
- `filter_var()` - Validates email format
- `preg_match()` - Pattern matching for validation
- `strtotime()` - Converts date strings to timestamps
- `header()` - Sends HTTP headers (for redirect)
- `urlencode()` - Encodes URL parameters safely
- `isset()` - Checks if variable is set
- `empty()` - Checks if variable is empty

## Why This Approach?

1. **Server-Side Validation:** Cannot be bypassed, ensures data integrity
2. **Security First:** All inputs sanitized, XSS prevention built-in
3. **User Experience:** Form repopulation on errors, clear error messages
4. **Maintainable:** Clean, commented code structure
5. **Scalable:** Easy to add database integration, email notifications, etc.

## Future Enhancements

The code includes comments indicating where you would:
- Save booking to database
- Send email notifications
- Process payments
- Generate booking confirmations

This structure makes it easy to extend functionality while maintaining security and code quality.

