function verProgreso(e) {
var p= document.getElementById("progreso");
p.innerHTML = Math.round((e.loaded / e.total)*100)+"%";
}
function crearimagen(img){
  var imagen = document.createElement("img"); 
               imagen.setAttribute("src", "assets/img/" + img.file);
               imagen.width=90;
               var div = document.getElementById("imagenes"); 
               div.appendChild(imagen); 
}
function subiendoAJAX(f) {
  var f= document.getElementById("archivo");
var fd = new FormData(); 
    fd.append("fiche", f.files[0]);
var xhr = new XMLHttpRequest();
xhr.upload.addEventListener("progress", verProgreso, false)
xhr.open("POST", 'php/imagen.php')
xhr.onreadystatechange = function() {
	if (this.readyState==4){
		 crearimagen(JSON.parse(this.response)); 
	}
};
xhr.send(fd)
}