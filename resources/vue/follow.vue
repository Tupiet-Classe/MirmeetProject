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
export default {
  data() {
    return {
      isClicked: false,
    };
  },
  methods: {
    handleClick() {
      this.isClicked = !this.isClicked;
    },
  },
};
</script>


  