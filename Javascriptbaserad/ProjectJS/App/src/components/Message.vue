<template>
  <div class="messageBox" id="messageBox" :style="{background: color, display: reveal}">
    <p>{{ theMessage }}</p>
  </div>
</template>

<script>
export default {
  name: "Message",

  props: {
    theMessage: {
      type: String,
      default: "No message send",
    },
    color: {
        type: String,
        default: "white"
    },
    reveal: {
        type: String,
        default: "none"
    }
  },
};
</script>

<style scoped lang="scss">
@import "../style/main.scss";

.messageBox {
  position: fixed;
  bottom: 23px;
  right: 10%;
  background-color: $light;
  width: 300px;
  max-width: $widthSize;
  box-sizing: border-box;
  padding: 1em;
  text-align: center;
  border-radius: $br;
  z-index: 999;
  transition: 2s;
  margin: 0 auto;
  box-shadow: 0 0 10px 0 #eee;
}
</style>