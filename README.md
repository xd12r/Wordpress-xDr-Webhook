# WordPress to Discord Webhook Integration
[![License](https://img.shields.io/github/license/xd12r/Wordpress-xDr-Webhook?color=green)](https://github.com/xd12r/Wordpress-xDr-Webhook)

This plugin works with Node.js Discord Bot for Webhook Integration
This project provides a WordPress plugin that integrates your WordPress website with a Discord server via webhooks. With it, you can have real-time updates sent to your Discord server whenever a new post is published on your WordPress website.

## Features

- Sends a notification to a Discord channel whenever a new post is published on your WordPress website.

## Installation

1. Download or clone this repository.
2. Upload the plugin files to the `/wp-content/plugins/` directory, or install the plugin through the WordPress plugins screen directly.
3. Activate the plugin through the 'Plugins' screen in WordPress.
4. Use the 'xDr Webhook Plugin' settings page to configure the Discord webhook URL.

## Usage

1. Go to the 'xDr Webhook Plugin' settings page and enter your Discord webhook URL.
2. Save or publish your post. A notification will be sent to your Discord channel.

## Code Overview

This plugin uses WordPress's `save_post` hook to trigger a function whenever a post is saved. This function retrieves the post details and custom Discord metadata, formats them into a JSON payload, and sends them to the configured Discord webhook URL.

## Project that works together

| Name  | Release |
| ------------- | ------------- |
| [Discord Bot](https://github.com/xd12r/Node.js-WordPress-to-Discord)  | [![Bot Release](https://img.shields.io/github/v/release/xd12r/Node.js-WordPress-to-Discord)](https://github.com/xd12r/Node.js-WordPress-to-Discord/releases)  |
| [Wordpress Plugin](https://github.com/xd12r/Wordpress-xDr-Webhook)  | [![Plugin Release](https://img.shields.io/github/v/release/xd12r/Wordpress-xDr-Webhook)](https://github.com/xd12r/Wordpress-xDr-Webhook/releases)  |

## License

Distributed under the GNU GPLv3 License. See `LICENSE` for more information.

