# Blade Directives

[![MIT Licensed](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)

This package provides a way to allow logged in users to download private assets.

## Requirements

- PHP 8.0+
- Statamic v3.2+

## Installation

You can install this package via composer using:

```bash
composer require edalzell/download
```

The package will automatically register itself.

**NOTE**: assets must be private (otherwise they are publicly accessible and can always be downloaded)

# Usage

## By User

The `{{ download }}` tag will only allow the file to be downloaded if the user is logged in.
Parameters:

* `file` (required) - name of the file
* `container` (required) - container the file is in.
