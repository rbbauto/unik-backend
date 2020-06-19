<div class="modal fade" id="add_new_cat" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
        <!--    <div class="modal-header">
                   
                    <h4 class="modal-title" id="myModalLabel">Nuevo Producto</h4> <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div> 
            -->
                <div class="modal-body">

                	 <ul class="alert alert-danger" ng-if="errors.length > 0">
                        <li ng-repeat="error in errors">
                        	{{ error }}
                        </li>
                     </ul>
                   
                    <div class="form-group">
                        <label for="categoria">Categoria</label>
                        <input class="form-control" type="text" ng-model="nuevaCategoria" placeholder="Ingrese una nueva ategoria">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" ng-click="addCategoria()">Guardar Categoria</button>
                </div>
            </div>
        </div>
    </div>