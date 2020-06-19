<div class="modal fade" id="modal_update" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Editar Producto</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
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
                            <label for="name">Nombre</label>
                            <input id="name" ng-model="detalle_producto.nombre" type="text" id="name" class="form-control"/>
                        </div>
                        <div class="col">
                            <label for="description">Descripción</label>
                            <textarea id="descripcion" ng-model="detalle_producto.descripcion" class="form-control" name="description"></textarea>
                        </div>
                    </div>
                    <hr/>
                    <div class="form-row">
                        <div class="col">
                            <label for="color">Color</label>
                            <select id="color" ng-model="detalle_producto.color" class="form-control">
                                <option ng-repeat="color in colores">{{color}}</option>
                            </select>
                        </div>

                        <div class="col">
                            <label for="categoria">Categoria</label>
                            <select id="categoria" ng-model="detalle_producto.categoria" class="form-control">
                                <option ng-repeat="categoria in categorias">{{categoria}}</option>
                            </select>
                        </div>
                    </div>
                    <hr/>
                    <div class="form-row">
                        <div class="col">
                            <label for="stock">Cantidad</label>
                            <input id="stock" class="form-control" type="number" ng-model="detalle_producto.stock">
                        </div>
                        <div class="col">
                            <label for="precio">Precio</label>
                            <input id="precio" class="form-control" type="number" ng-model="detalle_producto.precio">
                        </div>
                        <div class="col">
                            <label for="stock">Activa</label>
                            <select id="stock" class="form-control" ng-model="detalle_producto.activa">
                                <option value="1" ng-selected="detalle_producto.activa">Si</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                        
                        
                    </div>
                    
                    <hr/>
                    <div class="card col">
                        <img class="card-img-top img-card-custom" src="{{ detalle_producto.imagen }}">
                        <div class="card-body">
                            <form enctype="multipart/form-data" id="formu">
                                <input type="file" id="archivo2" class="form-control-file"/> <br/>
                                <input ng-model="detalle_producto.imagen" type="hidden" name="imagen" class="form-control" />
                                <button ng-click="subiendoAJAX()" class="btn btn-info" >Subir</button>
                            </form>
                        </div>
                            
                    </div>

                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button ng-click="updateProduct()" type="button" class="btn btn-primary">Guardar Cambios</button>
                </div>
            </div>
        </div>
    </div>