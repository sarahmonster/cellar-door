# cellar-door

A custom theme developed for FeministFrequency.com, hosted on WordPress.com VIP.

This documentation is split into two sections:

* [User's Guide](#users-guide)
* [Developer's Guide](#developers-guide)

## User's Guide

Welcome to your new site! If you're new to WordPress, [here is a good place to start](https://learn.wordpress.com/). [WordPress.com support](https://en.support.wordpress.com/) is a great place if you have a specific question.

### Tips for formatting posts

Posts should have both a [Featured Image](https://en.support.wordpress.com/featured-images/) and an [Excerpt](https://en.support.wordpress.com/excerpts/) set in order to display well on archive pages.

### Formatting transcripts and resource lists

Transcript and resource lists require extra formatting. To make this as easy as possible, your theme is using custom [shortcodes](https://en.support.wordpress.com/shortcodes/).

Transcripts can be added by using the following code:

```
[transcript]
Here is the text for your transcript.
[/transcript]
```

The "transcript" title will automatically be prepended to the transcript, so there's no need to add it yourself.

To add a resource list, use this code:

```
[resourcelist title="Recommended Reading"]
- List item one
- List item two
- List item three
[/resourcelist]
```

The title will appear as the header for the list, and can be skipped if you don't need a title.

Shortcodes can also be added automatically using the "Add Media" button and selecting the shortcode desired from the "Insert Post Element" tab.

### Testimonials

Support for [testimonials](https://en.support.wordpress.com/testimonials/) is built into the theme. Testimonials can be added via the [Testimonials page](http://ffreq.wordpress.com/wp-admin/edit.php?post_type=jetpack-testimonial) in your admin panel. They can then be added to any post or page using the [testimonial shortcode](https://en.support.wordpress.com/testimonials-shortcode/). 

### Additional functionality

Additional functionality can be added to your site by taking advantage of [the plugins available on VIP.](https://vip.wordpress.com/plugins/) You can activate a plugin from your admin panel.

Currently, we're using the following plugins:

* [Co-Authors Plus](https://vip.wordpress.com/plugins/co-authors-plus/) to assign multiple authors to a post.
* [Term Management Tools](https://vip.wordpress.com/plugins/term-management-tools/) for better categorization tools.
* [Advanced Excerpt](https://vip.wordpress.com/plugins/advanced-excerpt/) for smarter automatic post excerpts.
* [Shortcake](https://vip.wordpress.com/plugins/shortcake/) for custom shortcodes and a UI for implementation.


## Developer's Guide

To get started, check out the repository to your local machine. It's easiest to test using [VIP Quickstart](https://vip.wordpress.com/documentation/quickstart/) since this will closely mirror the environment used for VIP. On a different environment, you'd probably need to remove the VIP init functions from `functions.php` to avoid PHP errors. Plugins would need to be installed manually.

This project relies on [gulp](http://gulpjs.com/) to build CSS and other files. Here's how to get started:

Change directories to where your theme files live. On VIP Quickstart, that's:
`cd` into `vip-quickstart/www/wp-content/themes/vip/`

Clone this repo and move into the directory
`git clone git@github.com:a8cteam51/femfreq.git`
`cd femfreq`

Install all dependencies and run gulp:
`npm install`
`gulp`

Now you're cooking with gas!

### Compiling CSS

- When compiled by Gulp, the CSS is output into a `style.css` file in the root directory. [Sass source maps](http://thesassway.com/intermediate/using-source-maps-with-sass) and [LiveReload](http://livereload.com/) are used to make development faster.
- Sass structure is broken down as follows:
	- Layout directory (`assets/sass/layout`) contains all of the layout-specific styles.
	- Modules directory (`assets/sass/modules`) contains all variables and mixins.
	- Shared directory (`assets/sass/shared`) contains styling for elements that are used in different places across the site—buttons, forms, images, navigation, etc.
	- Main SCSS stylesheet (`assets/sass/style.scss`) imports of all of the partials and is compiled to main theme stylesheet that lives in the root theme directory.

### Using LiveReload

LiveReload will magically detect when your CSS code has changed, and will refresh your browser window for you. You need to install a [free browser extension](http://livereload.com/extensions/) in order to get that magic going.

The server will automatically run when running `gulp`; make sure to kill gulp using Command+C or the server won't shut down properly.

If the server doesn't shut down, you'll get an error next time you run gulp and you'll need to kill the process manually.

`lsof -iTCP:35729` will give you the process ID `<PID>` using that particular port.
Run `kill -9 <PID>` to terminate the process.

### Mobile approach

Breakpoints are defined in `assets/sass/modules/_breakpoints.scss` and then used as a simple mixin within the relevant file:

```css
*/ Increase width to 50% on tablet sizes */
@include tablet {
	width: 50%;
}
```

### SVG icon system

We're using a custom icon set, relying on an SVG sprite method. To add a new icon, create an SVG using your editor of choice and save it to the `assets/svg/icons` directory.

Gulp will do all the work from there. To use the icon anywhere in the theme files, use the following function:

`<?php cellardoor_icon( 'filename' ); ?>`

This sprite is also used to build social navigation menus. It will automatically detect links to social networks and will replace the text for these links with an SVG icon. If you add a new social link, ensure there is an icon for it in the `assets/svg/icons` directory!

For more details, please read the comments in `inc/svg-icons.php`

### Plugins

Additional functionality is primarily implemented via plugins. [These are the plugins available on VIP.](https://vip.wordpress.com/plugins/)
Plugins used by the theme are loaded and configured in the `inc/plugins.php` file. For more infomation on plugins used, check [the plugin section of the user guide](#additional-functionality).

## Additional information

* Contributors: Automattic, Inc.
* Tested up to: 4.4
* Stable tag: 4.3.1
* License: GPLv2 or later
* License URI: http://www.gnu.org/licenses/gpl-2.0.html
