<template>
    <div>
        <button @click="searchModal = true">
            <i class="fa fa-search text-2xl" v-show="!searchModal"></i>
        </button>

        <div v-show="searchModal" class="modal">
            <div class="modal-content">
                <div class="relative">
                    <input type="text" name="username"
                        class="w-full h-8 px-3 py-2 pr-8 border rounded-md shadow-sm placeholder-gray-400 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Buscar usuario" v-model="searchUser" @keyup.enter="search" />
                    <button
                        class="absolute top-0 right-0 flex items-center justify-center bg-gray-200 hover:bg-gray-300 h-8 w-8 rounded-md"
                        @click="searchModal = false">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
            </div>

        </div>
    </div>
</template>
  
<script>
import axios from 'axios';

export default {
    data() {
        return {
            searchModal: false,
            searchUser: "",
        };
    },
    methods: {
        search() {
            // Lógica para realizar la búsqueda
            console.log("Búsqueda realizada:", this.searchUser);

            // Realizar petición axios al endpoint de búsqueda
            axios.post('/search/user', { 'username': this.searchUser })
                .then(response => {
                    // Actualizar la variable $users con los resultados de la búsqueda
                    this.$root.$data.users = response.data;
                    window.location.href = '/search';
                })

            // Cerrar modal después de realizar la búsqueda
            this.searchModal = false;
        },


    },
};
</script>
  