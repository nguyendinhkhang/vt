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
                                    <p class="text-warning">Đang giao</p>
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
                                <td v-if="data.trang_thai == 1">
                                    <router-link
                                        class="btn btn-info text-white custom-text-order"
                                        :to="{
                                            name: 'OrderSetUserDeadComponent',
                                            params: {
                                                id: data.id_quan_ly_giao,
                                            },
                                        }"
                                        >Giao</router-link
                                    >
                                </td>
                                <td v-if="data.trang_thai == 2">
                                    <p class="text-warning">Đang giao</p>
                                </td>
                                <td v-if="data.trang_thai == 3">
                                    <p class="text-success">Hoàn thành</p>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-end">
                            <li class="page-item">
                                <p class="page-custom">
                                    {{ first_page }}/{{ last_page }}
                                </p>
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
            id_user: null,
            role: null,
        };
    },
    async created() {
        if (localStorage.getItem("_token") == null) {
            window.location.href = "/";
        } else {
            this.role = window.atob(localStorage.getItem("_token")).slice(0, 1);
            if (this.role == 2) {
                this.id_user = window.atob(localStorage.getItem("_dataLogin"));
                console.log(this.id_user);
                await axios.get("sanctum/csrf-cookie");
                await axios
                    .get("/api/get-data-order-role/" + this.id_user)
                    .then((result) => {
                        console.log(result);
                        this.dataResposed = result.data.data.data;
                        this.last_page = result.data.data.last_page;
                    })
                    .catch((err) => {
                        console.log(err.status);
                    });
                // Select theo ID
            } else {
                await axios.get("sanctum/csrf-cookie");
                await axios
                    .get("/api/get-data-order")
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
.custom-text-order {
    width: 11vh;
}
</style>
