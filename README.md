### About

Markdown extension for phpBB.

[![Build Status](https://img.shields.io/github/actions/workflow/status/AlfredoRamos/phpbb-ext-markdown/ci.yml?style=flat-square)](https://github.com/AlfredoRamos/phpbb-ext-markdown/actions)
[![Latest Stable Version](https://img.shields.io/github/tag/AlfredoRamos/phpbb-ext-markdown.svg?label=stable&style=flat-square)](https://github.com/AlfredoRamos/phpbb-ext-markdown/releases)
[![Code Quality](https://img.shields.io/codacy/grade/7c8dbf2b5e6c4a68b7e0ceb04e9790f3.svg?style=flat-square)](https://app.codacy.com/gh/AlfredoRamos/phpbb-ext-markdown/dashboard)
[![Translation Progress](https://badges.crowdin.net/phpbb-ext-markdown/localized.svg)](https://crowdin.com/project/phpbb-ext-markdown)
[![License](https://img.shields.io/github/license/AlfredoRamos/phpbb-ext-markdown.svg?style=flat-square)](https://raw.githubusercontent.com/AlfredoRamos/phpbb-ext-markdown/main/license.txt)

Allows you to write Markdown text in posts, signature or private messages and it will be converted as HTML. It can be used instead of or alongside BBCodes.

It uses the plugins [Litedown](https://s9etextformatter.readthedocs.io/Plugins/Litedown/Syntax/), [PipeTables](https://s9etextformatter.readthedocs.io/Plugins/PipeTables/Syntax/) and [TaskLists](https://s9etextformatter.readthedocs.io/Plugins/TaskLists/Synopsis/) from the [s9e/TextFormatter](https://github.com/s9e/TextFormatter) library.

### Features

- Use Markdown in posts, personal messages and signatures
- Can be used instead of or alongside text formatted with BBCode
- Configuration to enable/disable the use of Markdown globally in the ACP
- Configuration to enable/disable the use of Markdown per user in the UCP
- Set per user group permissions to use Markdown
- Set per forum permissions to use Markdown
- Posting option to disable Markdown only in the current message
- Add help page to explain users how write messages in Markdown
- Add indentation when pressing the tab key inside Markdown code blocks
- Autogeneration of slugs/IDs for headings

### Requirements

- PHP 8.1 or greater
- phpBB 3.3 or greater

### Support

- [**Download page**](https://www.phpbb.com/customise/db/extension/markdown/)
- [Support area](https://www.phpbb.com/customise/db/extension/markdown/support)
- [GitHub issues](https://github.com/AlfredoRamos/phpbb-ext-markdown/issues)
- [Crowdin translations](https://crowdin.com/project/phpbb-ext-markdown)

### Donate

If you like or found my work useful and want to show some appreciation, you can consider supporting its development by [**giving a donation**](https://alfredoramos.mx/donate/).

### Installation

- Download the [latest release](https://github.com/AlfredoRamos/phpbb-ext-markdown/releases)
- Decompress the `*.zip` or `*.tar.gz` file
- Copy the files and directories inside `{PHPBB_ROOT}/ext/alfredoramos/markdown/`
- Go to your `Administration Control Panel` > `Customize` > `Manage extensions`
- Click on `Enable` and confirm

### Preview

See the [full blog post](https://alfredoramos.mx/markdown-extension-for-phpbb/) for the screenshots gallery.

### Configuration

#### Administrator

To enable or disable globally:

- Go to your `Administration Control Panel` > `Board features` > `Allow Markdown`
- Change settings as needed
- Click on `Submit`

To change forum permissions:

- Go to your `Administration Control Panel` > `Permissions` > `Forum permissions`
- Select the forums and click on `Submit`
- Select the users or groups and click on `Edit permissions`
- Select the users or groups and click on `Advanced Permissions`
- Go to `Content` and change the settings as needed
- Click on `Apply all permissions`

To change user group permissions:

- Go to your `Administration Control Panel` > `Permissions` > `Group permissions`
- Select the group and click on `Submit`
- Click on `Advanced permissions`
- Go to `Post` or `Private messages` and change settings as needed
- Click on `Apply all permissions`

#### User

To change default posting settings:

- Go to your `User Control Panel` > `Board preferences` > `Posting defaults`
- Change the settings as needed
- Click on `Submit`

To disable Markdown only in the current message (post, signature or private message):

- Go down to the posting editor options
- Check the option `Disable Markdown`
- Click on `Preview` or `Submit`

### Uninstallation

- Go to your `Administration Control Panel` > `Customize` > `Manage extensions`
- Click on `Disable` and confirm
- Go back to `Manage extensions` > `Markdown` > `Delete data` and confirm

### Upgrade

- Go to your `Administration Control Panel` > `Customize` > `Manage extensions`
- Click on `Disable` and confirm
- Delete all the files inside `{PHPBB_ROOT}/ext/alfredoramos/markdown/`
- Download the new version
- Upload the new files inside `{PHPBB_ROOT}/ext/alfredoramos/markdown/`
- Enable the extension again
