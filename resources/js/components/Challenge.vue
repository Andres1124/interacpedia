<template>

    <section class="py-4 px-4 mx-auto">

        <!-- Button to Open the Modal -->
        <button @click="modificar = false ;openModal()" type="button" class="bg-pink-600 rounded" style="display: block; width: 250px; padding: 10px 0; color: #fff;
text-decoration: none; margin: auto; text-align: center; font-weight: 700; font-size: 18px">
            Crear Desafío
        </button>

        <!-- The Modal -->
        <div class="modal" :class="{ mostrar:modal }">
            <div class="border form-modal">
                <div class="bg-indigo-800 form-modal-head">
                    <span class="titulo-modal">{{ tituloModal }}</span>
                </div>
                <div style="height: 95%">
                    <div style="padding: 5px 50px;" >
                        <label for="" class="form-label">Nombre:</label>
                        <input v-model="challenge.nombre" type="text" name="nombre" placeholder="Ejemplo: ¿Cómo podrias contribuir a la 4ta revolución industrial?" style="" class="focus:outline-none rounded border form-input">
                        <div v-if="errors && errors.nombre">
                            <small style="color: red;">{{ errors.nombre[0] }}</small>
                        </div>
                    </div>
                    <div style="padding: 5px 50px;">
                        <label for="" class="form-label">Descripción:</label>
                        <input v-model="challenge.descripcion" type="text" name="descripcion" placeholder="Ejemplo: Describe las estrategias que aplicarías" class="focus:outline-none rounded border form-input">
                        <div v-if="errors && errors.descripcion">
                            <small style="color: red;">{{ errors.descripcion[0] }}</small>
                        </div>
                    </div>
                    <div style="padding: 5px 50px;">
                        <label for="" class="form-label">Empresa:</label>
                        <div id='example-3' v-for="company in companies">   
                            <input type="checkbox" v-bind:value="company.id" v-model="challenge.empresas">
                            <label for="">{{ company.nombre }}</label>
                            <br>
                        </div>
                        <div v-if="errors && errors.empresas">
                            <small style="color: red;">{{ errors.empresas[0] }}</small>
                        </div>
                    </div>
                    <div class="form-buttons">
                        <button @click="closeModal()" type="button" class="btn btn-light rounded border" data-dismiss="modal">Cerrar</button>
                        <button @click="save()" type="button" class="bg-pink-600 rounded form-button" data-dismiss="modal">Guardar</button>
                    </div>
                </div>

            </div>
        </div>
        <!-- modal Desafío -->
        <!-- Button trigger modal -->
        

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="titulo-modal" id="exampleModalLabel">{{ tituloModal }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>{{ challenge.descripcion }}</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="bg-pink-600 rounded" style="padding: 8px 15px; color: #fff; font-weight: 600;text-decoration: none" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
        <!--cards -->
        <div class=" items-center justify-center bg-white">
            <div class="col-span-12">
                <div class="overflow-auto lg:overflow-visible">
                    <div class="flex lg:justify-between border-b-2 border-fuchsia-900 pb-1">
                        <h2 class="text-2xl text-gray-500 font-bold">Desafíos</h2>
                    </div>
                    <table class="table text-gray-400 border-separate space-y-6 text-sm">
                        <thead class="bg-pink-600 text-white rounded">
                        <tr>
                            <th class="p-3">id</th>
                            <th class="p-3 text-left">Nombre</th>
                            <th class="p-3 text-left">Descripcion</th>
                            <th class="p-3 text-left">Acciones</th>
                        </tr>
                        </thead>
                        <tbody>

                        <tr class="bg-blue-100 lg:text-black rounded" v-for="challenge in challenges">
                            <td class="p-3 font-medium capitalize">{{ challenge.id }}</td>
                            <td class="p-3">{{ challenge.nombre }}</td>
                            <td class="p-3">{{ challenge.descripcion }}</td>
                            <td class="p-3">
                                <button @click="modificar = true;openModal(challenge)" class="text-yellow-400 hover:text-gray-100 mx-2">
                                    <i class="material-icons-outlined text-base">edit</i>
                                </button>
                                <button @click="destroy(challenge.id)" class="text-red-400 hover:text-gray-100 ml-2">
                                    <i class="material-icons-round text-base">delete_outline</i>
                                </button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        
    </section>
    
    
    
</template>
<script>
export default {
    data(){
        return{
            challenge: {
              nombre: '',
              descripcion: '',
              empresas: [],  
            },
            id: 0,
            checked: true,
            modificar: true,
            modal: 0,
            tituloModal: '',
            companies: [],
            challenges: [],
            errors: {},
        }
    },
    methods: {
        async list(){
            const res = await axios.get('/challenges');
            this.companies = res.data.companies;
            this.challenges = res.data.challenge;
        },
        async destroy(id){
            const res = await axios.delete('/challenge/'+id);
            this.list();
        },
        async save(){
            if (this.modificar){
                const res = await axios.put('/challenge/'+ this.id, this.challenge).then(response =>{
                    this.closeModal();
                    this.list();
                }).catch((error)=>{
                    if (error.response.status === 422){
                        this.errors = error.response.data.errors;
                    }
                });
            }else{
                const res = await axios.post('/challenge', this.challenge).then(response =>{
                    this.closeModal();
                    this.list();
                }).catch(error => {
                    this.errors = error.response.data.errors;
                });
            }
            
        },
        
        async challengeCompany(id = null){
            const res = await axios.get('/challenge/'+id+'/edit').then(response => {
                let companies = response.data[0].companies;
                for(let i = 0; i <= companies.length; i++){
                    this.challenge.empresas.push(companies[i].id);
                }
            }).catch(error => {
                console.log(error);
            })
        },
        
         openModal(data={}){
          this.modal = 1;
          if (this.modificar){
              this.tituloModal = 'Editar Desafío';
              this.id = data.id;
                  this.challenge.nombre = data.nombre;
                  this.challenge.descripcion = data.descripcion;
                  this.challenge.empresas = [];
                  this.challengeCompany(this.id);
                  this.errors ={}
          }else{
              this.tituloModal = 'Crear Desafío';
              this.id = 0;
              this.challenge.nombre = '';
              this.challenge.descripcion = '';
              this.challenge.empresas = [];
              this.errors = {};
          }
        },
        closeModal(){
            this.modal = 0;
        },
        viewChallenge(data={}) {
            this.tituloModal = data.nombre;
            this.challenge.descripcion = data.descripcion;
        }
    },
    created() {
        this.list();
    }
}
</script>

<style>

.form-modal{
    width: 800px; 
    margin: auto; 
    height: auto; 
    background-color: #fff;
    overflow: hidden; 
    border-radius: 20px; 
    margin-top: 150px;
    padding: 0 0 20px 0;
}
.form-modal-head{
    height: 15%; 
    display: flex;
    align-items: center;
    justify-content: center;
}

.titulo-modal{
    text-align: center; 
    font-size: 25px; 
    color: #fff; 
    font-weight: 700;
}

.form-label{
    display: block;
    color: #1E40AF;
    font-weight: 600;
}

.form-input{
    width: 100%; 
    padding: 8px 8px;
}

.form-buttons{
    display: flex; 
    justify-content: space-between ;
    padding: 5px 50px;
}

.form-button{
    padding: 8px 15px; 
    color: #fff; 
    font-weight: 600;
    text-decoration: none;
}

.mostrar{
    display: list-item;
    opacity: 1;
    background: rgba(0,0,0, 0.84);
    transition: top;
}

.table {
    border-spacing: 0 15px;
}

i {
    font-size: 1rem !important;
}

tr{
    border-radius: 10px;
}



</style>