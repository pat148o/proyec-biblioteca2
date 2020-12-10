<template>
    <main class="main" >
    <!-- Breadcrumb -->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item"><a href="#">Admin</a></li> 
        <li class="breadcrumb-item active">Dashboard</li>
    </ol>            
    <div class="container-fluid">
        <!-- {{-- <example-component></example-component>
        <categoria></categoria> --}} -->
        <!-- Ejemplo de tabla Listado -->
        <div class="card">
            <div class="card-header">
                <i class="fa fa fa-book"></i> libros
                <button type="button" class="btn btn-primary" data-toggle="modal" @click="abrirModal('guardar')">
                    <i class="icon-plus"></i>&nbsp;Nuevo 
                </button>
            </div>
            <div class="card-body">
                <div class="form-group row">
                    <div class="col-md-6">
                        <div class="input-group">
                            <select class="form-control col-md-2" id="opcion" name="opcion" v-model="criterio">
                              <option value="nombre">Nombre</option>
                            </select>
                            <input v-model="buscar" type="text" id="texto" name="texto" class="form-control" placeholder="libro a buscar" @keypress="listLib(1, criterio, buscar)">
                            <button type="button" @click="listLib(1, criterio, buscar)"  class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                        </div>
                    </div>
                </div>
                <table class="table table-bordered table-striped table-sm">
                    <thead>
                        <tr>
                            <th>Nombre</th>                                   
                            <th>Codigo</th>                                   
                            <th>Cantidad</th>                                   
                            <th>Año Publicación</th>                                   
                            <th>Num. Pag</th>                                   
                            <th>Ubicación</th>                                   
                            <th>Edición</th>                                   
                            <th>Editorial</th>                                   
                            <th>Categoria</th>                                   
                            <th>Autor</th>                                    
                            <th>Idioma</th>                                                                    
                            <th>Opciones</th>                               
                        </tr>
                    </thead>
                    <tbody>

                        <tr v-for="objeto in arrayDatos" :key="objeto.id">
                            <td v-text="objeto.nombre"></td>
                            <td v-text="objeto.codigo"></td>
                            <td v-text="objeto.cant"></td>
                            <td v-text="objeto.ano_publi"></td>
                            <td v-text="objeto.num_pag"></td>
                            <td v-text="objeto.ubicacion"></td>
                            <td v-text="objeto.edicion"></td>
                            <td v-text="objeto.nomEdit"></td>
                            <td v-text="objeto.nomCat"></td>
                            <td v-text="objeto.nomAut"></td>
                            <td v-text="objeto.nomIdi"></td>
                            <td>
                                <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" @click="abrirModal('editar', objeto)">
                                  <i class="icon-pencil"></i>
                                </button> &nbsp;
                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" @click="eliminarLib(objeto)">
                                  <i class="icon-trash"></i>
                                </button>
                            </td>                                                                        
                        </tr>                                                                                                                                
                    </tbody>
                </table>
                
            <nav>
                <ul class="pagination">
                    <li class="page-item" v-if="pagination.current_page > 1">
                    <a
                    class="page-link"
                    href="#"
                    @click.prevent="cambiarPagina(pagination.current_page - 1,buscar,criterio)"
                    >Ant</a>
                    </li>
                    <li
                    class="page-item"
                    v-for="page in pagesNumber" 
                    :key="page"
                    :class="[page == isActived ? 'active' : '']"
                    >
                    <a
                    class="page-link"
                    href="#"
                    @click.prevent="cambiarPagina(page,buscar,criterio)"
                    v-text="page"
                    ></a>
                 </li>
                 <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                    <a
                    class="page-link"
                    href="#"
                    @click.prevent="cambiarPagina(pagination.current_page + 1,buscar,criterio)"
                    >Sig</a>
                        </li>
                    </ul>
            </nav>
            </div>
        </div>
        <!-- Fin ejemplo de tabla Listado -->
    </div>
    <!--Inicio del modal agregar/actualizar-->
    <div class="modal fade" id="modalNuevo" :class="{'mostrar':modal}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-primary modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" v-text="titulo"></h4>
                    <button type="button" class="close" @click="cerrarModal" aria-label="Close">
                      <span aria-hidden="true">X</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                        <div class="form-group row">
                           
                             <label class="col-md-2 form-control-label" for="text-input">Nombre</label>
                                 <div class="col-md-4">
                                 <input type="text" v-model="nombre" id="nombre" name="nombre" class="form-control" placeholder="Nombre libro">
                                 <span class="help-block"><br> </span>
                               </div> 
                            

                            <label class="col-md-2 form-control-label" for="text-input">Código</label>
                            <div class="col-md-4">
                                <input type="text" v-model="codigo" id="codigo" name="codigo" class="form-control" placeholder="codigo libro">
                                <span class="help-block"> <br></span>
                            </div>

                            

                            <label class="col-md-2 form-control-label" for="text-input">Cantidad</label>
                            <div class="col-md-4">
                                <input type="text" v-model="cant" id="cant" name="cant" class="form-control" placeholder="cantidad">
                                <span class="help-block"> <br></span>
                            </div>

                            
                            <label class="col-md-2 form-control-label" for="text-input">Año Publicación</label>
                            <div class="col-md-4">
                                <input type="date" v-model="ano_publi" id="ano_publi" name="ano_publi" class="form-control" placeholder="año publicacion">
                                <span class="help-block"><br> </span>
                            </div>

                            

                            <label class="col-md-2 form-control-label" for="text-input">Num. Paginas</label>
                            <div class="col-md-4">
                                <input type="text" v-model="num_pag" id="num_pag" name="num_pag" class="form-control" placeholder="numero de paginas">
                                <span class="help-block"><br> </span>
                            </div> 

                            

                            <label class="col-md-2 form-control-label" for="text-input">Ubicación</label>
                            <div class="col-md-4">
                                <input type="text" v-model="ubicacion" id="ubicacion" name="ubicacion" class="form-control" placeholder="ubicacion">
                                <span class="help-block"> <br></span>
                            </div> 

                            <label class="col-md-2 form-control-label" for="text-input">Edición</label>
                            <div class="col-md-4">
                                <input type="text" v-model="edicion" id="edicion" name="edicion" class="form-control" placeholder="edicion">
                                <span class="help-block"><br> </span>
                            </div> 
                        </div>
                            <div class="form-group row">
                           
                                <label class="col-md-2 ">Editoriales</label>
                                <div class="col-md-4">    
                                  <select v-model="idEdit" class="form-control   " >
                                        <option v-for="objeto in arrayEdit" :value="objeto.id" :key="objeto.id" v-text="objeto.nombre"></option> 
                                  </select><br>
                                </div>

                                  <label class=" col-md-2 ">Categorias</label>  
                                     <div class="col-md-4 "> 
                                        <select v-model="idCat" class="form-control " >
                                         <option v-for="objeto in arrayCat" :value="objeto.id" :key="objeto.id" v-text="objeto.nombre"></option> 
                                        </select><br>
                                    </div>

                                <label class=" col-md-2 ">Autor</label>   
                                   <div class="col-md-4 ">  
                                     <select v-model="idAut" class="form-control   " >
                                     <option v-for="objeto in arrayAut" :value="objeto.id" :key="objeto.id" v-text="objeto.nombre"></option> 
                                     </select><br>
                                    </div>


                                <label class=" col-md-2 ">Idioma</label> 
                                 <div class="col-md-4 ">     
                                <select v-model="idIdi" class="form-control " >
                                    <option v-for="objeto in arrayIdi" :value="objeto.id" :key="objeto.id" v-text="objeto.nombre"></option> 
                                </select><br>
                                </div>
                            </div>
                                                        
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" @click="cerrarModal" data-dismiss="modal">Cerrar</button>
                    <button v-show="accion==0" type="button" @click="regLib" class="btn btn-primary">Guardar</button>
                    <button v-show="accion" type="button" @click="actLib" class="btn btn-primary">Actualizar</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!--Fin del modal-->
    <!-- Inicio del modal Eliminar -->
    <div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-danger" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Eliminar Autor</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Estas seguro de eliminar el libro?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"  data-dismiss="modal">Cerrar</button>
                    <button type="button" @click="eliminarLib" class="btn btn-danger">Eliminar</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- Fin del modal Eliminar -->
