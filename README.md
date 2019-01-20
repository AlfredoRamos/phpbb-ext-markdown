### About

Markdown extension for phpBB.

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
- Go back to `Manage extensions` > `Simple Spoiler` > `Delete data` and confirm

### Upgrade

- Uninstall the extension
- Delete all the files inside `{PHPBB_ROOT}/ext/alfredoramos/simplespoiler/`
- Download the new version
- Install the extension
