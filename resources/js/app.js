require('./bootstrap');
import VueRouter from "vue-router"
import Vue from "vue";
import router from "../../public/js/routers";
import Vuex from "vuex";
import index from "../js/index";
import NavComponent from "../js/share/NavComponent";
import MenuLeftComponent from "../js/share/MenuLeftComponent";
import MenuRightComponent from "../js/share/MenuRightComponent";

Vue.component("nav-component", NavComponent);
Vue.component("menu-left", MenuLeftComponent);
Vue.component("menu-right", MenuRightComponent);
window.Vue = require('vue').default;

window.axios.interceptors.response.use(
    response => {return response},
    error => {
        if(401 === error.response.status){
            window.location.href = "/"
        }
        return window.location.href = "/"
    }
);


Vue.use(VueRouter);
Vue.use(Vuex);
Vue.use(Dropdown);

const store = new Vuex.Store({
    state:{
        token: null,
        role: null,
        name: null,
    },
    getters:{
        name: state => state.name,
        role: state => state.role,
        token: state => state.token,
    },
    mutations:{
        setName(state, name){
            state.name = name;
        },
        setRole(state, role){
            state.role = role;
        },
        setToken(state, token){
            state.token = token;
        }
    },
})

const app = new Vue({
    el: '#app',
    router: router,
    store,
    components: {
        "index" : index,
    }
});
