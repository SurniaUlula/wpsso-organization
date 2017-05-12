=== WPSSO Organization Markup - Manage Organizations / Publishers for Schema and SEO ===
Plugin Name: WPSSO Organization Markup (WPSSO ORG)
Plugin Slug: wpsso-organization
Text Domain: wpsso-organization
Domain Path: /languages
License: GPLv3
License URI: https://www.gnu.org/licenses/gpl.txt
Assets URI: https://surniaulula.github.io/wpsso-organization/assets/
Tags: publisher, organization, local seo, local business, schema, schema.org, markup, article, event, location, knowledge graph, seo
Contributors: jsmoriss
Requires At Least: 3.7
Tested Up To: 4.7.4
Stable Tag: 1.0.18

WPSSO extension to manage Organizations and additional Schema Article / Event properties (Publisher, Organizer, Performer, etc.).

== Description ==

<img class="readme-icon" src="https://surniaulula.github.io/wpsso-organization/assets/icon-256x256.png">

<p><strong>Control your Organization markup for Google's Knowledge Graph.</strong></p>

<ul>
<li>Customize your Website name, alternate name, description, and URL for each WordPress local / language / region.</li>
<li>Select an Organization sub-type (Corporation, Educational, NGO, Performing Group, etc.), logo and/or banner for Articles.</li>
<li>Add Local SEO Place / Location information to your Schema Organization markup.</li>
<li>Select a different Publisher for your Schema Article markup.</li>
<li>Select an Organizer or Performer for the Schema Event markup.</li>
</ul>

<blockquote>
<p><strong>Prerequisite</strong> &mdash; WPSSO Organization Markup (WPSSO ORG) is an extension for the <a href="https://wordpress.org/plugins/wpsso/">WordPress Social Sharing Optimization (WPSSO)</a> plugin, which <em>automatically</em> generates complete and accurate meta tags + Schema markup from your content for Social Sharing Optimization (SSO) and Search Engine Optimization (SEO).</p>
</blockquote>

= Quick List of Features =

**WPSSO ORG Free / Basic Features**

