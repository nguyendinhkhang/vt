<template>
  <div id="app">
    <nav-component></nav-component>
    <div class="container-fluid">
      <div class="row">
        <menu-left></menu-left>

        <div class="col-sm-10 custom-table">
          <div class="pb-2 custom-location-btn">
            <router-link
              class="btn w-25 btn-custom-center"
              to="/home/tao-kho-hang"
            >
              Thêm mới
            </router-link>
          </div>
          <table class="table table-borderless">
            <thead class="thead-dark">
              <tr>
                <th scope="col text-center-custom">ID</th>
                <th scope="col text-center-custom">Seri</th>
                <th scope="col text-center-custom">Tên sản phẩm</th>
                <th scope="col text-center-custom">Nhà cung cấp</th>
                <th scope="col text-center-custom">Giá nhập</th>
                <th scope="col text-center-custom">Giá bán</th>
                <th scope="col text-center-custom">Kho hàng</th>
                <th scope="col text-center-custom">Tồn kho</th>
                <th scope="col text-center-custom">Đã xuất</th>
                <th scope="col text-center-custom">Hành động</th>
              </tr>
            </thead>
            <tbody>
              <tr
                v-for="(data, index) in dataResposed"
                :key="'data_kho_' + index"
              >
                <th scope="row">{{ index + 1 }}</th>
                <td>{{ data.ma_so_seri }}</td>
                <td>{{ data.ten_san_pham }}</td>
                <td>{{ data.nha_cung_cap }}</td>
                <td>{{ data.gia_nhap }}</td>
                <td>{{ data.gia_ban }}</td>
                <td>{{ data.kho_hang }}</td>

                <td>
                  {{ data.so_luong_trong_kho }}
                </td>

                <td v-if="data.so_luong_da_xuat > 0" @click="getDataXuat">
                  <router-link
                    class="text-danger text-decoration-none"
                    :to="{
                      name: 'HomeDetailsOrderExportComponent',
                      params: { id: data.id_kho_hang },
                    }"
                    >{{ data.so_luong_da_xuat }}</router-link
                  >
                </td>
                <td v-else>
                  {{ data.so_luong_da_xuat }}
                </td>

                <td>
                  <router-link
                    class="btn btn-secondary"
                    :to="{
                      name: 'HomeEditComponent',
                      params: { id: data.id_kho_hang, seri: data.ma_so_seri },
                    }"
                    >Sửa</router-link
                  >
                  <a
                    class="btn btn-danger"
                    @click="deleteData(data.id_kho_hang)"
                    >Xoá</a
                  >

                  <router-link
                    class="btn btn-info text-white"
                    :to="{
                      name: 'HomeExportComponent',
                      params: {
                        id: data.id_kho_hang,
                        tong: data.so_luong_trong_kho,
                        daxuat: data.so_luong_da_xuat,
                      },
                    }"
                    >Xuất kho</router-link
                  >
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

        <!-- <menu-right></menu-right> -->
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
    };
  },
  async created() {
    if (localStorage.getItem("_token") == null) {
      window.location.href = "/";
    } else {
      var _token = window.atob(localStorage.getItem("_token"));
      this.role = window.atob(localStorage.getItem("_token")).slice(0, 1);
      console.log(_token);
      console.log(this.role);
      if (this.role == 2) {
        this.$router.push({ path: '/order' });
      } else {
        await axios.get("sanctum/csrf-cookie");
        await axios
          .get("/api/get-data-ware-house")
          .then((result) => {
            this.dataResposed = result.data.data.data;
            this.last_page = result.data.data.last_page;
          })
          .catch((err) => {
            console.log(err.status);
          });
      }
    }
  },
  methods: {
    async changePage(page) {
      await axios
        .get("/api/get-data-ware-house?page=" + page)
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

    change_responsible() {
      this.change_user_responsible = false;
    },

    async deleteData(event) {
      var answer = window.confirm("Bạn có muốn xoá dữ liệu?");
      if (answer) {
        await axios
          .post("/api/delete-data-ware-house", {
            id: event,
          })
          .then((result) => {
            if (result.data.status_code == 200) {
              alert("Chúc mừng bạn đã xoá dữ liệu thành công.");
              axios
                .get("/api/get-data-ware-house")
                .then((result) => {
                  this.dataResposed = result.data.data.data;

                  console.log(result.data.data.data);

                  this.last_page = result.data.data.last_page;
                })
                .catch((err) => {
                  console.log(err.status);
                });
            } else {
              alert("Xoá dữ liệu thất bại vui lòng thử lại sau.");
            }
          })
          .catch((err) => {
            alert("Xoá dữ liệu thất bại vui lòng thử lại sau.");
          });
      }
    },

    getDataXuat() {
      console.log("hi");
    },
  },
};
</script>

<style>
.dropdown .dropdown-input[data-v-6149e08a] {
  min-width: 40px;
}
.dropdown-css {
  width: 85%;
  margin-left: inherit;
}
.custom-table {
  margin-left: 7vh;
}

table,
th,
td {
  box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;
  background-color: white;
  border-radius: 25px;
}
th,
td {
  background-color: #96d4d4;
}

.btn-custom-center {
  position: relative;
  background-color: white;
  color: #ea0a2a;
  box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;
  margin-left: 38.5%;
  z-index: 1;
  font-weight: bold;
}
.btn-custom-center:hover {
  color: #ea0a2a;
  z-index: 1;
}
.custom-location-btn {
  margin-top: -25px;
  z-index: 1;
}
.text-center-custom {
  text-align: center !important;
}
</style>