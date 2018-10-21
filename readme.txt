=== WPSSO Organization Markup - Customize Schema WebSite Properties and Other Organizations ===
Plugin Name: WPSSO Organization Markup
Plugin Slug: wpsso-organization
Text Domain: wpsso-organization
Domain Path: /languages
License: GPLv3
License URI: https://www.gnu.org/licenses/gpl.txt
Assets URI: https://surniaulula.github.io/wpsso-organization/assets/
Tags: publisher, organization, local seo, local business, schema, schema.org, markup, article, event, location, knowledge graph, seo
Contributors: jsmoriss
Requires PHP: 5.4
Requires At Least: 3.8
Tested Up To: 5.0
Stable Tag: 1.4.2

WPSSO Core add-on to manage Organizations and additional Schema markup properties (Organizer, Performer, Publisher, etc.).

== Description ==

<p style="margin:0;"><img class="readme-icon" src="https://surniaulula.github.io/wpsso-organization/assets/icon-256x256.png"></p>

Customize your Organization name, alternate name, description, and WebSite URL for each WordPress locale / language / region.

Select an Organization logo and banner for the Schema Articles markup.

Select an Schema Organization sub-type for Google's Knowledge Graph (Corporation, Educational, NGO, Performing Group, etc.).

Select an optional place / location / address for the Schema Organization markup.

Provide an Organization selector for the [WPSSO Schema JSON-LD Markup Pro](https://wpsso.com/extend/plugins/wpsso-schema-json-ld/) add-on:

* Select a different Publisher for Schema CreativeWork markup.
* Select an Organizer or Performer for Schema Event markup.
* Select a Hiring Organization for Schema JobPosting markup.

<h3>WPSSO ORG Free / Standard Features</h3>

* Extends the features of the WPSSO Core Free or Pro plugin.

* Manage additional Schema Organization properies for Google's Knowledge Graph, including different values for each WordPress locale / language / region:

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
		* Google+ Business Page URL (localized)
		* Instagram Business Page URL (localized)
		* LinkedIn Company Page URL (localized)
		* Myspace Business Page URL (localized)
		* Pinterest Company Page URL (localized)
		* Soundcloud Business Page URL (localized)
		* Tumblr Business Page URL (localized)
		* Twitter Business @username (localized)
		* YouTube Business Channel URL (localized)
	
* Select a more specific Schema Organization sub-type for Google's Knowlege Graph and Organization markup.

* Include address / place / location information in your Schema Organization markup when used in combination with the [WPSSO Place / Location and Local Business Meta](https://wordpress.org/plugins/wpsso-plm/) add-on.

* Download the Free version from [GitHub](https://surniaulula.github.io/wpsso-organization/) or [WordPress.org](https://wordpress.org/plugins/wpsso-organization/).

<h3>WPSSO ORG Pro / Additional Features</h3>

* Extends the features of WPSSO Core Pro (requires an active and licensed <a href="https://wpsso.com/">WPSSO Core Pro plugin</a>).

* Provides a selection of Organizations for the [WPSSO Schema JSON-LD Markup](https://wpsso.com/extend/plugins/wpsso-schema-json-ld/) add-on property values (Publisher, Event Organizer, etc.).

<h3>WPSSO Core Plugin Prerequisite</h3>

WPSSO Organization Markup (aka WPSSO ORG) is an add-on for the [WPSSO Core Plugin](https://wordpress.org/plugins/wpsso/) (Free or Pro version). The [WPSSO ORG Pro add-on](https://wpsso.com/extend/plugins/wpsso-organization/) uses WPSSO Core Pro features and requires an active and licensed [WPSSO Core Pro plugin](https://wpsso.com/).

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

<h3>Free / Standard Version Repositories</h3>

* [GitHub](https://surniaulula.github.io/wpsso-organization/)
* [WordPress.org](https://plugins.trac.wordpress.org/browser/wpsso-organization/)

<h3>Changelog / Release Notes</h3>

**Version 1.4.3-dev.7 (2018/10/22)**

* *New Features*
	* None.
* *Improvements*
	* None.
* *Bugfixes*
	* None.
* *Developer Notes*
	* Renamed the 'org_type' option key to 'org_schema_type' for standardization.

**Version 1.4.2 (2018/10/04)**

* *New Features*
	* None.
* *Improvements*
	* None.
* *Bugfixes*
	* None.
* *Developer Notes*
	* Minor changes for code style and standardization.

**Version 1.4.1 (2018/09/16)**

* *New Features*
	* None.
* *Improvements*
	* Added a static local cache to the WpssoOrgOrganization::get_id() method.
* *Bugfixes*
	* None.
* *Developer Notes*
	* None.

== Upgrade Notice ==

= 1.4.3-dev.7 =

(2018/10/22) Renamed the 'org_type' option key to 'org_schema_type' for standardization.

= 1.4.2 =

(2018/10/04) Minor changes for code style and standardization.

