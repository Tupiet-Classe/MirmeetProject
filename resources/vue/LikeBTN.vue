<template>
  <button v-if="btnLike" @click.prevent="makeLike()"
    class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
    <i class="fa-regular fa-heart"></i>
  </button>

  <button v-if="!btnLike" @click.prevent="makeLike()"><i class="fa-regular fa-heart"></i></button>
</template>

<script>
import axios from 'axios';

export default {
  name: "Test",
  created() { },
  data() {
    return {
      btnLike: false,
      likes: '',
      id_user: this.id_user,
      id_post: this.id_post
    };
  },
  props: {
    id_user: null,
    id_post: null
  },
  methods: {
    makeLike() {
      axios.get('make-like/' + this.id_user + '/' + this.id_post).then(res => {
        this.likes = res.data;
        if (this.likes == "OK") {
          this.btnLike = true;
        }else{
          this.btnLike = false;
        }
      });
    }

  },
};
</script>