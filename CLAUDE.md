# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Build & Quality Commands

```bash
# Install dependencies
composer install

# Static analysis (level max)
./vendor/bin/phpstan analyse

# Code style check (PSR-12 + Slevomat)
./vendor/bin/phpcs

# Auto-fix code style
./vendor/bin/phpcbf

# Run tests
./vendor/bin/phpunit
```

## Architecture

This is a TYPO3 CMS extension (`ms_features`) that provides a feature showcase with card-based grid layout.

**Namespace:** `MarekSkopal\MsFeatures`

### Key Components

- **FeatureController** (`Classes/Controller/`) - Extbase controller with `listAction()` to render the feature list
- **Feature** (`Classes/Domain/Model/`) - Domain model with title, subtitle, perex, description (RTE), images (FAL `ObjectStorage<FileReference>`), and topped flag; includes `getMainImage()` to retrieve the first image
- **FeatureRepository** (`Classes/Domain/Repository/`) - Multiple ordering methods and topped-only filtering

### Data Flow

1. `listAction()` loads features based on FlexForm settings (ordering + filter)
2. Fluid template renders a responsive CSS grid of feature cards
3. Each feature partial renders an image, title, subtitle, perex, and RTE description

### Template Structure

- `Layouts/Default.html` — wraps content in `.msfeatures-wrapper`
- `Templates/Feature/List.html` — iterates features, passes each to partial
- `Partials/Feature/Item.html` — renders feature card with image, title, subtitle, perex, and description

### Configuration

- TypoScript Sets (TYPO3 13+) are in `Configuration/Sets/MsFeatures/`
- FlexForm provides ordering (topped+sorting, sorting, UID, alphabetical) and filter (all, only topped) options
- No additional configurable settings — CSS is included automatically

## Requirements

- PHP 8.3+
- TYPO3 13.4+ or 14.1+

## Code Style

- Strict types enabled in all files
- **No constructor property promotion in Extbase domain models** — TYPO3 Extbase hydrates models by setting protected properties directly (bypassing the constructor), so properties must be declared classically with default values
- PHPStan level `max` with bleeding edge; `method.internalClass` ignored globally (needed for `getUid()` on Extbase entities)
- PSR-12 with Slevomat Coding Standard
