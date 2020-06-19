<div class="modal fade" id="add_new_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog mw-100-w-75" role="document">
            <div class="modal-content">
                <div class="modal-header">
                   
                    <h4 class="modal-title" id="myModalLabel">Nuevo Producto</h4> <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div> 
            
                <div class="modal-body">

                	 <ul class="alert alert-danger" ng-if="errors.length > 0">
                        <li ng-repeat="error in errors">
                        	{{ error }}
                        </li>
                     </ul>

                    <div class="form-row">

                        <div class="col">
                            <label for="name">Nombre <i class="alert-danger">obligatorio!</i></label>
                             <input placeholder="Nombre del Producto" ng-model="producto.nombre" type="text" id="name" class="form-control"/>
                            </div>
                        <div class="col">
                            <label for="description">Descricion</label>
                            <textarea placeholder="Descripcion del Producto" ng-model="producto.descripcion" class="form-control" name="    description">
                            </textarea>
                        </div>
                    </div>
                    <hr/>
                    <div class="form-row">
                        <div class="col">
                                <label for="color">Color <i class="alert-danger">obligatorio!</i></label>
                                <select ng-model="producto.color" class="form-control">
                                    <option ng-repeat="color in colores">{{color}}</option>
                                </select>
                        </div>

                            <div class="col">
                                <label for="categoria">Categoria <i class="alert-danger">obligatorio!</i></label>
                                <select ng-model="producto.categoria" class="form-control">
                                    <option ng-repeat="categoria in categorias">{{categoria}}</option>
                                </select>
                            </div>
                    </div>      
                    <hr/> 
                    <div class="form-row">
                        <div class="col">
                            <label for="stock">Cantidad <i class="alert-danger">obligatorio!</i></label>
                            <input class="form-control" type="number" ng-model="producto.stock">
                            
                        </div>
                        <div class="col">
                            <label for="precio">Precio <i class="alert-danger">obligatorio!</i></label>
                            <input class="form-control" type="number" ng-model="producto.precio">

                        </div>
                        <div class="col">
                           <label for="stock">Activa <i class="alert-danger">obligatorio!</i></label>
                                <select ng-model="producto.activa" class="form-control">
                                    <option value="1">Si</option>
                                    <option value="0">No</option>
                                </select>
                                
                        </div>
                    </div>
                    <hr/>        

                    <div class="form-row">
                        <div class="card col" style="width: 18rem;">
                            <img  class="card-img-top img-card-custom" src="{{ detalle_producto.imagen }}">
                            <div class="card-body">
                                <form enctype="multipart/form-data" id="formu">
                                    <input type="file" id="archivo" class="form-control-file"/> <br/>
                                    <input ng-model="producto.imagen" type="hidden" name="imagen" class="form-control" />
                                    <button ng-click="AddImagen()" class="btn btn-info" >Subir</button>
                                </form>
                            </div>
                        </div>
           
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" ng-click="addProduct()">Guardar Producto</button>
                </div>
            </div>
        </div>
    </div>