Make a file available to download only once per email address or only if the user is logged in.

**NOTE**: assets must be private (otherwise they are publicly accessible and can always be downloaded)

# Installation

1. Download and unzip
2. Copy `Downlaod` folder to `yoursite/site/addons`

# Configuration (optional)
1. Visit `yoursite.com/cp/addons/download/settings` or `CP > Configure > Addons > Download`
2. Pick the asset container (only private ones are shown)

# Usage

## By User

The `{{ download }}` tag will only allow the file to be downloaded if the user is logged in.
Parameters:

* `file` (required) - name of the file
* `container` (optional) - container the file is in. If you leave it out, the one in the settings will be used.

## Only Once

The `{{ download:once }}` tag will only allow the file to be downloaded once per email address.
Parameters:

* `file` (required) - name of the file
* `container` (optional) - container the file is in. If you leave it out, the one in the settings will be used.
* `email` (required) - email address allowed to download the file

## Error

Use the `{{ download:errors }}` the same way you would the `{{ form:errors }}`, i.e. as single tag or a tag pair.

For example:

```
{{ if {download:errors} }}
    {{ download:errors }}
        {{ value }}
    {{ /download:errors }}
{{ /if }}
```
