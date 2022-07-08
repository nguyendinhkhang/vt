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
                            @click="updateDataUser"
                        >
                            Lưu
                        </a>
                    </div>

                    <div class="row custom-data-border">
                        <div class="col-sm-6">
                            <div class="form-group p-3">
                                <label for="seri">Tên nhà cung cấp</label>
                                <span
                                    class="text-danger"
                                    style="padding-left: 5px"
                                    >{{ errTen_nha_cung_cam }}</span
                                >
                                <input
                                    type="text"
                                    class="form-control"
                                    id="seri"
                                    v-model="ten_nha_cung_cap"
                                    :class="{
                                        ' is-invalid':
                                            $v.ten_nha_cung_cap.$error,
                                    }"
                                    placeholder="Nhập Tên nhà cung cấp"
                                />
                            </div>

                            <div class="form-group p-3">
                                <label for="nha_cung_cap"
                                    >Sản phẩm cung cấp</label
                                >
                                <span
                                    class="text-danger"
                                    style="padding-left: 5px"
                                    >{{ errSp_cung_cap }}</span
                                >
                                <input
                                    type="text"
                                    class="form-control"
                                    id="sp_cung_cap"
                                    v-model="sp_cung_cap"
                                    :class="{
                                        ' is-invalid': $v.sp_cung_cap.$error,
                                    }"
                                    placeholder="Sản phẩm cung cấp"
                                />
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group p-3">
                                <label for="doanh_so_ap">Doanh số áp</label>
                                <span
                                    class="text-danger"
                                    style="padding-left: 5px"
                                    >{{ errDoanh_so }}</span
                                >
                                <input
                                    type="number"
                                    class="form-control"
                                    id="doanh_so_ap"
                                    v-model="doanh_so_ap"
                                    :class="{
                                        ' is-invalid': $v.doanh_so_ap.$error,
                                    }"
                                    placeholder="Doanh số áp"
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
            loading: false,
            dataResposed: null,
            ten_nha_cung_cap: null,
            ten_san_pham: null,
            sp_cung_cap: null,
            doanh_so_ap: null,
            id: null,
            errTen_nha_cung_cam: null,
            errSp_cung_cap: null,
            errDoanh_so: null,
        };
    },
    validations() {
        return {
            ten_nha_cung_cap: {
                required,
            },
            sp_cung_cap: {
                required,
                minLength: minLength(3),
                maxLength: maxLength(255),
            },
            doanh_so_ap: {
                required,
            },
        };
    },

    async created() {
        this.loading = true;
        this.id = this.$route.params.id;

        await axios
            .get(`/api/get-nha-cung-cap-voi-id/${this.$route.params.id}`)
            .then((result) => {
                this.dataResposed = result.data.data[0];
                this.ten_nha_cung_cap = this.dataResposed.ten_nha_cung_cap;
                this.sp_cung_cap = this.dataResposed.san_pham_cung_cap;
                this.doanh_so_ap = this.dataResposed.doanh_so_ap;
            })
            .then((result) => {
                this.loading = false;
            })
            .catch((err) => {
                alert("Error Sua Kho Hang");
            });
    },
    methods: {
        async updateDataUser() {
            this.$v.$touch();
            if (this.$v.$invalid) {
                this.errTen_nha_cung_cam =
                    "Vui lòng nhập tên nhà cung cấp hoặc nhập đúng định dạng";
                this.errSp_cung_cap =
                    "Vui lòng nhập sản phẩm cung cấp hoặc nhập đúng định dạng";
                this.errDoanh_so =
                    "Vui lòng nhập doanh số hoặc nhập đúng định dạng";
                return;
            }
            this.errTen_nha_cung_cam = "";
            this.errSp_cung_cap = "";
            this.errDoanh_so = "";

            await axios
                .post("/api/update-nha-cung-cap", {
                    id_supplier: this.id,
                    ten_nha_cung_cap: this.ten_nha_cung_cap,
                    san_pham_cung_cap: this.sp_cung_cap,
                    doanh_so_ap: this.doanh_so_ap,
                    cong_no_nha_cung_cap: 0,
                    id_kho_hang: 1,
                })
                .then((result) => {
                    if (result.data.status_code == 200) {
                        alert("Chúc mừng bạn đã cập nhật thành công.");
                        this.$router.push({ path: "/supplier" });
                    } else {
                        alert("Error: ");
                    }
                })
                .catch((err) => {
                    alert("Error: " + err);
                });
        },
        dataSelecteds(e) {
            this.role = e.id;
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
