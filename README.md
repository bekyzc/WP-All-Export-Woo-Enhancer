# WP-All-Export-Woo-Enhancer
Enhance your WooCommerce product exports with this custom WordPress plugin, designed to integrate seamlessly with WP All Export. It adds detailed product information including images, categories, descriptions, features, and specifications to your CSV exports, ensuring comprehensive and user-friendly data management.

# WooCommerce Product Export Enhancement for functions.php

## Overview

This enhancement is designed to be added to your WordPress theme's `functions.php` file. It extends WooCommerce's product export capabilities when using the WP All Export plugin, enriching the exported CSV file with additional product details such as images, categories, descriptions, features, and specifications.

## Features

- **Comprehensive Export Data**: Adds detailed columns to your product export, including images, categories, descriptions, features, and specifications.
- **Enhanced Image Export**: Supports exporting the main image and additional gallery images.
- **Category Details**: Extracts both main and subcategories for each product.
- **Clean Product Descriptions**: Exports full and short descriptions, free from HTML markup.
- **Customizable Output**: Easily modify the code to add or remove export columns according to your needs.

## Installation

1. Ensure you have WordPress with WooCommerce and the WP All Export plugin installed.
2. Open your theme's `functions.php` file.
3. Copy and paste the code from this repository into your `functions.php` file.
4. Save the changes.

## Usage

Simply run the export process in WP All Export. The new fields will automatically be included in your WooCommerce product exports.

## Customization

- Adjust the export ID in the code for specific export processes.
- Modify the `$additional_headers` array in the `wpae_wp_all_export_csv_headers` function to customize columns.
- Alter the data extraction logic in `wp_all_export_csv_rows` for different data formats or requirements.

## Contribution

Contributions to enhance this code are welcome. Please adhere to WordPress coding standards and ensure thorough testing of any changes.

## License

This code is open-source, released under the MIT License. See the LICENSE file for more details.
