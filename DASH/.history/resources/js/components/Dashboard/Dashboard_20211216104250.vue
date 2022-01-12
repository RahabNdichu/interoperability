<template>
  <!-- <main id="app">
    <header>
      <Navbar />
    </header> -->
    <section class="items">
      <Item
      v-for="item in items"
      :key="item.color"
      :item="item"
      />
    </section>
    <!-- <section class="footer">
      <p>copy vinrish technologies</p>
    </section>  -->
  <!-- </main> -->
</template>

<script>
import Navbar from './components/Navbar.vue'
import Item from './components/Item'

export default {
  name: 'app',
  components: {
    Item,
    Navbar
  },
  data () {
    return {
      items : [
        {
          title : 'NHIF',
          color : 'green',
          bgText : 'nhif',
          link : 'http://127.0.0.1:8000',
          src : require('./assets/nssf.jpg')
        },
        {
          title : 'NSSF',
          color : 'blue',
          bgText : 'nssf',
          link : 'http://127.0.0.1:8000',
          src : require('./assets/nssf.jpg')
        },
        {
          title : 'KPB',
          color : 'pink',
          bgText : 'KPB',
          link : 'http://127.0.0.1:8000',
          src : require('./assets/nssf.jpg')
        },
        {
          title : 'KPA',
          color : 'red',
          bgText : 'KPA',
          link : 'http://127.0.0.1:8000',
          src : require('./assets/nssf.jpg')
        }
      ]
    }
  }
}
</script>

<style>
* {
  margin : 0;
  padding : 0;
  box-sizing: border-box;
}

body {
  font-family: 'montseratt', sans-serif;
}

main {
  width: 100vw;
  min-height: 100vh;
  overflow: hidden;
  background-image: linear-gradient(to bottom left, #F444A4, #1168D4);
  /* display: flex; */
  /* justify-content: center;
  align-items: center; */
}

header {
  width: 100vw;
  padding: 15px;
}

.items {
  display: flex;
  max-width: 1280px;
  padding: 25px;
  margin: 0 auto;
}

</style>
