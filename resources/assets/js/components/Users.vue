<template>
    <main class="main">
   
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
            <i class="fa fa fa-user"></i> Usuarios
            <button type="button" class="btn btn-secondary" data-toggle="modal" @click="abrirModal('guardar')">
                <i class="icon-plus"></i>&nbsp;Nuevo
            </button>
        </div>
        <div class="card-body">
            <div class="form-group row">
                    <div class="col-md-6">
                        <div class="input-group">
                            <select class="form-control col-md-3" id="opcion" name="opcion" v-model="criterio">
                              <option value="name">Nombre</option>
                            </select>
                            <input v-model="buscar" type="text" id="texto" name="texto" class="form-control" placeholder="nombre a buscar" @keypress="listUsers(1, criterio, buscar)">
                            <button type="button" @click="listUsers(1,criterio, buscar)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                        </div>
                    </div>
             </div>
             <table class="table table-bordered table-striped table-sm">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Password</th>
                        <th>Opciones</th>
                        
                    </tr>
                </thead>
                <tbody>
                
                    <tr v-for="objeto in arrayDatos" :key="objeto.id">
                        <td v-text="objeto.name"></td>
                        <td v-text="objeto.email"></td>
                        <td v-text="objeto.password"></td>
                         <td>   
                            <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" @click="abrirModal('editar', objeto)">
                              <i class="icon-pencil"></i>
                            </button> &nbsp;
                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" @click="eliminarUsers(objeto)">
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
                        <label class="col-md-3 form-control-label" for="text-input">Nombre</label>
                        <div class="col-md-9">
                            <input type="text" v-model="nombre" id="nombre" name="nombre" class="form-control" placeholder="Nombre del usuario">
                            <span class="help-block">(*) Ingrese el nombre del Usuario</span>
                        </div>

                        <label class="col-md-3 form-control-label" for="text-input">Email</label>
                        <div class="col-md-9">
                            <input type="text" v-model="email" id="email" name="email" class="form-control" placeholder="email">
                            <span class="help-block">(*) Ingrese el Email</span>
                        </div>
                        
                        <label class="col-md-3 form-control-label" for="text-input">Contraseña</label>
                        <div class="col-md-9">
                            <input type="text" v-model="password" id="password" name="password" class="form-control" placeholder="password">
                            <span class="help-block">(*) Ingrese la contraseña</span>
                        </div>
                    </div>
                   
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" @click="cerrarModal" data-dismiss="modal">Cerrar</button>
                <button v-show="accion==0" type="button" @click="regUsers" class="btn btn-primary">Guardar</button>
                <button v-show="accion" type="button" @click="actUsers" class="btn btn-primary">Actuallizar</button>
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
                <h4 class="modal-title">Eliminar Usuario</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Estas seguro de eliminar el usuario?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="submit" @click="eliminarUsers" class="btn btn-danger">Eliminar</button>
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
         data() {
              return {
                 arrayDatos: [],
                //  arrayUsers:[],
                  nombre: "",
                  idUsers: 0,
                  modal: 0,
                  titulo:"",
                  accion: 0,
                  email:"",
                  name:"",
                  nombre:"",
                  password:"",

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
                criterio:'name'

                }
            },

        methods: {
            cambiarPagina(page, buscar, criterio){
                let me=this;
                //va a la pagina actual
                 me.pagination.current_page= page;
                //envia al metodo para traer los datos
                me.listUsers(page,criterio,buscar);
            },

            listUsers: function (page,criterio,buscar) {
             let me = this;
             var url = "/users?page="+page+'&criterio='+criterio+'&buscar='+buscar;
             axios.get(url).then(function (response) {
             var respuesta = response.data;
             me.arrayDatos = respuesta.users.data;
             me.pagination=respuesta.pagination;
             })
            .catch(function (error) {
            console.log(error);
            });
         },
            regUsers() {
            let me = this;
            var url = "/users/registrar";
            axios.post(url, {
             id:this.idUsers,
             name: this.nombre,
             email:this.email,
             password:this.password

             })
            .then(function (response) {
            me.listUsers(1, me.criterio, me.buscar);
            me.mensaje('Se guardo correctamente');
            me.cerrarModal();
             })
            .catch(function (error) {
             console.log(error);
            });
          },
            actUsers() {
            let me = this;
            var url = "/users/actualizar";
            axios.put(url, {
             id: this.idUsers,
            name:this.nombre,
            email:this.email,
            password:this.password
            })
            .then(function (response) {
            me.listUsers(1, me.criterio, me.buscar);
            me.mensaje("Se actualizo correctamente");
             me.cerrarModal();
             })
            .catch(function (error) {
            console.log(error);
             });
         },
              eliminarUsers(data=[]){
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
           var url = "/users/eliminar";
            axios.post(url, {
                id: data["id"],
                })
                .then(function (response) {
               me.listUsers(1, me.criterio, me.buscar);
                me.mensaje2('Se elimino correctamente.'); 
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
        
            abrirModal(accion, data = []) {
              switch (accion) {
                case "guardar":
                this.titulo = "Registrar usuario";
                this.accion = 0;
                this.limpiar();
                break;
                case "editar":
                this.titulo = "Editar usuario";
                this.accion = 1;
                this.idUsers = data["id"];
                this.nombre = data["name"];
                this.email = data["email"];
                this.password = data["password"];
                break;
                default:
                break;
            }
            this.modal = 1;
            },
            cerrarModal() {
             this.modal=0;
            },
             limpiar() {
              this.name = "";
              this.email="";
              this.password="";
             },
             mensaje(msj) {
             Swal.fire({
                position: "center",
                icon: "success",
                title: msj,
                showConfirmButton: false,
                timer: 2000,
            });
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
            console.log("Component mounted.");
            this.listUsers(1,this.criterio,this.buscar);
            }
}
</script>

<style>
.modal-content {
  width: 100% !important;
  position: absolute !important;
}

.mostrar {
  display: list-item !important;
  opacity: 1 !important;
  position: absolute !important;
  background-color: #9995957a;
}
</style>
