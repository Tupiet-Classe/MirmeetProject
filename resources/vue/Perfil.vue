<!-- Codi de la pagina -->
<template>
    <div style="width: 500px;">
      
      <div style="margin-right: 20px;">
            <img
              class="img-perfil"
              src="https://profesional.semillasbatlle.com/wp-content/uploads/2020/07/semillas-oleaginosas-industriales-girasol.jpg"
              alt=""
            />
          </div>
        <div style="width: 500px; display: flex; align-items: center;">
          
          <div v-if="this.me.id != this.perfil.id">
            
            <button class="boto" @click="handleClick">
              {{ isClicked ? 'unFollow' : 'Follow' }}
            </button>
          </div>

          <div style="display: inline-block;">
            <div class="contador" style="display: inline-block; padding-right: 30px; padding-left: 50px;">
              <h2>Publicaciones</h2>
              <p>57</p>
            </div>
            <div class="contador" style="display: inline-block; padding-right: 30px;">
              <h2>Seguidores</h2>
              <p v-if="followers.length > 0">{{ followers[0].followersammount}}</p>
            </div>
            <div class="contador" style="display: inline-block;">
              <h2>Siguiendo</h2>
              <p v-if="following.length > 0">{{ following[0].followingammount}}</p>
            </div>
          </div>
        </div>
  
        <form
        class="content bg-white w-full mx-5 p-3 rounded-lg flex flex-col text-sm relative bg-white rounded-lg">

        <div class="mb-4">
          <label class="block font-bold mb-2">Nombre</label>
          <input
            class="w-full border border-gray-400 p-2 rounded-lg"
            type="text"
            required
          />
        </div>
  
        <div class="mb-4">
          <label class="block font-bold mb-2" for="email">Nombre del usuario</label>
          <input
            class="w-full border border-gray-400 p-2 rounded-lg"
            type="text"
            required
          />
        </div>
  
        <div class="mb-6">
          <label class="block font-bold mb-2">Descripción</label>
          <input
            class="w-full border border-gray-400 p-2 rounded-lg"
            type="text"
            required
          />
        </div>
  
        <div class="mb-4">
          <label class="block font-bold mb-2" for="email">Añadir enlace</label>
          <input
            class="w-full border border-gray-400 p-2 rounded-lg"
            type="email"
            id="email"
            name="email"
            required
          />
        </div>
  
        <div class="flex items-center">
          <button
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg"
            type="submit"
          >
            Guardar cambios
          </button>
        </div>
      </form>
    </div>
  </template>


<!-- Estils per a esta vista -->
<style scoped>
.img-perfil {
    width: 30%;
    border-radius: 50%;
}

.boto {
  background-color: blue;
  color: white;
  border: none;
  padding: 10px 20px;
  border-radius: 5px;
  cursor: pointer;
}

.contador {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    margin-bottom: 10%;
    margin-top: 10%;
}

.contador h2 {
    margin: 0;
    font-size: 18px;
    font-weight: bold;
}

.contador p {
    margin: 0;
    font-size: 16px;
    font-weight: bold;
}
</style>

<!-- Scripts per a esta vista -->




<script>

// Importem la llibreria axios per a fer peticions HTTP
import axios from 'axios';

export default {
    data() {
        return {
            isClicked: false,
            confirm: null,
            idfollowing: 0,
            followers: 0,
            following: 0,
            perfil: {},
            me: {}
        };
    },

    mounted() {
        this.getFollowers();
        this.getFollowing();
        this.getPerfil();
        this.getMe();
    },

    methods:{
        getPerfil() {
          let id = window.location.pathname.split('/').pop()
          this.idfollowing = id
          axios.get('/perfil/' + id +'/recuperar')
            .then(response => {
              this.perfil = response.data
            })
            .catch(error => {
              console.log(error)
            })
        },
        getMe() {
          let id = window.location.pathname.split('/').pop()
          axios.get('/me')
            .then(response => {
              this.me = response.data
            })
            .catch(error => {
              console.log(error)
            })
        },
        getFollowers(){                 
            axios.get("perfil/get-followers/5")
            
                .then(response => {    
                this.followers = response.data;
            })
                .catch(error => {  
                console.log(error);
            });
        },

        getFollowing(){                 
            axios.get("perfil/get-following/6")
            
                .then(response => {    
                this.following = response.data;
            })
                .catch(error => {  
                console.log(error);
            });
        },

        handleClick() {
            this.isClicked = !this.isClicked;

            // Si el botón está activado (isClicked == true), hacemos la petición POST
            if (this.isClicked) {
                axios.post('/follower', {
                idFollower: this.idfollower,
                idFollowing: this.idfollowing,
                })
                .then((response) => {
                console.log(this.confirm);
                this.confirm = response.data;
                })
                .catch((error) => {
                console.log(error);
                });
            } 
            // Si el botón no está activado (isClicked == false), hacemos la petición PUT
            else {
                axios.put(`/following`, {
                idFollower: this.idfollower,
                idFollowing: this.idfollowing,
                })

                .then((response) => {
                console.log(response);
                })
                .catch((error) => {
                console.log(error);
                });
            }
        },
    },

    


};
</script>