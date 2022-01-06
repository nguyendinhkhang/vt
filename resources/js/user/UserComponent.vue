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
            :to="{
              name: 'UserCreateComponent',
            }"
            >Thêm mới người dùng</router-link
          >
          </div>

          <table class="table table-borderless">
            <thead class="thead-dark">
              <tr>
                <th scope="col">ID</th>
                <th scope="col">Tên người dùng</th>
                <th scope="col">Email</th>
                <th scope="col">Số điện thoại</th>
                <th scope="col">Quyền</th>
                <th scope="col">Hành động</th>
              </tr>
            </thead>
            <tbody>
              <tr
                v-for="(data, index) in dataResposed"
                :key="'data_kho_' + index"
              >
                <th scope="row">{{ index + 1 }}</th>
                <td>{{ data.name }}</td>
                <td>{{ data.email }}</td>
                <td>{{ data.phone }}</td>
                <td v-if="data.role == 1">Quản trị</td>
                <td v-else-if="data.role == 2">Hỗ trợ tiếp nhận đơn hàng</td>
                <td v-else-if="data.role == 3">Người giao hàng</td>
                <td>
                  <router-link
                    class="btn btn-secondary"
                    :to="{
                      name: 'UserEditComponent',
                      params: { id: data.id },
                    }"
                    >Sửa</router-link
                  >

                  <a class="btn btn-danger" @click="deleteData(data.id)">Xoá</a>
                </td>
              </tr>
            </tbody>
          </table>
          <!-- PageNavigation -->
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

        <!-- <div class="col-sm-2">
          <router-link
            class="btn btn-success"
            :to="{
              name: 'UserCreateComponent',
            }"
            >Thêm mới người dùng</router-link
          >
        </div> -->
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
    await axios
      .get("/api/get-all-user")
      .then((result) => {
        this.dataResposed = result.data.data.data;
        this.last_page = result.data.data.last_page;
        console.log(this.dataResposed);
      })
      .catch((err) => {
        console.log("Error Catch");
      });
  },
  methods: {
    async deleteData(event) {
      var answer = window.confirm("Bạn có muốn xoá dữ liệu?");
      if (answer) {
        await axios
          .post("/api/delete-data-user", {
            id: event,
          })
          .then((result) => {
            if (result.data.status_code == 200) {
              alert("Chúc mừng bạn đã xoá dữ liệu thành công.");
              axios
                .get("/api/get-all-user")
                .then((result) => {
                  this.dataResposed = result.data.data.data;
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

    // page navigation
    async changePage(page) {
      await axios
        .get("/api/get-all-user?page=" + page)
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
    // End page navigation
  },
};
</script>