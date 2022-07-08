<template>
    <div id="app">
        <nav-component></nav-component>
        <div class="container-fluid">
            <div class="row">
                <menu-left></menu-left>

                <div class="col-sm-10 custom-table">
                    <div class="row pt-2">
                        <div class="col-sm-2"></div>
                        <div class="col-sm-4">
                            <select
                                name="month"
                                id="month"
                                style="
                                    height: 2.5rem;
                                    border-radius: 8px;
                                    border: 1px;
                                    color: #ea0a2a;
                                    float: right;
                                    width: 13rem;
                                "
                                @change="selectProductChange($event)"
                            >
                                <option value="ma_so_seri">Seri</option>
                                <option value="ten_san_pham">
                                    Tên sản phẩm
                                </option>
                                <option value="nha_cung_cap">
                                    Nhà cung cấp
                                </option>
                                <option value="ma_san_pham">
                                    Mã số sản phẩm
                                </option>
                            </select>
                        </div>

                        <div class="col-sm-4">
                            <input
                                style="
                                    height: 2.5rem;
                                    border-radius: 8px;
                                    border: 1px;
                                    color: rgb(234, 10, 42);
                                    width: 13rem;
                                    background-color: white;
                                "
                                type="text"
                                v-model="search"
                                placeholder="Tìm kiếm"
                                class="form-control"
                                v-on:keyup.enter="filteredProducts()"
                            />
                        </div>
                        <div class="col-sm-2"></div>
                    </div>

                    <div class="row custom-row-analyst">
                        <div class="col-sm-2"></div>
                        <div class="col-sm-4">
                            <div class="block">
                                <h4 class="head-analyst">
                                    Tổng hàng trong kho
                                </h4>
                                <h4>{{ this.totalProduct }}</h4>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="block">
                                <h4 class="head-analyst">
                                    Số lượng hàng tồn trong tháng
                                    <select
                                        name="month"
                                        id="month"
                                        class="pb-2 custom-location-btn"
                                        style="
                                            height: 2rem;
                                            border-radius: 8px;
                                            border: 1px;
                                            color: #ea0a2a;
                                        "
                                        @change="selectDataChange($event)"
                                    >
                                        <option
                                            value="1"
                                            :selected="month === 1"
                                        >
                                            1
                                        </option>
                                        <option
                                            value="2"
                                            :selected="month === 2"
                                        >
                                            2
                                        </option>
                                        <option
                                            value="3"
                                            :selected="month === 3"
                                        >
                                            3
                                        </option>
                                        <option
                                            value="4"
                                            :selected="month === 4"
                                        >
                                            4
                                        </option>
                                        <option
                                            value="5"
                                            :selected="month === 5"
                                        >
                                            5
                                        </option>
                                        <option
                                            value="6"
                                            :selected="month === 6"
                                        >
                                            6
                                        </option>
                                        <option
                                            value="7"
                                            :selected="month === 7"
                                        >
                                            7
                                        </option>
                                        <option
                                            value="8"
                                            :selected="month === 8"
                                        >
                                            8
                                        </option>
                                        <option
                                            value="9"
                                            :selected="month === 9"
                                        >
                                            9
                                        </option>
                                        <option
                                            value="10"
                                            :selected="month === 10"
                                        >
                                            10
                                        </option>
                                        <option
                                            value="11"
                                            :selected="month === 11"
                                        >
                                            11
                                        </option>
                                        <option
                                            value="12"
                                            :selected="month === 12"
                                        >
                                            12
                                        </option>
                                    </select>
                                </h4>
                                <h4>{{ this.totalProductInMonth }}</h4>
                            </div>
                        </div>
                        <div class="col-sm-2"></div>
                    </div>

                    <table
                        class="table table-borderless"
                        style="padding-top: 15px"
                    >
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col text-center-custom">ID</th>
                                <th scope="col text-center-custom">Seri</th>
                                <th scope="col text-center-custom">
                                    Tên sản phẩm
                                </th>
                                <th scope="col text-center-custom">
                                    Mã sản phẩm
                                </th>
                                <th scope="col text-center-custom">
                                    Nhà cung cấp
                                </th>
                                <th scope="col text-center-custom">Giá nhập</th>
                                <!-- <th scope="col text-center-custom">Tồn kho</th> -->
                                <th scope="col text-center-custom">Tạm ứng</th>
                                <th scope="col text-center-custom">Thực tế</th>
                                <th scope="col text-center-custom">
                                    Tổng sản phẩm
                                </th>
                                <th scope="col text-center-custom">Đã xuất</th>
                                <th scope="col text-center-custom">
                                    Thời gian tồn kho
                                </th>
                                <th scope="col text-center-custom">
                                    Hành động
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr
                                v-for="(data, index) in arrSearch.length != 0
                                    ? arrSearch
                                    : dataResposed"
                                :key="'data_kho_' + index"
                            >
                                <th scope="row">{{ index + 1 }}</th>
                                <td>{{ data.ma_so_seri }}</td>
                                <td>{{ data.ten_san_pham }}</td>
                                <td>{{ data.ma_san_pham }}</td>
                                <td>{{ data.nha_cung_cap }}</td>
                                <td>{{ data.gia_nhap }}</td>
                                <td>0</td>
                                <td>0</td>
                                <td>{{ data.so_luong_trong_kho }}</td>

                                <td
                                    v-if="data.so_luong_da_xuat > 0"
                                    @click="getDataXuat"
                                >
                                    <router-link
                                        class="text-danger text-decoration-none"
                                        :to="{
                                            name: 'HomeDetailsOrderExportComponent',
                                            params: { id: data.id_kho_hang },
                                        }"
                                        >{{
                                            data.so_luong_da_xuat
                                        }}</router-link
                                    >
                                </td>
                                <td v-else>
                                    {{ data.so_luong_da_xuat }}
                                </td>

                                <td>
                                    {{
                                        Math.round(
                                            Math.abs(
                                                (new Date(
                                                    new Date()
                                                        .toISOString()
                                                        .slice(0, 10)
                                                ) -
                                                    new Date(
                                                        data.updated_at.slice(
                                                            0,
                                                            -9
                                                        )
                                                    )) /
                                                    (24 * 60 * 60 * 1000)
                                            )
                                        )
                                    }}
                                    Ngày
                                </td>

                                <td>
                                    <router-link
                                        class="btn btn-secondary"
                                        :to="{
                                            name: 'HomeEditComponent',
                                            params: {
                                                id: data.id_kho_hang,
                                                seri: data.ma_so_seri,
                                            },
                                        }"
                                        >Sửa</router-link
                                    >
                                    <a
                                        class="btn btn-danger"
                                        @click="
                                            showModal = true;
                                            removeID = data.id_kho_hang;
                                            dataGet = {
                                                id_quan_ly_giao:
                                                    data.id_kho_hang,
                                                storage_seri: data.ma_so_seri,
                                                storage_ten_san_pham:
                                                    data.ten_san_pham,
                                                storage_nha_cung_cap:
                                                    data.nha_cung_cap,
                                                storage_gia_nhap: data.gia_nhap,
                                            };
                                            changeRadioBtn();
                                        "
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
                                                gia: data.gia_ban,
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

                    <div v-if="showModal">
                        <transition name="modal">
                            <div class="modal-mask">
                                <div class="modal-wrapper">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">
                                                    Bạn muốn xóa dữ liệu?
                                                </h5>
                                                <button
                                                    type="button"
                                                    class="close"
                                                    data-dismiss="modal"
                                                    aria-label="Close"
                                                >
                                                    <span
                                                        aria-hidden="true"
                                                        @click="
                                                            showModal = false
                                                        "
                                                        >&times;</span
                                                    >
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div
                                                    style="padding-bottom: 8px"
                                                >
                                                    <input
                                                        type="radio"
                                                        id="removeAllv"
                                                        value="removeAll"
                                                        v-model="picked"
                                                        @change="changeRadioBtn"
                                                        checked
                                                    />
                                                    <label for=" removeAll"
                                                        >Xóa</label
                                                    >
                                                </div>
                                                <div
                                                    style="padding-bottom: 8px"
                                                >
                                                    <input
                                                        type="radio"
                                                        id="removeSave"
                                                        value="removeSave"
                                                        v-model="picked"
                                                        @change="changeRadioBtn"
                                                    />
                                                    <label for="removeSave"
                                                        >Lưu trữ</label
                                                    >
                                                </div>
                                                <div
                                                    style="padding-bottom: 8px"
                                                >
                                                    <input
                                                        type="tex"
                                                        class="form-control"
                                                        id="ly_do"
                                                        v-model="ly_do"
                                                        placeholder="Lý do"
                                                        :disabled="
                                                            disabledRemove
                                                        "
                                                    />
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button
                                                    type="button"
                                                    class="btn btn-secondary"
                                                    @click="showModal = false"
                                                >
                                                    Đóng
                                                </button>
                                                <button
                                                    type="button"
                                                    class="btn btn-primary"
                                                    @click="
                                                        deleteData(removeID)
                                                    "
                                                >
                                                    Xóa dữ liệu
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </transition>
                    </div>
                </div>

                <div v-if="showModalSuccess">
                    <transition name="modal">
                        <div class="modal-mask">
                            <div class="modal-wrapper">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">
                                                Thông báo
                                            </h5>
                                            <button
                                                type="button"
                                                class="close"
                                                data-dismiss="modal"
                                                aria-label="Close"
                                            >
                                                <span
                                                    aria-hidden="true"
                                                    @click="
                                                        showModalSuccess = false
                                                    "
                                                    >&times;</span
                                                >
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Xóa dữ liệu thành công</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button
                                                type="button"
                                                class="btn btn-secondary"
                                                @click="
                                                    showModalSuccess = false
                                                "
                                            >
                                                Đóng
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </transition>
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
            showModal: false,
            picked: "removeAll",
            ly_do: null,
            disabledRemove: true,
            showModalSuccess: false,
            removeID: 0,
            dataGet: null,
            rolte: null,
            _token: null,
            id: null,
            totalProduct: 0,
            totalProductInMonth: 0,
            search: "",
            arrSearch: [],
            month: 0,
            year: 0,
            setStatusLoadData: 0,
            valueProductChange: "ma_so_seri",
        };
    },
    async created() {
        if (localStorage.getItem("_token") == null) {
            window.location.href = "/";
        } else {
            var _token = window.atob(localStorage.getItem("_token"));
            this.role = window.atob(localStorage.getItem("_token")).slice(0, 1);
            this.id = this.$route.params.id;
            const d = new Date();
            this.month = d.getMonth() + 1;
            this.year = d.getFullYear();
            console.log(_token);
            if (this.role == 2) {
                this.$router.push({ path: "/order" });
            } else {
                await axios.get("sanctum/csrf-cookie");
                await axios
                    .get(`/api/get-data-ware-house/${this.$route.params.id}`)
                    .then((result) => {
                        this.dataResposed = result.data.data.data;
                        this.last_page = result.data.data.last_page;
                        console.log(this.dataResposed);
                        axios
                            .get(
                                `/api/get-sum-ware-house/${
                                    this.$route.params.id
                                }/${
                                    this.year +
                                    "-" +
                                    ("0" + this.month).slice(-2)
                                }`
                            )
                            .then((result) => {
                                this.totalProduct = result.data.data[0].total;
                                this.totalProductInMonth =
                                    result.data.data[1].total;
                                this.setStatusLoadData = 0;
                            })
                            .catch((err) => {
                                alert(err.status);
                            });
                    })
                    .catch((err) => {
                        console.log(err.status);
                    });
            }
        }
    },
    methods: {
        async changePage(page) {
            let route = "";
            if (this.search.length != 0) {
                route = `search-data-ware-house`;
                let month = "";
                if (this.setStatusLoadData == 1) {
                    month = this.year + "-" + ("0" + this.month).slice(-2);
                } else {
                    month = "2022";
                }
                await axios
                    .post(`/api/${route}?page=` + page, {
                        id: this.id,
                        column: this.valueProductChange,
                        dataSearch: this.search,
                        month: month,
                    })
                    .then((result) => {
                        if (result.data.status_code == 200) {
                            this.arrSearch = result.data.data.data;
                        } else {
                            alert("Lỗi: " + result.data.status_code);
                        }
                    })
                    .catch((err) => {
                        alert("Có lỗi xảy ra trong quá trình lấy dữ liệu");
                    });
            } else {
                if (this.setStatusLoadData === 0) {
                    route = `get-data-ware-house/${this.id}`;
                } else if (this.setStatusLoadData === 1) {
                    let date = this.year + "-" + ("0" + this.month).slice(-2);
                    route = `get-data-count-ware-house/${this.id}/${date}`;
                }
                await axios
                    .get(`/api/${route}?page=` + page)
                    .then((result) => {
                        this.dataResposed = result.data.data.data;
                    })
                    .catch((err) => {
                        console.log(err.status);
                    });
            }
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
            console.log(event);
            console.log(this.picked);
            if (this.picked == "removeAll") {
                await axios
                    .post("/api/delete-data-ware-house", {
                        id: event,
                    })
                    .then((result) => {
                        if (result.data.status_code == 200) {
                            this.showModalSuccess = true;
                            this.showModal = false;
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
            } else {
                await axios
                    .post("/api/insert-data-storage-remove", {
                        id_quan_ly_giao: this.dataGet.id_quan_ly_giao,
                        storage_seri: this.dataGet.storage_seri,
                        storage_ten_san_pham: this.dataGet.storage_ten_san_pham,
                        storage_nha_cung_cap: this.dataGet.storage_nha_cung_cap,
                        storage_gia_nhap: this.dataGet.storage_gia_nhap,
                        storage_ly_do_tra_hang: this.ly_do,
                    })
                    .then((result) => {
                        if (result.data.status_code == 200) {
                            this.showModalSuccess = true;
                            this.showModal = false;
                            axios
                                .post("/api/delete-data-ware-house", {
                                    id: event,
                                })
                                .then((result) => {
                                    if (result.data.status_code == 200) {
                                        this.showModalSuccess = true;
                                        this.showModal = false;
                                        axios
                                            .get("/api/get-data-ware-house")
                                            .then((result) => {
                                                this.dataResposed =
                                                    result.data.data.data;

                                                console.log(
                                                    result.data.data.data
                                                );

                                                this.last_page =
                                                    result.data.data.last_page;
                                            })
                                            .catch((err) => {
                                                console.log(err.status);
                                            });
                                    } else {
                                        alert(
                                            "Xoá dữ liệu thất bại vui lòng thử lại sau."
                                        );
                                    }
                                })
                                .catch((err) => {
                                    alert(
                                        "Xoá dữ liệu thất bại vui lòng thử lại sau."
                                    );
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

        changeRadioBtn() {
            if (this.picked == "removeAll") {
                this.disabledRemove = true;
            } else {
                this.disabledRemove = false;
            }
        },

        async filteredProducts() {
            if (this.search.length != 0) {
                this.postSearch();
                // this.arrSearch = this.dataResposed.filter(
                //     (p) =>
                //         p.ten_san_pham
                //             .toLowerCase()
                //             .indexOf(this.search.toLowerCase()) != -1
                // );
            } else {
                this.arrSearch = [];
                this.setStatusLoadData = 0;
            }

            console.log(this.arrSearch.length);
        },

        async postSearch() {
            let month = "";
            if (this.setStatusLoadData == 1) {
                month = this.year + "-" + ("0" + this.month).slice(-2);
            } else {
                month = "2022";
            }
            await axios
                .post("/api/search-data-ware-house", {
                    id: this.id,
                    column: this.valueProductChange,
                    dataSearch: this.search,
                    month: month,
                })
                .then((result) => {
                    if (result.data.status_code == 200) {
                        this.arrSearch = result.data.data.data;
                    } else {
                        alert("Lỗi: " + result.data.status_code);
                    }
                })
                .catch((err) => {
                    alert("Có lỗi xảy ra trong quá trình lấy dữ liệu");
                });
        },

        async selectDataChange(e) {
            this.month = e.target.value;
            let date = this.year + "-" + ("0" + e.target.value).slice(-2);
            this.setStatusLoadData = 1;
            if (this.search.length != 0) {
                this.postSearch();
            } else {
                await axios
                    .get(`/api/get-sum-ware-house/${this.id}/${date}`)
                    .then((result) => {
                        this.totalProduct = result.data.data[0].total;
                        this.totalProductInMonth = result.data.data[1].total;
                        axios
                            .get(
                                `/api/get-data-count-ware-house/${this.id}/${date}`
                            )
                            .then((result) => {
                                this.arrSearch = [];
                                this.dataResposed = result.data.data.data;
                                this.last_page = result.data.data.last_page;
                            })
                            .catch((err) => {
                                alert(err.status);
                            });
                    })
                    .catch((err) => {
                        alert(err.status);
                    });
            }
        },

        selectProductChange(e) {
            this.valueProductChange = e.target.value;
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

.modal-mask {
    position: fixed;
    z-index: 9998;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    display: table;
    transition: opacity 0.3s ease;
}

.modal-wrapper {
    display: table-cell;
    vertical-align: middle;
}

.block {
    text-align: center;
    background-color: #ffff;
    box-shadow: rgb(149 157 165 / 20%) 0px 8px 24px;
    padding-top: 1rem;
    padding-bottom: 1rem;
}

.custom-row-analyst {
    padding: 16px;
}
.head-analyst {
    color: #ea0a2a;
}
</style>
