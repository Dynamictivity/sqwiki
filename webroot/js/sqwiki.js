$(function() {

	// Apply jQueryUI Theme
	$('#header').addClass('ui-widget ui-widget-header ui-helper-reset ui-helper-clearfix');
	$('#content').addClass('ui-widget ui-widget-content ui-helper-reset ui-helper-clearfix');
	$('#container').addClass('ui-widget ui-widget-content ui-helper-reset ui-helper-clearfix');
	$('#footer').addClass('ui-widget ui-widget-header ui-helper-reset ui-helper-clearfix');
	$('form input, form textarea, .select select').addClass('ui-widget ui-corner-all');
	//$('table td.actions a').addClass('ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only');
	$("table td.actions a, .button, .submit input, .article-toolbar a").button();
	$("textarea").markItUp(markitupSettings);

}); 