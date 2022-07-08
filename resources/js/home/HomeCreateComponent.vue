<template>
    <div id="app">
        <nav-component></nav-component>
        <div class="container-fluid">
            <div class="row">
                <menu-left></menu-left>

                <div class="col-sm-10 custom-margin">
                    <div
                        class="row"
                        style="padding-bottom: 20px; padding-top: 20px"
                    >
                        <div class="col-sm-6">
                            <div class="pb-2 custom-location-btn">
                                <a
                                    class="btn w-50 btn-custom-center"
                                    @click="createDataKho"
                                >
                                    Tạo mới
                                </a>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="pb-2 custom-location-btn">
                                <a
                                    class="btn w-50 btn-custom-center"
                                    @click="successDataKho"
                                >
                                    Hoàn thành phiếu nhập
                                </a>
                            </div>
                        </div>
                    </div>
                    <div
                        class="alert alert-info"
                        role="alert"
                        style="text-align: center"
                    >
                        Mã phiếu nhập: {{ name_phieu_nhap }}
                    </div>
                    <table class="table table-borderless">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col text-center-custom">ID</th>
                                <th scope="col text-center-custom">
                                    Tên sản phẩm
                                </th>
                                <th scope="col text-center-custom">
                                    Mã số Seri
                                </th>
                                <th scope="col text-center-custom">
                                    Mã số sản phẩm
                                </th>
                                <th scope="col text-center-custom">
                                    Đơn vị tính
                                </th>
                                <th scope="col text-center-custom">Số lượng</th>
                                <th scope="col text-center-custom">Đơn giá</th>
                                <th scope="col text-center-custom">
                                    Thành tiền
                                </th>
                                <th scope="col text-center-custom">
                                    Hành động
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr
                                v-for="(data, index) in dataSave"
                                :key="'data_kho_' + index"
                            >
                                <th scope="row">{{ index + 1 }}</th>
                                <td>{{ data.ten_san_pham }}</td>
                                <!-- MARK - Tên sản phẩm -->
                                <td>{{ data.ma_so_seri }}</td>
                                <!-- MARK - Mã số Seri -->
                                <td>{{ data.ma_so_san_pham }}</td>
                                <!-- MARK - Mã số sản phẩm -->
                                <td>{{ data.don_vi }}</td>
                                <!-- MARK - Đơn vị tính -->
                                <td>{{ data.so_luong_trong_kho }}</td>
                                <!-- MARK - Số lượng -->
                                <td>{{ data.gia_nhap }}</td>
                                <!-- MARK - Đơn giá -->
                                <td>
                                    {{
                                        data.gia_nhap * data.so_luong_trong_kho
                                    }}
                                </td>
                                <!-- MARK - Thành tiền -->
                                <td>
                                    <a
                                        class="btn btn-danger"
                                        @click="removeData(data)"
                                        >Xoá</a
                                    >
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="row custom-data-border">
                        <div class="col-sm-6">
                            <div class="form-group p-3">
                                <label for="seri">Mã số Seri</label>
                                <span
                                    class="text-danger"
                                    style="padding-left: 5px"
                                    >{{ errMa_so_seri }}</span
                                >
                                <input
                                    type="text"
                                    class="form-control"
                                    id="seri"
                                    v-model="ma_so_seri"
                                    placeholder="Nhập mã số seri"
                                />
                            </div>

                            <div class="form-group p-3">
                                <label for="nha_cung_cap">Nhà cung cấp</label>
                                <span
                                    class="text-danger"
                                    style="padding-left: 5px"
                                    >{{ errNha_cung_cap }}</span
                                >
                                <Dropdown
                                    class="form-control dropdown-css w-100"
                                    name="subject"
                                    v-on:selected="dataSelectedsNhaCungCap"
                                    :options="nhaCungCapOption"
                                    :value="{
                                        id: nhaCungCapOption.id,
                                        text: nhaCungCapOption.name,
                                    }"
                                    placeholder="Lựa chọn nhà cung cấp"
                                    autocomplete="off"
                                >
                                </Dropdown>
                            </div>

                            <div class="form-group p-3">
                                <label for="gia_nhap">Giá nhập</label>
                                <span
                                    class="text-danger"
                                    style="padding-left: 5px"
                                    >{{ errGia_nhap }}</span
                                >
                                <input
                                    type="number"
                                    class="form-control"
                                    id="gia_nhap"
                                    v-model="gia_nhap"
                                    @change="onChangeTongGiaTri(gia_nhap, so_luong_trong_kho)"
                                    :class="{
                                        ' is-invalid': $v.gia_nhap.$error,
                                    }"
                                    placeholder="Giá nhập"
                                />
                            </div>

                            <div class="form-group p-3">
                                <label for="so_luong_trong_kho"
                                    >Số lượng nhập về</label
                                >
                                <span
                                    class="text-danger"
                                    style="padding-left: 5px"
                                    >{{ errSo_luong_trong_kho }}</span
                                >
                                <input
                                    type="number"
                                    class="form-control"
                                    id="so_luong_trong_kho"
                                    v-model="so_luong_trong_kho"
                                    @change="onChangeSoLuong(gia_nhap, gia_von, so_luong_trong_kho)"
                                    :class="{
                                        ' is-invalid':
                                            $v.so_luong_trong_kho.$error,
                                    }"
                                    placeholder="Số lượng"
                                />
                            </div>

                            <div class="form-group p-3">
                                <label for="ngay_hoa_don"
                                    >Ngày hóa đơn (VD: 20/12/2020)</label
                                >
                                <span
                                    class="text-danger"
                                    style="padding-left: 5px"
                                    >{{ errNgay_hoa_don }}</span
                                >
                                <input
                                    type="text"
                                    class="form-control"
                                    id="ngay_hoa_don"
                                    v-model="ngay_hoa_don"
                                    :class="{
                                        ' is-invalid':
                                            $v.ngay_hoa_don.$error,
                                    }"
                                    placeholder="Ngày hóa đơn"
                                />
                            </div>

                            <div class="form-group p-3">
                                <label for="nha_cung_cap">Mã số sản phẩm</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="ma_so_san_pham"
                                    v-model="ma_so_san_pham"
                                    placeholder="Mã số sản phẩm"
                                />
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group p-3">
                                <label for="nameProduct">Tên sản phẩm</label>
                                <span
                                    class="text-danger"
                                    style="padding-left: 5px"
                                    >{{ errTen_san_pham }}</span
                                >
                                <input
                                    type="text"
                                    class="form-control"
                                    id="nameProduct"
                                    v-model="ten_san_pham"
                                    :class="{
                                        ' is-invalid': $v.ten_san_pham.$error,
                                    }"
                                    placeholder="Tên sản phẩm"
                                />
                            </div>

                            <div class="form-group p-3">
                                <label for="kho_hang">Kho hàng</label>
                                <span
                                    class="text-danger"
                                    style="padding-left: 5px"
                                    >{{ errKho_hang }}</span
                                >
                                <Dropdown
                                    class="form-control dropdown-css w-100"
                                    name="subject"
                                    v-on:selected="dataSelecteds"
                                    :options="khoOption"
                                    :value="{
                                        id: khoOption.id,
                                        text: khoOption.name,
                                    }"
                                    placeholder="Lựa chọn kho hàng"
                                    autocomplete="off"
                                >
                                </Dropdown>
                            </div>

                            <div class="form-group p-3">
                                <label for="gia_ban">Đơn vị</label>
                                <span
                                    class="text-danger"
                                    style="padding-left: 5px"
                                    >{{ errDon_vi }}</span
                                >
                                <input
                                    type="text"
                                    class="form-control"
                                    id="don_vi"
                                    v-model="don_vi"
                                    :class="{
                                        ' is-invalid': $v.don_vi.$error,
                                    }"
                                    placeholder="Đơn vị"
                                />
                            </div>

                            <div class="form-group p-3">
                                <label for="gia_von">Giá vốn</label>
                                <span
                                    class="text-danger"
                                    style="padding-left: 5px"
                                    >{{ errGia_von }}</span
                                >
                                <input
                                    type="number"
                                    class="form-control"
                                    id="gia_von"
                                    v-model="gia_von"
                                    @change="onChangeTongGiaVon(gia_von, so_luong_trong_kho)"
                                    :class="{
                                        ' is-invalid': $v.gia_von.$error,
                                    }"
                                    placeholder="Giá vốn"
                                />
                            </div>

                            <div class="form-group p-3">
                                <label for="tong_gia_tri">Tổng giá trị</label>
                                <span
                                    class="text-danger"
                                    style="padding-left: 5px"
                                    >{{ errTong_gia_tri }}</span
                                >
                                <input
                                    type="number"
                                    class="form-control"
                                    id="tong_gia_tri"
                                    v-model="tong_gia_tri"
                                    :class="{
                                        ' is-invalid': $v.tong_gia_tri.$error,
                                    }"
                                    placeholder="Tổng giá trị"
                                    disabled
                                />
                            </div>

                            <div class="form-group p-3">
                                <label for="tong_gia_von">Tổng giá vốn</label>
                                <span
                                    class="text-danger"
                                    style="padding-left: 5px"
                                    >{{ errTong_gia_von }}</span
                                >
                                <input
                                    type="number"
                                    class="form-control"
                                    id="tong_gia_von"
                                    v-model="tong_gia_von"
                                    :class="{
                                        ' is-invalid': $v.tong_gia_von.$error,
                                    }"
                                    placeholder="Tổng giá vốn"
                                    disabled
                                />
                            </div>

                            <div class="form-group p-3">
                                <label for="noi_dung_ghi_chu">Nội dung ghi chú</label>
                                <span
                                    class="text-danger"
                                    style="padding-left: 5px"
                                    >{{ errNoi_dung_ghi_chu }}</span
                                >
                                <input
                                    type="text"
                                    class="form-control"
                                    id="noi_dung_ghi_chu"
                                    v-model="noi_dung_ghi_chu"
                                    placeholder="Nội dung ghi chú"
                                />
                            </div>

                            <div
                                class="form-group p-3"
                                style="margin-top: 2rem"
                            >
                                <input
                                    class="custom-control-input"
                                    type="checkbox"
                                    id="gift"
                                    value="gift"
                                    v-model="checkGift"
                                />
                                <label for="gia_ban">Hàng tặng</label>
                            </div>
                        </div>
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
                                                Thông báo thêm sản phẩm vào kho
                                                thành công
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
                                            <p>
                                                Bạn có muốn tạo thêm tiếp sản
                                                phẩm vào kho?
                                            </p>
                                        </div>
                                        <div class="modal-footer">
                                            <button
                                                type="button"
                                                class="btn btn-success"
                                                @click="
                                                    showModalSuccess = false;
                                                    AddDataNewKhoHang();
                                                "
                                            >
                                                Thêm
                                            </button>
                                            <button
                                                type="button"
                                                class="btn btn-secondary"
                                                @click="
                                                    showModalSuccess = false;
                                                    CloseDataNewKhoHang();
                                                "
                                            >
                                                Không
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
</template>
<script>
import {
    required,
    email,
    minLength,
    maxLength,
    sameAs,
} from "vuelidate/lib/validators";
export default {
    props: {
        id: String,
        seri: String,
    },
    data() {
        return {
            loading: false,
            ma_so_seri: null,
            ten_san_pham: null,
            nha_cung_cap: null,
            san_pham_nha_cung_cap: null,
            gia_nhap: null,
            don_vi: null,
            kho_hang: null,
            so_luong_trong_kho: null,
            ngay_hoa_don: null,
            tong_gia_tri: 1,
            tong_gia_von: 1,
            gia_von: null,
            noi_dung_ghi_chu: null,
            errMa_so_seri: null,
            errTen_san_pham: null,
            errNha_cung_cap: null,
            errGia_nhap: null,
            errDon_vi: null,
            errKho_hang: null,
            errSo_luong_trong_kho: null,
            errNgay_hoa_don: null,
            errTong_gia_tri: null,
            errTong_gia_von: null,
            errGia_von: null,
            errNoi_dung_ghi_chu: null,
            err: false,
            khoOption: [],
            nhaCungCapOption: [],
            spCungCapOption: [],
            tls_id_kho: null,
            showModalSuccess: false,
            name_phieu_nhap: null,
            id_phieu_nhap: null,
            dataResposedNhaCungCap: null,
            dataSave: [],
            dataObject: {
                ma_so_seri: null,
                ten_san_pham: null,
                nha_cung_cap: null,
                gia_nhap: null,
                don_vi: null,
                so_luong_trong_kho: null,
                ma_so_san_pham: null,
                ngay_hoa_don: null,
                tong_gia_tri: null,
                tong_gia_von: null,
                gia_von: null,
                noi_dung_ghi_chu: null,
            },
            checkGift: null,
            ma_so_san_pham: null,
            checkChangeWareHouseTemp: [],
            checkChangeWareHouse: [],
            checkFor: true,
            dataPrice: {
                nhaCungCap: null,
                giaNhap: null,
            },
            listPrice: [],
            listResultPrice: [],
            listDataNameSupplier: [],
            datePhieuNhap: null,
        };
    },
    validations() {
        return {
            nha_cung_cap: {
                required,
                minLength: minLength(1),
                maxLength: maxLength(255),
            },
            gia_nhap: {
                required,
            },
            so_luong_trong_kho: {
                required,
            },
            ten_san_pham: {
                required,
                minLength: minLength(3),
                maxLength: maxLength(255),
            },
            kho_hang: {
                required,
                minLength: minLength(3),
                maxLength: maxLength(255),
            },
            don_vi: {
                required,
            },
            ngay_hoa_don: {
              required,
            },
            tong_gia_tri: {
              required,
            },
            tong_gia_von: {
              required
            },
            gia_von: {
              required
            },
        };
    },
    async created() {
        this.loading = true;
        this.name_phieu_nhap = window.atob(
            localStorage.getItem("name_phieu_nhap")
        );
        this.datePhieuNhap = window.atob(localStorage.getItem("datePhieuNhap"));

        await axios
            .get("/api/get-all-hang")
            .then((result) => {
                this.khoOption = result.data.data;

                if (result.status === 200) {
                    axios
                        .get(
                            `/api/get-all-nha-cung-cap-date/${this.datePhieuNhap}`
                        )
                        .then((result) => {
                            this.nhaCungCapOption = result.data.data;

                            axios
                                .get(
                                    `/api/get-phieu-nhap-when-id/${this.name_phieu_nhap}`
                                )
                                .then((result) => {
                                    this.dataResposedNhaCungCap =
                                        result.data.data[0];
                                    this.id_phieu_nhap =
                                        this.dataResposedNhaCungCap.id_phieu_nhap;

                                    axios
                                        .get(`/api/get-san-pham-cung-cap`)
                                        .then((result) => {
                                            this.spCungCapOption =
                                                result.data.data;
                                        })
                                        .then((result) => {
                                            this.loading = false;
                                        })
                                        .catch((err) => {
                                            alert("Error Sua Kho Hang");
                                        });
                                })
                                .then((result) => {
                                    this.loading = false;
                                })
                                .catch((err) => {
                                    alert("Error Sua Kho Hang");
                                });
                        })
                        .catch((err) => {
                            console.log("Error Catch");
                        });
                }
            })
            .catch((err) => {
                console.log("Error Catch");
            });
    },
    methods: {
        async createDataKho() {
            this.$v.$touch();
            if (this.$v.$invalid) {
                this.errMa_so_seri =
                    "Vui lòng nhập seri hoặc nhập đúng định dạng";
                this.errTen_san_pham =
                    "Vui lòng nhập tên sản phẩm hoặc nhập đúng định dạng";
                this.errNha_cung_cap =
                    "Vui lòng nhập nhà cung cấp hoặc nhập đúng định dạng";
                this.errGia_nhap =
                    "Vui lòng nhập giá nhập hoặc nhập đúng định dạng";
                this.errDon_vi =
                    "Vui lòng nhập giá bán hoặc nhập đúng định dạng";
                this.errKho_hang =
                    "Vui lòng nhập kho hàng hoặc nhập đúng định dạng";
                this.errSo_luong_trong_kho =
                    "Vui lòng nhập số lượng hoặc đúng nhập định dạng";
                this.errNgay_hoa_don = 
                    "Vui lòng nhập ngày hóa đơn hoặc nhập đúng định dạng ngày";
                this.errTong_gia_tri = 
                    "Vui lòng nhập tổng giá trị hoặc nhập đúng định dạng";
                this.errTong_gia_von = 
                    "Vui lòng nhập tổng giá vốn hoặc nhập đúng định dạng";
                this.errGia_von = 
                    "Vui lòng nhập giá vốn hoặc nhập đúng định dạng";
                return;
            }
            this.errMa_so_seri = "";
            this.errTen_san_pham = "";
            this.errNha_cung_cap = "";
            this.errGia_nhap = "";
            this.errDon_vi = "";
            this.errKho_hang = "";
            this.errSo_luong_trong_kho = "";
            this.errNgay_hoa_don = "";
            this.errTong_gia_tri = "";
            this.errTong_gia_von = "";
            this.errGia_von = "";

            await axios
                .post("/api/create-data-ware-house", {
                    ma_so_seri:
                        this.ma_so_seri == null ? "None" : this.ma_so_seri,
                    ten_san_pham: this.ten_san_pham,
                    nha_cung_cap: this.nha_cung_cap,
                    gia_nhap: this.gia_nhap,
                    gia_ban: 0,
                    don_vi: this.don_vi,
                    kho_hang: this.kho_hang,
                    so_luong_trong_kho: this.so_luong_trong_kho,
                    ngay_hoa_don: this.ngay_hoa_don,
                    tong_gia_tri: this.tong_gia_tri,
                    tong_gia_von: this.tong_gia_von,
                    gia_von: this.gia_von,
                    noi_dung_ghi_chu: this.noi_dung_ghi_chu,
                    tls_id_kho: this.tls_id_kho,
                    id_phieu_nhap: this.id_phieu_nhap,
                    trang_thai_nhap_kho: 1,
                    trang_thai_thanh_toan: 1,
                    trang_thai_hang_tang: this.checkGift ? 0 : 1,
                    san_pham_nha_cung_cap: this.ma_so_san_pham,
                    monthPhieuNhap:
                        this.nha_cung_cap + "-" + this.datePhieuNhap,
                })
                .then((result) => {
                    if (result.data.status_code == 200) {
                        this.dataObject.ma_so_seri = this.ma_so_seri;
                        this.dataObject.ten_san_pham = this.ten_san_pham;
                        this.dataObject.nha_cung_cap = this.nha_cung_cap;
                        this.dataObject.gia_nhap = this.gia_nhap;
                        this.dataObject.don_vi = this.don_vi;
                        this.dataObject.so_luong_trong_kho =
                            this.so_luong_trong_kho;
                        this.dataObject.ngay_hoa_don = this.ngay_hoa_don;
                        this.dataObject.tong_gia_tri = this.tong_gia_tri;
                        this.dataObject.tong_gia_von = this.tong_gia_von;
                        this.dataObject.gia_von = this.gia_von;
                        this.noi_dung_ghi_chu = this.noi_dung_ghi_chu;
                        this.dataObject.ma_so_san_pham = this.ma_so_san_pham;
                        this.dataSave.push({ ...this.dataObject });

                        this.ma_so_seri = null;
                        this.ten_san_pham = "...";
                        this.gia_nhap = 0;
                        this.gia_ban = 0;
                        this.don_vi = "...";
                        this.so_luong_trong_kho = 0;
                        this.noi_dung_ghi_chu = "";
                        this.tong_gia_von = 0;
                        this.tong_gia_tri = 0;
                        this.gia_von = 0;
                    } else {
                        alert("Có vấn đề đã xảy ra, xin vui lòng thử lại sau.");
                    }
                })
                .catch((err) => {
                    alert("Có vấn đề đã xảy ra, xin vui lòng thử lại sau.");
                });

            this.checkChangeWareHouseTemp.push(this.tls_id_kho);
            this.dataPrice.nhaCungCap = this.nha_cung_cap;
            this.dataPrice.giaNhap = this.gia_nhap;
            this.listPrice.push({ ...this.dataPrice });
        },

        dataSelecteds(e) {
            this.kho_hang = e.name;
            this.tls_id_kho = e.id;
        },

        dataSelectedsNhaCungCap(e) {
            this.nha_cung_cap = e.name;
        },

        dataSelectedsSanPhamNhaCungCap(e) {
            this.san_pham_nha_cung_cap = e.id;
        },

        AddDataNewKhoHang() {
            console.log("halo");
            this.$router.go();
        },

        CloseDataNewKhoHang() {
            this.$router.push({ path: "/home" });
        },

        removeData: function (index) {
            axios
                .post("/api/delete-data-ware-house-seri", {
                    seri: index.ma_so_seri,
                })
                .then((result) => {
                    if (result.data.status_code == 200) {
                        console.log("ok");
                    } else {
                        alert("Xoá dữ liệu thất bại vui lòng thử lại sau.");
                    }
                })
                .catch((err) => {
                    alert("Xoá dữ liệu thất bại vui lòng thử lại sau.");
                });
            this.dataSave.splice(this.dataSave.indexOf(index), 1);
        },

        onChangeSoLuong: function (gia_nhap, gia_von, so_luong_trong_kho) {
          this.tong_gia_tri = gia_nhap * so_luong_trong_kho;
          this.tong_gia_von = gia_von * so_luong_trong_kho;
        },

        onChangeTongGiaTri: function (gia_nhap, so_luong_trong_kho) {
          this.tong_gia_tri = gia_nhap * so_luong_trong_kho;
        },

        onChangeTongGiaVon: function (gia_von, so_luong_trong_kho) {
          this.tong_gia_von = gia_von * so_luong_trong_kho;
        },

        async successDataKho() {
            this.checkChangeWareHouse = this.checkChangeWareHouseTemp.filter(
                function (item, pos, self) {
                    return self.indexOf(item) == pos;
                }
            );
            console.log(this.nha_cung_cap + "-" + this.datePhieuNhap);

            await axios
                .get(
                    `/api/get-all-name-phieu-nhap/${
                        this.nha_cung_cap + "-" + this.datePhieuNhap
                    }`
                )
                .then((result) => {
                    if (result.data.status_code == 200) {
                        this.listDataNameSupplier = result.data.data;
                        console.log(this.listDataNameSupplier);
                        this.listPrice.map((item) => {
                            if (
                                this.listResultPrice.find((object) => {
                                    if (object.nhaCungCap === item.nhaCungCap) {
                                        //if the object exists iterate times
                                        object.giaNhap =
                                            parseInt(item.giaNhap) +
                                            parseInt(object.giaNhap);
                                        return true;
                                    } else {
                                        return false;
                                    }
                                })
                            ) {
                            } else {
                                this.listResultPrice.push(item);
                            }
                        });

                        this.listDataNameSupplier.map((item) => {
                            this.listResultPrice.map((itemPrice) => {
                                if (
                                    item.name.toLowerCase() ==
                                    itemPrice.nhaCungCap.toLowerCase()
                                ) {
                                    itemPrice.giaNhap =
                                        parseInt(itemPrice.giaNhap) +
                                        parseInt(item.cong_no_nha_cung_cap);
                                }
                            });
                        });
                        // for (var x1 in this.listDataNameSupplier) {
                        var nameCongNo = [];
                        var priceCongNo = [];

                        this.listResultPrice.map((itemPrice) => {
                            nameCongNo.push(itemPrice.nhaCungCap);
                            priceCongNo.push(itemPrice.giaNhap);
                        });

                        axios
                            .post("/api/update-data-cong-no", {
                                name: nameCongNo,
                                cong_no_nha_cung_cap: priceCongNo,
                            })
                            .then((result) => {
                                console.log(result.data);
                                // alert(result);
                                if (result.data.status_code == 200) {
                                    axios
                                        .post("/api/insert-count-phieu-nhap", {
                                            id_kho: this.checkChangeWareHouse,
                                            name_phieu_nhap:
                                                this.name_phieu_nhap,
                                            tong_chua_xac_nhan:
                                                this.dataSave.length,
                                            tong_da_xac_nhan: 0,
                                        })
                                        .then((result) => {
                                            if (
                                                result.data.status_code == 200
                                            ) {
                                            } else {
                                                alert(
                                                    "Có lỗi trong quá trình xử lý dữ liệu"
                                                );
                                            }
                                        })
                                        .catch((err) => {
                                            alert(
                                                "Có lỗi trong quá trình xử lý dữ liệu - 2"
                                            );
                                        });
                                    this.$router.push({ path: "/home" });
                                } else {
                                    // console.log(result);
                                    alert(
                                        "Có lỗi trong quá trình xử lý dữ liệu"
                                    );
                                }
                            })
                            .catch((err) => {
                                alert(
                                    "Có lỗi trong quá trình xử lý dữ liệu - 2" +
                                        err
                                );
                            });
                        // alert("Có lỗi trong quá trình xử lý dữ liệu -1");
                    } else {
                        alert("Có lỗi trong quá trình xử lý dữ liệu-1");
                    }
                })
                .catch((err) => {
                    console.log("Error Catch");
                });

            // console.log(this.listResultPrice);
        },
    },
};
</script>

<style>
.dropdown-input {
    min-width: 100% !important;
    font-size: 0.9rem !important;
}
.dropdown-item {
    font-size: 0.9rem !important;
}
.dropdown-content {
    min-width: 90% !important;
}
.custom-data-border {
    box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;
    background-color: white;
    border-radius: 25px;
}
.custom-margin {
    margin-left: 7vh;
}
.custom-location-btn-success {
    margin-top: 16px;
    margin-bottom: 16px;
}
</style>
