=== WPSSO Organization Markup ===
Plugin Name: WPSSO Organization Markup
Plugin Slug: wpsso-organization
Text Domain: wpsso-organization
Domain Path: /languages
License: GPLv3
License URI: https://www.gnu.org/licenses/gpl.txt
Assets URI: https://surniaulula.github.io/wpsso-organization/assets/
Tags: local seo, local business, publisher, organization, schema.org, knowledge graph, logo, location
Contributors: jsmoriss
Requires PHP: 7.0
Requires At Least: 5.0
Tested Up To: 5.8
Stable Tag: 3.10.1

Customize the Schema Organization markup for your website and create additional Schema Organizations (publisher, organizer, etc.).

== Description ==

<p><img class="readme-icon" src="https://surniaulula.github.io/wpsso-organization/assets/icon-256x256.png"> <strong>Customize the Schema Organization markup for your home page:</strong></p>

Customize your Schema Organization name, alternate name, description, WebSite URL, banner, logo, and social page URLs for each installed WordPress language / locale.

Select an optional physical location (ie. place or address) for your WebSite Organization and/or each additional Organization you create.

<h3>WPSSO ORG Add-on Features</h3>

Extends the features of the [WPSSO Core plugin](https://wordpress.org/plugins/wpsso/) (required plugin).

Customize your Schema Organization properties for Google's Knowledge Graph, including different values for each installed WordPress language / locale:

* WebSite Name (localized)
* WebSite Alternate Name (localized)
* WebSite Description (localized)
* WebSite URL (localized)
* Organization Logo Image URL (localized)
* Organization Banner (600x60) URL (localized)
* Organization Schema Type
* Organization Location
* Google's Knowledge Graph Social Profile URLs:
	* Facebook Business Page URL (localized)
	* Instagram Business Page URL (localized)
	* LinkedIn Company Page URL (localized)
	* Myspace Business Page URL (localized)
	* Pinterest Company Page URL (localized)
	* Soundcloud Business Page URL (localized)
	* Tumblr Business Page URL (localized)
	* Twitter Business @username (localized)
	* Wikipedia Organization Page URL (localized)
	* YouTube Business Channel URL (localized)

The WPSSO Organization Markup Standard add-on is designed to satisfy the requirements of most standard WordPress sites. If your site requires the management of multiple organizations, then you may want to get the [WPSSO ORG Premium add-on](https://wpsso.com/extend/plugins/wpsso-organization/) for those additional features.

**[Premium]** Manage the details of multiple organizations.

**[Premium]** Offers an organization selector for the [WPSSO Schema JSON-LD Markup Premium add-on](https://wpsso.com/extend/plugins/wpsso-schema-json-ld/) to optionally select a different publisher, service provider, event organizer, event performer, hiring organization, etc.

<h3>WPSSO Core Required</h3>

WPSSO Organization Markup (WPSSO ORG) is an add-on for the [WPSSO Core plugin](https://wordpress.org/plugins/wpsso/).

== Installation ==

<h3 class="top">Install and Uninstall</h3>

* [Install the WPSSO Organization Markup add-on](https://wpsso.com/docs/plugins/wpsso-organization/installation/install-the-plugin/).
* [Uninstall the WPSSO Organization Markup add-on](https://wpsso.com/docs/plugins/wpsso-organization/installation/uninstall-the-plugin/).

== Frequently Asked Questions ==

== Screenshots ==

01. The WPSSO ORG settings page includes options for the WebSite name, alternate name, description, URL, logo image, banner image (for Articles), the Organization type, an optional location, and social page URLs for Google's Knowledge Graph.

== Changelog ==

<h3 class="top">Version Numbering</h3>

Version components: `{major}.{minor}.{bugfix}[-{stage}.{level}]`

* {major} = Major structural code changes / re-writes or incompatible API changes.
* {minor} = New functionality was added or improved in a backwards-compatible manner.
* {bugfix} = Backwards-compatible bug fixes or small improvements.
* {stage}.{level} = Pre-production release: dev < a (alpha) < b (beta) < rc (release candidate).

<h3>Standard Version Repositories</h3>

* [GitHub](https://surniaulula.github.io/wpsso-organization/)
* [WordPress.org](https://plugins.trac.wordpress.org/browser/wpsso-organization/)

<h3>Changelog / Release Notes</h3>

**Version 3.10.1 (2021/02/25)**

* **New Features**
	* None.
* **Improvements**
	* Updated the banners and icons of WPSSO Core and its add-ons.
* **Bugfixes**
	* None.
* **Developer Notes**
	* None.
* **Requires At Least**
	* PHP v7.0.
	* WordPress v5.0.
	* WPSSO Core v8.34.0.

**Version 3.10.0 (2020/12/17)**

* **New Features**
	* None.
* **Improvements**
	* None.
* **Bugfixes**
	* None.
* **Developer Notes**
	* Updated the 'site_url' option key to 'home_url' for WPSSO Core v8.18.0.
* **Requires At Least**
	* PHP v7.0.
	* WordPress v4.5.
	* WPSSO Core v8.18.0.

**Version 3.9.0 (2020/12/04)**

* **New Features**
	* None.
* **Improvements**
	* None.
* **Bugfixes**
	* None.
* **Developer Notes**
	* Included the `$addon` argument for library class constructors.
* **Requires At Least**
	* PHP v7.0.
	* WordPress v4.5.
	* WPSSO Core v8.16.0.

**Version 3.8.1 (2020/10/17)**

* **New Features**
	* None.
* **Improvements**
	* Refactored the add-on class to extend a new WpssoAddOn abstract class.
* **Bugfixes**
	* Fixed backwards compatibility with older 'init_objects' and 'init_plugin' action arguments.
* **Developer Notes**
	* Added a new WpssoAddOn class in lib/abstracts/add-on.php.
	* Added a new SucomAddOn class in lib/abstracts/com/add-on.php.
* **Requires At Least**
	* PHP v5.6.
	* WordPress v4.4.
	* WPSSO Core v8.13.0.

== Upgrade Notice ==

= 3.10.1 =

(2021/02/25) Updated the banners and icons of WPSSO Core and its add-ons.

= 3.10.0 =

(2020/12/17) Updated the 'site_url' option key to 'home_url' for WPSSO Core v8.18.0.

= 3.9.0 =

(2020/12/04) Included the `$addon` argument for library class constructors.

= 3.8.1 =

(2020/10/17) Refactored the add-on class to extend a new WpssoAddOn abstract class.

