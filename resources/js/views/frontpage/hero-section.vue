<template>
  <el-carousel indicator-position="outside" height="500px">
    <el-carousel-item v-for="item in image" :key="item">
      <img
        alt="Image"
        :src="item"
      >
    </el-carousel-item>
  </el-carousel>
</template>

<script>
import hero1 from '@/assets/login/slide11.jpg';
import hero2 from '@/assets/login/slide31.jpg';
import hero3 from '@/assets/login/slide21.png';
export default {
  name: 'HeroSection',
  data() {
    return {
      image: [hero1, hero2, hero3],
    };
  },
};
</script>

<style>
  .el-carousel__item h3 {
    color: #475669;
    font-size: 18px;
    opacity: 0.75;
    line-height: 300px;
    margin: 0;
  }

  .el-carousel__item:nth-child(2n) {
    background-color: #99a9bf;
  }

  .el-carousel__item:nth-child(2n+1) {
    background-color: #d3dce6;
  }
</style>
