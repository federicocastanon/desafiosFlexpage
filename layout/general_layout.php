<?php
//Función para limpiar string y convertirlos en sin tildes
function stripAccents($cadena){
    $originales = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿŔŕ ';
    $modificadas = 'aaaaaaaceeeeiiiidnoooooouuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr-';
    $cadena = utf8_decode($cadena);
    $cadena = strtr($cadena, utf8_decode($originales), $modificadas);
    $cadena = strtolower($cadena);
    return utf8_encode($cadena);
}

// Tener los datos de la sección, si está disponible. Utilizado en el bloque lateral.
//Lo buscamos en la DB
if($PAGE->cm->section) {
    GLOBAL $DB;
    $sql = "";
    $section = FALSE;
    if ($PAGE->cm->section) {
        $sql = "SELECT * FROM mooc_course_sections WHERE id = ". $PAGE->cm->section;
    };
    if ($sql != "") {
        $section = $DB->get_record_sql($sql);
        $sectionname = $section->name;
        $sectionurl = $CFG->wwwroot."/course/view.php?id=".$section->course."&section=".$section->section;
    };
};

// Generamos el array $modules que va a servir para generar automáticamente la botonera lateral y la superior/inferior en cada módulo
$modtype = Array('page','forum');
$allmodules = get_fast_modinfo($PAGE->course->id)->cms;
$modules = Array();
foreach ($allmodules as $allmod) {
    if(in_array($allmod->modname, $modtype) && ($allmod->section == $PAGE->cm->section)){
        $module = Array();
        $module['id'] = $allmod->id;
        $module['name'] = $allmod->name;
        $module['modname'] = $allmod->modname;
        $module['url'] = $CFG->wwwroot.'/mod/'.$allmod->modname.'/view.php?id='.$allmod->id;
        $module['safename'] = strtolower(stripAccents($allmod->name));
        array_push($modules, $module);
    };
};

// Sabemos si el menú lateral va a estar vacío.
$hassidebar = $PAGE->blocks->region_has_content('side-pre', $OUTPUT);

//Generar la URL del curso
$courseurl = $CFG->wwwroot."/course/view.php?id=".$PAGE->course->id;

//Generar el Breadcrumb
$bradcrumb = '<a class="navbar-link" href="'. $courseurl . '">'. $PAGE->course->fullname .'</a>'; //Nombre del curso, va siempre
if($sectionname) {$bradcrumb .= ' <span class="separador">|</span> <a class="navbar-link" href="'. $sectionurl . '">'.$sectionname .'</a>';};  //Agregamos nombre de sección, si está disponible
if($PAGE->cm->name) {$bradcrumb .= ' <span class="separador">|</span> '.$PAGE->cm->name;}; //Agregamos nombre del módulo (Página/Foro/Carpeta/Etc), si está disponible.

echo $OUTPUT->doctype(); ?>

<!-- Generamos el layout html -->
<html <?php echo $OUTPUT->htmlattributes(); ?>>
<head>
    <!-- Head -->
    <?php require('head.php'); ?>
    <!-- /Head -->
</head>
<body <?php echo $OUTPUT->body_attributes(); ?>>

    <?php echo $OUTPUT->standard_top_of_body_html(); ?> 

    <?php if($hassidebar) { ?>
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
        <div class="bloque-lateral panel panel-default breadcrumb block visible-sm visible-xs"> <!-- Breadcrumb, solo SM y XS -->
            <div class="panel-body">
                <?php echo $bradcrumb; ?>
            </div>
        </div>
        <?php if(count($modules) > 0) { ?>
            <div class="bloque-lateral list-group list-etiquetas list-secciones"> <!-- Menú lateral con los enlaces a los módulos -->
                <?php foreach ($modules as $module) { ?>
                    <a href="<?php echo $module['url'] ?>" class="list-group-item item-etiqueta item-seccion id-<?php echo $module['id'] ?> <?php echo $module['modname']; echo ' '.$module['safename']; if ($module['url'] == $PAGE->url->out()) {echo ' active';}; ?>"><?php echo $module['name'] ?></a>
                <?php }; ?>
            </div>
        <?php }; ?>
        <?php echo $OUTPUT->blocks('side-pre'); ?>
    </div> <!-- ./navbar lateral -->
    <?php }; ?>

    <div class="canvas <?php if($PAGE->cm->section) {echo "section-" . $PAGE->cm->section;}; if($PAGE->cm->sectionname) {echo "sectionname-" . $PAGE->cm->sectionname;}; ?>">
        <!-- Navbar superior -->
        <nav class="navbar navbar-default navbar-fixed-top navbar-inverse">
            <div class="container-fluid">
                <?php if($hassidebar) { ?>
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

            <div id="<?php echo $regionbsid ?>" class="row">
                <div class="col-lg-12">
                    <section id="region-main">
                    <div class="row text-center">
                        <div class="col-lg-12">
                            <?php if(count($modules) > 0) { ?>
                                <!-- Bloque superior de módulos -->
                                <div class="bloque-superior btn-group btn-group-lg list-etiquetas list-secciones" role="group">
                                    <?php foreach ($modules as $module) { ?>
                                        <a href="<?php echo $module['url'] ?>" class="btn btn-default item-etiqueta item-seccion id-<?php echo $module['id'] ?> <?php echo $module['modname']; echo ' '.$module['safename']; if ($module['url'] == $PAGE->url->out()) {echo ' btn-primary';}; ?>"><?php echo $module['name'] ?></a>
                                    <?php }; ?>
                                </div>
                            <?php }; ?>
                        </div>
                    </div>
                    <!-- Contenido principal -->
                    <?php
                        echo $OUTPUT->course_content_header();
                        echo $OUTPUT->main_content();
                        echo $OUTPUT->course_content_footer();
                    ?>
                    </section>                    
                </div>
            </div>

        </div> <!-- ./page-content main-container -->

        <!--<footer id="page-footer">-->
        <!--    <?php //require('footer.php'); ?>-->
        <!--</footer>-->

        <?php require('end_of_html.php'); ?>

        <?php echo $OUTPUT->standard_end_of_body_html(); ?>
    </div> <!-- ./canvas -->

</body>
</html>
