=== WPSSO Organization Markup - Manage Multiple Organizations / Publishers for Schema ===
Plugin Name: WPSSO Organization Markup (WPSSO ORG)
Plugin Slug: wpsso-organization
Text Domain: wpsso-organization
Domain Path: /languages
Contributors: jsmoriss
Donate Link: https://wpsso.com/?utm_source=wpssoorg-readme-donate
Tags: wpsso, organization, schema, markup, properties, local business, publisher, article
License: GPLv3
License URI: http://www.gnu.org/licenses/gpl.txt
Requires At Least: 3.1
Tested Up To: 4.5.3
Stable Tag: 1.0.3-1

WPSSO extension to manage Organizations and additional Schema Article / Event properties (Publisher, Organizer, Performer, etc.).

== Description ==

<p><img src="https://surniaulula.github.io/wpsso-organization/assets/icon-256x256.png" width="256" height="256" style="width:33%;min-width:128px;max-width:256px;float:left;margin:0 40px 20px 0;" /><strong>Control your Organization markup for Google's Knowledge Graph.</strong></p>

<ul>
<li>Select an Organization sub-type (Corporation, Educational, NGO, Performing Group, etc.), Organization logo and/or banner.</li>
<li>Add Place / Location information to your Schema Organization markup.</li>
<li>Select a different Publisher for the Schema Article markup.</li>
<li>Select an Organizer or Performer for the Schema Event markup.</li>
</ul>

<p>WPSSO Organization Markup (WPSSO ORG) works in conjunction with the <a href="https://wordpress.org/plugins/wpsso/">WordPress Social Sharing Optimization (WPSSO)</a> plugin, extending its features with additional settings pages and options to manage multiple Organizations / Publishers and additional Schema properties.</p>

= Quick List of Features =

**WPSSO ORG Free / Basic Features**

