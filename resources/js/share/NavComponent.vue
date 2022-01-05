<template>
  <nav class="navbar navbar-toggleable-md navbar-light bg-faded custom-css">
    <div class="container-fluid">
      <img
        src="https://sieuthicongngheviettel.vn/wp-content/uploads/2021/11/Logo-Viettel.png"
        width="100px"
        height="30px"
      />
      <ul class="nav navbar navbar-left d-flex d-inline-flex">
        <li class="nav-item d-inline-flex align-items-center mr-2">
          <a class="nav-link custom-text-color" href="#"
            >Xin Chào {{ this.name }}</a
          >
        </li>
        <li class="nav-item d-inline-flex align-items-center mr-2">
          <a class="nav-link custom-text-color" @click="logout">Thoát</a>
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
  background-color: #f2f2f2;
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
}
.custom-text-color {
  color: red;
}
.custom-text-color:hover {
  color: black;
}
</style>