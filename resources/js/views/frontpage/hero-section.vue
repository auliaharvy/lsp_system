<template>
  <el-row type="flex" class="content" justify="center">
    <el-col :span="24">
      <el-carousel v-if="isDesktop" indicator-position="outside" height="600px">
        <el-carousel-item v-for="item in image" :key="item">
          <img
            alt="Image"
            :src="item"
            style="height: 100%; width: 100%;"
          >
        </el-carousel-item>
      </el-carousel>
      <el-carousel v-else indicator-position="outside" height="300px">
        <el-carousel-item v-for="item in imageMobile" :key="item">
          <img
            alt="Image"
            :src="item"
            style="height: 100%; width: 100%;"
          >
        </el-carousel-item>
      </el-carousel>
    </el-col>
  </el-row>
</template>

<script>
import hero1 from '@/assets/login/slide11.jpg';
import hero2 from '@/assets/login/slide31.jpg';
import hero3 from '@/assets/login/slide21.png';
import hero4 from '@/assets/login/slide11-768.jpg';
import hero5 from '@/assets/login/slide31-768.jpg';
import hero6 from '@/assets/login/slide21-768.jpg';
// import hero4 from '@/assets/login/slide11.jpg';
export default {
  name: 'HeroSection',
  data() {
    return {
      image: [hero1, hero2, hero3],
      imageMobile: [hero4, hero5, hero6],
      isDesktop: true,
    };
  },
  computed: {
    getImageStyle(){
      // Kembalikan gaya sesuai ukuran layar
      if (window.innerWidth < 768) {
        return { maxWidth: '100%' };
      } else {
        return { height: '100%', width: '100%' };
      }
    },
  },
  mounted(){
    this.isDesktop = window.innerWidth >= 768;
    this.handleResize();
    window.addEventListener('resize', this.handleResize);
  },
  beforeDestroy(){
    window.removeEventListener('resize', this.handleResize);
  },
  methods: {
    handleResize(){
      const screenWidth = window.innerWidth;
      this.isDesktop = screenWidth >= 768;
    },
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
/* @media screen and (max-width: 320px){
  .carousel-outside{
    width: 100%;
    height: 150px;
    background-color: red;
  }

  .carousel-outside-item{
    width: 100%;
    height: 150px;
  }

  .image-container {
    width: 100%;
    height: 150px;
    border: 1px solid yellow;
  }

  .responsive-image {
    width: 100%;
    height: 150px;
    border: 1px solid green;
  }

}

@media screen and (min-width: 321px) and (max-width: 447px){
  .carousel-outside{
    width: 100%;
    height: 200px;
    background-color: red;
  }

  .carousel-outside-item{
    width: 100%;
    height: 200px;
  }

  .image-container {
    width: 100%;
    height: 200px;
    border: 1px solid yellow;
  }

  .responsive-image {
    width: 100%;
    height: 200px;
    border: 1px solid green;
  }

}

@media screen and (min-width: 448px) and (max-width: 767px){
  .carousel-outside{
    width: 100%;
    height: 400px;
    background-color: red;
  }

  .carousel-outside-item{
    width: 100%;
    height: 400px;
  }

  .image-container {
    width: 100%;
    height: 400px;
    border: 1px solid yellow;
  }

  .responsive-image {
    width: 100%;
    height: 400px;
    border: 1px solid green;
  }

}

@media screen and (min-width: 768px){
  .carousel-outside{
    width: 100%;
    height: 600px;
  }

  .carousel-outside-item{
    width: 100%;
    height: 600px;
  }

  .image-container {
    width: 100%;
    height: 600px;
    border: 1px solid black;
  }

  .responsive-image {
    width: 100%;
    height: 600px;
    border: 1px solid red;
  }

} */

  .el-carousel__item h3 {
    color: #475669;
    font-size: 18px;
    opacity: 0.75;
    line-height: 300px;
    margin: 0;
  }
