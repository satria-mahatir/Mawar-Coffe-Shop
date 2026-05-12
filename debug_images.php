<?php
ob_start();
require 'index.php';
$html = ob_get_clean();
// Check for PHP errors in output
if (stripos($html, 'Warning:') !== false || stripos($html, 'Fatal error') !== false || stripos($html, 'Notice:') !== false || stripos($html, 'Parse error') !== false) {
    echo "ERRORS FOUND IN OUTPUT!\n";
    // Find error lines
    $lines = explode("\n", $html);
    foreach ($lines as $i => $line) {
        if (preg_match('/(Warning|Fatal|Notice|Parse error|Deprecated)/i', $line)) {
            echo "LINE $i: " . trim($line) . "\n";
        }
    }
} else {
    echo "NO ERRORS IN OUTPUT\n";
}

// Check CSS link
if (stripos($html, 'style.css') !== false) {
    echo "CSS FILE: FOUND\n";
} else {
    echo "CSS FILE: MISSING FROM HTML!\n";
}

// Check JS link
if (stripos($html, 'main.js') !== false) {
    echo "JS FILE: FOUND\n";
} else {
    echo "JS FILE: MISSING FROM HTML!\n";
}

// Check images
preg_match_all('/src="images\/([^"]+)"/', $html, $matches);
echo "\nIMAGE REFERENCES (" . count($matches[1]) . " total):\n";
foreach(array_unique($matches[1]) as $img) {
    $exists = file_exists("images/" . $img) ? "OK" : "MISSING!";
    echo "  $img => $exists\n";
}

// Show HTML length
echo "\nHTML LENGTH: " . strlen($html) . " bytes\n";

// Show first 500 chars to check structure
echo "\nFIRST 500 CHARS:\n";
echo substr($html, 0, 500);
