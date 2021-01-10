<template>
<article class="project" :class="`${type} ${slug}`">
  <!--
    Die Eintragstypen "einzel-" und "doppelbild" sind gleich strukturiert. 
    D.h. im Backend können max. 2 Bilder eingesetzt werden. Im Frontend werden
    aber nur im zweiten Fall zwei Bilder gezeigt. Ein ev. vorhandenes 2. Bild
    im Eintragstyp "einzelbild" wird ignoriert.

    Zur Anzeige eines Einzelbildes ist eine spezielle komponente nötig, die
    in der Lage ist, den img-Tag durch ein Hintergrundbild zu ersetzen.
    Sonst wären die Höhen von Einzel- und Doppelbildern meist uneinheitlich.
  -->

    <BackgroundImage
      v-if="type == 'einzelbild'"
      class="single"
      :img-url="images[0].url"
      :alt-text="`Mathias Renner, ${title}`" />

    <ProjectImage
      v-if="type == 'doppelbild'"
      v-for="image in images"
      :key="image.id"
      class="double"
      :img-url="image.url"
      :alt-text="`Mathias Renner, ${title}`" />

    <ProjectVideo
      v-if="type == 'video'"
      :vimeoId="vimeoId" />
      <!-- vorderhand obsolet: :video-src="videos[0].url" -->

  </article>
</template>

<script>
import ProjectImage from "./ProjectImage"
import BackgroundImage from "./BackgroundImage"
import ProjectVideo from "./ProjectVideo"

export default {
  name: "Project",
  components: {
    ProjectImage,
    BackgroundImage,
    ProjectVideo
  },
  props: {
    title: {
      type: String,
      required: true
    },
    vimeoId: {
      type: String,
      required: false
    },
    type: {
      type: String,
      required: true
    },
    vimeoLink: {
      type: String,
      required: false
    },
    slug: {
      type: String,
      required: true
    },
    images: {
      type: Array,
      required: false
    },
    videos: {
      type: Array,
      required: false
    }
  }
}
</script>
