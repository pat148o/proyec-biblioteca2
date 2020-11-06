<template>
    <main class="main" >
    <!-- Breadcrumb -->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item"><a href="#">Admin</a></li> 
        <li class="breadcrumb-item active">Dashboard</li>
    </ol>            
    <div class="container-fluid">     
        <!-- Ejemplo de tabla Listado -->
        <div class="card">
            <div class="card-header">
                <i class="fa fa fa-book"></i>Solicitud Libros
                <button type="button" class="btn btn-primary" data-toggle="modal" @click="abrirModal('guardar')">
                    <i class="icon-plus"></i>&nbsp;Nuevo 
                </button>
            </div>
            <div class="card-body">

               <label>Usuario</label>
               <div class= "form-group form-inline">
                    <select v-model="idPersona" class="form-control col-5 mx-sm-1" >
                     <option v-for="objeto in arrayPersona" :value="objeto.id" :key="objeto.id" v-text="objeto.nomCom"></option> 
                   </select>
                   <label class="mx-sm-1">Fecha Devolución</label>
                  <input v-model="fecEntrega" type="date" class="form-control col-md-4">
                
                  
                </div>
               <div class= "form-group form-inline">
                   <input v-model="buscar" class="form-control col-4" placeholder="Ingrese el codigo del libro" type="text" @keyup.enter="getLibro(buscar)">
                   <button class="btn btn-primary" @click="abrirModal()"><i class="fa fa-search"></i></button>
                   <h4 class= "text-muted mx-sm-3" v-text="nomLibro"></h4>
                   <label  class="mx-sm-3">Cantidad</label>
                    <input v-model="cant" type="number" class="form-control" placeholder="cantidad libros" >
                   <button type="button" class="btn btn-success" @click="agregarItem2" >
                    <i class="icon-check"></i></button>
                  

                </div>  
                <table class="table table-bordered table-striped table-sm">
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Nombre</th>
                            <th>Cantidad</th>
                            <th>Autor</th>
                            <th>Editorial</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="objeto in arrayDatos" :key="objeto.id">
                            <td v-text="objeto.cod"></td>
                            <td v-text="objeto.nombre"></td>
                            <td v-text="objeto.cant"></td>
                            <td v-text="objeto.autor"></td>
                            <td v-text="objeto.edit"></td>
                           
                            <td>
                               <button type="button" @click="eliminarSolicitud" class="btn btn-danger"><i class="icon-trash"></i></button>
                             <!-- <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" @click="eliminarSolicitud(objeto)"></button> -->
                            </td>                                                                        
                        </tr>                                                                                                                                
                    </tbody>
                </table>
                <button type="button" class="btn btn-primary" data-togle="modal" @click="regSolicitud()">Guardar</button>
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
                    <form class="form-horizontal">
                         <div class="form-group row">
                    <div class="col-md-6">
                        <div class="input-group">
                            <input type="text" id="texto" name="texto" class="form-control" placeholder="libro a buscar" @keypress="listLib(1,buscar)">
                            <button type="button" @click=listLib(1,buscar) class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                        </div>
                    </div>
                     <div class="col-md-6">
                        <div class="input-group">
                            <label  class="mx-sm-3">Cantidad</label>
                            <input v-model="cant" type="number" class="form-control" placeholder="cantidad libros" >
                        </div>
                    </div>
                </div>
                        <table class="table table-bordered table-striped">
                            <thead>
                                    <tr>
                                        <th>Código</th>
                                        <th>Nombre</th>
                                        <th>Autor</th>
                                        <th>Editorial</th>
                                        <th>Disponible</th>
                                        <th>Seleccione</th>
                                    </tr>
                            </thead>
                            <tbody>
                               <tr v-for="objeto in arrayLibros" :key ="objeto.id">
                                   <td v-text="objeto.codigo"></td>
                                   <td v-text="objeto.nombre"></td>
                                   <td v-text="objeto.nomaut"></td>
                                   <td v-text="objeto.nomedit"></td>
                                   <td v-text="objeto.cant"></td>
                                   <td style="width=20px;"><button class="btn btn-success" @click="agregarItem(objeto)">OK</button></td>
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
                    </form>
                 </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" @click="cerrarModal" data-dismiss="modal">Cerrar</button>
                   
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!--Fin del modal-->
    
    <!-- Fin del modal Eliminar -->
</main>
</template>

