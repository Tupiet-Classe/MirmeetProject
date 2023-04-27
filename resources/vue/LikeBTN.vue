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
      id: this.id,
      post: this.post
    };
  },
  props: {
    id: null,
    post: null
  },
  methods: {
    makeLike(){
      axios.get('make-like/'+ this.id + '/' + this.post).then(res => {
          this.likes = res.data;
      });
    }

  },
};
</script>