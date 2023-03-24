# Build Processes Demo

This is a demo project for showcasing standardized build processes of theme and plugin assets. Learn more about it in the [Soft Launch](https://wpspecialprojectsp2.wordpress.com/2023/01/26/front-end-build-processes-task-force-product-soft-launch/) post.

This documentation is supposed to answer the what and how questions, but while we do try to keep it up-to-date, the single source of truth is the code itself. If you find any discrepancies, please open an issue or a pull request.

## Project Structure

The `git` repository only keeps track of **custom** content inside the `wp-content` directory. In general, that entails:

- the theme **or** child theme directory inside the `themes` directory
- the custom plugins inside the `plugins` directory
- the `mu-plugins` directory

As a rule of thumb, if there is another source of updates for a piece of code, it must not be tracked via the repository (e.g., off-the-shelf plugins or parent themes).

### Theme Structure

This demo project contains a theme called `build-processes-demo` which is a child theme of the [Blockbase](https://wordpress.org/themes/blockbase/) theme. Using Blockbase is **not** a requirement, but it is a good example of a FSE theme.

The usage of a child theme is strongly encouraged even if the project is built upon a Twenty\* theme. Rather than modifying the theme directly and disabling updates by renaming it, it is better to create a child theme and use the Twenty\* theme as a parent theme. That way, we can still benefit from fixes in the template theme **and** it makes it much easier to figure out what the customizations were when the inevitable redesign rolls around in 3-5 years.

In general, any active theme on the site should contain the following folder structure:

```console
.
├── assets           	# Main assets folder
│   ├── img/**         	  # Image assets folder
│   └── css            	  # Single-purpose CSS assets folder
│        ├── build/**       		    
│        └── src/**         		    
│   ├── js             	  # JS assets folder
│        ├── build/**       		    
│        └── src/**         			
│   ├── sass           	  # SCSS folder for the main stylesheet
│        ├── abstracts/
│        	├── _variables.scss
│        	├── _mixins.scss
│        	├── _helpers.scss
│        	├── ...
│        	└── _functions.scss
│        ├── base/
│        	├── _theme-details.scss
│        	├── _reset.scss
│        	├── _typography.scss
│        	├── ...
│        	└── _utilities.scss      
│        ├── components/
│        	├── _buttons.scss
│        	├── _forms.scss
│        	├── _tables.scss
│        	├── ...
│        	└── _tooltips.scss
│        ├── layout/
│        	├── _header.scss
│        	├── _footer.scss
│        	├── _sidebar.scss
│        	├── ...
│        	└── _content.scss  
│        ├── ...
│        ├── style.scss 
│        ├── style-editor.scss
├── includes/**        	# PHP files (classes, functions, etc)
├── languages/**       	# POT and translations folder
├── parts/**            # FSE Theme template parts
├── patterns/**       	# FSE Theme template patterns
├── templates/**       	# FSE Theme full templates
├── functions.php    	# Theme functions file
├── style.css        	# Theme CSS file compiled from SCSS
├── style-editor.css	# Editor CSS file compiled from SCSS
├── theme.json      	# Theme variable definitions
.
```

As for the structure of the `assets/sass` folder and of the files therein, we recommend reading [this helpful gist](https://gist.github.com/AdamMarsden/7b85e8d5bdb5bef969a0). While we don't follow the exact same structure (e.g., we would like page-specific CSS to **not** be part of `style.css`), it encapsulates the general idea of how we want to structure the SCSS files.

### FSE Templates, Parts, Patterns, and `theme.json`

FSE template parts are included in this to show desired folder structure only. You will likely want to start from scratch with all FSE related files to avoid battling what's already here and been filled as a placeholder demonstration only.

### Gutenberg blocks

All custom-built blocks must be placed in a mu-plugin. The demo project contains a mu-plugin called `build-processes-demo-blocks` which exemplifies building two blocks called `build-processes-demo/foobar` and `build-processes-demo/spamham`, respectively.

By separating the blocks from the theme into a mu-plugin, we can ensure that the blocks are always available on the site, even if the theme is changed (e.g., because of a future redesign or as part of the debugging process). Moreover, it forces us, as developers, to think about the blocks as a separate entity from the theme and to design the code as such thus making it easier to reuse them in other projects.

The mu-plugin must contain enough CSS for the block to be functional and not appear broken. All other styling can be held in the mu-plugin or the theme. [Seedlet is an example](https://github.com/Automattic/themes/tree/trunk/seedlet/assets/sass/blocks) of a theme providing its own styling for the blocks.

### Features plugin

As part of the effort to decouple the theme from the site's functionality, we are also requiring a features plugin that contains all the custom functionality of the site. The demo project contains a plugin called `build-processes-demo-features` which contains a custom post type registration and some basic scaffolding.

As far as the mu-plugin's assets are concerned, these follows the same folder structure as the theme (see above).

It's not required to use the suffix `-features`, and it's perfectly fine to have more than one features plugin. Basically as long as you want to build a feature which is likely to stick around after a redesign of the site, it must be in a mu-plugin instead of the theme (e.g., a custom map functionality could be in its own mu-plugin suffixed `-map`).

**Tip:** if you want to use a different suffix, you will also need to update the `composer.json` and the `package.json` scripts to reflect the new name.

## Code Style & Quality

This project uses PHP CodeSniffer for linting PHP files and the wrappers provided by `@wordpress/scripts` for linting JS/TS and CSS/SCSS files. You can find the scripts for linting and formatting PHP in the `composer.json` file and the scripts for linting and formatting JS/TS and CSS/SCSS in the `package.json` file.

While JS/TS/CSS/SCSS linting should be configuration-free (using the defaults provided by `@wordpress/scripts`), the PHP linting requires a configuration file called `phpcs.xml.dist` which is located [in the Composer dependency `a8cteam51/team51-configs`](https://github.com/a8cteam51/team51-configs). If you have a very good reason to use different rules, although this is highly discouraged, you can create a new file called `.phpcs.xml` in the root of the project and add your customizations there.

Moreover, you will likely notice `.phpcs.xml` files sprinkled throughout the project (e.g., in the child theme and in the features plugin). These files are used to enhance the default configuration provided by the centralized `phpcs.xml.dist` file for the files inside the respective folders. For example, they add checks for using the correct text domain for the theme and the features plugin, respectively, or for using the correct prefixes for global variables. Modifying these files is the preferred way to update the linting rules for the respective folders.

## Installing themes and plugins through Composer.json

It's possible to install themes and plugins which are available on the WordPress.org repository through the `composer.json` file. This can help with development and debugging as it allows us to install a parent theme or a plugin that is required for the theme to work without tracking it through `git`.

Installing non-WP.org themes and plugins via Composer is also possible if the plugin offers support for it. For example, all plugins sold through Freemius do support Composer, as well as some popular ones such as Advanced Custom Fields Pro.

### Installing WordPress itself as a Composer dependency (optional nice-to-have)

You can install WordPress itself as a Composer dependency by including the package `johnpbloch/wordpress-core`. This can be useful for PHPStorm's code completion or simply for searching through the codebase locally.

## Contributing

Contributions are welcome! Please open an issue or a pull request if you find any issues or have any suggestions. This project is supposed to be a living document, so we'll be updating it as we learn more.

## Frequently Asked Questions

### What's with the `build` and `src` folders for the `js` and `css` folders?

The standardized build processes use the `@wordpress/scripts` npm package for building JS assets. As it depends on webpack, the JS assets are built into the `build` folder with the `src` folder containing the source files.

To keep in line with this convention, the CSS assets are also to be built into the `build` folder with the `src` folder containing the source files.

If you don't need a build step for your single-purpose CSS and JS files, you can remove the `build` folder and move the files in the `src` folder to the root of the `css` and `js` folders. But if you're using a build process for them, as we recommend, then please use this folder structure as a convention. [Read this comment for more info](https://github.com/a8cteam51/build-processes-demo/issues/17#issuecomment-1379277392).

### Do I need to use everything in this demo project?

No, many of the files in this demo project are simply examples. You can use them as a reference, but you don't need to copy them over to your project. This applies particularly to the CSS and JS assets used in this project -- if your project doesn't use WooCommerce or doesn't need any cart-related customizations, then you don't need a `<theme>/assets/css/build/cart.css` file! 

Similarly, if your project is English-only (and likely to remain so), then you don't need to include the `languages` folder and the `pot` file. And you probably don't need the build processes related to creating RTL versions of the CSS.

### Can I remove the WC Usage Tracking Auto-Opt-In git module?

If your project isn't using WooCommerce, it might be tempting to remove the `wc-usage-tracking-auto-opt-in` git module. Over time, that module has incorporated auto-opt-in for other plugins as well, like Sensei, and is likely to keep evolving.

Moreover, there is always a possibility that WooCommerce will be included at some point in the future. So it's better to keep the module in place and just ignore it. [Read more about it here](https://github.com/a8cteam51/build-processes-demo/issues/19#issuecomment-1379270537).

### Why aren't we using an .nvmrc file?

An .nvmrc file is used to specify the version of Node.js that should be used for a project. It allows typing `nvm use` without specifying a version argument in the project directory to automatically switch to the correct version of Node.js.

We decided against including this file because the goal is to ensure that the build processes work on the latest version of Node.js whichever that may be. Inside the `package.json` file, there is an `engines` entry which contains the version of Node.js and npm that worked the last time the assets were rebuilt should there ever be an issue on the current version.

In order to bring down technical debt, whenever a developer works on a site and rebuilds the assets, they should also update the packages and the `engines` entry in the `package.json` file, and try to fix any incompatibilities. It should be much easier to upgrade from Node.js 16 to 18 and so on than from Node.js 16 to 24 when the current packages are likely to first break.

We feel that including an .nvmrc file would be counter-productive to this goal of "forcing" maintainers to upgrade the packages and the Node.js version.

### Is this perfect and bug-free?

Hopefully yes, probably not! If you find any problems, please open an issue or a pull request. This project is supposed to be a living document, so we'll be updating it as we learn more.
