<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Beam-Template
 * 
 * @package Beam-Template
 * @category Config
 * @author Jafar Sidik
 */


/**
 * Path to Template Layout.
 * 
 * Default: 'application/views/layouts' 
 */
$config['beam_template']['layout_path'] = 'layouts';

/**
 * Default Template Layout
 * 
 * The default layout to use 
 * Default: 'default'
 */
$config['beam_template']['default_layout'] = 'default';
//$config['beam_template']['default_layout'] = 'fluid';

/**
 * Path to Assets
 * 
 * Path to your assets files, default to 'assets'.
 */
$config['beam_template']['assets_path'] = 'assets';

/**
 * Default Site Title
 */
$config['beam_template']['base_title'] = 'SmartBuz';

/**
 * Title Separator 
 */
$config['beam_template']['title_separator'] = ' | ';

/**
 * Default Site Metas
 */
$config['beam_template']['metas'] = array(
	'description'	=> '',
	'author'		=> 'Muhamad Jafar Sidik ST'
);

/**
 * Default CSS 
 */
$config['beam_template']['css'] = array(
	'css/cloud-admin',	
	'css/themes/default',
	'css/responsive',	
	'font-awesome/css/font-awesome.min',	
	'js/bootstrap-daterangepicker/daterangepicker-bs3',
	'css/css-google-font',
	'css/datatables-3',
	'js/select2/select2.min',
	'css/jquery.pnotify.default',
	'js/uniform/css/uniform.default.min',	
	'js/typeahead/typeahead',
	'js/bootstrap-switch/bootstrap-switch.min',
	'css/orgChart/jquery.jOrgChart',
	'js/bootstrap-wizard/wizard',
	'js/jquery-ui-1.10.3.custom/css/custom-theme/jquery-ui-1.10.3.custom.min',
	'js/fullcalendar/fullcalendar.min',
	'jsplumb/css/jsplumb',
	'jsplumb/css/demo',
	'js/dropzone/dropzone.min',
	'js/jqplot/jquery.jqplot.min',
	'codebase/dhtmlxgantt',
	'js/verticaltimeline/css/style',
	'treetable/css/jquery.treegrid',
	//'css/jquery.gridster.min',
);
/**
 * Default Javascript
 */

$config['beam_template']['js_header'] = array(
	'js/flot/jquery.min',
	//'js/jquery/jquery-2.0.3.min',
	'js/jquery-ui-1.10.3.custom/js/jquery-ui-1.10.3.custom.min',
	
	'bootstrap-dist/js/bootstrap.min',
	'js/datatables/media/js/jquery.dataTables.min',
	'js/jquery-validate/jquery.validate.min',
	'js/jquery.pnotify',
	'js/select2/select2.min',
	'js/bootstrap-daterangepicker/daterangepicker.min',
	//'js/bootstrap-datepicker',
	'js/typeahead/typeahead.min',
	'js/autosize/jquery.autosize.min',
	'js/countable/jquery.simplyCountable.min',
	'codebase/dhtmlxgantt',
	'codebase/ext/dhtmlxgantt_tooltip',
	'js/bootstrap-inputmask/bootstrap-inputmask.min',
	'js/jquery.jOrgChart',
	'js/bootbox/bootbox.min',
	'js/bootstrap-switch/bootstrap-switch.min',
	'js/countable/jquery.simplyCountable.min',	
	'js/bootstrap-daterangepicker/moment.min',
	'js/fullcalendar/fullcalendar.min',	
	'jsplumb/lib/jsBezier-0.6',	
	'jsplumb/lib/biltong-0.2',	
	'jsplumb/src/util',	
	'jsplumb/src/dom-adapter',	
	
	'jsplumb/src/jsPlumb',	
	'jsplumb/src/endpoint',	
	'jsplumb/src/connection',	
	'jsplumb/src/anchors',	
	'jsplumb/src/defaults',	
	'jsplumb/src/connectors-bezier',	
	'jsplumb/src/connectors-statemachine',	
	'jsplumb/src/connectors-flowchart',	
	'jsplumb/src/connector-editors',	
	'jsplumb/src/renderers-svg',	
	'jsplumb/src/renderers-vml',	
	'jsplumb/src/jquery.jsPlumb',	
	'js/dropzone/dropzone.min',
	'js/bootstrap-wysiwyg/jquery.hotkeys.min',
	'js/bootstrap-wysiwyg/bootstrap-wysiwyg.min',
	'codebase/connector',
	'js/verticaltimeline/js/modernizr-2.5.3.min',
	'treetable/js/jquery.treegrid',
	'treetable/js/jquery.treegrid.bootstrap3',
	'js/interact-1.1.2.min',
	'js/shuffle/jquery.shuffle.modernizr.min',
	'js/shuffle/jquery.shuffle.min',
	'jeff',
	
	
);
$config['beam_template']['js_footer'] = array(	
	//'js/jquery/jquery-2.0.3.min',
	'js/jqplot/jquery.jqplot.min',
	'js/jqplot/plugins/jqplot.highlighter.min',
	'js/jqplot/plugins/jqplot.cursor.min',
	'js/jqplot/plugins/jqplot.dateAxisRenderer.min',

	'js/jQuery-BlockUI/jquery.blockUI.min',
	'js/jQuery-slimScroll-1.3.0/jquery.slimscroll.min',
	'js/jQuery-slimScroll-1.3.0/slimScrollHorizontal.min',
	'js/jQuery-Cookie/jquery.cookie.min',
	'js/uniform/jquery.uniform.min',
	'js/datatables-3',
	'js/bootstrap-fileupload/bootstrap-fileupload.min',
	'js/verticaltimeline/js/handlebars',
	'js/verticaltimeline/js/tabletop',
	'js/verticaltimeline/js/plugins',
	/*'js/sparklines/jquery.sparkline.min',*/
	/*'js/flot/jquery.flot.min',
	'js/flot/jquery.flot.time.min',
	'js/flot/jquery.flot.selection.min',
	'js/flot/jquery.flot.selection.min',
	'js/flot/jquery.flot.resize.min',
	'js/flot/jquery.flot.pie.min',
	'js/flot/jquery.flot.stack.min',
	'js/flot/jquery.flot.crosshair.min',
	'js/verticaltimeline/js/script',*/
	'js/script',   
	'js/accounting.min',
/*	'js/charts',*/


);
