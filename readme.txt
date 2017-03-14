=== WPSSO Organization Markup - Manage Multiple Organizations / Publishers for Schema ===
Plugin Name: WPSSO Organization Markup (WPSSO ORG)
Plugin Slug: wpsso-organization
Text Domain: wpsso-organization
Domain Path: /languages
License: GPLv3
License URI: https://www.gnu.org/licenses/gpl.txt
Donate Link: https://wpsso.com/extend/plugins/wpsso-organization/?utm_source=wpssoorg-readme-donate
Assets URI: https://surniaulula.github.io/wpsso-organization/assets/
Tags: organization, schema, schema.org, markup, local business, publisher, article
Contributors: jsmoriss
Requires At Least: 3.8
Tested Up To: 4.7.3
Stable Tag: 1.0.13-1

WPSSO extension to manage Organizations and additional Schema Article / Event properties (Publisher, Organizer, Performer, etc.).

== Description ==

<p><img src="https://surniaulula.github.io/wpsso-organization/assets/icon-256x256.png" width="256" height="256" style="width:33%;min-width:128px;max-width:256px;float:left;margin:0 40px 20px 0;" /><strong>Control your Organization markup for Google's Knowledge Graph.</strong></p>

<ul>
<li>Select an Organization sub-type (Corporation, Educational, NGO, Performing Group, etc.), Organization logo and/or banner.</li>
<li>Add Place / Location information to your Schema Organization markup.</li>
<li>Select a different Publisher for the Schema Article markup.</li>
<li>Select an Organizer or Performer for the Schema Event markup.</li>
</ul>

<blockquote>
<p><strong>Prerequisite</strong> &mdash; WPSSO Organization Markup (WPSSO ORG) is an extension for the <a href="https://wordpress.org/plugins/wpsso/">WordPress Social Sharing Optimization (WPSSO)</a> plugin, which <em>automatically</em> generates complete and accurate meta tags + Schema markup from your content for Social Sharing Optimization (SSO) and Search Engine Optimization (SEO).</p>

<p>The <a href="https://wordpress.org/plugins/wpsso-organization/">WPSSO ORG Free extension</a> works with the WPSSO Free or Pro plugin. The <a href="https://wpsso.com/extend/plugins/wpsso-organization/?utm_source=wpssoorg-readme-requires">WPSSO ORG Pro extension</a> (along with all WPSSO Pro extensions) requires the <a href="https://wpsso.com/extend/plugins/wpsso/?utm_source=wpssoorg-readme-requires">WPSSO Pro plugin</a> as well.</p>
</blockquote>

= Quick List of Features =

**WPSSO ORG Free / Basic Features**

