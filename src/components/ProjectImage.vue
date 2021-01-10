<template>
  <img
    draggable="false"
    ondragstart="return false;"
    class="project-image"
    :src="imgUrl"
    :alt="altText">
</template>

<script>
export default {
  name: "ProjectImage",
  props: {
    imgUrl: {
      type: String,
      required: true
    },
    altText: {
      type: String,
      required: true
    },
  }
}
</script>
