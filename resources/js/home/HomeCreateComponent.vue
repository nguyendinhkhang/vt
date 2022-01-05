<template>
  <div id="app">
    <nav-component></nav-component>
    <div class="container-fluid">
      <div class="row">
        <menu-left></menu-left>

        <div class="col-sm-8">
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label for="seri">Mã số Seri</label>
                <input
                  type="text"
                  class="form-control"
                  id="seri"
                  v-model="ma_so_seri"
                  placeholder="Nhập mã số seri"
                />
              </div>

              <div class="form-group">
                <label for="nha_cung_cap">Nhà cung cấp</label>
                <input
                  type="text"
                  class="form-control"
                  id="nha_cung_cap"
                  v-model="nha_cung_cap"
                  placeholder="Nhà cung cấp"
                />
              </div>

              <div class="form-group">
                <label for="gia_nhap">Giá nhập</label>
                <input
                  type="number"
                  class="form-control"
                  id="gia_nhap"
                  v-model="gia_nhap"
                  placeholder="Giá nhập"
                />
              </div>

              <div class="form-group">
                <label for="so_luong_trong_kho">Số lượng nhập về</label>
                <input
                  type="number"
                  class="form-control"
                  id="so_luong_trong_kho"
                  v-model="so_luong_trong_kho"
                  placeholder="Giá nhập"
                />
                <!-- <Dropdown
                  class="form-control dropdown-css w-100"
                  name="subject"
                  v-on:selected="dataSelecteds"
                  :options="options"
                  :value="{ id: options.id, text: options.name }"
                  placeholder="Lựa chọn người đảm nhiệm"
                  autocomplete="off"
                >
                </Dropdown> -->
              </div>
            </div>

            <div class="col-sm-6">
              <div class="form-group">
                <label for="nameProduct">Tên sản phẩm</label>
                <input
                  type="text"
                  class="form-control"
                  id="nameProduct"
                  v-model="ten_san_pham"
                  placeholder="Tên sản pphẩm"
                />
              </div>

              <div class="form-group">
                <label for="kho_hang">Kho hàng</label>
                <input
                  type="text"
                  class="form-control"
                  id="kho_hang"
                  v-model="kho_hang"
                  placeholder="Kho hàng"
                />
              </div>

              <div class="form-group">
                <label for="gia_ban">Giá bán</label>
                <input
                  type="number"
                  class="form-control"
                  id="gia_ban"
                  v-model="gia_ban"
                  placeholder="Giá bán"
                />
              </div>
            </div>
          </div>
          
        </div>

        <div class="col-sm-2">
          <a class="btn btn-success w-100" @click="createDataKho"> Tạo mới </a>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  props: {
    id: String,
    seri: String,
  },
  data() {
    return {
      loading: false,
      ma_so_seri: null,
      ten_san_pham: null,
      nha_cung_cap: null,
      gia_nhap: null,
      gia_ban: null,
      kho_hang: null,
    //   nameData: null,
    //   id_user: null,
    //   dataSelected: null,
    //   options: [],
    };
  },
  async created() {
    this.loading = true;
    
    // await axios
    //   .get("/api/get-name-usr/kho-tls")
    //   .then((result) => {
    //     console.log(result.data.data);
    //     this.options = result.data.data;
    //   })
    //   .then((result) => {
    //     this.loading = false;
    //   })
    //   .catch((err) => {
    //     console.log("Error Tạo Kho Hang");
    //   });
  },
  methods: {
    async createDataKho() {
      await axios
        .post("/api/create-data-ware-house", {
          ma_so_seri: this.ma_so_seri,
          ten_san_pham: this.ten_san_pham,
          nha_cung_cap: this.nha_cung_cap,
          gia_nhap: this.gia_nhap,
          gia_ban: this.gia_ban,
          kho_hang: this.kho_hang,
          so_luong_trong_kho: this.so_luong_trong_kho,
        })
        .then((result) => {
          if (result.data.status_code == 200) {
            alert("Chúc mừng bạn đã tạo sản phẩm thành công.");
            this.$router.push({path : "/home"});
          } else {
            alert("Có vấn đề đã xảy ra, xin vui lòng thử lại sau.");
          }
        })
        .catch((err) => {
          calert("Có vấn đề đã xảy ra, xin vui lòng thử lại sau.");
        });
    },
    // dataSelecteds(e) {
    //   this.id_user = e.id;
    // },
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