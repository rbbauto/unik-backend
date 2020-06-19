var app = angular.module('crud',[]);
var Global,escope;
app.controller('crudController',['$scope','$http',function($scope, $http){

	$scope.colores	=	['Blanco','Negro','Gris','Azul', 'Celeste','Rojo','Amarillo','Naranja'];

	$scope.nuevaCategoria= "";
	
	$scope.productos = [];

	$scope.producto = {};

	$scope.detalle_producto =	{};

	$scope.errors = [];

	//list
	$scope.listProducts = function(){

		$http.get('ajax.php?list',{})
		.then(function success(e){
			$scope.productos = e.data.productos;
		}, function error(e){

			console.log("Se ha producido un error al recuperar la información");
		});
	};

	$scope.listProducts();

	//método para registrar 
	$scope.addProduct = function(){

		$scope.detalle_producto.imagen = "";
		
		$http.post('ajax.php?create',{
			producto:$scope.producto
		})
		.then(function success(e){

			$scope.errors = [];

			$scope.productos.push(e.data.producto);

			var modal_element = angular.element('#add_new_modal');
			modal_element.modal('hide');

		}, function error(e){

			$scope.errors = e.data.errors;

		});
	};

	// metodo para registrar categoria

	$scope.addCategoria = function(){

		$http.post('ajax.php?addCat',{
			categoria:$scope.nuevaCategoria
		})
		.then(function success(e){

			$scope.categorias.push(e.data.categoria);
			var modal_element = angular.element('#add_new_cat');
			modal_element.modal('hide');

		}, function error(e){
			$scope.errors = e.data.errors;
		});

	};

	//eliminar
	$scope.delete = function(index){

		var conf = confirm("¿Realmente quieres eliminar el producto?");

		if (conf==true) {

			$http.post('ajax.php?delete',{
				producto:$scope.productos[index]
			})
			.then(function success(e){

				$scope.errors = [];

				$scope.productos.splice(index,1);

			}, function error(e){

				$scope.errors = e.data.errors;
			})
		}

	};

	//recuperar
	$scope.edit = function(index){

		$scope.errors = [];
		$scope.detalle_producto = $scope.productos[index];

		var modal_element = angular.element('#modal_update');
		modal_element.modal('show');
	};

	//actualizar
	$scope.updateProduct = function(){

		$http.post('ajax.php?update',{
			producto:$scope.detalle_producto
		})
		.then(function success(e){

			$scope.errors = [];

			var modal_element = angular.element('#modal_update');
			modal_element.modal('hide');
			$

		}, function error(e){

			$scope.errors = e.data.errors;
		});
	};

	// Agrega imagen a Edit
	$scope.subiendoAJAX	=	function (f) {
		var fd= null;
		var f= document.getElementById("archivo2");
		fd = new FormData(); 
		fd.append("fiche", f.files[0]);
		var xhr = new XMLHttpRequest();
		//xhr.upload.addEventListener("progress", $scope.verProgreso, false)
		xhr.open("POST", 'ajax.php?imagen')
		xhr.onreadystatechange = function() {
			if (this.readyState==4){
				var respuesta=JSON.parse(this.response);
				if(respuesta.status == 'ok') {
					$scope.detalle_producto.imagen = 'assets/img/' + respuesta.file;
					$scope.$apply();
				}else{
					Global = this ;//JSON.parse(this.response); //$scope.errors = e.data.errors;
					escope = $scope;
					$scope.errors = JSON.parse(Global.response).errors;
					$scope.$apply();
				}
			}
	};
		xhr.send(fd)
	};

	// Agrega imagen Cuando se crea un producto
	$scope.AddImagen	=	function (f) {
		var f= document.getElementById("archivo");
		var fd = new FormData(); 
		fd.append("fiche2", f.files[0]);
		var xhr = new XMLHttpRequest();
		//xhr.upload.addEventListener("progress", $scope.verProgreso, false)
		xhr.open("POST", 'ajax.php?imagen2')
		xhr.onreadystatechange = function() {
		if (this.readyState==4){
			var respuesta=JSON.parse(this.response);
			if(respuesta.status == 'ok') {
				$scope.producto.imagen = 'assets/img/' + respuesta.file;
				$scope.detalle_producto.imagen = 'assets/img/' + respuesta.file;
				$scope.$apply();
				
			}else{
					Global = this ;//JSON.parse(this.response); //$scope.errors = e.data.errors;
					escope = $scope;
					$scope.errors = JSON.parse(Global.response).errors;
					$scope.$apply();
				}
		}
	};
		xhr.send(fd)
	};

	// agrega categoria a select 

	$scope.listCat = function(){

		$http.get('ajax.php?listCat',{})
		.then(function success(e){
			$scope.categorias=	e.data.categorias;
			
		}, function error(e){

			console.log("Se ha producido un error al recuperar categorias");
		});

		
	};

	$scope.listCat();
	


	setTimeout(function(){
		$(".se-pre-con").hide();
	},1000);
	
}]);

