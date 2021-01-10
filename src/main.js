import Vue from "vue";
import Components from "./components";
import "./sass/general.scss";
import vueVimeoPlayer from 'vue-vimeo-player'

Vue.config.productionTip = false;
Vue.use(vueVimeoPlayer)

new Vue({
  el: "#app",
  delimiters: ["${", "}"]
});
