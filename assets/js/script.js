// In your Javascript (external .js resource or <script> tag)
$(document).ready(function() {
	"use-strict";
    
    $body = $('body');
    
    if($body.find('#ResponsiveTable')) {
    	$('#ResponsiveTable').DataTable({
			responsive: true,
			language: {
				searchPlaceholder: 'Search...',
				sSearch: '',
				lengthMenu: '_MENU_ show',
			}
		});
    }

    $('select').select2({
    	placeholder: "choose a value"
    });

});