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
                />
              </div>

              <div class="form-group">
                <label for="nha_cung_cap">Nhà cung cấp</label>
                <input
                  type="text"
                  class="form-control"
                  id="nha_cung_cap"
                  v-model="nha_cung_cap"
                />
              </div>

              <div class="form-group">
                <label for="gia_nhap">Giá nhập</label>
                <input
                  type="number"
                  class="form-control"
                  id="gia_nhap"
                  v-model="gia_nhap"
                />
              </div>

              <div class="form-group">
                <label for="so_luong_trong_kho">Tổng số lượng trong kho</label>
                <input
                  type="number"
                  class="form-control"
                  id="so_luong_trong_kho"
                  v-model="so_luong_trong_kho"
                />
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
                />
              </div>

              <div class="form-group">
                <label for="kho_hang">Kho hàng</label>
                <input
                  type="text"
                  class="form-control"
                  id="kho_hang"
                  v-model="kho_hang"
                />
              </div>

              <div class="form-group">
                <label for="gia_ban">Giá bán</label>
                <input
                  type="number"
                  class="form-control"
                  id="gia_ban"
                  v-model="gia_ban"
                />
              </div>
            </div>
          </div>
          
        </div>

        <div class="col-sm-2">
          <a class="btn btn-success w-100" @click="updateDataKho"> Lưu </a>
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
      dataResposed: null,
      ma_so_seri: null,
      ten_san_pham: null,
      nha_cung_cap: null,
      gia_nhap: null,
      gia_ban: null,
      kho_hang: null,
      so_luong_trong_kho: null,
      // id_user: null,
      dataSelected: null,
      id_kho_hang: null,
      // options: [],
    };
  },
  async created() {
    this.loading = true;
    this.id_kho_hang = this.$route.params.id;
    await axios
      .get(
        `/api/get-data-ware-house/${this.$route.params.id}/${this.$route.params.seri}`
      )
      .then((result) => {
        this.dataResposed = result.data.data[0];
        this.ma_so_seri = this.dataResposed.ma_so_seri;
        this.ten_san_pham = this.dataResposed.ten_san_pham;
        this.nha_cung_cap = this.dataResposed.nha_cung_cap;
        this.gia_nhap = this.dataResposed.gia_nhap;
        this.gia_ban = this.dataResposed.gia_ban;
        this.kho_hang = this.dataResposed.kho_hang;
        this.so_luong_trong_kho = this.dataResposed.so_luong_trong_kho;
        // this.id_user = this.dataResposed.id_user;
      })
      .then((result) => {
        this.loading = false;
      })
      .catch((err) => {
        console.log("Error Sua Kho Hang");
      });

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
    //     console.log("Error Sua Kho Hang");
    //   });
  },
  methods: {
    async updateDataKho() {
      await axios
        .post("/api/update-data-ware-house", {
          id: this.id_kho_hang,
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
            alert("Chúc mừng bạn đã cập nhật thành công.");
            this.$router.push({path : "/home"});
          } else {
            console.log("Error: ");
          }
        })
        .catch((err) => {
          console.log("Error: " + err);
        });
    },
    // dataSelecteds(e) {
      // this.id_user = e.id;
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