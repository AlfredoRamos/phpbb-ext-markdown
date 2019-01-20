### About

Markdown extension for phpBB.

[![Build Status](https://img.shields.io/travis/com/AlfredoRamos/phpbb-ext-markdown.svg?style=flat-square)](https://travis-ci.com/AlfredoRamos/phpbb-ext-markdown)
[![Latest Stable Version](https://img.shields.io/github/tag/AlfredoRamos/phpbb-ext-markdown.svg?label=stable&style=flat-square)](https://github.com/AlfredoRamos/phpbb-ext-markdown/releases)
[![Code Quality](https://img.shields.io/codacy/grade/7c1665095088482e9f023c96ed569653.svg?style=flat-square)](https://app.codacy.com/app/AlfredoRamos/phpbb-ext-markdown)
[![License](https://img.shields.io/github/license/AlfredoRamos/phpbb-ext-markdown.svg?style=flat-square)](https://raw.githubusercontent.com/AlfredoRamos/phpbb-ext-markdown/master/license.txt)

### Dependencies

- PHP 5.6 or greater
- phpBB 3.2 or greater

### Installation

- Download the [latest release](https://github.com/AlfredoRamos/phpbb-ext-markdown/releases)
- Decompress the `*.zip` or `*.tar.gz` file
- Copy the files and directories inside `{PHPBB_ROOT}/ext/alfredoramos/markdown/`
- Go to your `Administration Control Panel` > `Customize` > `Manage extensions`
- Click on `Enable` and confirm

### Usage

It uses the plugin Litedown from [s9e/TextFormatter](https://github.com/s9e/TextFormatter).

You can read more about the supported syntax in the official documentation:

https://s9etextformatter.readthedocs.io/Plugins/Litedown/Syntax/

### Configuration

TODO

### Uninstallation

- Go to your `Administration Control Panel` > `Customize` > `Manage extensions`
- Click on `Disable` and confirm
- Go back to `Manage extensions` > `Markdown` > `Delete data` and confirm

### Upgrade

- Uninstall the extension
- Delete all the files inside `{PHPBB_ROOT}/ext/alfredoramos/markdown/`
- Download the new version
- Install the extension
