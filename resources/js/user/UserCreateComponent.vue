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
                            @click="createDataUser"
                        >
                            Lưu
                        </a>
                    </div>

                    <div class="row custom-data-border">
                        <div class="col-sm-6">
                            <div class="form-group p-3">
                                <label for="name">Tên người dùng</label>
                                <span
                                    class="text-danger"
                                    style="padding-left: 5px"
                                    >{{ errName }}</span
                                >
                                <input
                                    type="text"
                                    class="form-control"
                                    id="name"
                                    v-model="name"
                                    :class="{
                                        ' is-invalid': $v.name.$error,
                                    }"
                                />
                            </div>

                            <div class="form-group p-3">
                                <label for="email">Email người dùng</label>
                                <span
                                    class="text-danger"
                                    style="padding-left: 5px"
                                    >{{ errEmail }}</span
                                >
                                <input
                                    type="text"
                                    class="form-control"
                                    id="email"
                                    v-model="email"
                                    :class="{
                                        ' is-invalid': $v.email.$error,
                                    }"
                                />
                            </div>

                            <div class="form-group p-3">
                                <label for="gia_nhap">Quyền</label>
                                <span
                                    class="text-danger"
                                    style="padding-left: 5px"
                                    >{{ errRole }}</span
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
                                    placeholder="Lựa chọn"
                                    autocomplete="off"
                                >
                                </Dropdown>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group p-3">
                                <label for="password">Mật khẩu</label>
                                <span
                                    class="text-danger"
                                    style="padding-left: 5px"
                                    >{{ errPassword }}</span
                                >
                                <input
                                    type="text"
                                    class="form-control"
                                    id="password"
                                    v-model="password"
                                    :class="{
                                        ' is-invalid': $v.password.$error,
                                    }"
                                />
                            </div>

                            <div class="form-group p-3">
                                <label for="phone">Số điện thoại</label>
                                <span
                                    class="text-danger"
                                    style="padding-left: 5px"
                                    >{{ errPhone }}</span
                                >
                                <input
                                    type="number"
                                    class="form-control"
                                    id="phone"
                                    v-model="phone"
                                    :class="{
                                        ' is-invalid': $v.phone.$error,
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
    data() {
        return {
            loading: false,
            dataResposed: null,
            name: null,
            email: null,
            phone: null,
            role: null,
            id: null,
            password: null,
            options: [
                { id: "1", name: "Quản trị" },
                { id: "2", name: "Hỗ trợ tiếp nhận đơn hàng" },
                { id: "3", name: "Người giao hàng" },
            ],
            errName: null,
            errEmail: null,
            errPassword: null,
            errPhone: null,
            errRole: null,
        };
    },
    validations() {
        return {
            name: {
                required,
                minLength: minLength(3),
                maxLength: maxLength(255),
            },
            email: {
                required,
                email,
                minLength: minLength(3),
                maxLength: maxLength(255),
            },
            password: {
                required,
                minLength: minLength(3),
                maxLength: maxLength(255),
            },
            phone: {
                required,
                minLength: minLength(10),
                maxLength: maxLength(13),
            },
        };
    },
    methods: {
        async createDataUser() {
            this.$v.$touch();
            if (this.$v.$invalid) {
                this.errName = "Vui lòng kiểm tra lại thông tin tên người dùng";
                this.errEmail = "Vui lòng nhập email hoặc nhập đúng định dạng";
                this.errPassword =
                    "Vui lòng nhập mật khẩu hoặc nhập đúng định dạng";
                this.errPhone =
                    "Vui lòng nhập số điện thoại hoặc nhập đúng định dạng";
                return;
            }

            if (this.role == "" || this.role == null) {
                this.errRole = "Vui lòng chọn quyền người dùng";
                return;
            }

            this.errName = "";
            this.errEmail = "";
            this.errPassword = "";
            this.errPhone = "";

            await axios
                .post("/api/create-data-user", {
                    name: this.name,
                    email: this.email,
                    phone: this.phone,
                    role: this.role,
                    password: this.password,
                })
                .then((result) => {
                    if (result.data.status_code == 200) {
                        alert("Chúc mừng bạn đã thêm thành công.");
                        this.$router.push({ path: "/user" });
                    } else {
                        console.log("Error: ");
                    }
                })
                .catch((err) => {
                    console.log("Error: " + err);
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
