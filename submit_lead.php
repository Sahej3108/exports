<?php
/**
 * submit-lead.php
 * 1. Sends email notification to sales team
 * 2. Logs lead data to Google Sheets
 * Place this file in the root directory of your website.
 */

// ─── CONFIGURATION ────────────────────────────────────────────────────────────
$to               = 'sales@takkarpolychem.com';
$subject          = 'New Chatbot Lead – Takkar Polychem Website';
$from_email       = 'noreply@takkarpolychem.com'; // Must be on your domain
$google_sheet_url = 'https://script.google.com/macros/s/AKfycbxMPlS3mAX_pYSkV1NFav7_7bHvwCWuqVxlbofdlgCoYKZXUoxCxB3AyeXqmI4dhTzp5w/exec';
// ──────────────────────────────────────────────────────────────────────────────

// Sanitize inputs
function clean($value) {
    return htmlspecialchars(strip_tags(trim($value)), ENT_QUOTES, 'UTF-8');
}

$name        = clean($_POST['name']        ?? '');
$email       = clean($_POST['email']       ?? '');
$requirement = clean($_POST['requirement'] ?? '');
$source      = clean($_POST['source']      ?? 'Website Chatbot');
$ip          = $_SERVER['REMOTE_ADDR'] ?? 'Unknown';
date_default_timezone_set('Asia/Kolkata');
$date        = date('d M Y, h:i A');

// ── 1. SEND EMAIL ──────────────────────────────────────────────────────────────
$body  = "New lead received from the website chatbot.\n\n";
$body .= "─────────────────────────────\n";
$body .= "Name        : " . ($name        ?: 'Not provided') . "\n";
$body .= "Email       : " . ($email       ?: 'Not provided') . "\n";
$body .= "Requirement : " . ($requirement ?: 'Not provided') . "\n";
$body .= "Source      : {$source}\n";
$body .= "─────────────────────────────\n";
$body .= "Submitted on: {$date}\n";
$body .= "IP Address  : {$ip}\n";

$headers  = "From: {$from_email}\r\n";
$headers .= "Reply-To: {$email}\r\n";
$headers .= "X-Mailer: PHP/" . phpversion() . "\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

mail($to, $subject, $body, $headers);

// ── 2. LOG TO GOOGLE SHEETS ────────────────────────────────────────────────────
$payload = json_encode([
    'date'        => $date,
    'name'        => $name,
    'email'       => $email,
    'requirement' => $requirement,
    'source'      => $source,
    'ip'          => $ip
]);

$ch = curl_init($google_sheet_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_POST,           true);
curl_setopt($ch, CURLOPT_POSTFIELDS,     $payload);
curl_setopt($ch, CURLOPT_HTTPHEADER,     ['Content-Type: application/json']);
curl_setopt($ch, CURLOPT_TIMEOUT,        10);
curl_exec($ch);
curl_close($ch);

// No visible response needed — form submits into a hidden iframe
?>