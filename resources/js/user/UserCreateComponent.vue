<template>
  <div id="app">
    <nav-component></nav-component>
    <div class="container-fluid">
      <div class="row">
        <menu-left></menu-left>

        <div class="col-sm-10 custom-margin">
          <div class="pb-2 custom-location-btn">
            <a class="btn w-25 btn-custom-center" @click="createDataUser">
              Lưu
            </a>
          </div>

          <div class="row custom-data-border">
            <div class="col-sm-6">
              <div class="form-group p-3">
                <label for="name">Tên người dùng</label>
                <input
                  type="text"
                  class="form-control"
                  id="name"
                  v-model="name"
                />
              </div>

              <div class="form-group p-3">
                <label for="email">Email người dùng</label>
                <input
                  type="text"
                  class="form-control"
                  id="email"
                  v-model="email"
                />
              </div>

              <div class="form-group p-3">
                <label for="gia_nhap">Quyền</label>
                <Dropdown
                  class="form-control dropdown-css w-100"
                  name="subject"
                  v-on:selected="dataSelecteds"
                  :options="options"
                  :value="{ id: options.id, text: options.name }"
                  placeholder="Lựa chọn"
                  autocomplete="off"
                >
                </Dropdown>
              </div>
            </div>

            <div class="col-sm-6">
              <div class="form-group p-3">
                <label for="password">Mật khẩu</label>
                <input
                  type="text"
                  class="form-control"
                  id="password"
                  v-model="password"
                />
              </div>

              <div class="form-group p-3">
                <label for="phone">Số điện thoại</label>
                <input
                  type="number"
                  class="form-control"
                  id="phone"
                  v-model="phone"
                />
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      loading: false,
      dataResposed: null,
      name: null,
      email: null,
      phone: null,
      role: null,
      id: null,
      password: null,
      options: [
        { id: "1", name: "Quản trị" },
        { id: "2", name: "Hỗ trợ tiếp nhận đơn hàng" },
        { id: "3", name: "Người giao hàng" },
      ],
    };
  },
  methods: {
    async createDataUser() {
        console.log(this.name);
        console.log(this.email);
        console.log(this.phone);
        console.log(this.role);
        console.log(this.password);
      await axios
        .post("/api/create-data-user", {
          name: this.name,
          email: this.email,
          phone: this.phone,
          role: this.role,
          password: this.password,
        })
        .then((result) => {
          if (result.data.status_code == 200) {
            alert("Chúc mừng bạn đã thêm thành công.");
            this.$router.push({path : "/user"});
          } else {
            console.log("Error: ");
          }
        })
        .catch((err) => {
          console.log("Error: " + err);
        });
    },
    dataSelecteds(e) {
      this.role = e.id;
    },
  },
};
</script>

<style>
.dropdown-input {
  min-width: 100% !important;
  font-size: 0.9rem !important;
}
.dropdown-item {
  font-size: 0.9rem !important;
}
.dropdown-content {
  min-width: 90% !important;
}
</style>