<template>
    <div id="app">
        <nav-component></nav-component>
        <div class="container-fluid">
            <div class="row">
                <menu-left></menu-left>

                <div class="col-sm-10 custom-table">
                    <div class="pb-2 custom-location-btn">
                        <!-- <router-link
                            class="btn w-25 btn-custom-center"
                            to="/supplier/create-supplier"
                        >
                            Thêm mới loại sản phẩm
                        </router-link> -->
                        <a
                            class="btn w-25 btn-custom-center"
                            @click="showModalAdd = true"
                            >Thêm mới loại sản phẩm</a
                        >
                    </div>

                    <div
                        class="alert alert-info"
                        role="alert"
                        style="text-align: center"
                    >
                        Nhà cung cấp: {{ this.nhaCungCap }}
                    </div>

                    <table class="table table-borderless">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col text-center-custom">
                                  Doanh số áp
                                </th>
                                <th scope="col text-center-custom">
                                    Doanh số đạt được
                                </th>

                                <th scope="col text-center-custom">
                                    Doanh số còn lại
                                </th>

                                <th scope="col text-center-custom">
                                   Số lượng áp
                                </th>

                                <th scope="col text-center-custom">
                                   Số lượng đạt được
                                </th>

                                <th scope="col text-center-custom">
                                   Số lượng còn lại
                                </th>

                                <th scope="col text-center-custom">
                                   Nhập sản phẩm về nhiều nhất
                                </th>

                                <th scope="col text-center-custom">
                                   Nhập sản phẩm về ít nhất
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr
                                v-for="(data, index) in dataResposed"
                                :key="'data_kho_' + index"
                            >
                                <!-- <th scope="row">{{ index + 1 }}</th> -->
                                <!-- <td>{{ data.nha_cung_cap }}</td> -->
                                <!-- <td>{{ data.name_phieu_nhap }}</td> -->
                                
                                <!-- <td>
                                    <a
                                        class="btn btn-light"
                                        @click="
                                            getDetailsSupplier(
                                                data.name_phieu_nhap
                                            )
                                        "
                                        >{{ data.name_phieu_nhap }}</a
                                    >
                                </td>
                                <td>{{ data.updated_at.slice(0, -9) }}</td>
                                <td
                                    v-if="
                                        data.tuoi_cong_no === null ||
                                        data.tuoi_cong_no.length == 0
                                    "
                                >
                                    <p
                                        v-if="data.id_kho_hang"
                                        @click="changeDataAge(data.id_kho_hang)"
                                    >
                                        Nhập tuổi công nợ
                                    </p>

                                    <date-picker
                                        v-if="!data.id_kho_hang"
                                        v-model="tuoi_cong_no"
                                        :default-value="new Date()"
                                        value-type="format"
                                        format="YYYY-MM-DD"
                                    ></date-picker>

                                    <button
                                        v-if="!data.id_kho_hang"
                                        type="button"
                                        class="btn btn-success"
                                        @click="saveData(data.id_kho_hang)"
                                    >
                                        Hoàn tất
                                    </button>

                                    <button
                                        v-if="!data.id_kho_hang"
                                        type="button"
                                        class="btn btn-danger"
                                        @click="closeDataAge(data.id_kho_hang)"
                                    >
                                        Hủy
                                    </button>
                                </td>
                                <td
                                    v-if="
                                        data.tuoi_cong_no !== null ||
                                        data.tuoi_cong_no.length > 0
                                    "
                                >
                                    <p
                                        v-if="data.id_kho_hang"
                                        @click="changeDataAge(data.id_kho_hang)"
                                    >
                                        {{ data.tuoi_cong_no }}
                                    </p>
                                </td> -->
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

                    <div v-if="showModalAdd">
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
                                                            showModalAdd = false
                                                        "
                                                        >&times;</span
                                                    >
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Sản phẩm nhà cung cấp</p>
                                                <div
                                                    style="padding-bottom: 8px"
                                                >
                                                    <input
                                                        type="text"
                                                        id="sanPhamCungCap"
                                                        class="form-control w-100"
                                                        v-model="sanPhamCungCap"
                                                    />
                                                </div>
                                            </div>

                                            <div class="modal-footer">
                                                <button
                                                    type="button"
                                                    class="btn btn-primary"
                                                    @click="
                                                        createDataSupplier()
                                                    "
                                                >
                                                    Thêm mới
                                                </button>
                                                <button
                                                    type="button"
                                                    class="btn btn-secondary"
                                                    @click="
                                                        showModalAdd = false
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

                    <div v-if="showDetailsData">
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
                                                            showDetailsData = false
                                                        "
                                                        >&times;</span
                                                    >
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <table
                                                    class="table table-borderless"
                                                >
                                                    <thead class="thead-dark">
                                                        <tr>
                                                            <th
                                                                scope="col text-center-custom"
                                                            >
                                                                ID
                                                            </th>
                                                            <th
                                                                scope="col text-center-custom"
                                                            >
                                                                Tên Sản Phẩm
                                                            </th>

                                                            <th
                                                                scope="col text-center-custom"
                                                            >
                                                                Trạng thái nhập
                                                                kho
                                                            </th>

                                                            <th
                                                                scope="col text-center-custom"
                                                            >
                                                                Ngày nhập
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr
                                                            v-for="(
                                                                data, index
                                                            ) in dataDetails"
                                                            :key="
                                                                'data_dataDetails_' +
                                                                index
                                                            "
                                                        >
                                                            <th scope="row">
                                                                {{ index + 1 }}
                                                            </th>
                                                            <td>
                                                                {{
                                                                    data.ten_san_pham
                                                                }}
                                                            </td>
                                                            <td>
                                                                <p
                                                                    v-if="
                                                                        data.trang_thai_nhap_kho ==
                                                                        1
                                                                    "
                                                                >
                                                                    hàng chưa
                                                                    nhập kho
                                                                </p>
                                                                <p
                                                                    v-if="
                                                                        data.trang_thai_nhap_kho ==
                                                                        0
                                                                    "
                                                                >
                                                                    hàng đã nhập
                                                                    kho
                                                                </p>
                                                            </td>
                                                            <td>
                                                                {{
                                                                    data.created_at.slice(
                                                                        0,
                                                                        -9
                                                                    )
                                                                }}
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>

                                            <div class="modal-footer">
                                                <button
                                                    type="button"
                                                    class="btn btn-success"
                                                    @click="
                                                        showDetailsData = false
                                                    "
                                                >
                                                    Hoàn tất phiếu nhập
                                                </button>
                                                <button
                                                    type="button"
                                                    class="btn btn-secondary"
                                                    @click="
                                                        showDetailsData = false
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
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import DatePicker from "vue2-datepicker";
import "vue2-datepicker/index.css";
import "vue2-datepicker/locale/vi";
export default {
    components: { DatePicker },
    data() {
        return {
            dataResposed: null,
            first_page: 1,
            last_page: null,
            change_page: 1,
            showModalAdd: false,
            sanPhamCungCap: null,
            showModal: false,
            showModalSuccess: false,
            dataIdUpdate: 0,
            nhaCungCap: null,
            showDetailsData: false,
            dataDetails: null,
            dataIdUpdate: null,
            tuoi_cong_no: null,
        };
    },
    async created() {
        console.log(window.atob(localStorage.getItem("datePhieuNhapSupplier")));
        this.nhaCungCap = window.atob(localStorage.getItem("nameDataSupplier"));
        let dataDateNhaCungCap =
            window.atob(localStorage.getItem("nameDataSupplier")) +
            "-" +
            window.atob(localStorage.getItem("datePhieuNhapSupplier"));

        console.log(dataDateNhaCungCap);
        if (localStorage.getItem("_token") == null) {
            window.location.href = "/";
        } else {
            await axios
                .get(
                    `/api/get-data-by-supplier/${this.$route.params.name}/${dataDateNhaCungCap}`
                )
                .then((result) => {
                    this.dataResposed = result.data.data.data;
                    console.log(result.data.data.data);
                    this.last_page = result.data.data.last_page;
                })
                .catch((ereer) => {
                    console.log(err.status);
                });
        }
    },
    methods: {
        async changePage(page) {
            await axios
                .get(
                    `/api/get-data-by-supplier/${this.$route.params.name}?page=` +
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
                            .get(
                                `/api/get-nha-cung-cap/${this.$route.params.name}`
                            )
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

        async createDataSupplier() {
            console.log(this.sanPhamCungCap);
            await axios
                .post("/api/create-san-pham-nha-cung-cap", {
                    ten_nha_cung_cap: this.$route.params.name,
                    san_pham_cung_cap: this.sanPhamCungCap,
                })
                .then((result) => {
                    if (result.data.status_code == 200) {
                        alert("Thêm dữ liệu thành công");
                        axios
                            .get(
                                `/api/get-nha-cung-cap/${this.$route.params.name}`
                            )
                            .then((result) => {
                                this.dataResposed = result.data.data.data;
                                this.last_page = result.data.data.last_page;
                            })
                            .catch((err) => {
                                console.log(err.status);
                            });
                        // this.$router.go(this.$router.currentRoute);
                    } else {
                        alert("Có lỗi trong quá trình xử lý dữ liệu");
                    }
                })
                .catch((err) => {
                    alert("Có lỗi trong quá trình xử lý dữ liệu - 2");
                });
        },

        updateDataSupplier(e) {
            this.dataIdUpdate = e;
            this.dataResposed.map((data) => {
                if (e == data.id_supplier) {
                    data.id_supplier = !!!data.id_supplier;
                }
            });
        },

        async saveDataSupplier(e) {
            console.log(e);
            await axios
                .post("/api/update-san-pham-cung-cap", {
                    id_supplier: this.dataIdUpdate,
                    nha_cung_cap: e.san_pham_cung_cap,
                    ten_nha_cung_cap: this.$route.params.name,
                })
                .then((result) => {
                    if (result.data.status_code == 200) {
                        alert("Chúc mừng bạn đã cập nhật thành công.");
                        this.dataResposed.map((data) => {
                            if (e.id_supplier == data.id_supplier) {
                                data.id_supplier = !!!data.id_supplier;
                            }
                        });
                    } else {
                        alert("Error: ");
                    }
                })
                .catch((err) => {
                    alert("Error: " + err);
                });
        },

        async getDetailsSupplier(e) {
            console.log(e);
            this.showDetailsData = true;
            await axios
                .get(`/api/get-phieu-nhap-when-name/${e}`)
                .then((result) => {
                    this.dataDetails = result.data.data;
                    console.log(this.dataDetails);
                    // this.last_page = result.data.data.last_page;
                })
                .catch((ereer) => {
                    console.log(err.status);
                });
        },

        changeDataAge(e) {
            this.dataIdUpdate = e;
            this.dataResposed.map((data) => {
                if (e == data.id_kho_hang) {
                    data.id_kho_hang = !!!data.id_kho_hang;
                }
            });
            console.log("?");
        },

        closeDataAge(e) {
            this.dataIdUpdate = e;
            this.dataResposed.map((data) => {
                if (e == data.id_kho_hang) {
                    data.id_kho_hang = !!!data.id_kho_hang;
                }
            });
        },

        async saveData(data) {
            console.log(data);
            // try {
            //   const response = await axios.post(
            //     '/update-cong-no',
            //     {
            //       tuoi_cong_no: data.tuoi_cong_no,
            //       id_kho_hang: data.id_kho_hang
            //     }
            //   )
            //   console.log(response)
            // } catch (err) {
            //   console.log(err);
            // }
        },
    },
};
</script>
