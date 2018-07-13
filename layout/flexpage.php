<?php
/**
 * Flexpage Theme
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see http://opensource.org/licenses/gpl-3.0.html.
 *
 * @copyright Copyright (c) 2009 Moodlerooms Inc. (http://www.moodlerooms.com)
 * @license http://opensource.org/licenses/gpl-3.0.html GNU Public License
 * @package theme_flexpage
 * @author Mark Nielsen
 */

/**
 * Flexpage Layout File
 *
 * @author Mark Nielsen
 * @package theme_flexpage
 */

/**
 * Flexpage local library
 * @see format_flexpage_default_width_styles
 */
require_once($CFG->dirroot.'/course/format/flexpage/locallib.php');

$hasheading = ($PAGE->heading);
$hasnavbar = (empty($PAGE->layout_options['nonavbar']) && $PAGE->has_navbar());
$hasfooter = (empty($PAGE->layout_options['nofooter']));
$hassidetop = (empty($PAGE->layout_options['noblocks']) && $PAGE->blocks->region_has_content('side-top', $OUTPUT));
$hassidepre = (empty($PAGE->layout_options['noblocks']) && $PAGE->blocks->region_has_content('side-pre', $OUTPUT));
$hassidepost = (empty($PAGE->layout_options['noblocks']) && $PAGE->blocks->region_has_content('side-post', $OUTPUT));
$haslogininfo = (empty($PAGE->layout_options['nologininfo']));

$showsidepre = ($hassidepre && !$PAGE->blocks->region_completely_docked('side-pre', $OUTPUT));
$showsidepost = ($hassidepost && !$PAGE->blocks->region_completely_docked('side-post', $OUTPUT));

// Always show block regions when editing so blocks can
// be dragged into empty block regions.
if ($PAGE->user_is_editing()) {
    if ($PAGE->blocks->is_known_region('side-pre')) {
        $showsidepre = true;
        $hassidepre  = true;
    }
    if ($PAGE->blocks->is_known_region('side-post')) {
        $showsidepost = true;
        $hassidepost  = true;
    }
    if ($PAGE->blocks->is_known_region('side-top')) {
        $hassidetop = true;
    }
}

$custommenu = $OUTPUT->custom_menu();
$hascustommenu = (empty($PAGE->layout_options['nocustommenu']) && !empty($custommenu));

$courseheader = $coursecontentheader = $coursecontentfooter = $coursefooter = '';
if (empty($PAGE->layout_options['nocourseheaderfooter'])) {
    $courseheader = $OUTPUT->course_header();
    $coursecontentheader = $OUTPUT->course_content_header();
    if (empty($PAGE->layout_options['nocoursefooter'])) {
        $coursecontentfooter = $OUTPUT->course_content_footer();
        $coursefooter = $OUTPUT->course_footer();
    }
}

$bodyclasses = array();
if ($showsidepre && !$showsidepost) {
    if (!right_to_left()) {
        $bodyclasses[] = 'side-pre-only';
    } else {
        $bodyclasses[] = 'side-post-only';
    }
} else if ($showsidepost && !$showsidepre) {
    if (!right_to_left()) {
        $bodyclasses[] = 'side-post-only';
    } else {
        $bodyclasses[] = 'side-pre-only';
    }
} else if (!$showsidepost && !$showsidepre) {
    $bodyclasses[] = 'content-only';
}
if ($hascustommenu) {
    $bodyclasses[] = 'has_custom_menu';
}

echo $OUTPUT->doctype() ?>
<html <?php echo $OUTPUT->htmlattributes() ?>>
<head>  <!-- Head -->
        <?php require('head.php'); ?>
        <!-- /Head -->
