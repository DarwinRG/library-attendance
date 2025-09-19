<?php
/**
 * Timezone Helper Functions
 * Provides functions to get and set timezone settings
 */

/**
 * Get the current timezone setting from database
 * @param mysqli $conn Database connection
 * @return string Timezone string (default: Asia/Manila)
 */
function getCurrentTimezone($conn) {
    $stmt = $conn->prepare("SELECT setting_value FROM settings WHERE setting_key = 'timezone'");
    $stmt->execute();
    $result = $stmt->get_result();
    $timezone_setting = $result->fetch_assoc();
    return $timezone_setting ? $timezone_setting['setting_value'] : 'Asia/Manila';
}

/**
 * Set the timezone for the current session
 * @param mysqli $conn Database connection
 */
function setTimezoneFromDatabase($conn) {
    $timezone = getCurrentTimezone($conn);
    date_default_timezone_set($timezone);
}

/**
 * Update timezone setting in database
 * @param mysqli $conn Database connection
 * @param string $timezone New timezone value
 * @return bool Success status
 */
function updateTimezoneSetting($conn, $timezone) {
    $stmt = $conn->prepare("INSERT INTO settings (setting_key, setting_value) VALUES ('timezone', ?) ON DUPLICATE KEY UPDATE setting_value = ?");
    $stmt->bind_param("ss", $timezone, $timezone);
    return $stmt->execute();
}

/**
 * Get formatted current time based on database timezone
 * @param mysqli $conn Database connection
 * @param string $format Date format (default: 'F j, Y g:i A')
 * @return string Formatted date/time string
 */
function getCurrentTimeFormatted($conn, $format = 'F j, Y g:i A') {
    setTimezoneFromDatabase($conn);
    return date($format);
}

/**
 * Get current timezone name for display
 * @param mysqli $conn Database connection
 * @return string Timezone name
 */
function getCurrentTimezoneName($conn) {
    setTimezoneFromDatabase($conn);
    return date_default_timezone_get();
}
?> 