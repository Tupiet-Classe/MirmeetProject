<template>
  <div class="flex justify-center">
    <button class="hidden sm:block absolute bottom-0 right-0 p-3 bg-red rounded-lg px-3 py-2 text-lg mb-2 mr-2"
      @click="showModal = true"><i class="fa fa-add text-white"></i></button>

    <Modal :isOpen="showModal" @update:isOpen="showModal = $event">

      <!-- Contenido del modal -->
      <div>
        <h2 class="text-lg font-medium text-gray-900 mb-4">Publicar</h2>
      </div>

      <div class="">
        <div class="flex justify-center mb-5">
          <template v-if="file">
            <template v-if="isImage">
              <img :src="imagePreview" alt="Vista previa del archivo seleccionado">
            </template>
            <template v-else-if="isVideo">
              <video :src="videoPreview" controls></video>
            </template>
          </template>
        </div>
        <div class="mt-2 mb-2 text-red">
          <p class="">{{ alert }}</p>
        </div>
        <div class="flex justify-center mb-5">
          <input v-model="text"
            class="relative m-0 block w-full min-w-0 flex-auto rounded border border-solid border-neutral-300 dark:border-neutral-600 bg-clip-padding py-[0.32rem] px-3 text-base font-normal text-neutral-700 dark:text-neutral-200 transition duration-300 ease-in-out file:-mx-3 file:-my-[0.32rem] file:overflow-hidden file:rounded-none file:border-0 file:border-solid file:border-inherit file:bg-neutral-100 dark:file:bg-neutral-700 file:px-3 file:py-[0.32rem] file:text-neutral-700 dark:file:text-neutral-100 file:transition file:duration-150 file:ease-in-out file:[margin-inline-end:0.75rem] file:[border-inline-end-width:1px] hover:file:bg-neutral-200 focus:border-primary focus:text-neutral-700 focus:shadow-[0_0_0_1px] focus:shadow-primary focus:outline-none"
            type="text">
        </div>
        <div class="mb-3 w-96">
          <input name="image"
            class="relative m-0 block w-full min-w-0 flex-auto rounded border border-solid border-neutral-300 dark:border-neutral-600 bg-clip-padding py-[0.32rem] px-3 text-base font-normal text-neutral-700 dark:text-neutral-200 transition duration-300 ease-in-out file:-mx-3 file:-my-[0.32rem] file:overflow-hidden file:rounded-none file:border-0 file:border-solid file:border-inherit file:bg-neutral-100 dark:file:bg-neutral-700 file:px-3 file:py-[0.32rem] file:text-neutral-700 dark:file:text-neutral-100 file:transition file:duration-150 file:ease-in-out file:[margin-inline-end:0.75rem] file:[border-inline-end-width:1px] hover:file:bg-neutral-200 focus:border-primary focus:text-neutral-700 focus:shadow-[0_0_0_1px] focus:shadow-primary focus:outline-none"
            type="file" @change="onFileChange" ref="fileInput" accept="image/*,video/*" />
        </div>
      </div>

      <!-- Botones del modal -->
      <div class="bg-gray-50 px-4 py-3 sm:px-6 w-full justify-between flex sm:flex sm:justify-center">
        <button type="button"
          class="flex justify-start bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full"
          @click="doAction()">
          Compartir
        </button>
        <button type="button" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-full"
          @click="closeModal()">
          Cancelar
        </button>
      </div>
    </Modal>
  </div>
</template>
  
<script>
import axios from 'axios';
import Modal from './Modal.vue';
import MyProfile from './MyProfile.vue';
import { resultPosts } from './mostrar-posts';

export default {
  components: {
    Modal,
    MyProfile,
  },
  data() {
    return {
      showModal: false,
      file: null,
      alert: '',
      image64: '',
      text: null,
      image: null,
      coment: null,
    }
  },
  computed: {
    isImage() {
      return this.file && this.file.type.startsWith('image/');
    },
    isVideo() {
      return this.file && this.file.type.startsWith('video/');
    },
    imagePreview() {
      return this.file ? URL.createObjectURL(this.file) : ''
    },
    videoPreview() {
      return this.file ? URL.createObjectURL(this.file) : ''
    }
  },
  methods: {
    closeModal() {
      this.$refs.fileInput.value = null;
      this.file = null
      this.text = null
      this.showModal = false;
    },
    doAction() {
      const formData = new FormData();
      formData.append('file', this.image64);
      formData.append('text', this.text);
      console.log(this.image64)
      if(this.image64 != null && this.text != null){
      axios.post('/new-post', formData)
        .then(response => {
          this.image = response.data['image'];
          this.coment = response.data['text'];
          this.alsoDo()
        })
        .catch(error => {
          console.error(error);
        });
      this.closeModal();
      }else{
        this.alert = 'Completa uno de los campos'
      }
    },

    alsoDo() {
      const data = {
        image: this.image,
        coment: this.coment
      };

      axios.post('/post', data)
        .then(response => {
          this.data = response.data;
          MyProfile.methods.getposts()
          // console.log(response.data['reference'])
        })
        .catch(error => {
          console.error(error);
        });
    },

    onFileChange(event) {
      this.file = event.target.files[0]
      const file = event.target.files[0]
      const reader = new FileReader()
      reader.readAsDataURL(file)
      reader.onload = () => {
        const base64Image = reader.result
        this.image64 = base64Image
      }
    },

    onFileSelected(event) {
      const file = event.target.files[0]
      const reader = new FileReader()
      reader.readAsDataURL(file)
      reader.onload = () => {
        const base64Image = reader.result
        this.image64 = base64Image
      }
    },

    beforeUnmount() {
      if (this.file) {
        URL.revokeObjectURL(this.file);
      }
    },
  }
}
</script>