# TYPO3 Features Extension (ms_features)

A TYPO3 CMS extension for managing and displaying features in a responsive card-based grid layout.

## Features

- **Feature management** — title, subtitle, perex (plain text), description (rich text), multiple images
- **Topped features** — mark features as topped to highlight them visually and sort them first
- **Flexible ordering** — by sorting + topped (default), sorting only, UID, or alphabetically
- **Filtering** — show all features or only topped ones
- **Responsive grid** — CSS grid layout adapting from 1 to 3+ columns
- **Template layouts** — support for custom template overrides via TypoScript or PHP globals
- **Multilingual** — English, German, and Czech translations included
- **No JavaScript** — pure CSS layout, no JS dependencies

## Requirements

- PHP 8.3+
- TYPO3 13.4+ or 14.1+

## Installation

### Composer

```bash
composer require marekskopal/typo3-features
```

### Setup

1. Install the extension
2. Include the static TypoScript template "Features" in your site
3. Create Feature records on your storage page
4. Add the "Features" content element to your page

## Backend Setup

Create **Feature** records on the page where the content element is placed:

- **Title** — feature title (required)
- **Subtitle** — optional subtitle
- **Perex** — optional short description (plain text)
- **Description** — full description with rich text editor
- **Images** — one or more images; the first image is used as the main image in the card layout
- **Topped** — mark the feature as topped for visual highlighting and priority sorting

Drag and drop features to set their display order. Then add the **Features** content element to the same page.

## Content Element Options (FlexForm)

| Option | Values | Default |
|--------|--------|---------|
| **Ordering** | Topped + sorting, Sorting, UID, Alphabetically | Topped + sorting |
| **Filter** | Show all, Only topped | Show all |
| **Template layout** | Custom layouts via TypoScript/PHP | — |

## Template Layouts

Register custom template layouts in Page TSconfig:

```typoscript
tx_msfeatures.templateLayouts {
    my_layout = My custom layout
}
```

Or in PHP (e.g. `ext_localconf.php`):

```php
$GLOBALS['TYPO3_CONF_VARS']['EXT']['ms_features']['templateLayouts'][] = ['My layout label', 'my_layout'];
```

Then configure the corresponding template paths in TypoScript:

```typoscript
plugin.tx_msfeatures_feature.settings.templateLayouts {
    my_layout {
        templateRootPath = EXT:your_extension/Resources/Private/Templates/MsFeatures/MyLayout/
        partialRootPath  = EXT:your_extension/Resources/Private/Partials/MsFeatures/MyLayout/
        layoutRootPath   = EXT:your_extension/Resources/Private/Layouts/MsFeatures/MyLayout/
    }
}
```

## Customization

### Templates

Override templates by setting custom paths in TypoScript constants:

```typoscript
plugin.tx_msfeatures_feature.view {
    templateRootPath = EXT:your_extension/Resources/Private/Templates/MsFeatures/
    partialRootPath = EXT:your_extension/Resources/Private/Partials/MsFeatures/
    layoutRootPath = EXT:your_extension/Resources/Private/Layouts/MsFeatures/
}
```

### Styling

The extension includes minimal CSS. Key classes:

| Class | Element |
|-------|---------|
| `.msfeatures-wrapper` | Outer wrapper (max-width 1200px) |
| `.msfeatures__list` | CSS grid container |
| `.msfeatures__item` | Single feature card |
| `.msfeatures__item--topped` | Topped feature card (highlighted border) |
| `.msfeatures__image` | Image container |
| `.msfeatures__title` | Feature title |
| `.msfeatures__subtitle` | Feature subtitle |
| `.msfeatures__perex` | Perex text |
| `.msfeatures__description` | RTE description |

## Feature Model

| Field | Type | Description |
|-------|------|-------------|
| `title` | string | Feature title (required) |
| `subtitle` | string | Feature subtitle |
| `perex` | text | Short description (plain text) |
| `description` | RTE | Full description (rich text) |
| `images` | FAL | Multiple images; `getMainImage()` returns the first |
| `top` | boolean | Topped flag for highlighting and priority sorting |

## License

GPL-2.0-or-later
