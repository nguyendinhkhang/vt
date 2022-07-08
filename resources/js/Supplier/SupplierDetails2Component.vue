<template>
    <div id="app">
        <nav-component></nav-component>
        <div class="container-fluid">
            <div class="row">
                <menu-left></menu-left>

                <div class="col-sm-10 custom-table">
                    <table class="table table-borderless">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Seri</th>
                                <th scope="col">Nhà cung cấp</th>
                                <th scope="col">Tên sản phẩm</th>
                                <th scope="col">Giá nhập</th>
                                <th scope="col">Trạng thái nhập kho</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr
                                v-for="(data, index) in dataResposed"
                                :key="'data_kho_' + index"
                            >
                                <th scope="row">{{ index + 1 }}</th>
                                <td>{{ data.ma_so_seri }}</td>
                                <td>{{ data.nha_cung_cap }}</td>
                                <td>{{ data.ten_san_pham }}</td>
                                <td>{{ data.gia_nhap }}</td>
                                <td>
                                    <p v-if="data.trang_thai_nhap_kho == 1">
                                        hàng chưa về
                                    </p>
                                    <p v-if="data.trang_thai_nhap_kho == 0">
                                        hàng đã nhập kho
                                    </p>
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
            showModal: false,
            picked: "removeAll",
            ly_do: null,
            disabledRemove: true,
            showModalSuccess: false,
            removeID: 0,
            dataGet: null,
        };
    },
    async created() {
        console.log("?");
        this.name_phieu_nhap = window.atob(
            localStorage.getItem("data_name_phieu_nhap")
        );
        await axios
            .get(`/api/get-san-pham-theo-phieu-nhap/${this.name_phieu_nhap}`)
            .then((result) => {
                this.dataResposed = result.data.data.data;
                this.last_page = result.data.data.last_page;
                console.log(result.data.data.data);
            })
            .catch((err) => {
                console.log(err.status);
            });
    },
    methods: {
        async changePage(page) {
            await axios
                .get(
                    `/api/get-san-pham-theo-phieu-nhap/${this.name_phieu_nhap}?page=` +
                        page
                )
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

        // change_responsible() {
        //     this.change_user_responsible = false;
        // },

        // async deleteData(event) {
        //     console.log(event);
        //     await axios
        //         .post("/api/delete-data-nha-cung-cap", {
        //             id_supplier: event,
        //         })
        //         .then((result) => {
        //             if (result.data.status_code == 200) {
        //                 this.showModalSuccess = true;
        //                 this.showModal = false;
        //                 axios
        //                     .get("/api/get-nha-cung-cap")
        //                     .then((result) => {
        //                         this.dataResposed = result.data.data.data;
        //                         this.last_page = result.data.data.last_page;
        //                     })
        //                     .catch((err) => {
        //                         console.log(err.status);
        //                     });
        //             } else {
        //                 alert("Xoá dữ liệu thất bại vui lòng thử lại sau.");
        //             }
        //         })
        //         .catch((err) => {
        //             alert("Xoá dữ liệu thất bại vui lòng thử lại sau.");
        //         });
        // },

        // getDataXuat() {
        //     console.log("hi");
        // },

        // changeRadioBtn() {
        //     if (this.picked == "removeAll") {
        //         this.disabledRemove = true;
        //     } else {
        //         this.disabledRemove = false;
        //     }
        // },

        // getDeatails(data) {
        //     console.log(data);
        //     localStorage.setItem(
        //         "data_name_phieu_nhap",
        //         window.btoa(data.name_phieu_nhap)
        //     );
        //     this.$router.push({ path: "/supplier/detail" });
        //     // this.$router.push({ path: "/home" });
        //     // if (this.picked == "removeAll") {
        //     //     this.disabledRemove = true;
        //     // } else {
        //     //     this.disabledRemove = false;
        //     // }
        // },
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
