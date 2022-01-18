<template>
    <div class="form-login">
        <div class="row">
            <div class="col-sm-4"></div>
            <div class="col-sm-4 custom-row-login">
                <div class="p-4 custom-logo-login">
                    <img
                        src="https://sieuthicongngheviettel.vn/wp-content/uploads/2021/11/Logo-Viettel.png"
                        width="150px"
                        height="45px"
                    />
                </div>
                <span class="text-danger">{{ validateEmail }}</span>
                <div class="input-group mb-3">
                    <span
                        class="input-group-text w-25"
                        id="inputGroup-sizing-default"
                        >Email
                    </span>
                    <input
                        type="text"
                        v-model="email"
                        class="form-control"
                        aria-label="Default"
                        aria-describedby="inputGroup-sizing-default"
                    />
                </div>

                <div class="input-group mb-3">
                    <span
                        class="input-group-text w-25"
                        id="inputGroup-sizing-default"
                        >Mật khẩu</span
                    >
                    <input
                        v-on:keyup.enter="login"
                        type="password"
                        v-model="pwd"
                        class="form-control"
                        aria-label="Default"
                        aria-describedby="inputGroup-sizing-default"
                    />
                </div>
                <button
                    type="button"
                    class="btn btn-danger w-100 mb-4"
                    @click="login"
                >
                    Đăng nhập
                </button>
            </div>
            <div class="col-sm-4"></div>
        </div>
    </div>
</template>
<script>
import { mapGetters, mapActions, mapMutations } from "vuex";
export default {
    data() {
        return {
            email: "",
            pwd: "",
            role: "",
            name: "",
            token: "",
            validateEmail: "",
        };
    },
    methods: {
        async login() {
            if (
                this.email == "" ||
                this.pwd == "" ||
                this.email.length > 225 ||
                this.email.pwd > 225
            ) {
                this.validateEmail = "Định dạng email hoặc password sai";
            } else {
                try {
                    await axios.get("sanctum/csrf-cookie");
                    await axios
                        .post("/api/login_system", {
                            email: this.email,
                            password: this.pwd,
                        })
                        .then((result) => {
                            if (result.data.status_code == 200) {
                                if (result.data.role === 3) {
                                    this.$router.push({ path: "/error" });
                                } else {
                                    this.$store.commit(
                                        "setName",
                                        result.data.name
                                    );
                                    this.$store.commit(
                                        "setRole",
                                        result.data.role
                                    );
                                    this.$store.commit(
                                        "setToken",
                                        result.data.access_token
                                    );

                                    localStorage.setItem(
                                        "_token",
                                        window.btoa(
                                            result.data.role +
                                                result.data.access_token
                                        )
                                    );
                                    localStorage.setItem(
                                        "_name",
                                        window.btoa(result.data.name)
                                    );
                                    localStorage.setItem(
                                        "_dataLogin",
                                        window.btoa(result.data.id)
                                    );

                                    this.$router.push({ path: "/home" });
                                }
                            } else {
                                this.validateEmail =
                                    "Tài khoản hoặc mật khẩu không đúng";
                            }
                        })
                        .catch((err) => {
                            this.validateEmail =
                                "Tài khoản hoặc mật khẩu không đúng";
                        });
                } catch (error) {
                    this.validateEmail = "Tài khoản hoặc mật khẩu không đúng";
                }
            }
        },
    },
    created() {
        localStorage.clear();
    },
};
</script>

<style>
.form-login {
    width: 100%;
    position: static;
    height: 1000px;
    background-image: url("https://nelsoncourse.concept4hosting.co.uk/casestudy/606302553591b-HNC-Sustainable-Construction-Design.jpg");
    background-repeat: no-repeat;
    position: fixed;
}
.custom-row-login {
    margin-top: 10%;
    border-radius: 25px;
    background-color: white;
    box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
}
.custom-logo-login {
    display: flex;
    justify-content: center;
}
</style>