* Extends the features of WPSSO Free or Pro.
* Manage properies of the Schema Organization markup for your front page:
	* Website Name
	* Website Alternate Name
	* Website Description
	* Website URL
	* Organization Logo Image URL
	* Organization Banner (600x60) URL
	* Organization Schema Type:
		* [schema.org/Organization](https://schema.org/Organization)
			* [schema.org/Airline](https://schema.org/Airline)
			* [schema.org/Corporation](https://schema.org/Corporation)
			* [schema.org/EducationalOrganization](https://schema.org/EducationalOrganization)
				* [schema.org/CollegeOrUniversity](https://schema.org/CollegeOrUniversity)
				* [schema.org/ElementarySchool](https://schema.org/ElementarySchool)
				* [schema.org/MiddleSchool](https://schema.org/MiddleSchool)
				* [schema.org/Preschool](https://schema.org/Preschool)
				* [schema.org/School](https://schema.org/School)
			* [schema.org/GovernmentOrganization](https://schema.org/GovernmentOrganization)
			* [schema.org/MedicalOrganization](https://schema.org/MedicalOrganization)
				* [schema.org/Dentist](https://schema.org/Dentist)
				* [schema.org/Hospital](https://schema.org/Hospital)
				* [schema.org/Pharmacy](https://schema.org/Pharmacy)
				* [schema.org/Physician](https://schema.org/Physician)
			* [schema.org/NGO](https://schema.org/NGO)
			* [schema.org/PerformingGroup](https://schema.org/PerformingGroup)
				* [schema.org/DanceGroup](https://schema.org/DanceGroup)
				* [schema.org/MusicGroup](https://schema.org/MusicGroup)
				* [schema.org/TheaterGroup](https://schema.org/TheaterGroup)
			* [schema.org/SportsOrganization](https://schema.org/SportsOrganization)
				* [schema.org/SportsTeam](https://schema.org/SportsTeam)
	* Organization Place / Location ([WPSSO PLM](https://wordpress.org/plugins/wpsso-plm/) extension required) 
	* Google Knowledge Graph:
		* Facebook Business Page URL
		* Google+ Business Page URL
		* Instagram Business URL
		* LinkedIn Company Page URL
		* MySpace Business Page URL
		* Pinterest Company Page URL
		* Twitter Business @username
* Select a more specific Schema Organization sub-type for Google's Organization markup.
* Include Place / Location information in your Schema / Google Organization markup, when used in combination with the [WPSSO Place / Location and Local Business Meta (WPSSO PLM)](https://wordpress.org/plugins/wpsso-plm/) extension.

**WPSSO ORG Pro / Power-User Features**

* Extends the features of WPSSO Pro (requires a licensed WPSSO Pro plugin).
* Manage multiple Organizations with the [WPSSO Schema JSON-LD Markup (WPSSO JSON)](https://wpsso.com/extend/plugins/wpsso-schema-json-ld/) extension:
	* Allows selecting an alternate Publisher for the Schema Article type and sub-types ([WPSSO JSON](https://wordpress.org/plugins/wpsso-schema-json-ld/) extension required):
		* [schema.org/Article](https://schema.org/Article)
			* [schema.org/BlogPosting](https://schema.org/BlogPosting)
			* [schema.org/NewsArticle](https://schema.org/NewsArticle)
			* [schema.org/Report](https://schema.org/Report)
			* [schema.org/ScholarlyArticle](https://schema.org/ScholarlyArticle)
			* [schema.org/SocialMediaPosting](https://schema.org/SocialMediaPosting)
			* [schema.org/TechArticle](https://schema.org/TechArticle)
	* Allows selecting an Organizer and/or Performer for the Schema Event type and sub-types ([WPSSO JSON](https://wordpress.org/plugins/wpsso-schema-json-ld/) extension required):
		* [schema.org/Event](https://schema.org/Event)
			* [schema.org/BusinessEvent](https://schema.org/BusinessEvent)
			* [schema.org/ChildrensEvent](https://schema.org/ChildrensEvent)
			* [schema.org/DanceEvent](https://schema.org/DanceEvent)
			* [schema.org/DeliveryEvent](https://schema.org/DeliveryEvent)
			* [schema.org/EducationEvent](https://schema.org/EducationEvent)
			* [schema.org/ExhibitionEvent](https://schema.org/ExhibitionEvent)
			* [schema.org/Festival](https://schema.org/Festival)
			* [schema.org/FoodEvent](https://schema.org/FoodEvent)
			* [schema.org/LiteraryEvent](https://schema.org/LiteraryEvent)
			* [schema.org/MusicEvent](https://schema.org/MusicEvent)
			* [schema.org/PublicationEvent](https://schema.org/PublicationEvent)
			* [schema.org/SaleEvent](https://schema.org/SaleEvent)
			* [schema.org/ScreeningEvent](https://schema.org/ScreeningEvent)
			* [schema.org/SocialEvent](https://schema.org/SocialEvent)
			* [schema.org/SportsEvent](https://schema.org/SportsEvent)
			* [schema.org/TheaterEvent](https://schema.org/TheaterEvent)
			* [schema.org/VisualArtsEvent](https://schema.org/VisualArtsEvent)

= Extends the WPSSO Plugin =

The WordPress Social Sharing Optimization (WPSSO) plugin is required to use the WPSSO ORG extension.

<blockquote>
<p>The <a href="https://wordpress.org/plugins/wpsso-organization/">WPSSO ORG Free extension</a> works with the WPSSO Free or Pro plugin. The <a href="https://wpsso.com/extend/plugins/wpsso-organization/?utm_source=wpssoorg-readme-extends">WPSSO ORG Pro extension</a> (along with all WPSSO Pro extensions) requires the <a href="https://wpsso.com/extend/plugins/wpsso/?utm_source=wpssoorg-readme-extends">WPSSO Pro plugin</a> as well.</p>
</blockquote>

[Purchase the WPSSO Organization Markup (WPSSO ORG) Pro extension here](https://wpsso.com/extend/plugins/wpsso-organization/?utm_source=wpssoorg-readme-purchase) (all purchases include a *No Risk 30 Day Refund Policy*).

== Installation ==

= Install and Uninstall =

* [Install the Plugin](https://wpsso.com/codex/plugins/wpsso-organization/installation/install-the-plugin/)
* [Uninstall the Plugin](https://wpsso.com/codex/plugins/wpsso-organization/installation/uninstall-the-plugin/)

== Frequently Asked Questions ==

= Frequently Asked Questions =

* None

== Other Notes ==

= Additional Documentation =

* None

== Screenshots ==

01. Settings for the Website (Front Page) Organization &mdash; Includes the Website name, alternate name, description, URL, logo image, banner image (for Articles), Schema type (Corporation, Educational, NGO, Performing Group, etc.), and social pages / Knowledge Graph for Google.
02. Settings for the Other Organizations / Publishers &mdash; Includes the Organization name, alternate name, description, URL, logo image, banner image (for Articles), Schema type (Corporation, Educational, NGO, Performing Group, etc.), and social pages / Knowledge Graph for Google.
03. Article Publisher selection when combined with the WPSSO Schema JSON-LD Markup (WPSSO JSON) extension.
04. Event Organizer and Performer selection when combined with the WPSSO Schema JSON-LD Markup (WPSSO JSON) extension.

== Changelog ==

= Free / Basic Version Repository =

* [GitHub](https://surniaulula.github.io/wpsso-organization/)
* [WordPress.org](https://wordpress.org/plugins/wpsso-organization/developers/)

= Version Numbering Scheme =

Version components: `{major}.{minor}.{bugfix}-{stage}{level}`

* {major} = Major code changes / re-writes or significant feature changes.
* {minor} = New features / options were added or improved.
* {bugfix} = Bugfixes or minor improvements.
* {stage}{level} = dev &lt; a (alpha) &lt; b (beta) &lt; rc (release candidate) &lt; # (production).

Note that the production stage level can be incremented on occasion for simple text revisions and/or translation updates. See [PHP's version_compare()](http://php.net/manual/en/function.version-compare.php) documentation for additional information on "PHP-standardized" version numbering.

= Changelog / Release Notes =

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
	* Fixed creation of 'sameAs' array with origanization social URLs.
* *Developer Notes*
	* None

**Version 1.0.9-1 (2016/11/25)**

* *New Features*
	* None
* *Improvements*
	* None
* *Bugfixes*
	* None
* *Developer Notes*
	* Refactored the min_version_notice() method and moved variables to config class.

**Version 1.0.8-1 (2016/11/12)**

* *New Features*
	* None
* *Improvements*
	* None
* *Bugfixes*
	* None
* *Developer Notes*
	* Minor code changes required for WPSSO v3.37.1-1.
		* Renamed the WpssoSchema get_schema_types() method to get_schema_types_array().

== Upgrade Notice ==

= 1.0.13-1 =

(2017/03/07) Fixed a CSS id problem that prevented the automatic display/hidding of options from working properly.

= 1.0.12-1 =

(2017/02/19) Replaced site organization array code by a call to a new method in WPSSO v3.39.9-1.

= 1.0.11-1 =

(2017/01/08) Corrected a few incorrect text domain names in the settings page. Added a 'plugins_loaded' action hook to load the plugin text domain.

= 1.0.10-1 =

(2016/12/04) Fixed creation of 'sameAs' array with origanization social URLs.

= 1.0.9-1 =

(2016/11/25) Refactored the min_version_notice() method.

