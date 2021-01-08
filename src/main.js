import Vue from "vue";
import Components from "./components";
import "./sass/general.scss";

Vue.config.productionTip = false;

new Vue({
  el: "#app",
  delimiters: ["${", "}"]
});
