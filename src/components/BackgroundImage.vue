<template>
  <figure :style="`background-image: url(${imgUrl});`" >
    <img
      draggable="false"
      ondragstart="return false;"
      class="project-image"
      :src="imgUrl"
      :alt="altText">
  </figure>
</template>

<script>
export default {
  name: "BackgroundImage",
  props: {
    imgUrl: {
      type: String,
      required: true
    },
    altText: {
      type: String,
      required: true
    }
  }
}
</script>

<style scoped>
/* Auf Desktop muss das Bild mit einem Hintergrund ersetzt werden
   sonst stimmt die Rasterzeilenhöhe nicht. :-(
 */
figure {
  width: 100%;
  height: 100%;
  background-repeat: no-repeat;
  background-position: 0 0;
  background-size: contain;
}
img { display: none; }

/* Auf Mobile braucht es das Bild, sonst wird nichts angezeigt */
@media (max-width: 600px) {
  figure { background-image: none; }
  img { display: block; }
}
</style>
