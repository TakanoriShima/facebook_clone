/* global $*/
$(function(){
    const previewImage = (obj) => {
        var fileReader = new FileReader();
        fileReader.onload = () => {
        	$('#preview').prop('src', fileReader.result);
        };
        fileReader.readAsDataURL(obj.files[0]);
    };
    
    // function previewImage(obj)
    // {
    // 	var fileReader = new FileReader();
    // 	fileReader.onload = (function() {
    // 		document.getElementById('preview').src = fileReader.result;
    // 	});
    // 	fileReader.readAsDataURL(obj.files[0]);
    // }
});