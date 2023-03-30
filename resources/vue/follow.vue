<template>
  <button class="boto" @click="handleClick">
    {{ isClicked ? 'unFollow' : 'Follow' }}
  </button>
</template>

<style scoped>
.boto {
  background-color: blue;
  color: white;
  border: none;
  padding: 10px 20px;
  border-radius: 5px;
  cursor: pointer;
}
</style>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      isClicked: false,
      confirm: null,
      idfollower: 2,
      idfollowing: 3
    };
  },
  methods: {

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


  