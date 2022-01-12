<template>
  <div class="item">
    <a class="item-link" :href=item.link>
      <div :class="'item-inner ' + item.color">
        <div class="item-text-wrap">
          <h2 class="bg-text">{{  item.bgText }}</h2>
        </div>
        <div class="item-image-wrap">
          <img :src="item.src" class="image" />
        </div>
        <div class="item-detail">
          <h2>{{  item.title  }}</h2>
          <p>{{ item.text </p>
        </div>
      </div>
    </a>
  </div>
</template>

<script>
export default {
  name : 'item',
  props : ['item']
}
</script>

<style>
.item {
  flex: 1 1 33.333%;
  width: 100%;
  padding: 25px;
}

.item-link {
  text-decoration: none;
}

.item-inner {
  position: relative;
  padding: 25px;
  box-shadow: 0px 0px 16px rgba(0, 0, 0, 0.25);
}

.item-inner.green {
  background-image: linear-gradient(to bottom right, #24D484, #116432);
}

.item-inner.blue {
  background-image: linear-gradient(to bottom left, #24D484, #2474C4 70%);
}

.item-inner.pink {
  background-image: linear-gradient(to bottom right, #F444A4, #1168D4);
}

.item-inner.red {
  background-image: linear-gradient(to bottom left, #1068d4, #f91692 50%);
}
.item-text-wrap {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  z-index: 0;
  overflow: hidden;
}

.item-text-wrap h2 {
  color: #313131;
  font-size: 128px;
  font-weight: 900;
  opacity: 0.2;
  transform-origin: center;
}

.item-image-wrap {
  position: relative;
  z-index: 1;
  transform-origin: center;
}

.item-detail h2 {
  color: #EEE;
  font-size: 28px;
}

.item-detail P {
  color: rgb(2, 2, 2);
}

.item-image-wrap .image {
  width: 100%;
  filter: drop-shadow(0px 0px 12px, rgba(0, 0, 0, 0.25));
}
</style>