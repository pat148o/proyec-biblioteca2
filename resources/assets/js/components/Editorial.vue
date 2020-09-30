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
            <i class="fa fa fa-globe-americas"></i> Editorial
            <button type="button" class="btn btn-secondary" data-toggle="modal" @click="abrirModal('guardar')">
                <i class="icon-plus"></i>&nbsp;Nuevo
            </button>
        </div>
        <div class="card-body">
            <div class="form-group row">
                <div class="col-md-6">
                    <div class="input-group">
                        <select class="form-control col-md-3" id="opcion" name="opcion">
                          <option value="nombre">Nombre</option>
                        </select>
                        <input type="text" id="texto" name="texto" class="form-control" placeholder="Texto a buscar">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                    </div>
                </div>
            </div>
            <table class="table table-bordered table-striped table-sm">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Opciones</th>
                        
                    </tr>
                </thead>
                <tbody>
                
                    <tr v-for="objeto in arrayDatos" :key="objeto.id">
                        <td v-text="objeto.nombre"></td>
                         <td>   
                            <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" @click="abrirModal('editar', objeto)">
                              <i class="icon-pencil"></i>
                            </button> &nbsp;
                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" @click="eliminarEdit(objeto)">
                              <i class="icon-trash"></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
            <nav>
                <ul class="pagination">
                    <li class="page-item">
                        <a class="page-link" href="#">Ant</a>
                    </li>
                    <li class="page-item active">
                        <a class="page-link" href="#">1</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#">2</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#">3</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#">4</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#">Sig</a>
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
                            <input type="text" v-model="nombre" id="nombre" name="nombre" class="form-control" placeholder="Nombre de la editorial">
                            <span class="help-block">(*) Ingrese el nombre de la editorial</span>
                        </div>
                    </div>
                   
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" @click="cerrarModal" data-dismiss="modal">Cerrar</button>
                <button v-show="accion==0" type="button" @click="regEdit" class="btn btn-primary">Guardar</button>
                <button v-show="accion" type="button" @click="actEdit" class="btn btn-primary">Actuallizar</button>
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
                <h4 class="modal-title">Eliminar Editorial</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Estas seguro de eliminar la editorial?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="submit" @click="eliminarEdit" class="btn btn-danger">Eliminar</button>
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
                  nombre: "",
                  idEdit: 0,
                  modal: 0,
                  titulo:"",
                    accion: 0,
                }
            },

        methods: {
            listEdit: function () {
             let me = this;
             var url = "/editorials";
             axios.get(url)
            .then(function (response) {
             var respuesta = response.data;
             me.arrayDatos = respuesta.editorials;
             })
            .catch(function (error) {
            console.log(error);
            });
         },
            regEdit() {
            let me = this;
            var url = "/editorials/registrar";
            axios.post(url, {
             nombre: this.nombre,
             })
            .then(function (response) {
            me.listEdit();
            me.mensaje('Se guardo correctamente');
            me.cerrarModal();
             })
            .catch(function (error) {
             console.log(error);
            });
          },
            actEdit() {
            let me = this;
            var url = "/editorials/actualizar";
            axios.put(url, {
             id: this.idEdit,
            nombre: this.nombre,
            })
            .then(function (response) {
            me.listEdit();
            me.mensaje("Se actualizo correctamente");
             me.cerrarModal();
             })
            .catch(function (error) {
            console.log(error);
             });
         },
            eliminarEdit(data = []) {
            let me = this;
            var url = "/editorials/eliminar";
            axios.post(url, {
                id: data["id"],
                })
                .then(function (response) {
                me.listEdit();
                me.mensaje2('Se elimino correctamente.');
                })
                .catch(function (error) {
                console.log(error);
                });
            },
            abrirModal(accion, data = []) {
              switch (accion) {
                case "guardar":
                this.titulo = "Registrar editorial";
                this.accion = 0;
                this.limpiar();
                break;
                case "editar":
                this.titulo = "Editar editorial";
                this.accion = 1;
                this.idEdit = data["id"];
                this.nombre = data["nombre"];
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
              this.nombre = "";
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
            mensaje2(msj2) {
            Swal.fire({
                title: "Esta seguro de eliminarlo?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!",
             }).then((result) => {
                if (result.isConfirmed) {
                Swal.fire("Deleted!", "Se elimino correctamente.", "success");
                }
             });
            },
        },

  mounted() {
    console.log("Component mounted.");
    this.listEdit();
  },
};
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
