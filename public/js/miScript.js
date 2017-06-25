$('#miImagenInput').change(function(){
	LeerURL(this);
});
function LeerURL(input){
	if(input.files && input.files[0]){
		var reader = new FileReader();
		reader.onload=function(e){
			$("#mi_img").attr('src',e.target.result);
		}
		reader.readAsDataURL(input.files[0]);
	}
};
/*******************************************/
$('#miDocImg1').change(function(){
	LeerURL1(this);
});
function LeerURL1(input){
	if(input.files && input.files[0]){
		var reader = new FileReader();
		reader.onload=function(e){
			$("#mi_img1").attr('src',e.target.result);
		}
		reader.readAsDataURL(input.files[0]);
	}
};
/*******************************************/
$('#miDocImg2').change(function(){
	LeerURL2(this);
});
function LeerURL2(input){
	if(input.files && input.files[0]){
		var reader = new FileReader();
		reader.onload=function(e){
			$("#mi_img2").attr('src',e.target.result);
		}
		reader.readAsDataURL(input.files[0]);
	}
};/*******************************************/
$('#miDocImg3').change(function(){
	LeerURL3(this);
});
function LeerURL3(input){
	if(input.files && input.files[0]){
		var reader = new FileReader();
		reader.onload=function(e){
			$("#mi_img3").attr('src',e.target.result);
		}
		reader.readAsDataURL(input.files[0]);
	}
};/*******************************************/
$('#miDocImg4').change(function(){
	LeerURL4(this);
});
function LeerURL4(input){
	if(input.files && input.files[0]){
		var reader = new FileReader();
		reader.onload=function(e){
			$("#mi_img4").attr('src',e.target.result);
		}
		reader.readAsDataURL(input.files[0]);
	}
};/*******************************************/
$('#miDocImg5').change(function(){
	LeerURL5(this);
});
function LeerURL5(input){
	if(input.files && input.files[0]){
		var reader = new FileReader();
		reader.onload=function(e){
			$("#mi_img5").attr('src',e.target.result);
		}
		reader.readAsDataURL(input.files[0]);
	}
};/*******************************************/
$('#miDocImg6').change(function(){
	LeerURL6(this);
});

function LeerURL6(input){
	if(input.files && input.files[0]){
		var reader = new FileReader();
		reader.onload=function(e){
			$("#mi_img6").attr('src',e.target.result);
		}
		reader.readAsDataURL(input.files[0]);
	}
};

function confirmarEliminar(btn){
	if(confirm("Esta seguro de eliminar")){
	$("#"+btn).click();
	}
}

