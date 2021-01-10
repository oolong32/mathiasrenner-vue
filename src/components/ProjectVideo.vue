<template>
<vimeo-player
  class="vimeo-player"
  ref="player"
  :video-id="vimeoId"
  :client-height="'100%'"
  :client-width="'100%'"
  :options="vimeoOptions"
/>

  <!-- vorderhand obsolet
  <video autoplay playsinline muted loop :src="videoSrc">
  </video>
  -->
</template>

<script>
import { vueVimeoPlayer } from 'vue-vimeo-player'

export default {
  name: "ProjectVideo",
  components: { vueVimeoPlayer },
  props: {
    vimeoId: {
      type: String,
      required: false
    },
    videoSrc: { // vorderhand obsolet
      type: String,
      required: false
    }
  },
  data() {
    return {
      vimeoOptions: {
        responsive: true,
        width: "100%",
        height: "100%",
        controls: false,
        playsinline: true,
        background: true
      },
    }
  },
  created() {
    // console.log(this.vimeoId)
  }
}
</script>
