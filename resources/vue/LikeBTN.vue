<template>
  <button @click.prevent="makeLike()"><i class="fa-regular fa-heart"></i></button>
</template>

<script>
import axios from 'axios';

export default {
  name: "Test",
  created() {},
  data() {
    return {
      likes:'',
      id_user: this.id_user,
      id_post: this.id_post
    };
  },
  props: {
    id_user: null,
    id_post: null
  },
  methods: {
    makeLike(){
      axios.get('make-like/'+ this.id_user + '/' + this.id_post).then(res => {
          this.likes = res.data;
      });
    }

  },
};
</script>