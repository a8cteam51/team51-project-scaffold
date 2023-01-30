# Build Processes Demo

## What's this?

This is a demo/start-kit for showcasing standardized build processes of theme and plugin assets.
The examples listed here are for the most common tasks, but all of them don't apply to every project so only use what is needed.

- [Package.json](https://github.com/a8cteam51/build-processes-demo/blob/trunk/package.json)
- [Composer.json](https://github.com/a8cteam51/build-processes-demo/blob/trunk/composer.json)

## How to use?

#### This is not a starter theme!

Use this as a guide on how to setup your theme/plugin build processes.

## Dependencies

- [Node.js](https://nodejs.org/en/)
- [NPM](https://www.npmjs.com/)
- [Composer](https://getcomposer.org/)
- [Sass](https://sass-lang.com/)
- [Wordpress-scripts](https://developer.wordpress.org/block-editor/packages/packages-scripts/)
- [Postcss](https://postcss.org/)

## Asset Folder Structure

```console
.
├── assets           # Main assets folder
│   ├── img          # Images folder
│   └── css          # CSS folder
│        ├── build   # Compiled CSS folder
│        └── src     # Single-purpose CSS files (cart, checkout, etc)
│   ├── js           # JS folder
│        ├── build   # Compiled JS folder
│        └── src     # Single-purpose JS files
│   ├── scss         # SCSS folder
│        ├── core    # Core SCSS files
│        ├── ...     # Other SCSS files grouped by purpose
├── includes         # PHP files (classes, functions, etc)
├── languages        # Translations folder
├── style.css        # Theme CSS file, the compiled CSS should be located here
.
```

## Package.json

- should have the engines set to the version of node you are using
- the packages listed in the devDependencies should be used
- contains NPM scripts for building/watching plugin and theme CSS and JS files
- contains NPM scripts for linting

## Composer.json

### Translations


