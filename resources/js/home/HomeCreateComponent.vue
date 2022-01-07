<template>
  <div id="app">
    <nav-component></nav-component>
    <div class="container-fluid">
      <div class="row">
        <menu-left></menu-left>

        <div class="col-sm-10 custom-margin">
          <div class="pb-2 custom-location-btn">
            <a
              class="btn w-25 btn-custom-center"
              @click="createDataKho"
            >
              Tạo mới
            </a>
          </div>
          <div class="row custom-data-border">
            <div class="col-sm-6">
              <div class="form-group p-3">
                <label for="seri">Mã số Seri</label> 
                <span class="text-danger" style="padding-left:5px">{{errMa_so_seri}}</span>
                <input
                  type="text"
                  class="form-control"
                  id="seri"
                  v-model="ma_so_seri"
                  placeholder="Nhập mã số seri"
                />
              </div>

              <div class="form-group p-3">
                <label for="nha_cung_cap">Nhà cung cấp</label>
                <span class="text-danger" style="padding-left:5px">{{errNha_cung_cap}}</span>
                <input
                  type="text"
                  class="form-control"
                  id="nha_cung_cap"
                  v-model="nha_cung_cap"
                  placeholder="Nhà cung cấp"
                />
              </div>

              <div class="form-group p-3">
                <label for="gia_nhap">Giá nhập</label>
                <span class="text-danger" style="padding-left:5px">{{errGia_nhap}}</span>
                <input
                  type="number"
                  class="form-control"
                  id="gia_nhap"
                  v-model="gia_nhap"
                  placeholder="Giá nhập"
                />
              </div>

              <div class="form-group p-3">
                <label for="so_luong_trong_kho">Số lượng nhập về</label>
                <span class="text-danger" style="padding-left:5px">{{errSo_luong_trong_kho}}</span>
                <input
                  type="number"
                  class="form-control"
                  id="so_luong_trong_kho"
                  v-model="so_luong_trong_kho"
                  placeholder="Giá nhập"
                />
              </div>
            </div>

            <div class="col-sm-6">
              <div class="form-group p-3">
                <label for="nameProduct">Tên sản phẩm</label>
                <span class="text-danger" style="padding-left:5px">{{errTen_san_pham}}</span>
                <input
                  type="text"
                  class="form-control"
                  id="nameProduct"
                  v-model="ten_san_pham"
                  placeholder="Tên sản pphẩm"
                />
              </div>

              <div class="form-group p-3">
                <label for="kho_hang">Kho hàng</label>
                <span class="text-danger" style="padding-left:5px">{{errKho_hang}}</span>
                <input
                  type="text"
                  class="form-control"
                  id="kho_hang"
                  v-model="kho_hang"
                  placeholder="Kho hàng"
                />
              </div>

              <div class="form-group p-3">
                <label for="gia_ban">Giá bán</label>
                <span class="text-danger" style="padding-left:5px">{{errGia_ban}}</span>
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
      so_luong_trong_kho: null,
      errMa_so_seri: null,
      errTen_san_pham: null,
      errNha_cung_cap: null,
      errGia_nhap: null,
      errGia_ban: null,
      errKho_hang: null,
      errSo_luong_trong_kho: null,
      err: false,
    };
  },
  async created() {
    this.loading = true;
  },
  methods: {
    async createDataKho() {
      // this.err = false;
      // if(this.ma_so_seri == "" || this.ma_so_seri == null || this.ma_so_seri.length > 255){
      //     this.errMa_so_seri = "Vui lòng nhập seri hoặc nhập đúng định dạng"
      //     this.err = true
      // }
      // if(this.ten_san_pham == "" || this.ten_san_pham == null || this.ten_san_pham.length > 255){
      //   this.errTen_san_pham = "Vui lòng nhập tên sản phẩm hoặc nhập đúng định dạng"
      //   this.err = true
      // }
      // if(this.nha_cung_cap == "" || this.nha_cung_cap == null || this.nha_cung_cap.length > 255){
      //   this.errNha_cung_cap = "Vui lòng nhập nhà cung cấp hoặc nhập đúng định dạng"
      //   this.err = true
      // }
      // if(this.gia_nhap == ""|| this.gia_nhap == null){
      //   this.errGia_nhap = "Vui lòng nhập giá nhập hoặc nhập đúng định dạng"
      //   this.err = true
      // }
      // if(this.gia_ban == ""|| this.gia_ban == null){
      //   this.errGia_ban = "Vui lòng nhập giá bán hoặc nhập đúng định dạng"
      //   this.err = true
      // }
      // if(this.kho_hang == "" || this.gia_ban == null){
      //   this.errKho_hang = "Vui lòng nhập kho hàng hoặc nhập đúng định dạng"
      //   this.err = true
      // }
      // if(this.so_luong_trong_kho == "" || this.so_luong_trong_kho == null){
      //   this.errSo_luong_trong_kho = "Vui lòng nhập số lượng hoặc đúng nhập định dạng"
      //   this.err = true
      // }
      // if(!this.err){
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
            this.$router.push({ path: "/home" });
          } else {
            alert("Có vấn đề đã xảy ra, xin vui lòng thử lại sau.");
          }
        })
        .catch((err) => {
          calert("Có vấn đề đã xảy ra, xin vui lòng thử lại sau.");
        });
      // }
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
.custom-data-border{
    box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;
    background-color: white;
    border-radius: 25px;
}
.custom-margin{
  margin-left: 7vh;
}
</style>