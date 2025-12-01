# Project 2 - Hugo Documentation

This directory contains the Hugo static site for Project 2 documentation.

## Structure

- `content/` - Markdown content files
- `themes/` - Hugo theme (or use a theme from Hugo themes)
- `config.toml` - Hugo configuration
- `static/` - Static assets (images, CSS, etc.)
- `archetypes/` - Content templates

## Setup

1. Install Hugo: https://gohugo.io/installation/
2. Initialize Hugo site (if not already done):
   ```bash
   hugo new site .
   ```
3. Add a theme (recommended: PaperMod or similar):
   ```bash
   git submodule add https://github.com/adityatelange/hugo-PaperMod themes/PaperMod
   ```
4. Build the site:
   ```bash
   hugo
   ```
5. Serve locally:
   ```bash
   hugo server
   ```

## Deployment

The site is automatically deployed to GitHub.io via GitHub Actions when pushed to the main branch.