</head>
<body id="<?php p($PAGE->bodyid) ?>" <?php echo $OUTPUT->body_attributes(); ?>>
<?php echo $OUTPUT->standard_top_of_body_html() ?>
<?php if($hassidepre) { ?>
    <div class="navmenu navmenu-default navmenu-fixed-left navmenu-inverse"> <!-- Navbar Lateral -->
        <?php if($PAGE->course->fullname) { ?>
            <div class="bloque-lateral panel panel-default coursename block"> <!-- Nombre del curso. -->
                <div class="panel-body nopadding"><h1 class="text-center nomargin"><?php echo $PAGE->course->fullname; ?></h1></div>
            </div>
        <?php }; ?>
        <?php if($section) { ?>
            <div class="bloque-lateral panel panel-default sectionname block"> <!-- Nombre de la sección. "Desafío" -->
                <div class="panel-body nopadding"><h1 class="text-center nomargin"><?php echo $sectionname; ?></h1></div>
            </div>
        <?php }; ?>
        <div class="bloque-lateral panel panel-default usermenu block visible-sm visible-xs"> <!-- Menú user, solo SM y XS -->
            <div class="panel-body">
                <?php echo $OUTPUT->user_menu(); ?>
            </div>
        </div>


        <?php echo $OUTPUT->blocks('side-pre'); ?>
    </div> <!-- ./navbar lateral -->
<?php }; ?>



    <div class="canvas <?php if($PAGE->cm->section) {echo "section-" . $PAGE->cm->section;}; if($PAGE->cm->sectionname) {echo "sectionname-" . $PAGE->cm->sectionname;}; ?>">
        <!-- Navbar superior -->
        <nav class="navbar navbar-default navbar-fixed-top navbar-inverse">
            <div class="container-fluid">
                <?php if($hassidepre) { ?>
                    <button type="button" class="navbar-toggle" data-toggle="offcanvas" data-recalc="false" data-target=".navmenu" data-canvas=".canvas">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <p class="navbar-brand hidden-sm hidden-xs"><?php echo $bradcrumb; ?></p>
                <?php } else { ?>
                    <p class="navbar-brand"><?php echo '<a class="navbar-link" href="'. $courseurl . '">'. $PAGE->course->fullname .'</a>'; ?></p>
                <?php }; ?>
                <div class="navbar-right hidden-sm hidden-xs"><?php echo $OUTPUT->user_menu(); ?></div>
            </div>
        </nav> <!-- ./navbar superior -->
        <div class="container-fluid main-container" id="page-content">
            <?php if ($hasheading || $hasnavbar || !empty($courseheader)) { ?>
                <div id="page-header">
                    <?php if ($hasheading) { ?>
                        <h1 class="headermain"><?php echo $PAGE->heading ?></h1>
                        <div class="headermenu"><?php
                        if ($haslogininfo) {
                            echo $OUTPUT->login_info();
                        }
                        if (!empty($PAGE->layout_options['langmenu'])) {
                            echo $OUTPUT->lang_menu();
                        }
                        echo $PAGE->headingmenu
                        ?></div><?php } ?>
                    <?php if (!empty($courseheader)) { ?>
                        <div id="course-header"><?php echo $courseheader; ?></div>
                    <?php } ?>
                    <?php if ($hascustommenu) { ?>
                        <div id="custommenu"><?php echo $custommenu; ?></div>
                    <?php } ?>
                    <?php echo format_flexpage_tabs() ?>
                    <?php if ($hasnavbar) { ?>
                        <div class="navbar clearfix">
                            <div class="breadcrumb"><?php echo $OUTPUT->navbar(); ?></div>
                            <div class="navbutton"> <?php echo $PAGE->button; ?></div>
                        </div>
                    <?php } ?>
                </div>
            <?php } ?>
            <!-- END OF HEADER -->
            <!-- Flexpage content -->
            <div id="flexpage_actionbar" class="flexpage_actionbar clearfix">
                <?php echo $OUTPUT->main_content() ?>
            </div>
            <?php if ($hassidetop) { ?>
            <div id="region-top" class="block-region">
                <div class="region-content">
                    <?php echo $OUTPUT->blocks('side-top') ?>
                </div>
            </div>
            <?php } ?>
            <?php if (format_flexpage_has_next_or_previous()) { ?>
            <div class="flexpage_prev_next">
                <?php
                echo format_flexpage_previous_button();
                echo format_flexpage_next_button();
                ?>
            </div>
            <?php } ?>
            <div id="region-main-box">
                <div id="region-post-box">

                    <div id="region-main-wrap">
                        <div id="region-main" class="block-region">
                            <div class="region-content">
                                <?php echo $OUTPUT->blocks('main') ?>
                            </div>
                        </div>
                    </div>

                    <?php if ($hassidepre OR (right_to_left() AND $hassidepost)) { ?>
                    <div id="region-pre" class="block-region">
                        <div class="region-content">
                            <?php
                            if (!right_to_left()) {
                                echo $OUTPUT->blocks('side-pre');
                            } elseif ($hassidepost) {
                                echo $OUTPUT->blocks('side-post');
                            } ?>

                        </div>
                    </div>
                    <?php } ?>

                    <?php if ($hassidepost OR (right_to_left() AND $hassidepre)) { ?>
                    <div id="region-post" class="block-region">
                        <div class="region-content">
                            <?php
                            if (!right_to_left()) {
                                echo $OUTPUT->blocks('side-post');
                            } elseif ($hassidepre) {
                                echo $OUTPUT->blocks('side-pre');
                            } ?>
                        </div>
                    </div>
                    <?php } ?>

                </div>
            </div>
            <!-- START OF FOOTER -->
            <?php if (!empty($coursefooter)) { ?>
                <div id="course-footer"><?php echo $coursefooter; ?></div>
            <?php } ?>
            <?php if ($hasfooter) { ?>
                <div id="page-footer" class="clearfix">
                    <p class="helplink"><?php echo page_doc_link(get_string('moodledocslink')) ?></p>
                    <?php
                    echo $OUTPUT->login_info();
                    echo $OUTPUT->home_link();
                    echo $OUTPUT->standard_footer_html();
                    ?>
                </div>
            <?php } ?>
            <div class="clearfix"></div>
        </div>

        <?php require('end_of_html.php'); ?>

        <?php echo $OUTPUT->standard_end_of_body_html(); ?>
    </div> <!-- ./canvas -->

</body>
</html>