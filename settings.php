<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/*
 * @author    Shaun Daubney
 * @package   theme_desafios
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

if ($ADMIN->fulltree) {

    // Basic Heading.
    $name = 'theme_desafios/basicheading';
    $heading = get_string('basicheading', 'theme_desafios');
    $information = get_string('basicheadingdesc', 'theme_desafios');
    $setting = new admin_setting_heading($name, $heading, $information);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $settings->add($setting);

    // Brand logo setting...
    $name = 'theme_desafios/brandlogo';
    $title = get_string('brandlogo', 'theme_desafios');
    $description = get_string('brandlogodesc', 'theme_desafios');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'brandlogo');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $settings->add($setting);

    // Main colour setting.
    $name = 'theme_desafios/maincolor';
    $title = get_string('maincolor','theme_desafios');
    $description = get_string('maincolordesc', 'theme_desafios');
    $default = '#f98012';
    $previewconfig = NULL;
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $settings->add($setting);

    // Short Name setting.
    $name = 'theme_desafios/shortname';
    $title = get_string('shortname','theme_desafios');
    $description = get_string('shortnamedesc', 'theme_desafios');
    $default = 1;
    $choices = array(1=>get_string('yes',''), 0=>get_string('no',''));
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $settings->add($setting);

    // General Alert setting.
    $name = 'theme_desafios/generalalert';
    $title = get_string('generalalert','theme_desafios');
    $description = get_string('generalalertdesc', 'theme_desafios');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $settings->add($setting);

    // Custom CSS file.
    $name = 'theme_desafios/customcss';
    $title = get_string('customcss','theme_desafios');
    $description = get_string('customcssdesc', 'theme_desafios');
    $default = '';
    $setting = new admin_setting_configtextarea($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $settings->add($setting);

    // Footer Options Heading.
    $name = 'theme_desafios/footeroptheading';
    $heading = get_string('footeroptheading', 'theme_desafios');
    $information = get_string('footeroptdesc', 'theme_desafios');
    $setting = new admin_setting_heading($name, $heading, $information);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $settings->add($setting);

    // Copyright setting.
    $name = 'theme_desafios/copyright';
    $title = get_string('copyright','theme_desafios');
    $description = get_string('copyrightdesc', 'theme_desafios');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $settings->add($setting);

    // CEOP.
    $name = 'theme_desafios/ceop';
    $title = get_string('ceop','theme_desafios');
    $description = get_string('ceopdesc', 'theme_desafios');
    $default = '';
    $choices = array(''=>get_string('ceopnone','theme_desafios'), 'http://www.thinkuknow.org.au/site/report.asp'=>get_string('ceopaus','theme_desafios'), 'http://www.ceop.police.uk/report-abuse/'=>get_string('ceopuk','theme_desafios'));
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $settings->add($setting);

    // Disclaimer setting.
    $name = 'theme_desafios/disclaimer';
    $title = get_string('disclaimer','theme_desafios');
    $description = get_string('disclaimerdesc', 'theme_desafios');
    $default = '';
    $setting = new admin_setting_confightmleditor($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $settings->add($setting);

    // Social Icons Heading.
    $name = 'theme_desafios/socialiconsheading';
    $heading = get_string('socialiconsheading', 'theme_desafios');
    $information = get_string('socialiconsheadingdesc', 'theme_desafios');
    $setting = new admin_setting_heading($name, $heading, $information);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $settings->add($setting);

    // Website url setting.
    $name = 'theme_desafios/website';
    $title = get_string('website','theme_desafios');
    $description = get_string('websitedesc', 'theme_desafios');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $settings->add($setting);

    // Facebook url setting.
    $name = 'theme_desafios/facebook';
    $title = get_string('facebook','theme_desafios');
    $description = get_string('facebookdesc', 'theme_desafios');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $settings->add($setting);

    // Twitter url setting.
    $name = 'theme_desafios/twitter';
    $title = get_string('twitter','theme_desafios');
    $description = get_string('twitterdesc', 'theme_desafios');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $settings->add($setting);

    // Snapchat url setting.
    $name = 'theme_desafios/snapchat';
    $title = get_string('snapchat','theme_desafios');
    $description = get_string('snapchatdesc', 'theme_desafios');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $settings->add($setting);	
	
    // Google+ url setting.
    $name = 'theme_desafios/googleplus';
    $title = get_string('googleplus','theme_desafios');
    $description = get_string('googleplusdesc', 'theme_desafios');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $settings->add($setting);

    // Flickr url setting.
    $name = 'theme_desafios/flickr';
    $title = get_string('flickr','theme_desafios');
    $description = get_string('flickrdesc', 'theme_desafios');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $settings->add($setting);

    // Pinterest url setting.
    $name = 'theme_desafios/pinterest';
    $title = get_string('pinterest','theme_desafios');
    $description = get_string('pinterestdesc', 'theme_desafios');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $settings->add($setting);

    // Instagram url setting.
    $name = 'theme_desafios/instagram';
    $title = get_string('instagram','theme_desafios');
    $description = get_string('instagramdesc', 'theme_desafios');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $settings->add($setting);

    // LinkedIn url setting.
    $name = 'theme_desafios/linkedin';
    $title = get_string('linkedin','theme_desafios');
    $description = get_string('linkedindesc', 'theme_desafios');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $settings->add($setting);

    // Wikipedia url setting.
    $name = 'theme_desafios/wikipedia';
    $title = get_string('wikipedia','theme_desafios');
    $description = get_string('wikipediadesc', 'theme_desafios');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $settings->add($setting);

    // YouTube url setting.
    $name = 'theme_desafios/youtube';
    $title = get_string('youtube','theme_desafios');
    $description = get_string('youtubedesc', 'theme_desafios');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $settings->add($setting);

    // Apple url setting.
    $name = 'theme_desafios/apple';
    $title = get_string('apple','theme_desafios');
    $description = get_string('appledesc', 'theme_desafios');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $settings->add($setting);

    // Android url setting.
    $name = 'theme_desafios/android';
    $title = get_string('android','theme_desafios');
    $description = get_string('androiddesc', 'theme_desafios');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $settings->add($setting);

}
