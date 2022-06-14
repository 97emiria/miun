<template>
  <header>
    <h1>{{ title }}</h1>
    <ButtonCom text='Add task' color="green" />
  </header>
</template>

<script>

import ButtonCom from './ButtonCom.vue'

export default {
  name: "Header",

  props: {
    title: {
      type: String,
      default: "Missing header",
    },
  },

  //Import components
  components: {
    ButtonCom
  }

};
</script>

<!-- Scoped means only within this component -->
<style scoped>
header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 20px;
}
</style>