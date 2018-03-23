//ezpieczne , poprawne uwierzytelnianie
$(document).ready( function() {

	$("#form1").submit( function() {
		$("#pass").val( hex_sha256($("#key").val() + hex_sha256($("#pass").val())) ); //zahaszuj i wyczyśc klucz
		//usuwac klucz
		$("#key").val("");
		//alert($("#pass").val());
		return true; // false zeby zobaczyc przed wyslaniem to, formularz nie zostanie wyslany jak false
	});
});