<template>
    <div id="app">
        <nav-component></nav-component>
        <div class="container-fluid">
            <div class="row">
                <menu-left></menu-left>

                <div class="col-sm-10 custom-margin">
                    <div class="pb-2 custom-location-btn">
                        <a
                            class="btn w-25 btn-custom-center"
                            @click="updateDataKho"
                        >
                            Lưu
                        </a>
                    </div>
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
                                    :class="{
                                        ' is-invalid': $v.ma_so_seri.$error,
                                    }"
                                />
                            </div>

                            <div class="form-group p-3">
                                <label for="nha_cung_cap">Nhà cung cấp</label>
                                <span
                                    class="text-danger"
                                    style="padding-left: 5px"
                                    >{{ errNha_cung_cap }}</span
                                >
                                <input
                                    type="text"
                                    class="form-control"
                                    id="nha_cung_cap"
                                    v-model="nha_cung_cap"
                                    :class="{
                                        ' is-invalid': $v.nha_cung_cap.$error,
                                    }"
                                />
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
                                    :class="{
                                        ' is-invalid': $v.gia_nhap.$error,
                                    }"
                                />
                            </div>

                            <div class="form-group p-3">
                                <label for="so_luong_trong_kho"
                                    >Tổng số lượng trong kho</label
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
                                    :class="{
                                        ' is-invalid':
                                            $v.so_luong_trong_kho.$error,
                                    }"
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
                                />
                            </div>

                            <div class="form-group p-3">
                                <label for="kho_hang">Kho hàng</label>
                                <span
                                    class="text-danger"
                                    style="padding-left: 5px"
                                    >{{ errKho_hang }}</span
                                >
                                <input
                                    type="text"
                                    class="form-control"
                                    id="kho_hang"
                                    v-model="kho_hang"
                                    :class="{
                                        ' is-invalid': $v.kho_hang.$error,
                                    }"
                                />
                            </div>

                            <div class="form-group p-3">
                                <label for="gia_ban">Giá bán</label>
                                <span
                                    class="text-danger"
                                    style="padding-left: 5px"
                                    >{{ errGia_ban }}</span
                                >
                                <input
                                    type="number"
                                    class="form-control"
                                    id="gia_ban"
                                    v-model="gia_ban"
                                    :class="{
                                        ' is-invalid': $v.gia_ban.$error,
                                    }"
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
    props: {
        id: String,
        seri: String,
    },
    data() {
        return {
            loading: false,
            dataResposed: null,
            ma_so_seri: null,
            ten_san_pham: null,
            nha_cung_cap: null,
            gia_nhap: null,
            gia_ban: null,
            kho_hang: null,
            so_luong_trong_kho: null,
            dataSelected: null,
            id_kho_hang: null,
            errMa_so_seri: null,
            errTen_san_pham: null,
            errNha_cung_cap: null,
            errGia_nhap: null,
            errGia_ban: null,
            errKho_hang: null,
            errSo_luong_trong_kho: null,
            err: false,
        };
    },
    validations() {
        return {
            ma_so_seri: {
                required,
            },
            nha_cung_cap: {
                required,
                minLength: minLength(3),
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
            gia_ban: {
                required,
            },
        };
    },
    async created() {
        this.loading = true;
        this.id_kho_hang = this.$route.params.id;
        await axios
            .get(
                `/api/get-data-ware-house/${this.$route.params.id}/${this.$route.params.seri}`
            )
            .then((result) => {
                this.dataResposed = result.data.data[0];
                this.ma_so_seri = this.dataResposed.ma_so_seri;
                this.ten_san_pham = this.dataResposed.ten_san_pham;
                this.nha_cung_cap = this.dataResposed.nha_cung_cap;
                this.gia_nhap = this.dataResposed.gia_nhap;
                this.gia_ban = this.dataResposed.gia_ban;
                this.kho_hang = this.dataResposed.kho_hang;
                this.so_luong_trong_kho = this.dataResposed.so_luong_trong_kho;
                // this.id_user = this.dataResposed.id_user;
            })
            .then((result) => {
                this.loading = false;
            })
            .catch((err) => {
                console.log("Error Sua Kho Hang");
            });

        // await axios
        //   .get("/api/get-name-usr/kho-tls")
        //   .then((result) => {
        //     console.log(result.data.data);
        //     this.options = result.data.data;
        //   })
        //   .then((result) => {
        //     this.loading = false;
        //   })
        //   .catch((err) => {
        //     console.log("Error Sua Kho Hang");
        //   });
    },
    methods: {
        async updateDataKho() {
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
                this.errGia_ban =
                    "Vui lòng nhập giá bán hoặc nhập đúng định dạng";
                this.errKho_hang =
                    "Vui lòng nhập kho hàng hoặc nhập đúng định dạng";
                this.errSo_luong_trong_kho =
                    "Vui lòng nhập số lượng hoặc đúng nhập định dạng";

                return;
            }
            this.errMa_so_seri = "";
            this.errTen_san_pham = "";
            this.errNha_cung_cap = "";
            this.errGia_nhap = "";
            this.errGia_ban = "";
            this.errKho_hang = "";
            this.errSo_luong_trong_kho = "";

            await axios
                .post("/api/update-data-ware-house", {
                    id: this.id_kho_hang,
                    ma_so_seri: this.ma_so_seri,
                    ten_san_pham: this.ten_san_pham,
                    nha_cung_cap: this.nha_cung_cap,
                    gia_nhap: this.gia_nhap,
                    gia_ban: this.gia_ban,
                    kho_hang: this.kho_hang,
                    so_luong_trong_kho: this.so_luong_trong_kho,
                })
                .then((result) => {
                    if (result.data.status_code == 200) {
                        alert("Chúc mừng bạn đã cập nhật thành công.");
                        this.$router.push({ path: "/home" });
                    } else {
                        console.log("Error: ");
                    }
                })
                .catch((err) => {
                    console.log("Error: " + err);
                });
            // }
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
</style>
