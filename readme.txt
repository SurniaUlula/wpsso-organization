=== WPSSO Organization Markup - Manage Multiple Organizations / Publishers for Schema ===
Plugin Name: WPSSO Organization Markup (WPSSO ORG)
Plugin Slug: wpsso-organization
Text Domain: wpsso-organization
Domain Path: /languages
License: GPLv3
License URI: https://www.gnu.org/licenses/gpl.txt
Donate Link: https://wpsso.com/?utm_source=wpssoorg-readme-donate
Assets URI: https://surniaulula.github.io/wpsso-organization/assets/
Tags: wpsso, organization, schema, schema.org, markup, local business, publisher, article
Contributors: jsmoriss
Requires At Least: 3.5
Tested Up To: 4.6.1
Stable Tag: 1.0.8-1

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
<p><strong>Prerequisite</strong> &mdash; WPSSO Organization Markup (WPSSO ORG) is an extension for the <a href="https://wordpress.org/plugins/wpsso/">WordPress Social Sharing Optimization (WPSSO)</a> plugin, which <em>automatically</em> creates complete and accurate meta tags and Schema markup for Social Sharing Optimization (SSO) and SEO.</p>
</blockquote>

= Quick List of Features =

**WPSSO ORG Free / Basic Features**

* Extends the features of either the Free or Pro versions of WPSSO.
* Manage properies of the Schema Organization markup for your home page:
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

= Available in Multiple Languages =

* English (US)
* French (France)
* More to come...

= Extends the WPSSO Plugin =

The WordPress Social Sharing Optimization (WPSSO) plugin is required to use the WPSSO ORG extension.

Use the Free version of WPSSO ORG with *both* the Free and Pro versions of WPSSO. The [WPSSO ORG Pro extension](https://wpsso.com/extend/plugins/wpsso-organization/?utm_source=wpssoorg-readme-extends) (along with all WPSSO Pro extensions) requires the [WPSSO Pro plugin](https://wpsso.com/extend/plugins/wpsso/?utm_source=wpssoorg-readme-extends) as well.

[Purchase the WPSSO Organization Markup (WPSSO ORG) Pro extension](https://wpsso.com/extend/plugins/wpsso-organization/?utm_source=wpssoorg-readme-purchase) (includes a *No Risk 30 Day Refund Policy*).

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

01. Settings for the Website (Home Page) Organization &mdash; Includes the Website name, alternate name, description, URL, logo image, banner image (for Articles), Schema type (Corporation, Educational, NGO, Performing Group, etc.), and social pages / Knowledge Graph for Google.
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

**Version 1.0.8-1 (2016/11/12)**

Official announcement: N/A

* *New Features*
	* None
* *Improvements*
	* None
* *Bugfixes*
	* None
* *Developer Notes*
	* Minor code changes required for WPSSO v3.37.1-1.
		* Renamed the WpssoSchema::get_schema_types() method to WpssoSchema::get_schema_types_array().

**Version 1.0.7-1 (2016/11/03)**

Official announcement: N/A

* *New Features*
	* None
* *Improvements*
	* None
* *Bugfixes*
	* None
* *Developer Notes*
	* Minor code changes required for WPSSO v3.37.0-1:
		* Renamed the 'wpsso_json_array_type_ids' filter to 'wpsso_json_array_schema_type_ids'.

**Version 1.0.6-1 (2016/09/10)**

Official announcement: N/A

* *New Features*
	* None
* *Improvements*
	* None
* *Bugfixes*
	* None
* *Developer Notes*
	* Updated the SucomNotice method calls for WPSSO v3.35.0-1.

== Upgrade Notice ==

= 1.0.8-1 =

(2016/11/12) Minor code changes required for WPSSO v3.37.1-1.