</main>
</template>

<script>
    export default {
        data(){
            return{
                arrayDatos:[],
                // arrayLib:[],
                arrayEdit:[],
                arrayCat:[],
                arrayAut:[],
                arrayIdi:[],
                nombre:"",
                codigo:"",
                cant:"",
                ano_publi:"",
                num_pag:"",
                ubicacion:"",
                edicion:"",
                idLib:0,
                idEdit:0,
                idCat:0,
                idAut:0,
                idIdi:0,
                modal:0,
                titulo:"",
                accion:0,
                

               //variables de pagination
                pagination:{
                    total:0,
                    current_page:0,
                    per_page:0,
                    last_page:0,
                    from:0,
                    to:0
                },
                offset:2,
                buscar:"",
                criterio:"nombre"

            }
        },

        methods: {
            cambiarPagina(page,buscar,criterio){
                let me=this;
                //va a la pagina actual
                me.pagination.current_page= page;
                //envia al metodo para traer los datos
                me.listLib(page,criterio,buscar);
            },

            listLib:function(page,criterio,buscar){
                let me = this;
                var url="/libros?page="+ page+ "&criterio="+criterio+ "&buscar="+buscar;
                axios.get(url).then(function(response){
                    var respuesta = response.data;
                    me.arrayDatos = respuesta.libro.data;
                    me.pagination=respuesta.pagination;
                })
                .catch(function(error){
                    console.log(error);
                });
            },
            getEditorials(){
                let me = this;
                var url= "/getedit";
                axios.get(url).then(function(response){
                 var respuesta =response.data;
                 me.arrayEdit=respuesta.editorials; 
                })
                .catch(function(error){
                    console.log(error);
                });
            },
            getCategorias(){
                let me = this;
                var url= "/getcat";
                axios.get(url).then(function(response){
                 var respuesta =response.data;
                 me.arrayCat=respuesta.categorias; 
                })
                .catch(function(error){
                    console.log(error);
                });
            },
            getAutor(){
                let me = this;
                var url= "/getaut";
                axios.get(url).then(function(response){
                 var respuesta =response.data;
                 me.arrayAut=respuesta.autors; 
                })
                .catch(function(error){
                    console.log(error);
                });
            },
            getIdiomas(){
                let me = this;
                var url= "/getidi";
                axios.get(url).then(function(response){
                 var respuesta =response.data;
                 me.arrayIdi=respuesta.idiomas; 
                })
                .catch(function(error){
                    console.log(error);
                });
            },
            
            
            regLib(){  
                let me = this;
                var url="/libro/registrar";
                axios.post(url,{
                    nombre:this.nombre,
                    codigo:this.codigo,
                    cant:this.cant,
                    ano_publi:this.ano_publi,
                    num_pag:this.num_pag,
                    ubicacion:this.ubicacion,
                    edicion:this.edicion,
                    idEdit:this.idEdit,
                    idCat:this.idCat,
                    idAut:this.idAut,
                    idIdi:this.idIdi,
                })
                .then(function(response){
                    me.listLib(1, me.criterio, me.buscar);
                    me.mensaje('Se guardo correctamente');
                    me.cerrarModal();
                })
                .catch(function(error){
                    console.log(error);
                });
                
            },
            actLib(){
	                let me = this;
	                var url="/libro/actualizar";
                    axios.put(url,{
		            id:this.idLib,
                    nombre :this.nombre,
                    codigo:this.codigo,
                    cant:this.cant,
                    ano_publi:this.ano_publi,
                    num_pag:this.num_pag,
                    ubicacion:this.ubicacion,
                    edicion:this.edicion,
                    idEdit:this.idEdit,
                    idCat:this.idCat,
                    idAut:this.idAut,
                    idIdi:this.idIdi,
                })
                .then(function(response){
                    me.listLib(1, me.criterio, me.buscar);
                    me.mensaje('Se actualizo correctamente');
                    me.cerrarModal();
                })
                .catch(function(error){
                    console.log(error);
                });
             },
            abrirModal(accion,data=[]){
                switch(accion){
                case'guardar':
                this.titulo='Registrar Libro';
                this.accion=0;
                this.limpiar();
             break;
                case 'editar':
                this.titulo='Editar Libro';
                this.accion=1;
                this.idLib=data["id"];
                this.nombre=data["nombre"];
                this.codigo=data["codigo"];
                this.cant=data["cant"];
                this.ano_publi=data["ano_publi"];
                this.num_pag=data["num_pag"];
                this.ubicacion=data["ubicacion"];
                this.edicion=data["edicion"];
                this.idEdit=data["nomEdit"];
                this.idCat=data["nomCat"];
                this.idAut=data["nomAut"];
                this.idIdi=data["nomIdi"];
             break;
                default:
                break;
            }
            this.modal=1;
          },
           cerrarModal(){
            this.modal=0;
          },
           limpiar(){
            this.nombre='';
          },
            mensaje(msj){
            Swal.fire({
             position: 'center',
             icon: 'success',
             title: msj,
             showConfirmButton: false,
             timer: 2000
            })
          },
           eliminarLib(data=[]){
                         let me = this;
                Swal.fire({
                    title: 'Estas seguro?',
                    text: "Se eliminaran los datos",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    cancelButtonText: 'Cancelar!',
                    confirmButtonText: 'Confirmar!'
             }).then((result) => {
                if (result.isConfirmed) {
           var url = "/libro/eliminar";
            axios.post(url, {
                id: data["id"],
                })
                .then(function (response) {
                me.listLib(1, me.criterio, me.buscar);
                })
                .catch(function (error) {
                console.log(error);
                });

                Swal.fire(
               'Borrado!',
                'Se elimino correctamente.',
                'success'
                    )
                 }
                })

            },
           
        }, 
            computed:{
            isActived: function() {
            return this.pagination.current_page;
            },
            //Calcula los elementos de la paginación
            pagesNumber: function() {
            if (!this.pagination.to) {
                return [];
            }

            var from = this.pagination.current_page - this.offset;
            if (from < 1) {
                from = 1;
            }

            var to = from + this.offset * 2;
            if (to >= this.pagination.last_page) {
                to = this.pagination.last_page;
            }

            var pagesArray = [];
            while (from <= to) {
                pagesArray.push(from);
                from++;
            }
            return pagesArray;
            }

        },
                
         mounted() {
         console.log('Component mounted.')
                    this.listLib(1,this.criterio,this.buscar);
                    this.getEditorials();
                    this.getCategorias();
                    this.getAutor();
                    this.getIdiomas();
         }
  }
</script>

<style>

.modal-content{
width: 100% !important;
position: absolute  !important;;

}

.mostrar{
 display:list-item !important;
 opacity: 1 !important;
 position: absolute !important;
 background-color:#9995957a; 
}
</style>