* Extends the features of WPSSO Free or Pro.
* Manage properies of the Schema Organization markup for your front page:
	* Website Name (localized)
	* Website Alternate Name (localized)
	* Website Description (localized)
	* Website URL (localized)
	* Organization Logo Image URL
	* Organization Banner (600x60) URL
	* Organization Schema Type:
		* Schema Type [schema.org/Organization](https://schema.org/Organization)
			* Schema Type [schema.org/Airline](https://schema.org/Airline)
			* Schema Type [schema.org/Corporation](https://schema.org/Corporation)
			* Schema Type [schema.org/EducationalOrganization](https://schema.org/EducationalOrganization)
				* Schema Type [schema.org/CollegeOrUniversity](https://schema.org/CollegeOrUniversity)
				* Schema Type [schema.org/ElementarySchool](https://schema.org/ElementarySchool)
				* Schema Type [schema.org/MiddleSchool](https://schema.org/MiddleSchool)
				* Schema Type [schema.org/HighSchool](https://schema.org/HighSchool)
				* Schema Type [schema.org/Preschool](https://schema.org/Preschool)
				* Schema Type [schema.org/School](https://schema.org/School)
			* Schema Type [schema.org/GovernmentOrganization](https://schema.org/GovernmentOrganization)
			* Schema Type [schema.org/MedicalOrganization](https://schema.org/MedicalOrganization)
				* Schema Type [schema.org/Dentist](https://schema.org/Dentist)
				* Schema Type [schema.org/Hospital](https://schema.org/Hospital)
				* Schema Type [schema.org/Pharmacy](https://schema.org/Pharmacy)
				* Schema Type [schema.org/Physician](https://schema.org/Physician)
			* Schema Type [schema.org/NGO](https://schema.org/NGO)
			* Schema Type [schema.org/PerformingGroup](https://schema.org/PerformingGroup)
				* Schema Type [schema.org/DanceGroup](https://schema.org/DanceGroup)
				* Schema Type [schema.org/MusicGroup](https://schema.org/MusicGroup)
				* Schema Type [schema.org/TheaterGroup](https://schema.org/TheaterGroup)
			* Schema Type [schema.org/SportsOrganization](https://schema.org/SportsOrganization)
				* Schema Type [schema.org/SportsTeam](https://schema.org/SportsTeam)
	* Organization Place / Location ([WPSSO PLM](https://wordpress.org/plugins/wpsso-plm/) extension required) 
	* Google Knowledge Graph Social Profile URLs:
		* Facebook Business Page URL (localized)
		* Google+ Business Page URL (localized)
		* Instagram Business URL (localized)
		* LinkedIn Company Page URL (localized)
		* Myspace Business Page URL (localized)
		* Pinterest Company Page URL (localized)
		* SoundCloud Business URL (localized)
		* Tumblr Business Page URL (localized)
		* Twitter Business @username (localized)
		* YouTube Business Channel URL (localized)
* Select a more specific Schema Organization sub-type for Google's Organization markup.
* Include Place / Location information in your Schema / Google Organization markup when used in combination with the [WPSSO Place / Location and Local Business Meta (WPSSO PLM)](https://wordpress.org/plugins/wpsso-plm/) extension.

**WPSSO ORG Pro / Power-User Features**

* Extends the features of WPSSO Pro (requires a licensed WPSSO Pro plugin).
* Manage multiple Organizations with the [WPSSO Schema JSON-LD Markup (WPSSO JSON)](https://wpsso.com/extend/plugins/wpsso-schema-json-ld/) extension:
	* Allows selecting an alternate Publisher for the Schema Article type and sub-types ([WPSSO JSON](https://wordpress.org/plugins/wpsso-schema-json-ld/) extension required):
		* Schema Type [schema.org/Article](https://schema.org/Article)
			* Schema Type [schema.org/BlogPosting](https://schema.org/BlogPosting)
			* Schema Type [schema.org/NewsArticle](https://schema.org/NewsArticle)
			* Schema Type [schema.org/Report](https://schema.org/Report)
			* Schema Type [schema.org/ScholarlyArticle](https://schema.org/ScholarlyArticle)
			* Schema Type [schema.org/SocialMediaPosting](https://schema.org/SocialMediaPosting)
			* Schema Type [schema.org/TechArticle](https://schema.org/TechArticle)
	* Allows selecting an Organizer and/or Performer for the Schema Event type and sub-types ([WPSSO JSON](https://wordpress.org/plugins/wpsso-schema-json-ld/) extension required):
		* Schema Type [schema.org/Event](https://schema.org/Event)
			* Schema Type [schema.org/BusinessEvent](https://schema.org/BusinessEvent)
			* Schema Type [schema.org/ChildrensEvent](https://schema.org/ChildrensEvent)
			* Schema Type [schema.org/DanceEvent](https://schema.org/DanceEvent)
			* Schema Type [schema.org/DeliveryEvent](https://schema.org/DeliveryEvent)
			* Schema Type [schema.org/EducationEvent](https://schema.org/EducationEvent)
			* Schema Type [schema.org/ExhibitionEvent](https://schema.org/ExhibitionEvent)
			* Schema Type [schema.org/Festival](https://schema.org/Festival)
			* Schema Type [schema.org/FoodEvent](https://schema.org/FoodEvent)
			* Schema Type [schema.org/LiteraryEvent](https://schema.org/LiteraryEvent)
			* Schema Type [schema.org/MusicEvent](https://schema.org/MusicEvent)
			* Schema Type [schema.org/PublicationEvent](https://schema.org/PublicationEvent)
			* Schema Type [schema.org/SaleEvent](https://schema.org/SaleEvent)
			* Schema Type [schema.org/ScreeningEvent](https://schema.org/ScreeningEvent)
			* Schema Type [schema.org/SocialEvent](https://schema.org/SocialEvent)
			* Schema Type [schema.org/SportsEvent](https://schema.org/SportsEvent)
			* Schema Type [schema.org/TheaterEvent](https://schema.org/TheaterEvent)
			* Schema Type [schema.org/VisualArtsEvent](https://schema.org/VisualArtsEvent)

= Extends the WPSSO Plugin =

The WordPress Social Sharing Optimization (WPSSO) plugin is required to use the WPSSO ORG extension.

<blockquote>
<p>The <a href="https://wordpress.org/plugins/wpsso-organization/">WPSSO ORG Free extension</a> works with the WPSSO Free or Pro plugin. The <a href="https://wpsso.com/extend/plugins/wpsso-organization/?utm_source=wpssoorg-readme-extends">WPSSO ORG Pro extension</a> (along with all WPSSO Pro extensions) requires the <a href="https://wpsso.com/extend/plugins/wpsso/?utm_source=wpssoorg-readme-extends">WPSSO Pro plugin</a> as well.</p>
</blockquote>

[Purchase the WPSSO Organization Markup (WPSSO ORG) Pro extension here](https://wpsso.com/extend/plugins/wpsso-organization/?utm_source=wpssoorg-readme-purchase) (all purchases include a *No Risk 30 Day Refund Policy*).

== Installation ==

= Install and Uninstall =

* [Install the Plugin (Free and Pro version)](https://wpsso.com/docs/plugins/wpsso-organization/installation/install-the-plugin/)
* [Uninstall the Plugin](https://wpsso.com/docs/plugins/wpsso-organization/installation/uninstall-the-plugin/)

== Frequently Asked Questions ==

= Frequently Asked Questions =

* None

== Other Notes ==

= Additional Documentation =

* None

== Screenshots ==

01. WPSSO ORG settings page for the Website (Front Page) organization &mdash; includes the Website name, alternate name, description, URL, logo image, banner image (for Articles), Schema type (Corporation, Educational, NGO, Performing Group, etc.), and social pages / Knowledge Graph for Google.

== Changelog ==

= Free / Basic Version Repository =

* [GitHub](https://surniaulula.github.io/wpsso-organization/)
* [WordPress.org](https://wordpress.org/plugins/wpsso-organization/developers/)

= Version Numbering =

Version components: `{major}.{minor}.{bugfix}[-{stage}.{level}]`

* {major} = Major structural code changes / re-writes or incompatible API changes.
* {minor} = New functionality was added or improved in a backwards-compatible manner.
* {bugfix} = Backwards-compatible bug fixes or small improvements.
* {stage}.{level} = Pre-production release: dev < a (alpha) < b (beta) < rc (release candidate).

= Changelog / Release Notes =

**Version 1.0.18 (2017/04/30)**

* *New Features*
	* None
* *Improvements*
	* None
* *Bugfixes*
	* None
* *Developer Notes*
	* Code refactoring to rename the $is_avail array to $avail for WPSSO v3.42.0.

**Version 1.0.17 (2017/04/16)**

* *New Features*
	* None
* *Improvements*
	* None
* *Bugfixes*
	* None
* *Developer Notes*
	* Refactored the plugin init filters and moved/renamed the registration boolean from `is_avail[$name]` to `is_avail['p_ext'][$name]`.

**Version 1.0.16 (2017/04/08)**

* *New Features*
	* None
* *Improvements*
	* None
* *Bugfixes*
	* None
* *Developer Notes*
	* Minor revision to move URLs in the extension config to the main WPSSO plugin config.
	* Dropped the package number from the production version string.

**Version 1.0.15-1 (2017/04/05)**

* *New Features*
	* None
* *Improvements*
	* Updated the plugin icon images and the documentation URLs.
* *Bugfixes*
	* None
* *Developer Notes*
	* None

**Version 1.0.14-1 (2017/03/25)**

* *New Features*
	* None
* *Improvements*
	* None
* *Bugfixes*
	* None
* *Developer Notes*
	* Maintenance release.

**Version 1.0.13-1 (2017/03/07)**

* *New Features*
	* None
* *Improvements*
	* None
* *Bugfixes*
	* Fixed a CSS id problem that prevented the automatic display/hidding of options from working properly.
* *Developer Notes*
	* None

**Version 1.0.12-1 (2017/02/19)**

* *New Features*
	* None
* *Improvements*
	* None
* *Bugfixes*
	* None
* *Developer Notes*
	* Renamed a few site related option keys for WPSSO v3.39.9-1:
		* 'og_site_name' =&gt; 'site_name'
		* 'og_site_description' =&gt; 'site_desc'
		* 'org_url' =&gt; 'site_url'
		* 'org_type' =&gt; 'site_org_type'
	* Replaced site organization array code by a call to the new WpssoSchema::get_site_organization() method in WPSSO v3.39.9-1.
	* Removed the 'wpsso_get_defaults' filter hook (no longer required).

**Version 1.0.11-1 (2017/01/08)**

* *New Features*
	* None
* *Improvements*
	* None
* *Bugfixes*
	* Corrected a few incorrect text domain names in the settings page.
* *Developer Notes*
	* Added a 'plugins_loaded' action hook to load the plugin text domain.

**Version 1.0.10-1 (2016/12/04)**

* *New Features*
	* None
* *Improvements*
	* None
* *Bugfixes*
	* Fixed creation of 'sameAs' array with organization social URLs.
* *Developer Notes*
	* None

== Upgrade Notice ==

= 1.0.18 =

(2017/04/30) Code refactoring to rename the $is_avail array to $avail for WPSSO v3.42.0.

= 1.0.17 =

(2017/04/16) Refactored the plugin init filters and moved/renamed the registration boolean.

= 1.0.16 =

(2017/04/08) Minor revision to move URLs in the extension config to the main WPSSO plugin config.

= 1.0.15-1 =

(2017/04/05) Updated the plugin icon images and the documentation URLs.

= 1.0.14-1 =

(2017/03/25) Maintenance release.

= 1.0.13-1 =

(2017/03/07) Fixed a CSS id problem that prevented the automatic display/hidding of options from working properly.

= 1.0.12-1 =

(2017/02/19) Replaced site organization array code by a call to a new method in WPSSO v3.39.9-1.

= 1.0.11-1 =

(2017/01/08) Corrected a few incorrect text domain names in the settings page. Added a 'plugins_loaded' action hook to load the plugin text domain.

= 1.0.10-1 =

(2016/12/04) Fixed creation of 'sameAs' array with organization social URLs.

