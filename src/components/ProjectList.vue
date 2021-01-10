<template>
  <main class="project-list">
    <Project
      v-for="project in projects"
      :key="project.id"
      :title="project.title"
      :type="project.type"
      :slug="project.slug"
      :images="project.images"
      :vimeoId="project.vimeoId"
    />
    <!-- vorderhand obsolet: :videos="project.videos" -->
  </main>
</template>

<script>
import Project from "./Project"

export default {
  name: "ProjectList",
  components: { 
    Project
  },
  props: {
    projects: {
      type: Array,
      required: true
    }
  },
  computed: {
    numProjects() {
      return this.projects.length
    }
  }
};
</script>
