var Demo = (function() {
	function popupResult(result) {
		var html;
		if (result.html) {
			html = result.html;
		}
		if (result.src) {
		console.log(result.src);
			html = '<img id="profile" src="' + result.src + '" />';
		}
		$("body").append(html);


		$.ajax({
			method: "POST",
			url: window.location.href,
			data: { img: result.src }
		})
		.done(function(o) {
			setTimeout(function(){ location.reload(); }, 4000); 
		});
	}

	function demoUpload() {
		var $uploadCrop;

		function readFile(input) {
 			if (input.files && input.files[0]) {
	            var reader = new FileReader();
	            
	            reader.onload = function (e) {
					$('.upload-demo').addClass('ready');
	            	$uploadCrop.croppie('bind', {
	            		url: e.target.result
	            	}).then(function(){
	            		console.log('jQuery bind complete');
	            	});
	            	
	            }
	            
	            reader.readAsDataURL(input.files[0]);
	        }
	        else {
		        alert("Sorry - you're browser doesn't support the FileReader API");
		    }
		}

		if(window.location.pathname.split("/")[2] == "profile-photo"){
			$uploadCrop = $('#upload-demo').croppie({
				viewport: {
					width: 400,
					height: 400,
					type: 'square'
				}
			});
		}else if(window.location.pathname.split("/")[2] == "cover-photo"){
			$uploadCrop = $('#upload-demo').croppie({
				viewport: {
					width: 700,
        			height: 200
				}
			});
		}

		

		$('#upload').on('change', function () { 
			$("[upload='true']").show();
			readFile(this); 
		});

		$('.upload-result').on('click', function (ev) {
			$uploadCrop.croppie('result', {
				type: 'canvas',
				size: 'viewport'
			}).then(function (resp) {
				popupResult({
					src: resp
				});
			});

			$uploadCover.croppie('result', {
				type: 'canvas',
				size: 'viewport'
			}).then(function (resp) {
				popupResult({
					src: resp
				});
			});
		});
	}


	function init() {
		demoUpload();
	}

	return {
		init: init
	};
})();


$(document).ready(function(){
	Demo.init();
});
