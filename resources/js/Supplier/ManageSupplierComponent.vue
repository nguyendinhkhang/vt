<template>
    <div id="app">
        <nav-component></nav-component>
        <div class="container-fluid">
            <div class="row">
                <menu-left></menu-left>

                <div class="col-sm-3 custom-table">
                    <!-- <div class="pb-2 custom-location-btn"> -->
                    <!-- <router-link
                            class="btn w-25 btn-custom-center"
                            to="/supplier/create-supplier"
                        >
                            Thêm mới
                        </router-link> -->
                    <!-- </div> -->
                    <table class="table table-borderless">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col text-center-custom">ID</th>
                                <th scope="col text-center-custom">
                                    Tên phiếu nhập
                                </th>
                                <!-- <th scope="col text-center-custom">
                                    Tên nhà cung cấp
                                </th>
                                <th scope="col text-center-custom">Kho hàng</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <tr
                                v-for="(data, index) in dataResposed"
                                :key="'data_kho_' + index"
                            >
                                <th scope="row">{{ index + 1 }}</th>
                                <td>
                                    <a
                                        @click="
                                            getDeatails(data.name_phieu_nhap)
                                        "
                                        >{{ data.name_phieu_nhap }}</a
                                    >
                                </td>
                                <!-- <td>{{ data.nha_cung_cap }}</td>
                                <td>{{ data.kho_hang }}</td> -->
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
                                                <h6>
                                                    Bạn có chắc chắn muốn xóa dữ
                                                    liệu này
                                                </h6>
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

                <div class="col-sm-2 custom-table">
                    <table class="table table-borderless">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col text-center-custom">
                                    Lựa chọn kho hàng
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <Dropdown
                                        class="form-control dropdown-css w-100"
                                        name="subject"
                                        v-on:selected="dataSelectedsNhaCungCap"
                                        :options="optionsWareHouse"
                                        :value="{
                                            id: optionsWareHouse.id,
                                            text: optionsWareHouse.name,
                                        }"
                                        placeholder="Lựa chọn nhà cung cấp"
                                        autocomplete="off"
                                    >
                                    </Dropdown>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="col-sm-4 custom-table">
                    <table class="table table-borderless">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col text-center-custom">ID</th>
                                <th scope="col text-center-custom">
                                    Tên sản phẩm
                                </th>
                                <th scope="col text-center-custom">
                                    Nhà cung cấp
                                </th>
                                <th scope="col text-center-custom">
                                    Trạng thái nhập kho
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr
                                v-for="(data, index) in dataResultProduct"
                                :key="'data_kho_' + index"
                            >
                                <th scope="row">{{ index + 1 }}</th>
                                <td>{{ data.ten_san_pham }}</td>
                                <td>{{ data.nha_cung_cap }}</td>
                                <td>
                                    <p v-if="data.trang_thai_nhap_kho == 1">
                                        hàng chưa về kho
                                    </p>
                                    <p v-if="data.trang_thai_nhap_kho == 0">
                                        hàng đã nhập kho
                                    </p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
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
            dataDetail: [],
            optionsWareHouse: [],
            dataResultProduct: [],
            forloop: 0,
        };
    },
    async created() {
        if (window.atob(localStorage.getItem("selectedDateSelect")) == "true") {
            var to = window.atob(localStorage.getItem("_to"));
            var from = window.atob(localStorage.getItem("_from"));
            await axios
                .get(`/api/get-data-nha-cung-cap/${to}/${from}`)
                .then((result) => {
                    this.dataResposed = result.data.data.data;
                    this.last_page = result.data.data.last_page;
                })
                .catch((err) => {
                    console.log(err.status);
                });
        }
        if (window.atob(localStorage.getItem("selectToProvider")) == "true") {
            // _nha_cung_cap
            console.log("???-2");
            var id = window.atob(localStorage.getItem("_nha_cung_cap"));
            console.log(id);

            await axios
                .get(`/api/get-data-by-supplier/${id}`)
                .then((result) => {
                    this.dataResposed = result.data.data.data;
                    this.last_page = result.data.data.last_page;
                })
                .catch((err) => {
                    console.log(err.status);
                });
        }
        if (window.atob(localStorage.getItem("selectWareHouse")) == "true") {
            // _kho_hang
            console.log("???-3");
            var id = window.atob(localStorage.getItem("_kho_hang"));
            await axios
                .get(`/api/get-data-by-ware-house/${id}`)
                .then((result) => {
                    this.dataResposed = result.data.data.data;
                    this.last_page = result.data.data.last_page;
                })
                .catch((err) => {
                    console.log(err.status);
                });
            // console.log("this here 3");
        }
    },
    methods: {
        async changePage(page) {
            console.log("lll");
            if (
                window.atob(localStorage.getItem("selectedDateSelect")) ==
                "true"
            ) {
                var to = window.atob(localStorage.getItem("_to"));
                var from = window.atob(localStorage.getItem("_from"));
                await axios
                    .get(
                        `/api/get-data-nha-cung-cap/${to}/${from}?page=` + page
                    )
                    .then((result) => {
                        this.dataResposed = result.data.data.data;
                    })
                    .catch((err) => {
                        console.log(err.status);
                    });
            }
            if (
                window.atob(localStorage.getItem("selectToProvider")) == "true"
            ) {
                var id = window.atob(localStorage.getItem("_nha_cung_cap"));
                await axios
                    .get(`/api/get-data-by-supplier/${id}?page=` + page)
                    .then((result) => {
                        this.dataResposed = result.data.data.data;
                    })
                    .catch((err) => {
                        console.log(err.status);
                    });
            }
            if (
                window.atob(localStorage.getItem("selectWareHouse")) == "true"
            ) {
                var id = window.atob(localStorage.getItem("_kho_hang"));
                await axios
                    .get(`/api/get-data-by-ware-house/${id}?page=` + page)
                    .then((result) => {
                        this.dataResposed = result.data.data.data;
                    })
                    .catch((err) => {
                        console.log(err.status);
                    });
            }

            // await axios
            //     .get("/api/get-nha-cung-cap?page=" + page)
            //     .then((result) => {
            //         this.dataResposed = result.data.data.data;
            //     })
            //     .catch((err) => {
            //         console.log(err.status);
            //     });
            // alert("?");
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
            await axios
                .post("/api/delete-data-nha-cung-cap", {
                    id_supplier: event,
                })
                .then((result) => {
                    if (result.data.status_code == 200) {
                        this.showModalSuccess = true;
                        this.showModal = false;
                        axios
                            .get("/api/get-nha-cung-cap")
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

        async getDeatails(e) {
            console.log(e);
            localStorage.setItem("data_name_phieu_nhap", window.btoa(e));
            await axios
                .get(`/api/get-detail-data-from-to/${e}`)
                .then((result) => {
                    this.dataDetail = result.data.data;

                    var dataR = { id: null, name: null };
                    var dataSelected = [];

                    this.dataDetail.map((item) => {
                        if (
                            dataSelected.find((object) => {
                                console.log(object);
                                if (object.kho_hang === item.kho_hang) {
                                    return true;
                                } else {
                                    return false;
                                }
                            })
                        ) {
                        } else {
                            dataSelected.push(item);
                        }
                    });

                    dataSelected.map((item) => {
                        dataR.id = item.id_kho_hang;
                        dataR.name = item.kho_hang;
                        this.optionsWareHouse.push({ ...dataR });
                    });

                    // console.log(this.optionsWareHouse);
                })
                .catch((err) => {
                    console.log(err.status);
                });
        },

        dataSelectedsNhaCungCap(e) {
            this.dataResultProduct = [];
            this.dataDetail.map((item) => {
                if (item.kho_hang === e.name) {
                    this.dataResultProduct.push({ ...item });
                }
            });
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
</style>
