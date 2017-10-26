# Instagram API Helper plugin for Craft CMS 3.x

A Helper for the Instagram API

![Screenshot](resources/img/plugin-logo.png)

## Requirements

This plugin requires Craft CMS 3.0.0-beta.23 or later.

## Installation

To install the plugin, follow these instructions.

1. Open your terminal and go to your Craft project:

        cd /path/to/project

2. Then tell Composer to load the plugin:

        composer require tkf/instagram-api-helper

3. In the Control Panel, go to Settings → Plugins and click the “Install” button for Instagram API Helper.

## Instagram API Helper Overview

This plugins mirrors the various endpoints of the instagram-API to your server and
keeps your API Keys secure. It also caches the responses so you don't hit the polling
Limit.

## Configuring Instagram API Helper

1. Insert your Instagram API Token
2. Define the path prefix (Defaults to /api)

## Endpoints

    /self/recent.json => get recent media

## Instagram API Helper Roadmap

Some things to do, and ideas for potential features:

* Port existing codebase to Craft3
* Add more hooks

Brought to you by [Jan Thoma](https://t-k-f.ch)
