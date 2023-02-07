# Build Processes Demo

## Links

- [Soft Launch](https://wpspecialprojectsp2.wordpress.com/2023/01/26/front-end-build-processes-task-force-product-soft-launch/)

## What's this?

This is a demo/start-kit for showcasing standardized build processes of theme and plugin assets.
**The examples listed here are for the most common tasks, but all of them don't apply to every project so only use what is needed.**

- [Package.json](https://github.com/a8cteam51/build-processes-demo/blob/trunk/package.json)
- [Composer.json](https://github.com/a8cteam51/build-processes-demo/blob/trunk/composer.json)

## How to use?

#### This is not a starter theme!

Use this as a guide on how to setup your theme/plugin build processes.

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

## Scripts

Scripts for building assets for both theme and blocks are located in the `package.json` file.
Scripts for internationalization and Code Style are located in the `composer.json` file.

## Installing themes and plugins through Composer.json

In composer.json there are examples on how to install a theme or plugin through composer.
This can be used to install a parent theme or a plugin that is required for the theme to work.

### Tips & Tricks (not required)

You can include WordPress as a Composer dev dependency by including the package `johnpbloch/wordpress-core` as a Composer dev dependency.

## Contributing

If you have any suggestions or improvements, please open an issue or a pull request.
