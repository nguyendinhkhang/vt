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
                            @click="createDataKho"
                        >
                            Tạo mới
                        </a>
                    </div>
                    <div class="row custom-data-border">
                        <div class="col-sm-12">
                            <div class="form-group p-3">
                                <label for="seri">Tên kho</label>
                                <span
                                    class="text-danger"
                                    style="padding-left: 5px"
                                    >{{ errTen_kho }}</span
                                >
                                <input
                                    type="text"
                                    class="form-control"
                                    id="seri"
                                    v-model="ten_kho"
                                    :class="{
                                        ' is-invalid': $v.ten_kho.$error,
                                    }"
                                    placeholder="Nhập Tên Kho Hàng"
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
            ten_kho: null,
            errTen_kho: null,
            err: false,
            dataResposed: null,
        };
    },
    validations() {
        return {
            ten_kho: {
                required,
            },
        };
    },
    async created() {
        this.loading = true;
    },
    methods: {
        async createDataKho() {
            this.$v.$touch();
            if (this.$v.$invalid) {
                this.errTen_kho =
                    "Vui lòng nhập tên kho hoặc nhập đúng định dạng";
                return;
            }
            this.errTen_kho = "";

            await axios
                .post("/api/create-kho-hang", {
                    ten_kho: this.ten_kho,
                })
                .then((result) => {
                    if (result.data.status_code == 200) {
                        alert("Chúc mừng bạn đã tạo kho thành công.");
                        this.$router.push({ path: "/home" });
                    } else {
                        alert("Có vấn đề đã xảy ra, xin vui lòng thử lại sau.");
                    }
                })
                .catch((err) => {
                    alert("Có vấn đề đã xảy ra, xin vui lòng thử lại sau.");
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
.custom-data-border {
    box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;
    background-color: white;
    border-radius: 25px;
}
.custom-margin {
    margin-left: 7vh;
}
</style>