<script>
    export default {


        data(){
            return{
                arrayDatos:[],
                arrayLibros:[],
                arrayGetLibro:[],
                arrayPersona:[],
                idPersona:"",
                idLibros:"",
                modal:0,
                nomLibro:"",
                codLibro:"",
                cant:"",
                titulo:"",
                cant:1,
                fecEntrega:"",
                buscar:"",

               //variables de pagination
                pagination:{
                    total:0,
                    current_page:0,
                    per_page:0,
                    last_page:0,
                    from:0,
                    to:0
                },
                offset:3,
                buscar:'',
                criterio:'nombre'

            }
        },

        methods:{
            listLib:function(page,buscar){
                let me = this;
                var url="/libros?page="+ page+ '&buscar='+buscar;
                axios.get(url).then(function(response){
                    var respuesta = response.data;
                    me.arrayLibros = respuesta.libro.data;
                    me.pagination=respuesta.pagination;
                })
                .catch(function(error){
                    console.log(error);
                });
            },
            getLibro:function(buscar){
                let me = this;
                var url="/getlibro?&buscar="+buscar;
                axios.get(url).then(function(response){
                    var respuesta = response.data;
                    me.arrayGetLibro = respuesta.libro;

                   if(me.arrayGetLibro.length >0 ){
                       me.idLibro=me.arrayGetLibro[0]['id'];
                       me.codLibro=me.arrayGetLibro[0]['codigo'];
                       me.nomLibro=me.arrayGetLibro[0]['nombre'];
                       me.cantLibro=me.arrayGetLibro[0]['cant'];
                       me.nomAut=me.arrayGetLibro[0]['nomaut'];
                       me.nomEdit=me.arrayGetLibro[0]['nomedit'];
                   }else{
                       me.nomLibro="verificar el codigo o nombre";
                   }

                })
                .catch(function(error){
                    console.log(error);
                });
            },

            getPersona:function(){
             let me=this;
             var url="/getpersona"
             axios.get(url).then(function(response){
                 var respuesta=response.data;
                 me.arrayPersona=respuesta.persona;
             })
            },
            
            abrirMoldal:function(){
                this.modal-1;
                this.titulo="selecione un libro";


            }, cerralMoldal:function(){
                this.modal-0;
                this.titulo="";

            },
            //toma los datos de la ventana modal cuando se da ok en el boton
            agregarItem:function(data=[]){
                this.arrayDatos.push({id:data['id'],cod:data['codigo'],nombre:data['nombre'],cant:this.cant,autor:data['nomaut'],edit:data['nomedit']});
                this.arrayLibros.splice (0,1);
             },
             //agrega los datos que se estan llenando del formulario principal
            agregarItem2:function(){
                this.arrayDatos.push({id:this.idLibro,cod:this.codLibro,nombre:this.nomLibro,cant:this.cant,autor:this.nomAut,edit:this.nomEdit});
                this.arrayLibros.splice (0,1);
             },
            
            regSolicitud(){
                let me = this;
                var url="/solicitud/registrar";
                axios.post(url,{
                    fecE: this.fecEntrega,
                    idPerso:this.idPersona,
                    data:me.arrayDatos
                })
                .then(function(response){
                    this.mensaje('Se guardo correctamente');
                })
                .catch(function(error){
                    console.log(error);
                });
                
            },


            cambiarPagina(page,buscar,criterio){
                let me=this;
                //va a la pagina actual
                me.pagination.current_page= page;
                //envia al metodo para traer los datos
                me.listLib(page,criterio,buscar);
            },
            eliminarSolicitud(data=[]){
                 let me = this;
            var url = "/solicitud/eliminar";
            axios.post(url, {
                id: data["id"],
                })
                .then(function (response) {
                me.listLib();
                me.mensaje2('Se elimino correctamente.');
                })
                .catch(function (error) {
                console.log(error);
                });
            },
            
            abrirModal(accion,data=[]){
                switch(accion){
                case'guardar':
                this.titulo='Registrar Prestamo';
                this.accion=0;
                this.limpiar();
             break;
                case 'editar':
                this.titulo='Solicitar libro';
                this.accion=1;
                this.idPersona=data['id'];
                this.nombre=data['nombre'];
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
           mensaje2(msj2){
             Swal.fire({
                title: 'Esta seguro de eliminarlo?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
             }).then((result) => {
                if (result.isConfirmed) {
                Swal.fire(
               'Deleted!',
                'Se elimino correctamente.',
                'success'
                    )
                 }
                })

            }
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
                    this.getPersona();
                    this.listLib(1,this.buscar);
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

