requirejs.config({
	//By default load any module IDs from js/lib
	baseUrl: '/vendor/',
	paths: {
		jquery: 'jquery/dist/jquery.min',
		bootstrap: 'bootstrap/dist/js/bootstrap.min',
		netteForms: '/js/netteForms',
		netteAjax: 'nette.ajax.js/nette.ajax',
		modernizr: 'modernizr/modernizr',
		detectizr: 'detectizr/dist/detectizr.min',
		liveformvalidation: '/js/live-form-validation',
	},
	shim: {
		bootstrap: {
			deps: ['jquery']
		},
		netteAjax: {
			deps: ['jquery']
		},
		detectizr: {
			deps: ['modernizr']
		}
	}
});

var dependencies = [
	'jquery',
	'bootstrap',
	'netteForms',
	'netteAjax',
	'modernizr',
	'detectizr'
];

require(dependencies, function() {
	main();
});

function main() {
	Detectizr.detect();

	$.nette.init();

	$.each(q, function(index, f) {
		$(f);
	});

};