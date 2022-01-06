<template>
  <div id="app">
    <nav-component></nav-component>
    <div class="container-fluid">
      <div class="row">
        <menu-left></menu-left>

        <div class="col-sm-10 custom-table pt-3">
          <table class="table table-borderless">
            <thead class="thead-dark">
              <tr>
                <th scope="col">ID</th>
                <th scope="col">Seri</th>
                <th scope="col">Địa chỉ giao hàng</th>
                <th scope="col">Số lượng</th>
                <th scope="col">Giá bán</th>
                <th scope="col">Ngày giao</th>
                <th scope="col">Trạng thái</th>
                <th scope="col">Người giao hàng</th>
                <th scope="col">Kho hàng</th>
                <th scope="col">Tên khách hàng</th>
                <th scope="col">Số điện thoại</th>
                <th scope="col">Ghi chú</th>
                <th scope="col">Hành động</th>
              </tr>
            </thead>
            <tbody>
              <tr
                v-for="(data, index) in dataResposed"
                :key="'data_kho_' + index"
              >
                <th scope="row">{{ index + 1 }}</th>
                <td>{{ data.ma_so_seri }}</td>
                <td>{{ data.dia_chi_giao_hang }}</td>
                <td>{{ data.so_luong }}</td>
                <td>{{ data.gia_ban }}</td>
                <td>{{ data.ngay_giao }}</td>
                <td v-if="data.trang_thai == 1">
                  <p class="text-danger">Chưa được giao</p>
                </td>
                <td v-else-if="data.trang_thai == 2">
                  <p class="text-warning">Đang giao giao</p>
                </td>
                <td v-else-if="data.trang_thai == 3">
                  <p class="text-success">Đã giao</p>
                </td>
                <td v-else-if="data.trang_thai == 4">
                  <p class="text-success">Trả về</p>
                </td>
                <td>{{ data.name }}</td>
                <td>{{ data.kho_hang }}</td>
                <td>{{ data.ten_khach_hang }}</td>
                <td>{{ data.so_dien_thoai }}</td>
                <td>{{ data.ghi_chu }}</td>

                <td>
                  <p class="btn btn-success" @click="thuHoiSp(data)">Thu hồi</p>
                </td>
              </tr>
            </tbody>
          </table>

          <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-end">
              <li class="page-item">
                <p class="page-custom">{{ first_page }}/{{ last_page }}</p>
              </li>

              <li class="page-item">
                <a
                  class="page-link"
                  @click="onChangePrevPage"
                  aria-label="Previous"
                >
                  <span aria-hidden="true">&laquo;</span>
                  <span class="sr-only">Trở lại</span>
                </a>
              </li>

              <li class="page-item">
                <a
                  class="page-link"
                  @click="onChangeNextPage"
                  aria-label="Next"
                >
                  <span class="sr-only">Tiếp theo</span>
                  <span aria-hidden="true">&raquo;</span>
                </a>
              </li>

              <li class="page-item">
                <input
                  class="set-input"
                  type="number"
                  @change="onChangePageInput"
                  v-model="change_page"
                />
              </li>
            </ul>
          </nav>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      dataResposed: null,
      first_page: 1,
      last_page: null,
      change_page: 1,
      id_kho_hang: null,
    };
  },
  async created() {
    if (localStorage.getItem("_token") == null) {
      window.location.href = "/";
    } else {
      this.id_kho_hang = this.$route.params.id;
      await axios.get("sanctum/csrf-cookie");
      await axios
        .get(`/api/get-details-order/${this.$route.params.id}`)
        .then((result) => {
          this.dataResposed = result.data.data.data;
          this.last_page = result.data.data.last_page;
        })
        .catch((err) => {
          console.log(err.status);
        });
    }
  },
  methods: {
    async loadData() {
      await axios
        .get(`/api/get-details-order/${this.id_kho_hang}`)
        .then((result) => {
          this.dataResposed = result.data.data.data;
          this.last_page = result.data.data.last_page;
        })
        .catch((err) => {
          console.log(err.status);
        });
    },

    async thuHoiSp(data) {
      console.log(this.id_kho_hang + " ID");
      console.log(data);
      var trong_kho   = parseInt(data.so_luong_trong_kho) + parseInt(data.so_luong);
      var da_xuat     = parseInt(data.so_luong_da_xuat) - parseInt(data.so_luong);

      await axios
        .post("/api/delete-data-order", {
          id_quan_ly_giao: data.id_quan_ly_giao,
        })
        .then((result) => {
          if (result.data.status_code == 200) {
            axios
              .post("/api/update-so-luong-order", {
                id_kho_hang: this.id_kho_hang,
                so_luong_trong_kho: trong_kho,
                so_luong_da_xuat: da_xuat,
              })
              .then((result) => {
                if (result.data.status_code == 200) {
                  alert("Chúc mừng bạn đã thu hồi thành công.");
                  if (da_xuat == 0) {
                    this.$router.push({ path: "/home" });
                  } else {
                    this.loadData();
                  }
                } else {
                  alert("Có vấn đề đã xảy ra, xin vui lòng thử lại sau.");
                }
              })
              .catch((err) => {
                alert("Có vấn đề đã xảy ra, xin vui lòng thử lại sau.");
              });
            // alert("Chúc mừng bạn đã cập nhật thành công.");
            // this.$router.push({path : "/home"});
          } else {
            alert("Error - 1")
            console.log("Error: ");
          }
        })
        .catch((err) => {
          alert("Error - 2" + err);
          console.log("Error: " + err);
        });

      // $ma_so_seri = $request->input('ma_so_seri');
      //             $id_quan_ly_giao = $request->input('id_quan_ly_giao');

      // delete tls_quan_ly_giao_hangs theo serri va id_quan_ly_giao

      // update tls_quan_ly_kho_hangs  theo id_don_hang,
      //  => lay so so_luong_da_xuat = so_luong_da_xuat - so_luong
      //  => lay so_luong_trong_kho = so_luong_trong_kho + so_luong
    },

    async changePage(page) {
      await axios
        .get("/api/get-data-order?page=" + page)
        .then((result) => {
          this.dataResposed = result.data.data.data;
        })
        .catch((err) => {
          console.log(err.status);
        });
    },

    onChangePageInput() {
      var setNotRequest = false;
      if (this.change_page > this.last_page) {
        this.change_page = this.last_page;
        setNotRequest = true;
      } else if (this.change_page == 0) {
        this.change_page = 1;
        setNotRequest = true;
      } else {
        this.first_page = this.change_page;
        setNotRequest = false;
      }

      if (!setNotRequest) {
        this.changePage(this.change_page);
      }
    },

    onChangeNextPage() {
      this.first_page++;
      var setNotRequest = false;
      if (this.first_page > this.last_page) {
        this.first_page = this.last_page;
        var setNotRequest = true;
      } else {
        var setNotRequest = false;
      }

      if (!setNotRequest) {
        this.changePage(this.first_page);
      }
    },

    onChangePrevPage() {
      this.first_page--;
      var setNotRequest = false;
      if (this.first_page == 0) {
        this.first_page = 1;
        var setNotRequest = true;
      } else {
        var setNotRequest = false;
      }

      if (!setNotRequest) {
        this.changePage(this.first_page);
      }
    },
  },
};
</script>

<style>
.set-input {
  width: 50px;
  height: 37px;
}
.page-link {
  height: 37px;
  color: red;
}
.page-link:hover {
  color: black;
}
.page-custom {
  height: 37px;
  margin-top: 0.5rem;
  margin-bottom: 0.5rem;
}
.page-item {
  padding-right: 8px;
}
</style>