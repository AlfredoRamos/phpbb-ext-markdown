### About

Markdown extension for phpBB.

[![Build Status](https://img.shields.io/travis/com/AlfredoRamos/phpbb-ext-markdown.svg?style=flat-square)](https://travis-ci.com/AlfredoRamos/phpbb-ext-markdown)
[![Latest Stable Version](https://img.shields.io/github/tag/AlfredoRamos/phpbb-ext-markdown.svg?label=stable&style=flat-square)](https://github.com/AlfredoRamos/phpbb-ext-markdown/releases)
[![Code Quality](https://img.shields.io/codacy/grade/7c8dbf2b5e6c4a68b7e0ceb04e9790f3.svg?style=flat-square)](https://app.codacy.com/manual/AlfredoRamos/phpbb-ext-markdown/dashboard)
[![License](https://img.shields.io/github/license/AlfredoRamos/phpbb-ext-markdown.svg?style=flat-square)](https://raw.githubusercontent.com/AlfredoRamos/phpbb-ext-markdown/master/license.txt)

Write Markdown text in posts, signature or private messages and it will be converted as HTML. It can be used instead of or alongside BBCodes.

It uses the plugins Litedown and PipeTables from [s9e/TextFormatter](https://github.com/s9e/TextFormatter). You can read more about the supported syntax in the official documentation:

- [Litedown: Syntax](https://s9etextformatter.readthedocs.io/Plugins/Litedown/Syntax/)
- [PipeTables: Syntax](https://s9etextformatter.readthedocs.io/Plugins/PipeTables/Syntax/)

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

### Requirements

- PHP 7.1.3 or greater
- phpBB 3.3 or greater

### Support

- [**Download page**](https://www.phpbb.com/customise/db/extension/markdown/)
- [Support area](https://www.phpbb.com/customise/db/extension/markdown/support)
- [GitHub issues](https://github.com/AlfredoRamos/phpbb-ext-markdown/issues)

### Donate

If you like or found my work useful and want to show some appreciation, you can consider supporting its development by giving a donation.

[![Donate with PayPal](https://alfredoramos.github.io/assets/images/donate.png)](https://alfredoramos.github.io/donate/)

[![Donate with PayPal](https://www.paypalobjects.com/webstatic/i/logo/rebrand/ppcom.svg)](https://alfredoramos.github.io/donate/)

### Installation

- Download the [latest release](https://github.com/AlfredoRamos/phpbb-ext-markdown/releases)
- Decompress the `*.zip` or `*.tar.gz` file
- Copy the files and directories inside `{PHPBB_ROOT}/ext/alfredoramos/markdown/`
- Go to your `Administration Control Panel` > `Customize` > `Manage extensions`
- Click on `Enable` and confirm

### Usage

Write Markdown text in posts, signature or private messages and it will be converted as HTML. It can be used instead of or alongside BBCodes.

It uses the plugins Litedown and PipeTables from [s9e/TextFormatter](https://github.com/s9e/TextFormatter). You can read more about the supported syntax in the official documentation:

- [Litedown: Syntax](https://s9etextformatter.readthedocs.io/Plugins/Litedown/Syntax/)
- [PipeTables: Syntax](https://s9etextformatter.readthedocs.io/Plugins/PipeTables/Syntax/)

### Preview

[![Board features](https://i.imgur.com/PSGGuM3b.png)](https://i.imgur.com/PSGGuM3.png)
[![Post settings](https://i.imgur.com/qYZ7JBCb.png)](https://i.imgur.com/qYZ7JBC.png)
[![Private message settings](https://i.imgur.com/np1PqN6b.png)](https://i.imgur.com/np1PqN6.png)
[![Signature settings](https://i.imgur.com/aEKJxWRb.png)](https://i.imgur.com/aEKJxWR.png)
[![Post group permissions](https://i.imgur.com/eiJJvbMb.png)](https://i.imgur.com/eiJJvbM.png)
[![Profile group permissions](https://i.imgur.com/spT9zXYb.png)](https://i.imgur.com/spT9zXY.png)
[![Private messages group permissions](https://i.imgur.com/YXcNxXKb.png)](https://i.imgur.com/YXcNxXK.png)
[![Forum permissions](https://i.imgur.com/5GIQpMVb.png)](https://i.imgur.com/5GIQpMV.png)
[![User posting defaults](https://i.imgur.com/zWhjOfVb.png)](https://i.imgur.com/zWhjOfV.png)
[![Markdown post](https://i.imgur.com/kba871fb.png)](https://i.imgur.com/kba871f.png)
[![Markdown private message](https://i.imgur.com/HGvlwhIb.png)](https://i.imgur.com/HGvlwhI.png)
[![Markdown signature](https://i.imgur.com/svBmgYXb.png)](https://i.imgur.com/svBmgYX.png)
[![Posting editor option](https://i.imgur.com/1Z7CDDrb.png)](https://i.imgur.com/1Z7CDDr.png)

*(Click to view in full size)*

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

- Uninstall the extension
- Delete all the files inside `{PHPBB_ROOT}/ext/alfredoramos/markdown/`
- Download the new version
- Install the extension
