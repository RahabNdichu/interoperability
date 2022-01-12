<template>
  <main>
    <section class="items">
      <Item
      v-for="item in items"
      :key="item.color"
      :item="item"
      />
    </section>
  </main>
</template>

<script>
import Item from './Item.vue'
import Image from '../assets/IMG-20211204-WA0004.jpg'
import Image1 from '../assets/IMG-20211204-WA0005.jpg'

export default {
  name: 'app',
  components: {
    Item,
  },
  data () {
    return {
      items : [
        {
          title : 'NHIF',
          color : 'green',
          bgText : 'nhif',
          link : 'http://nhif.tech',
          src : Image
        },
        {
          title : 'NSSF',
          color : 'blue',
          bgText : 'nssf',
          link : 'http://nssf.tech',
          src : Image1
        },
        {
          title : 'KPB',
          color : 'pink',
          bgText : 'KPB',
          link : 'http://kpb.tech',
        //   src : require('../assets/nhif.jpg')
        },
        {
          title : 'KPA',
          color : 'red',
          bgText : 'KPA',
          link : 'http://kpa.tech',
        //   src : require('../assets/nssf.jpg')
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
