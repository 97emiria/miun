<template>
  <footer>
    <div>
      <p>
        © Emilia Holmström |
        <a href="https://www.emiria.se" target="_blank">emiria.se</a> <br />
        Mittuniversitet | Javascriptbaserad webbutveckling | Projekt
      </p>
    </div>
  </footer>
</template>

<script>
export default {
  name: "Footer",

    props: {
      headerName: {
        type: String,
      },
    },
};
</script>

<style scoped lang="scss">
footer {
  position: absolute;
  bottom: 0;
  left: 0;
  right: 0;

  background-color: #333;

  div {
    max-width: 1200px;
    margin: 0 auto;
    padding: 5px 0;
  }

  p, a {
    color: white;
  }

  img {
    width: 150px;
  }
}
</style>