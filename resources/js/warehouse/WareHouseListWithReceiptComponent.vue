<template>
    <div id="app">
        <nav-component></nav-component>
        <div class="container-fluid">
            <div class="row">
                <menu-left></menu-left>

                <div class="col-sm-10 custom-table">
                    <!-- <div class="pb-2 custom-location-btn">
                        <input
                            type="text"
                            v-model="search"
                            placeholder="Search"
                            class="form-control btn-custom-center w-25"
                            v-on:input="filteredProducts"
                        />
                    </div> -->
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
                                    Nhà cung cấp
                                </th>
                                <th scope="col text-center-custom">Giá nhập</th>
                                <!-- <th scope="col text-center-custom">Giá bán</th> -->
                                <th scope="col text-center-custom">Kho hàng</th>
                                <th scope="col text-center-custom">
                                    Trạng thái
                                </th>
                                <th scope="col text-center-custom">
                                    Hành động
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr
                                v-for="(data, index) in dataResposed"
                                :key="'data_kho_' + index"
                            >
                                <th scope="row">{{ index + 1 }}</th>
                                <td v-if="data.id_kho_hang">
                                    <a @click="showDataSeri(data)">{{
                                        data.ma_so_seri
                                    }}</a>
                                </td>
                                <td v-if="!data.id_kho_hang">
                                    <div style="display: flex">
                                        <input
                                            type="text"
                                            id="createSupplierHouse"
                                            class="form-control w-75"
                                            style="margin-right: 15px"
                                            v-model="data.ma_so_seri"
                                        />
                                        <a
                                            v-if="!data.id"
                                            class="btn btn-success"
                                            @click="updateDataSeri(data)"
                                            >Lưu</a
                                        >
                                    </div>
                                </td>
                                <td>{{ data.ten_san_pham }}</td>
                                <td>{{ data.nha_cung_cap }}</td>
                                <td>{{ data.gia_nhap }}</td>
                                <td>{{ data.kho_hang }}</td>
                                <td>
                                    {{
                                        data.trang_thai_hang_tang == 1
                                            ? "Hàng nhập"
                                            : "Hàng tặng"
                                    }}
                                </td>

                                <td>
                                    <a
                                        v-if="data.trang_thai_nhap_kho == 1"
                                        class="btn btn-danger"
                                        @click="
                                            setDataHangNhap(data.id_kho_hang)
                                        "
                                        >Hàng về</a
                                    >
                                    <p v-if="data.trang_thai_nhap_kho == 0">
                                        Hàng đã nhập kho
                                    </p>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <!-- <nav aria-label="Page navigation example">
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
                    </nav> -->
                    <div v-if="showModalSetAnalytics">
                        <transition name="modal">
                            <div class="modal-mask">
                                <div class="modal-wrapper">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">
                                                    Lựa chọn trạng thái
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
                                                            showModalSetAnalytics = false
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
                                                        id="paid"
                                                        value="paid"
                                                        v-model="picked"
                                                        @change="changeRadioBtn"
                                                    />
                                                    <label for="paid"
                                                        >Đã thanh toán</label
                                                    >
                                                </div>
                                                <div
                                                    style="padding-bottom: 8px"
                                                >
                                                    <input
                                                        type="radio"
                                                        id="unPaid"
                                                        value="unPaid"
                                                        v-model="picked"
                                                        @change="changeRadioBtn"
                                                    />
                                                    <label for="unPaid"
                                                        >Chưa thanh toán</label
                                                    >
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button
                                                    type="button"
                                                    class="btn btn-success"
                                                    @click="chooseReceipt()"
                                                >
                                                    Xác nhận
                                                </button>
                                                <button
                                                    type="button"
                                                    class="btn btn-secondary"
                                                    @click="
                                                        showModalSetAnalytics = false
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
            tls_id_kho: null,
            name_phieu_nhap: null,
            showModalSetAnalytics: false,
            picked: "paid",
            statusPaid: true,
            statusUnPaid: false,
            dataIdHangNhap: null,
            idDemDataPhieuNhap: null,
            // sttusUpdate: true,
            countDataWareHosue: 0,
            dataIdUpdate: null,
        };
    },
    async created() {
        this.tls_id_kho = window.atob(localStorage.getItem("tls_id_kho"));
        this.name_phieu_nhap = window.atob(
            localStorage.getItem("name_phieu_nhap")
        );
        this.idDemDataPhieuNhap = window.atob(
            localStorage.getItem("id_data_phieu_nhap")
        );

        console.log(this.tls_id_kho);
        console.log(this.name_phieu_nhap);
        console.log(this.idDemDataPhieuNhap);

        await axios
            .get(
                `/api/get-phieu-nhap-when-id-phieu-nhap/${this.name_phieu_nhap}/${this.tls_id_kho}`
            )
            .then((result) => {
                this.dataResposed = result.data.data;
                result.data.data.forEach((element) => {
                    if (element.trang_thai_nhap_kho == 0) {
                        this.countDataWareHosue = this.countDataWareHosue + 1;
                    }
                });
                console.log(this.dataResposed);
            })
            .catch((err) => {
                alert(err.status);
            });
        // }

        // update-trang-thai-nhap-kho
    },
    methods: {
        async chooseReceipt() {
            // this.sttusUpdate = true;
            var statusPaid = 1;
            if (this.statusPaid) {
                statusPaid = 0;
            } else {
                statusPaid = 1;
            }

            await axios
                .post("/api/update-status-paid", {
                    id: this.dataIdHangNhap,
                    trang_thai_thanh_toan: statusPaid,
                    trang_thai_nhap_kho: 0,
                })
                .then((result) => {
                    if (result.data.status_code == 200) {
                        // if (this.sttusUpdate) {
                        axios
                            .post("/api/update-trang-thai-nhap-kho", {
                                id: this.idDemDataPhieuNhap,
                            })
                            .then((result) => {
                                if (result.data.status_code == 200) {
                                    this.countDataWareHosue =
                                        this.countDataWareHosue + 1;

                                    if (
                                        this.countDataWareHosue ==
                                        this.dataResposed.length
                                    ) {
                                        axios
                                            .post(
                                                "/api/success-trang-thai-nhap-kho",
                                                {
                                                    id: this.idDemDataPhieuNhap,
                                                }
                                            )
                                            .then((result) => {})
                                            .catch((err) => {
                                                alert(
                                                    "Có vấn đề đã xảy ra, xin vui lòng thử lại sau."
                                                );
                                            });
                                    }

                                    // this.sttusUpdate = false;
                                    this.showModalSetAnalytics = false;
                                } else {
                                    alert(
                                        "Có vấn đề đã xảy ra, xin vui lòng thử lại sau."
                                    );
                                }
                            })
                            .catch((err) => {
                                alert(
                                    "Có vấn đề đã xảy ra, xin vui lòng thử lại sau."
                                );
                            });
                        // }
                        alert("Chúc mừng bạn đã cập nhật thành công.");
                        // this.$router.push({ path: "/home" });
                    } else {
                        alert("Error: ");
                    }
                })
                .catch((err) => {
                    alert("Error: " + err);
                });
        },

        changeRadioBtn() {
            if (this.picked == "paid") {
                this.statusPaid = true;
                this.statusUnPaid = false;
            } else {
                this.statusUnPaid = true;
                this.statusPaid = false;
            }
        },

        setDataHangNhap(e) {
            this.showModalSetAnalytics = true;
            this.dataIdHangNhap = e;

            console.log(this.dataIdHangNhap);
        },

        showDataSeri(e) {
            if (e.trang_thai_nhap_kho != 0) {
                this.dataIdUpdate = e.id_kho_hang;
                this.dataResposed.map((data) => {
                    if (e.id_kho_hang == data.id_kho_hang) {
                        data.id_kho_hang = !!!data.id_kho_hang;
                    }
                });
            }
        },

        async updateDataSeri(e) {
            // $id_kho_hang, $seri
            await axios
                .post("/api/update-seri", {
                    id_kho_hang: this.dataIdUpdate,
                    seri: e.ma_so_seri,
                })
                .then((result) => {
                    if (result.data.status_code == 200) {
                        this.dataResposed.map((data) => {
                            if (e.id_kho_hang == data.id_kho_hang) {
                                data.id_kho_hang = !!!data.id_kho_hang;
                            }
                        });
                        // alert("Chúc mừng bạn đã cập nhật thành công.");
                    } else {
                        alert("Có vấn đề đã xảy ra, xin vui lòng thử lại sau.");
                    }
                })
                .catch((err) => {
                    alert("Có vấn đề đã xảy ra, xin vui lòng thử lại sau.");
                });

            console.log("hihi");
            // if (e.trang_thai_nhap_kho != 0) {
            //     this.dataIdUpdate = e.id_kho_hang;

            console.log(e);
            // }
        },
    },
};
</script>
