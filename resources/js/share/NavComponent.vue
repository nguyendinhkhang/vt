<template>
    <nav class="navbar navbar-toggleable-md navbar-light bg-faded custom-css">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand">Your way - Theo cách của bạn</a>
            </div>
            <ul class="nav navbar navbar-right d-flex d-inline-flex">
                <li class="nav-item d-inline-flex align-items-center mr-2">
                    <a class="nav-link custom-text-color" href=""
                        >Xin Chào {{ this.name }}</a
                    >
                </li>
                <li
                    class="nav-item d-inline-flex align-items-center mr-2 logout-nav"
                >
                    <a
                        class="nav-link custom-text-color"
                        href="/"
                        @click="logout"
                        >Thoát</a
                    >
                </li>
            </ul>
        </div>
    </nav>
</template>

<script>
export default {
    data() {
        return {
            name: null,
            role: null,
        };
    },
    created() {
        if (localStorage.getItem("_token") == null) {
            window.location.href = "/";
        } else {
            this.name = window.atob(localStorage.getItem("_name"));
        }
    },
    methods: {
        async logout() {
            await axios
                .post("/logout")
                .then((result) => {
                    localStorage.clear();
                    this.$store.commit("setName", null);
                    this.$store.commit("setRole", null);
                    this.$store.commit("setToken", null);
                })
                .catch((err) => {
                    console.log(err.status);
                });
        },
    },
};
</script>

<style>
.custom-css {
    z-index: 0;
    background-color: #bf3a30;
    background-image: linear-gradient(315deg, #ea0a2a 0%, #ea0a50 74%);
}
.custom-text-color {
    color: white;
    float: right;
}
.custom-text-color:hover {
    color: white;
}
.navbar-brand {
    color: white !important;
    padding-left: 46%;
}
</style>
