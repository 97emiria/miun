<template>
  <div class="container">
      <Header />
      <Body />

  </div>
</template>

<script>
    import Header from './components/Header'
    import Body from './components/Body'

    export default {
        name: 'App',
        components: {
            Header,
            Body,
        },

      

        
    }
</script>

<style>
    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }

    #app {
        font-family: Avenir, Helvetica, Arial, sans-serif;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
        color: #2c3e50;
        margin-top: 60px;
    }

    .container {
        margin: 0 auto;
        width: 90%;
    }

    
</style>
