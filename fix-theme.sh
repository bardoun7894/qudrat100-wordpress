#!/bin/bash
# Fix WordPress theme on live server

cd domains/qudrat100.com/public_html

echo "=== Activating custom-theme ==="
wp theme activate custom-theme --allow-root

echo "=== Clearing WordPress cache ==="
wp cache flush --allow-root

echo "=== Clearing transients ==="
wp transient delete --all --allow-root

echo "=== Flushing rewrite rules ==="
wp rewrite flush --allow-root

echo "=== Verifying theme is active ==="
wp theme list --allow-root

echo "=== Checking CSS enqueue ==="
wp eval 'wp_enqueue_scripts(); global $wp_styles; if(isset($wp_styles->registered["main-assets-css"])) { echo "✅ main-assets-css is registered!\n"; echo "URL: " . $wp_styles->registered["main-assets-css"]->src . "\n"; } else { echo "❌ main-assets-css NOT found\n"; }' --allow-root

echo "✅ Done! Check https://qudrat100.com now!"