* Extends the features of either the Free or Pro versions of WPSSO.
* Manage properies of the Schema Organization markup for your home page:
	* Website Name
	* Website Alternate Name
	* Website Description
	* Website URL
	* Organization Logo Image URL
	* Organization Banner (600x60px) URL
	* Organization Schema Type:
		* [schema.org/Organization](http://schema.org/Organization)
			* [schema.org/Airline](http://schema.org/Airline)
			* [schema.org/Corporation](http://schema.org/Corporation)
			* [schema.org/EducationalOrganization](http://schema.org/EducationalOrganization)
				* [schema.org/CollegeOrUniversity](http://schema.org/CollegeOrUniversity)
				* [schema.org/ElementarySchool](http://schema.org/ElementarySchool)
				* [schema.org/MiddleSchool](http://schema.org/MiddleSchool)
				* [schema.org/Preschool](http://schema.org/Preschool)
				* [schema.org/School](http://schema.org/School)
			* [schema.org/GovernmentOrganization](http://schema.org/GovernmentOrganization)
			* [schema.org/MedicalOrganization](http://schema.org/MedicalOrganization)
				* [schema.org/Dentist](http://schema.org/Dentist)
				* [schema.org/Hospital](http://schema.org/Hospital)
				* [schema.org/Pharmacy](http://schema.org/Pharmacy)
				* [schema.org/Physician](http://schema.org/Physician)
			* [schema.org/NGO](http://schema.org/NGO)
			* [schema.org/PerformingGroup](http://schema.org/PerformingGroup)
				* [schema.org/DanceGroup](http://schema.org/DanceGroup)
				* [schema.org/MusicGroup](http://schema.org/MusicGroup)
				* [schema.org/TheaterGroup](http://schema.org/TheaterGroup)
			* [schema.org/SportsOrganization](http://schema.org/SportsOrganization)
				* [schema.org/SportsTeam](http://schema.org/SportsTeam)
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
* Manage multiple Organizations with the [WPSSO Schema JSON-LD Markup (WPSSO JSON)](http://wpsso.com/extend/plugins/wpsso-schema-json-ld/) extension:
	* Allows selecting an alternate Publisher for the Schema Article type and sub-types ([WPSSO JSON](https://wordpress.org/plugins/wpsso-schema-json-ld/) extension required):
		* [schema.org/Article](http://schema.org/Article)
			* [schema.org/BlogPosting](http://schema.org/BlogPosting)
			* [schema.org/NewsArticle](http://schema.org/NewsArticle)
			* [schema.org/Report](http://schema.org/Report)
			* [schema.org/ScholarlyArticle](http://schema.org/ScholarlyArticle)
			* [schema.org/SocialMediaPosting](http://schema.org/SocialMediaPosting)
			* [schema.org/TechArticle](http://schema.org/TechArticle)
	* Allows selecting an Organizer and/or Performer for the Schema Event type and sub-types ([WPSSO JSON](https://wordpress.org/plugins/wpsso-schema-json-ld/) extension required):
		* [schema.org/Event](http://schema.org/Event)
			* [schema.org/BusinessEvent](http://schema.org/BusinessEvent)
			* [schema.org/ChildrensEvent](http://schema.org/ChildrensEvent)
			* [schema.org/DanceEvent](http://schema.org/DanceEvent)
			* [schema.org/DeliveryEvent](http://schema.org/DeliveryEvent)
			* [schema.org/EducationEvent](http://schema.org/EducationEvent)
			* [schema.org/ExhibitionEvent](http://schema.org/ExhibitionEvent)
			* [schema.org/Festival](http://schema.org/Festival)
			* [schema.org/FoodEvent](http://schema.org/FoodEvent)
			* [schema.org/LiteraryEvent](http://schema.org/LiteraryEvent)
			* [schema.org/MusicEvent](http://schema.org/MusicEvent)
			* [schema.org/PublicationEvent](http://schema.org/PublicationEvent)
			* [schema.org/SaleEvent](http://schema.org/SaleEvent)
			* [schema.org/ScreeningEvent](http://schema.org/ScreeningEvent)
			* [schema.org/SocialEvent](http://schema.org/SocialEvent)
			* [schema.org/SportsEvent](http://schema.org/SportsEvent)
			* [schema.org/TheaterEvent](http://schema.org/TheaterEvent)
			* [schema.org/VisualArtsEvent](http://schema.org/VisualArtsEvent)

= Available in Multiple Languages =

* English (US)
* French (France)
* More to come...

= Extends the WPSSO Plugin =

The WordPress Social Sharing Optimization (WPSSO) plugin is required to use the WPSSO ORG extension.

Use the Free version of WPSSO ORG with *both* the Free and Pro versions of WPSSO. The [WPSSO ORG Pro](http://wpsso.com/extend/plugins/wpsso-organization/?utm_source=wpssoorg-readme-extends) extension (along with all WPSSO Pro extensions) requires the [WPSSO Pro](http://wpsso.com/extend/plugins/wpsso/?utm_source=wpssoorg-readme-extends) plugin as well.

[Purchase the WPSSO Organization Markup (WPSSO ORG) Pro extension](http://wpsso.com/extend/plugins/wpsso-organization/?utm_source=wpssoorg-readme-purchase) (includes a *No Risk 30 Day Refund Policy*).

== Installation ==

= Install and Uninstall =

* [Install the Plugin](http://wpsso.com/codex/plugins/wpsso-organization/installation/install-the-plugin/)
* [Uninstall the Plugin](http://wpsso.com/codex/plugins/wpsso-organization/installation/uninstall-the-plugin/)

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

* [GitHub](https://github.com/SurniaUlula/wpsso-organization)
* [WordPress.org](https://wordpress.org/plugins/wpsso-organization/developers/)

= Changelog / Release Notes =

**Version 1.0.4-rc1 (2016/07/17)**

Official announcement: N/A

* *New Features*
	* None
* *Improvements*
	* None
* *Bugfixes*
	* None
* *Developer Notes*
	* Updated the 'wpsso_get_config' filter to use the new version argument in WPSSO v3.33.5-1.

**Version 1.0.3-1 (2016/07/06)**

Official announcement: N/A

* *New Features*
	* None
* *Improvements*
	* None
* *Bugfixes*
	* None
* *Developer Notes*
	* Updated the `SucomUtil::get_locale_opt()` method arguments for WPSSO v3.33.4-1.

**Version 1.0.2-1 (2016/06/22)**

Official announcement: N/A

* *New Features*
	* None
* *Improvements*
	* None
* *Bugfixes*
	* Fixed the "Organization Place / Location" default value.
* *Developer Notes*
	* None

**Version 1.0.1-1 (2016/06/21)**

Official announcement: N/A

* *New Features*
	* None
* *Improvements*
	* None
* *Bugfixes*
	* None
* *Developer Notes*
	* Added a new `WpssoOrgOrganization::get_org_names()` method.
	* Renamed the 'wpsso_organization_options' filter to 'wpsso_get_organization_options'.

== Upgrade Notice ==

= 1.0.4-rc1 =

(2016/07/17) Updated the 'wpsso_get_config' filter to use the new version argument in WPSSO v3.33.5-1.

= 1.0.3-1 =

(2016/07/06) Updated the SucomUtil get_locale_opt() method arguments for WPSSO v3.33.4-1.
