=== Organization Markup | WPSSO Add-on ===
Plugin Name: WPSSO Organization Markup
Plugin Slug: wpsso-organization
Text Domain: wpsso-organization
Domain Path: /languages
License: GPLv3
License URI: https://www.gnu.org/licenses/gpl.txt
Assets URI: https://surniaulula.github.io/wpsso-organization/assets/
Tags: publisher, organization, local seo, local business, schema, schema.org, markup, article, event, location, knowledge graph, seo
Contributors: jsmoriss
Requires At Least: 3.9
Tested Up To: 5.3
Stable Tag: 2.1.7

Customize home page Schema Organization markup and manage additional Organizations (publisher, organizer, etc.).

== Description ==

<p style="margin:0;"><img class="readme-icon" src="https://surniaulula.github.io/wpsso-organization/assets/icon-256x256.png"></p>

**Customize the Schema Organization markup for your home page:**

Edit your Schema Organization name, alternate name, description, and WebSite URL for each WordPress locale / language / region.

Select an Organization logo and banner for the Schema Article type and its sub-types.

Select an Schema Organization sub-type (Corporation, Educational, NGO, Performing Group, etc.) for Google's Knowledge Graph.

Select an optional place / location / address for your home page Organization and/or each additional Organization you create.

Provides an Organization selector for the [WPSSO Schema JSON-LD Markup Pro](https://wpsso.com/extend/plugins/wpsso-schema-json-ld/) add-on:

* Select a different Publisher for Schema CreativeWork markup.
* Select an Organizer or Performer for Schema Event markup.
* Select a Hiring Organization for Schema JobPosting markup.
* And more.

<h3>WPSSO ORG Standard Features</h3>

* Extends the features of the WPSSO Core plugin.

* Customize Schema Organization properies for Google's Knowledge Graph, including different values for each WordPress locale / language / region:

	* WebSite Name (localized)
	* WebSite Alternate Name (localized)
	* WebSite Description (localized)
	* WebSite URL (localized)
	* Organization Logo Image URL
	* Organization Banner (600x60) URL
	* Organization Schema Type
	* Organization Place / Location ([WPSSO PLM](https://wordpress.org/plugins/wpsso-plm/) add-on required) 
	* Google's Knowledge Graph Social Profile URLs:
		* Facebook Business Page URL (localized)
		* Instagram Business Page URL (localized)
		* LinkedIn Company Page URL (localized)
		* Myspace Business Page URL (localized)
		* Pinterest Company Page URL (localized)
		* Soundcloud Business Page URL (localized)
		* Tumblr Business Page URL (localized)
		* Twitter Business @username (localized)
		* YouTube Business Channel URL (localized)
	
* Select a more specific Schema Organization sub-type for Google's Knowlege Graph and Organization markup.

* Select an optional place / location / address for your Schema Organization markup when used with the [WPSSO Place / Location and Local SEO Meta](https://wordpress.org/plugins/wpsso-plm/) add-on.

<h3>WPSSO ORG Premium Features</h3>

* Provides a selection of Organizations for the [WPSSO Schema JSON-LD Markup add-on](https://wpsso.com/extend/plugins/wpsso-schema-json-ld/) publisher, event organizer, event performer, job hiring organization, etc. Schema property values.

<h3>WPSSO Core Plugin Required</h3>

WPSSO Organization Markup (aka WPSSO ORG) is an add-on for the [WPSSO Core plugin](https://wordpress.org/plugins/wpsso/).

== Installation ==

<h3 class="top">Install and Uninstall</h3>

* [Install the WPSSO ORG Add-on](https://wpsso.com/docs/plugins/wpsso-organization/installation/install-the-plugin/)
* [Uninstall the WPSSO ORG Add-on](https://wpsso.com/docs/plugins/wpsso-organization/installation/uninstall-the-plugin/)

== Frequently Asked Questions ==

== Screenshots ==

01. WPSSO ORG settings page for the WebSite (front page) Organization &mdash; includes the WebSite name, alternate name, description, URL, logo image, banner image (for Articles), the Schema Organization type, an optional Organization place / location, and the Organization social pages for Google's Knowledge Graph.

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

**Version 2.1.7 (2019/11/23)**

* **New Features**
	* None.
* **Improvements**
	* None.
* **Bugfixes**
	* None.
* **Developer Notes**
	* Updated `WpssoOrgRegister->activate_plugin()` for the new WpssoUtilReg class in WPSSO Core v6.13.1.

**Version 2.1.6 (2019/10/22)**

* **New Features**
	* None.
* **Improvements**
	* None.
* **Bugfixes**
	* None.
* **Developer Notes**
	* Update method arguments for `SucomForm->get_select()` in WPSSO Core v6.9.0.

== Upgrade Notice ==

= 2.1.7 =

(2019/11/23) Update for the new WpssoUtilReg class in WPSSO Core v6.13.1.

