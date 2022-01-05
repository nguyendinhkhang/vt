<template>
  <div id="app">
    <nav-component></nav-component>
    <div class="container-fluid">
      <div class="row">
        <menu-left></menu-left>

        <div class="col-sm-8">
          <div class="row">
            <div class="col-sm-6">
              <!-- dia chi -->
              <div class="form-group">
                <label for="dia_chi_giao_hang">Địa chỉ giao hàng</label>
                <input
                  type="text"
                  class="form-control"
                  id="dia_chi_giao_hang"
                  v-model="dia_chi_giao_hang"
                  placeholder="Nhập địa chỉ giao hàng"
                />
              </div>
              <!-- So luong -->
              <div class="form-group">
                <label for="so_luong">Số lượng xuất kho</label>
                <input
                  type="number"
                  class="form-control"
                  id="so_luong"
                  v-model="so_luong"
                  placeholder="Nhập số lượng xuất kho"
                />
              </div>
              <!-- user dam nhiem -->
              <div class="form-group">
                <label for="so_luong_trong_kho">Người chịu trách nhiệm</label>
                <Dropdown
                  class="form-control dropdown-css w-100"
                  name="subject"
                  v-on:selected="dataSelecteds"
                  :options="options"
                  :value="{ id: options.id, text: options.name }"
                  placeholder="Lựa chọn người chịu trách nhiệm"
                  autocomplete="off"
                >
                </Dropdown>
              </div>
            </div>

            <div class="col-sm-6">
              <!-- Ten khach hang -->
              <div class="form-group">
                <label for="ten_khach_hang">Tên khách hàng</label>
                <input
                  type="text"
                  class="form-control"
                  id="ten_khach_hang"
                  v-model="ten_khach_hang"
                  placeholder="Nhập tên khách hàng"
                />
              </div>

              <!-- So dien thoai -->
              <div class="form-group">
                <label for="so_dien_thoai">Số điện thoại</label>
                <input
                  type="number"
                  class="form-control"
                  id="so_dien_thoai"
                  v-model="so_dien_thoai"
                  placeholder="Nhập số điện thoại"
                />
              </div>
            </div>
          </div>
        </div>

        <div class="col-sm-2">
          <a class="btn btn-success w-100" @click="createGiaoHang"> Lưu </a>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      dia_chi_giao_hang: null,
      so_luong: null,
      user_dam_nhiem: null,
      ten_khach_hang: null,
      so_dien_thoai: null,
      id_kho_hang: null,
      so_luong_trong_kho: null,
      so_luong_da_xuat: null,
      options: [],
    };
  },
  async created() {
    this.id_kho_hang = this.$route.params.id;
    this.so_luong_trong_kho = this.$route.params.tong;
    this.so_luong_da_xuat = this.$route.params.daxuat;
    

    await axios
      .get("/api/get-name-usr/kho-tls")
      .then((result) => {
        this.options = result.data.data;
      })
      .then((result) => {
        this.loading = false;
      })
      .catch((err) => {
        console.log("Error Sua Kho Hang");
      });
  },
  methods: {
    async createGiaoHang() {
      var tong = this.so_luong_trong_kho - this.so_luong;
      if (this.so_luong > this.so_luong_trong_kho) {
        this.so_luong = this.so_luong_trong_kho;
        tong = 0;
      } else if (this.so_luong < 0) {
        this.so_luong = 1;
        tong = this.so_luong_trong_kho - this.so_luong;
      }
      var so_da_xuat = parseInt(this.so_luong_da_xuat) + parseInt(this.so_luong);

      await axios
        .post("/api/create-data-order", {
          dia_chi_giao_hang: this.dia_chi_giao_hang,
          so_luong: this.so_luong,
          ten_khach_hang: this.ten_khach_hang,
          user_dam_nhiem: this.user_dam_nhiem,
          so_dien_thoai: this.so_dien_thoai,
          id_kho_hang: this.id_kho_hang,
        })
        .then((result) => {
          if (result.data.status_code == 200) {
            axios
              .post("/api/update-so-luong-order", {
                id_kho_hang: this.id_kho_hang,
                so_luong_trong_kho: tong,
                so_luong_da_xuat: so_da_xuat,
              })
              .then((result) => {
                if (result.data.status_code == 200) {
                  alert("Chúc mừng bạn đã tạo đơn hàng thành công.");
                  this.$router.push({ path: "/home" });
                } else {
                  alert("Có vấn đề đã xảy ra, xin vui lòng thử lại sau.");
                }
              })
              .catch((err) => {
                calert("Có vấn đề đã xảy ra, xin vui lòng thử lại sau.");
              });
          } else {
            alert("Có vấn đề đã xảy ra, xin vui lòng thử lại sau.");
            return;
          }
        })
        .catch((err) => {
          alert("Có vấn đề đã xảy ra, xin vui lòng thử lại sau." + err);
          return;
        });
    },
    dataSelecteds(e) {
      this.user_dam_nhiem = e.id;
    },
  },
};
</script>