<template>
    <div id="app">
        <nav-component></nav-component>
        <div class="container-fluid">
            <div class="row">
                <menu-left></menu-left>
                <!-- <div class="col-sm-2">
          <a class="btn btn-success w-100" @click="createGiaoHang"> Lưu </a>
        </div> -->

                <div class="col-sm-10 custom-margin">
                    <div class="pb-2 custom-location-btn">
                        <a
                            class="btn w-25 btn-custom-center"
                            @click="createGiaoHang"
                        >
                            Lưu
                        </a>
                    </div>

                    <div class="row custom-data-border">
                        <div class="col-sm-6">
                            <!-- dia chi -->
                            <div class="form-group p-3">
                                <label for="dia_chi_giao_hang"
                                    >Địa chỉ, tên đường</label
                                >
                                <span
                                    class="text-danger"
                                    style="padding-left: 5px"
                                    >{{ errDia_chi_giao_hang }}</span
                                >
                                <input
                                    type="text"
                                    class="form-control"
                                    id="dia_chi_giao_hang"
                                    v-model="dia_chi_giao_hang"
                                    :class="{
                                        ' is-invalid':
                                            $v.dia_chi_giao_hang.$error,
                                    }"
                                    placeholder="Địa chỉ, tên đường"
                                />
                            </div>

                            <div class="form-group p-3">
                                <label for="dia_chi_phuong_xa"
                                    >Phường, xã</label
                                >
                                <span
                                    class="text-danger"
                                    style="padding-left: 5px"
                                    >{{ errDia_chi_phuong_xa }}</span
                                >
                                <input
                                    type="text"
                                    class="form-control"
                                    id="dia_chi_phuong_xa"
                                    v-model="dia_chi_phuong_xa"
                                    :class="{
                                        ' is-invalid':
                                            $v.dia_chi_phuong_xa.$error,
                                    }"
                                    placeholder="Phường, xã"
                                />
                            </div>

                            <div class="form-group p-3">
                                <label for="dia_chi_tinh"
                                    >Tỉnh, thành phố</label
                                >
                                <span
                                    class="text-danger"
                                    style="padding-left: 5px"
                                    >{{ errDia_chi_tinh }}</span
                                >
                                <input
                                    type="text"
                                    class="form-control"
                                    id="dia_chi_tinh"
                                    v-model="dia_chi_tinh"
                                    :class="{
                                        ' is-invalid': $v.dia_chi_tinh.$error,
                                    }"
                                    placeholder="Tỉnh, thành phố"
                                />
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <!-- Ten khach hang -->
                            <div class="form-group p-3">
                                <label for="ten_khach_hang"
                                    >Tên khách hàng</label
                                >
                                <span
                                    class="text-danger"
                                    style="padding-left: 5px"
                                    >{{ errTen_khach_hang }}</span
                                >
                                <input
                                    type="text"
                                    class="form-control"
                                    id="ten_khach_hang"
                                    v-model="ten_khach_hang"
                                    :class="{
                                        ' is-invalid': $v.ten_khach_hang.$error,
                                    }"
                                    placeholder="Nhập tên khách hàng"
                                />
                            </div>

                            <!-- So dien thoai -->
                            <div class="form-group p-3">
                                <label for="so_dien_thoai">Số điện thoại</label>
                                <span
                                    class="text-danger"
                                    style="padding-left: 5px"
                                    >{{ errSo_dien_thoai }}</span
                                >
                                <input
                                    type="number"
                                    class="form-control"
                                    id="so_dien_thoai"
                                    v-model="so_dien_thoai"
                                    :class="{
                                        ' is-invalid': $v.so_dien_thoai.$error,
                                    }"
                                    placeholder="Nhập số điện thoại"
                                />
                            </div>

                            <!-- user dam nhiem -->
                            <div class="form-group p-3">
                                <label for="so_luong_trong_kho"
                                    >Người chịu trách nhiệm</label
                                >
                                <span
                                    class="text-danger"
                                    style="padding-left: 5px"
                                    >{{ errUser_dam_nhiem }}</span
                                >
                                <Dropdown
                                    class="form-control dropdown-css w-100"
                                    name="subject"
                                    v-on:selected="dataSelecteds"
                                    :options="options"
                                    :value="{
                                        id: options.id,
                                        text: options.name,
                                    }"
                                    placeholder="Lựa chọn người chịu trách nhiệm"
                                    autocomplete="off"
                                >
                                </Dropdown>
                            </div>

                            <!-- So luong -->
                            <div class="form-group p-3">
                                <label for="so_luong">Số lượng xuất kho</label>
                                <span
                                    class="text-danger"
                                    style="padding-left: 5px"
                                    >{{ errSo_luong }}</span
                                >
                                <input
                                    type="number"
                                    class="form-control"
                                    :class="{
                                        ' is-invalid': $v.so_luong.$error,
                                    }"
                                    id="so_luong"
                                    name="so_luong"
                                    v-model="so_luong"
                                    placeholder="Nhập số lượng xuất kho"
                                />
                            </div>
                        </div>
                    </div>
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
    data() {
        return {
            dia_chi_giao_hang: null,
            dia_chi_phuong_xa: null,
            dia_chi_tinh: null,
            so_luong: null,
            user_dam_nhiem: null,
            ten_khach_hang: null,
            so_dien_thoai: null,
            id_kho_hang: null,
            so_luong_trong_kho: null,
            so_luong_da_xuat: null,
            options: [],
            errDia_chi_giao_hang: null,
            errTen_khach_hang: null,
            errSo_dien_thoai: null,
            errSo_luong: null,
            errUser_dam_nhiem: null,
            err: false,
            errDia_chi_tinh: null,
            errDia_chi_phuong_xa: null,
        };
    },
    validations() {
        return {
            so_luong: {
                required,
            },
            so_dien_thoai: {
                required,
                minLength: minLength(10),
                maxLength: maxLength(13),
            },
            ten_khach_hang: {
                required,
                minLength: minLength(3),
                maxLength: maxLength(255),
            },
            dia_chi_tinh: {
                required,
                minLength: minLength(3),
                maxLength: maxLength(255),
            },
            dia_chi_phuong_xa: {
                required,
                minLength: minLength(3),
                maxLength: maxLength(255),
            },
            dia_chi_giao_hang: {
                required,
                minLength: minLength(3),
                maxLength: maxLength(255),
            },
        };
    },
    async created() {
        this.id_kho_hang = this.$route.params.id;
        this.so_luong_trong_kho = this.$route.params.tong;
        this.so_luong_da_xuat = this.$route.params.daxuat;

        await axios
            .get("/api/get-name-usr/kho-tls")
            .then((result) => {
                this.options = result.data.data;
            })
            .then((result) => {
                this.loading = false;
            })
            .catch((err) => {
                console.log("Error Sua Kho Hang");
            });
    },
    methods: {
        async createGiaoHang() {
            this.$v.$touch();
            if (this.$v.$invalid) {
                this.errSo_luong =
                    "Vui lòng kiểm tra lại thông tin trong số lượng";
                this.errSo_dien_thoai =
                    "Vui lòng nhập số điện thoại hoặc nhập đúng định dạng";
                this.errTen_khach_hang =
                    "Vui lòng nhập tên khách hàng hoặc nhập đúng định dạng";
                this.errDia_chi_tinh =
                    "Vui lòng nhập địa chỉ tỉnh hoặc nhập đúng định dạng";
                this.errDia_chi_phuong_xa =
                    "Vui lòng nhập phường xã tỉnh hoặc nhập đúng định dạng";
                this.errDia_chi_giao_hang =
                    "Vui lòng nhập địa chỉ hoặc nhập đúng định dạng";

                return;
            }
            if (this.user_dam_nhiem == "" || this.user_dam_nhiem == null) {
                this.errUser_dam_nhiem = "Vui lòng người đảm nhiệm";
                return;
            }
            this.errSo_luong = "";
            this.errSo_dien_thoai = "";
            this.errTen_khach_hang = "";
            this.errDia_chi_tinh = "";
            this.errDia_chi_phuong_xa = "";
            this.errDia_chi_giao_hang = "";
            this.errUser_dam_nhiem = "";

            var tong = this.so_luong_trong_kho - this.so_luong;
            if (this.so_luong > this.so_luong_trong_kho) {
                this.so_luong = this.so_luong_trong_kho;
                tong = 0;
            } else if (this.so_luong < 0) {
                this.so_luong = 1;
                tong = this.so_luong_trong_kho - this.so_luong;
            }
            var so_da_xuat =
                parseInt(this.so_luong_da_xuat) + parseInt(this.so_luong);

            const keyAPI = "Qy8aTcFwmblsQWu2Rvl15ivSQvoW4m6qu2UxHFNB";
            const diaChiKhachHang =
                this.dia_chi_giao_hang +
                " " +
                this.dia_chi_phuong_xa +
                " " +
                this.dia_chi_tinh;
            const url = `https://rsapi.goong.io/geocode?address=${diaChiKhachHang}&api_key=${keyAPI}`;

            var latitude = 0.0;
            var longitude = 0.0;
            var setData = false;

            await axios
                .get(url)
                .then((result) => {
                    if (result.status === 200 && result.statusText == "OK") {
                        latitude = result.data.results[0].geometry.location.lat;
                        longitude =
                            result.data.results[0].geometry.location.lng;
                        setData = true;
                    } else {
                        alert("Có vấn đề đã xảy ra, xin vui lòng thử lại sau.");
                        return;
                    }
                })
                .catch((err) => {
                    console.log(err.status);
                });
            if (setData) {
                axios
                    .post("/api/create-data-order", {
                        dia_chi_giao_hang: this.dia_chi_giao_hang,
                        so_luong: this.so_luong,
                        ten_khach_hang: this.ten_khach_hang,
                        user_dam_nhiem: this.user_dam_nhiem,
                        so_dien_thoai: this.so_dien_thoai,
                        id_kho_hang: this.id_kho_hang,
                        latitude: latitude,
                        longitude: longitude,
                    })
                    .then((result) => {
                        if (result.data.status_code == 200) {
                            axios
                                .post("/api/update-so-luong-order", {
                                    id_kho_hang: this.id_kho_hang,
                                    so_luong_trong_kho: tong,
                                    so_luong_da_xuat: so_da_xuat,
                                })
                                .then((result) => {
                                    if (result.data.status_code == 200) {
                                        alert(
                                            "Chúc mừng bạn đã tạo đơn hàng thành công."
                                        );
                                        this.$router.push({
                                            path: "/home",
                                        });
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
                        } else {
                            alert(
                                "Có vấn đề đã xảy ra, xin vui lòng thử lại sau."
                            );
                            return;
                        }
                    })
                    .catch((err) => {
                        alert(
                            "Có vấn đề đã xảy ra, xin vui lòng thử lại sau." +
                                err
                        );
                        return;
                    });
            }
        },
        dataSelecteds(e) {
            this.user_dam_nhiem = e.id;
        },
    },
};
</script>
