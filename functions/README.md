# WordPress Testimonials Custom Post Type

Add a custum post type for testimonails in WordPress.

This includes Advanced Custom Fields field groups for some extra fields.

### Usage
Create a directory to store all files.

```
mkdir -p library/custom-post-types/testimonial
```

Place all files in this directory and include `require.php`.

```php
require_once 'library/custom-post-types/testimonial/require.php';
```

### Requirements
Advanced Custom Fields plugin installed.

Admin style requires the directory structure to be `'library/custom-post-types/testimonial/'`. This can be edited in `_add-custom-admin-css.php` to something more suitable.
