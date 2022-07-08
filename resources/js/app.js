require("./bootstrap");
import VueRouter from "vue-router";
import Vue from "vue";
import router from "../../public/js/routers";
import Vuex from "vuex";
import index from "../js/index";
import NavComponent from "../js/share/NavComponent";
import MenuLeftComponent from "../js/share/MenuLeftComponent";
import MenuRightComponent from "../js/share/MenuRightComponent";
import { ValidationProvider } from "vee-validate";
import Vuelidate from "vuelidate";
import VueHtmlToPaper from "vue-html-to-paper";

Vue.component("nav-component", NavComponent);
Vue.component("menu-left", MenuLeftComponent);
Vue.component("menu-right", MenuRightComponent);
Vue.component("ValidationProvider", ValidationProvider);

window.Vue = require("vue").default;

window.axios.interceptors.response.use(
    (response) => {
        return response;
    },
    (error) => {
        if (401 === error.response.status) {
            window.location.href = "/";
        }
        return (window.location.href = "/");
    }
);

const options = {
    name: "_blank",
    specs: ["fullscreen=yes", "titlebar=no", "scrollbars=yes"],
    styles: [
        "https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css",
        "/css/custom.css",
    ],
    timeout: 1000, // default timeout before the print window appears
    autoClose: true, // if false, the window will not close after printing
    // windowTitle: window.document.title, // override the window title
};

Vue.use(VueRouter);
Vue.use(Vuex);
Vue.use(Dropdown);
Vue.use(Vuelidate);
Vue.use(VueHtmlToPaper, options);

const store = new Vuex.Store({
    state: {
        token: null,
        role: null,
        name: null,
    },
    getters: {
        name: (state) => state.name,
        role: (state) => state.role,
        token: (state) => state.token,
    },
    mutations: {
        setName(state, name) {
            state.name = name;
        },
        setRole(state, role) {
            state.role = role;
        },
        setToken(state, token) {
            state.token = token;
        },
    },
});

const app = new Vue({
    el: "#app",
    router: router,
    store,
    components: {
        index: index,
    },
});
