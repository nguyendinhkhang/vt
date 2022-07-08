<template>
    <div id="app">
        <nav-component></nav-component>
        <div class="container-fluid">
            <div class="row">
                <menu-left></menu-left>

                <div class="col-sm-10 custom-table">
                    <div class="row">
                        <div class="col-sm-3">
                          <div class="custom-location-btn">
                                <a
                                    class="btn w-50 btn-custom-center"
                                    @click="showModalAdd = true"
                                >
                                    Thêm nhà cung cấp
                                </a>
                            </div>
                        </div>

                        <div class="col-sm-3">
                          <div class="custom-location-btn">
                                <a
                                    class="btn w-50 btn-custom-center"
                                >
                                    Áp doanh số
                                </a>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="custom-location-btn">
                                <a
                                    class="btn w-50 btn-custom-center"
                                    @click="historyPurcharse()"
                                >
                                    Lịch sử thanh toán công nợ
                                </a>
                            </div>
                        </div>

                        <div class="col-sm-3">
                          <div class="custom-location-btn">
                                <a
                                    class="btn w-50 btn-custom-center"
                                    @click="managePurcharse()"
                                >
                                    Quản lý công nợ
                                </a>
                            </div>
                        </div>
                    </div>
                    <div
                        style="
                            display: flex;
                            margin-top: 2rem;
                            margin-bottom: 1rem;
                            justify-content: center;
                            margin-top: 1rem;
                        "
                    >
                        <div style="width: 50%; text-align: end">
                            <select
                                name="month"
                                id="month"
                                class="pb-2 custom-location-btn"
                                style="
                                    margin-right: 10px;
                                    margin-left: 10px;
                                    width: 30%;
                                    border-radius: 8px;
                                    border: 1px;
                                    height: 2rem;
                                "
                                @change="selectDataChange($event)"
                            >
                                <option value="1" :selected="month === 1">
                                    Tháng 1
                                </option>
                                <option value="2" :selected="month === 2">
                                    Tháng 2
                                </option>
                                <option value="3" :selected="month === 3">
                                    Tháng 3
                                </option>
                                <option value="4" :selected="month === 4">
                                    Tháng 4
                                </option>
                                <option value="5" :selected="month === 5">
                                    Tháng 5
                                </option>
                                <option value="6" :selected="month === 6">
                                    Tháng 6
                                </option>
                                <option value="7" :selected="month === 7">
                                    Tháng 7
                                </option>
                                <option value="8" :selected="month === 8">
                                    Tháng 8
                                </option>
                                <option value="9" :selected="month === 9">
                                    Tháng 9
                                </option>
                                <option value="10" :selected="month === 10">
                                    Tháng 10
                                </option>
                                <option value="11" :selected="month === 11">
                                    Tháng 11
                                </option>
                                <option value="12" :selected="month === 12">
                                    Tháng 12
                                </option>
                            </select>
                        </div>
                        <div style="width: 50%">
                            <input
                                type="number"
                                min="2022"
                                max="2999"
                                step="1"
                                id="month"
                                class="form-control"
                                style="
                                    margin-right: 10px;
                                    margin-left: 10px;
                                    width: 30%;
                                    height: 2rem;
                                "
                                v-model="year"
                                @change="selectDataChange(0)"
                            />
                        </div>
                    </div>

                    <table class="table table-borderless">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col text-center-custom">
                                  ID
                                </th>
                                <th scope="col text-center-custom">
                                    Nhà cung cấp
                                </th>
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
                                    Công nợ nhà cung cấp
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr
                                v-for="(data, index) in getDataSupplier"
                                :key="'data_supplier_' + index"
                                :ref="`div-${data.id}`"
                            >
                                <th scope="row">
                                    {{ index + 1 }}
                                </th>
                                <td v-if="data.id">
                                    <a
                                        v-if="data.tuoi_cong_no === null"
                                        class="btn btn-light"
                                        @click="getDataWhenSupplier(data.name)"
                                        >{{ data.name }}</a
                                    >

                                    <span v-if="data.tuoi_cong_no !== null">
                                        <a
                                            class="btn btn-light"
                                            @click="
                                                getDataWhenSupplier(data.name)
                                            "
                                            ><span
                                                v-for="(st, index) in arrStyle"
                                                :key="'data_style_' + index"
                                            >
                                                <span
                                                    v-if="st.id == data.id"
                                                    v-bind:style="[
                                                        st.id == data.id
                                                            ? {
                                                                  color: st.style,
                                                                  margin: '0px',
                                                              }
                                                            : {
                                                                  color: 'black',
                                                                  margin: '0px',
                                                              },
                                                    ]"
                                                    >{{ data.name }}</span
                                                >
                                            </span></a
                                        >
                                    </span>
                                    <!-- style="color: red; margin: 0px" -->
                                </td>
                                <td v-if="!data.id">
                                    <input
                                        type="text"
                                        id="createSupplierHouse"
                                        class="form-control w-100"
                                        v-model="data.name"
                                    />
                                </td>
                                <td>
                                    {{ data.doanh_so_ap }}
                                </td>
                                <td>
                                    {{ data.doanh_dat_duoc }}
                                </td>
                                <td>
                                    {{ data.doanh_so_ap - data.doanh_dat_duoc }}
                                </td>
                                <td>
                                    {{ data.cong_no_nha_cung_cap }}
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
                                            <p>Thêm nhà cung cấp</p>
                                            <div style="padding-bottom: 8px">
                                                <input
                                                    type="text"
                                                    id="createSupplierHouse"
                                                    class="form-control w-100"
                                                    v-model="
                                                        createSupplierHouse
                                                    "
                                                />
                                            </div>

                                            
                                            <input
                                              class="form-check-input"
                                              type="radio"
                                              name="flexRadioDefault" id="inputDoanhSo"
                                              @change="disableInputSoLuongAp"
                                            >
                                            <label
                                                for="inputDoanhSo"
                                                >Áp theo doanh số</label
                                            >

                                            <br />

                                            <input
                                              class="form-check-input"
                                              type="radio"
                                              name="flexRadioDefault" id="inputSoLuong"
                                              @change="disableInputDoanhSoAp"
                                            >
                                            <label
                                                for="inputSoLuong"
                                                >Áp theo số lượng</label
                                            >

                                            <p>Doanh số áp</p>
                                            <div style="padding-bottom: 8px">
                                                <input
                                                    type="text"
                                                    id="doanhSoAp"
                                                    class="form-control w-100"
                                                    v-model="doanhSoAp"
                                                />
                                            </div>

                                            <p>Số lượng áp</p>
                                            <div style="padding-bottom: 8px">
                                                <input
                                                    type="text"
                                                    id="soLuongAp"
                                                    class="form-control w-100"
                                                    v-model="soLuongAp"
                                                />
                                            </div>

                                            <div style="display: flex">
                                                <div class="w-50">
                                                    <p
                                                        style="
                                                            margin-bottom: 8px !important;
                                                        "
                                                    >
                                                        Tháng
                                                    </p>
                                                    <div
                                                        style="
                                                            margin-right: 8px;
                                                        "
                                                    >
                                                        <input
                                                            type="number"
                                                            min="1"
                                                            max="12"
                                                            step="1"
                                                            id="month"
                                                            class="form-control w-100"
                                                            v-model="month"
                                                        />
                                                    </div>
                                                </div>

                                                <div class="w-50">
                                                    <p
                                                        style="
                                                            margin-bottom: 8px !important;
                                                        "
                                                    >
                                                        Năm
                                                    </p>
                                                    <div
                                                        style="
                                                            margin-right: 8px;
                                                        "
                                                    >
                                                        <input
                                                            type="number"
                                                            min="2022"
                                                            max="2999"
                                                            step="1"
                                                            id="year"
                                                            class="form-control w-100"
                                                            v-model="year"
                                                        />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            <button
                                                type="button"
                                                class="btn btn-primary"
                                                @click="createDataSupplier()"
                                            >
                                                Thêm mới
                                            </button>
                                            <button
                                                type="button"
                                                class="btn btn-secondary"
                                                @click="showModalAdd = false"
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

                <div v-if="showModalManageSupplier">
                    <transition name="modal">
                        <div class="modal-mask">
                            <div class="modal-wrapper">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">
                                                Quản lý nhà cung cấp
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
                                                        showModalManageSupplier = false
                                                    "
                                                    >&times;</span
                                                >
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div style="padding-bottom: 8px">
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
                                                                Tên nhà cung cấp
                                                            </th>
                                                            <th
                                                                scope="col text-center-custom"
                                                            >
                                                                Hành động
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr
                                                            v-for="(
                                                                data, index
                                                            ) in getDataSupplier"
                                                            :key="
                                                                'data_supplier_' +
                                                                index
                                                            "
                                                            :ref="`div-${data.id}`"
                                                        >
                                                            <th scope="row">
                                                                {{ index + 1 }}
                                                            </th>
                                                            <td v-if="data.id">
                                                                {{ data.name }}
                                                            </td>
                                                            <td v-if="!data.id">
                                                                <input
                                                                    type="text"
                                                                    id="createSupplierHouse"
                                                                    class="form-control w-100"
                                                                    v-model="
                                                                        data.name
                                                                    "
                                                                />
                                                            </td>
                                                            <td>
                                                                <a
                                                                    v-if="
                                                                        data.id
                                                                    "
                                                                    class="btn btn-secondary"
                                                                    @click="
                                                                        updateDataSupplier(
                                                                            data.id
                                                                        )
                                                                    "
                                                                    >Sửa</a
                                                                >
                                                                <a
                                                                    v-if="
                                                                        !data.id
                                                                    "
                                                                    class="btn btn-success"
                                                                    @click="
                                                                        saveDataSupplier(
                                                                            data
                                                                        )
                                                                    "
                                                                    >Lưu</a
                                                                >
                                                                <a
                                                                    class="btn btn-danger"
                                                                    @click="
                                                                        removeID =
                                                                            data.id
                                                                    "
                                                                    >Xoá</a
                                                                >
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            <button
                                                type="button"
                                                class="btn btn-secondary"
                                                @click="
                                                    showModalManageSupplier = false
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
            showModal: false,
            picked: "removeAll",
            ly_do: null,
            disabledRemove: true,
            showModalSuccess: false,
            removeID: 0,
            dataGet: null,
            showModalAdd: false,
            showModalManageSupplier: false,
            createSupplierHouse: null,
            getDataSupplier: null,
            showDataUpdate: "show",
            doanhSoAp: 0,
            soLuongAp: 0,
            dataIdUpdate: 0,
            month: 0,
            year: 0,
            oldMonth: 0,
            tuoiCongNo: "0",
            styleData: {
                id: null,
                style: null,
            },
            arrStyle: [],
        };
    },
    async created() {
        if (localStorage.getItem("_token") == null) {
            window.location.href = "/";
        } else {
            var _token = window.atob(localStorage.getItem("_token"));
            this.role = window.atob(localStorage.getItem("_token")).slice(0, 1);
            const d = new Date();
            this.month = d.getMonth() + 1;
            this.year = d.getFullYear();
            this.oldMonth = this.month;

            // console.log(this.checkDate(d, "2022-05-09"));

            localStorage.setItem(
                "datePhieuNhapSupplier",
                window.btoa(this.month + "-" + this.year)
            );
            if (this.role == 2) {
                this.$router.push({ path: "/order" });
            } else {
                await axios.get("sanctum/csrf-cookie");
                await axios
                    .get(
                        `/api/get-all-name-phieu-nhap/${
                            this.month + "-" + this.year
                        }`
                    )
                    .then((result) => {
                        this.getDataSupplier = result.data.data;
                        this.showModalManageSupplier = false;

                        result.data.data.forEach((element) => {
                            if (element.tuoi_cong_no != null) {
                                this.styleData.id = element.id;
                                var checkDay = this.checkDate(
                                    d,
                                    element.tuoi_cong_no
                                );
                                console.log(checkDay);
                                if (checkDay <= 15 && checkDay >= 0) {
                                    this.styleData.style = "green";
                                } else if (checkDay >= 15 && checkDay <= 30) {
                                    this.styleData.style = "orange";
                                } else if (checkDay >= 30) {
                                    this.styleData.style = "red";
                                } else {
                                    this.styleData.style = "black";
                                }

                                this.arrStyle.push({ ...this.styleData });
                            }
                        });

                        console.log(this.arrStyle);
                    })
                    .catch((err) => {
                        console.log("Error Catch");
                        alert("?");
                    });
            }
        }
    },
    methods: {
        async changePage(page) {
            await axios
                .get("/api/get-nha-cung-cap?page=" + page)
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

        async createDataSupplier() {
            // console.log(this.createSupplierHouse);

            await axios
                .post("/api/insert-name-phieu-nhap", {
                    name: this.createSupplierHouse,
                    doanhsoap: this.doanhSoAp,
                    month:
                        this.createSupplierHouse +
                        "-" +
                        this.month +
                        "-" +
                        this.year,
                })
                .then((result) => {
                    if (result.data.status_code == 200) {
                        alert("Thêm dữ liệu thành công");
                        this.showModalAdd = false;
                        axios
                            .get(
                                `/api/get-all-name-phieu-nhap/${
                                    this.oldMonth + "-" + this.year
                                }`
                            )
                            .then((result) => {
                                this.getDataSupplier = result.data.data;
                                this.showModalManageSupplier = false;
                            })
                            .catch((err) => {
                                console.log("Error Catch");
                            });
                    } else {
                        alert("Có lỗi trong quá trình xử lý dữ liệu");
                    }
                })
                .catch((err) => {
                    alert("Có lỗi trong quá trình xử lý dữ liệu - 2");
                });
        },

        async selectDataSupplier() {
            await axios
                .get("/api/get-all-name-phieu-nhap")
                .then((result) => {
                    this.getDataSupplier = result.data.data;
                    this.showModalManageSupplier = true;
                })
                .catch((err) => {
                    console.log("Error Catch");
                });
        },

        updateDataSupplier(e) {
            this.dataIdUpdate = e;
            this.getDataSupplier.map((data) => {
                if (e == data.id) {
                    data.id = !!!data.id;
                }
            });
        },

        async saveDataSupplier(e) {
            console.log(this.dataIdUpdate);
            console.log(e.name);

            await axios
                .post("/api/update-data-name-phieu-nhap", {
                    id: this.dataIdUpdate,
                    name: e.name,
                    tuoiCongNo: e.tuoi_cong_no,
                })
                .then((result) => {
                    if (result.data.status_code == 200) {
                        this.$router.go(this.$router.currentRoute);
                        alert("Chúc mừng bạn đã cập nhật thành công.");
                    } else {
                        alert("Có vấn đề đã xảy ra, xin vui lòng thử lại sau.");
                    }
                })
                .catch((err) => {
                    alert("Có vấn đề đã xảy ra, xin vui lòng thử lại sau.");
                });
        },

        getDataWhenSupplier(e) {
            console.log(e);
            localStorage.setItem("nameDataSupplier", window.btoa(e));
            this.$router.push({ path: `/supplier/details/${e}` });
            // alert("Chức năng đang được cập nhật");
        },

        changeDataAge(e) {
            console.log(e);
        },

        selectMonth(e) {
            console.log(e);
        },

        selectDataChange(e) {
            e != 0 ? (this.month = e.target.value) : this.month;
            console.log(this.month + " - " + this.year);
            axios
                .get(
                    `/api/get-all-name-phieu-nhap/${
                        this.month + "-" + this.year
                    }`
                )
                .then((result) => {
                    // this.arrStyle = [];
                    this.getDataSupplier = result.data.data;

                    result.data.data.forEach((element) => {
                        if (element.tuoi_cong_no != null) {
                            console.log(element.id);
                            this.styleData.id = element.id;
                            var checkDay = this.checkDate(
                                new Date(),
                                element.tuoi_cong_no
                            );

                            if (checkDay <= 15 && checkDay >= 0) {
                                this.styleData.style = "green";
                            } else if (checkDay >= 15 && checkDay <= 30) {
                                this.styleData.style = "orange";
                            } else if (checkDay >= 30) {
                                this.styleData.style = "red";
                            } else {
                                this.styleData.style = "black";
                            }

                            this.arrStyle.push({ ...this.styleData });
                            console.log(this.arrStyle);
                        }
                    });

                    this.showModalManageSupplier = false;
                    localStorage.setItem(
                        "datePhieuNhapSupplier",
                        window.btoa(this.month + "-" + this.year)
                    );
                })
                .catch((err) => {
                    console.log("Error Catch");
                });
        },

        checkDate(d, secondDay) {
            const oneDay = 24 * 60 * 60 * 1000;
            if (
                new Date(d).setHours(0, 0, 0, 0) <
                new Date(secondDay).setHours(0, 0, 0, 0)
            ) {
                return Math.round(
                    Math.abs(
                        (new Date(d.toISOString().slice(0, 10)) -
                            new Date(secondDay)) /
                            oneDay
                    )
                );
            } else {
                return -1;
            }
        },

        disableInputDoanhSoAp: () => {
          const inputDoanhSoAp = document.querySelector('#doanhSoAp')
          const inputSoLuongAp = document.querySelector('#soLuongAp')

          inputSoLuongAp.disabled = false
          inputSoLuongAp.focus()

          inputDoanhSoAp.disabled = true
          inputDoanhSoAp.value = null
        },

        disableInputSoLuongAp: () => {
          const inputDoanhSoAp = document.querySelector('#doanhSoAp')
          const inputSoLuongAp = document.querySelector('#soLuongAp')

          inputDoanhSoAp.disabled = false
          inputDoanhSoAp.focus()

          inputSoLuongAp.disabled = true
          inputSoLuongAp.value = null
        },

        changeRadioBtn: () => {
          console.log("123")
        },

        historyPurcharse() {
          this.$router.push({ path: "/history-purchase" });
        },

        managePurcharse() {
          this.$router.push({ path: "/manage-purchase" });
        }
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
