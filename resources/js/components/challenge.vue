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
                            <div v-if="modificar">
                                <span>{{challenge.empresas}}</span>
                            </div>
                            <input type="checkbox" v-bind:value="company.id" v-model="challenge.empresas">
                            <label for="">{{ company.nombre }}</label>
                            <br>
                        </div>
                        <span>{{  }}</span>
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
        <div class="grid mb-8 md:grid-cols-3 lg:grid-cols-3">
            <div v-for="challenge in challenges">
            <div class="border-2 mt-10" style="width: 350px; height: 350px; padding-bottom: 12px; border-radius: 10px; background-color: #fff;overflow: hidden">
                <div class="" style="height: 60%; width: 100%">
                    <img style="height: 100%; width: 100%" src="https://cdn.pixabay.com/photo/2021/08/30/21/29/port-6587129_960_720.jpg" alt="">
                </div>
                <div class="py-1 text-center border-2" style="width: 100%; height: 15%; border-right: none; border-left: none; border-top: none;display: flex; align-items: center;justify-content: center;font-weight: 700;">
                    <h4 class="text-center text-black mb-1" style="font-size: 20px;color: #1E40AF">{{ challenge.nombre }}</h4>
                </div>
                <div style="width: 100%; height: 25%; display: flex; align-items: center; justify-content: space-around">
                    <div>
                        <button @click="viewChallenge(challenge)" type="button" class="bg-pink-600 rounded" style="padding: 8px 15px; color: #fff; font-weight: 600;text-decoration: none" data-toggle="modal" data-target="#exampleModal">
                            Ver Desafío
                        </button>
                    </div>
                    <div>
                        <button @click="modificar = true;openModal(challenge)" style="padding: 7px 14px; color: #DB2777; font-weight: 600; border: 1.5px solid #DB2777;text-decoration: none" class="rounded" >Editar</button>
                    </div>
                        <button @click="destroy(challenge.id)" type="submit" style="padding: 7px 14px; color: #DB2777; font-weight: 600; border: 1.5px solid #DB2777" class="rounded">Eliminar</button>
                </div>
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
        openModal(data={}){
          this.modal = 1;
          if (this.modificar){
              this.tituloModal = 'Editar Desafío';
              this.id = data.id;
              this.challenge.nombre = data.nombre;
              this.challenge.descripcion = data.descripcion;
              this.errors ={}
          }else{
              this.tituloModal = 'Crear Desafío';
              this.id = 0;
              this.challenge.nombre = '';
              this.challenge.descripcion = '';
              this.checked = false;
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
    width: 800px; margin: auto; 
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
.ver{
    opacity: 0;
}

</style>