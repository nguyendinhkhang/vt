<template>
    <div id="app">
        <nav-component></nav-component>
        <div class="container-fluid">
            <div class="row">
                <menu-left></menu-left>
                <!-- <div class="col-sm-2">
          <a class="btn btn-success w-100" @click="updateDataUserDeal"> Lưu </a>
        </div> -->
                <div class="col-sm-10 custom-margin">
                    <div class="pb-2 custom-location-btn">
                        <a
                            class="btn w-25 btn-custom-center"
                            @click="updateDataUserDeal"
                        >
                            Lưu
                        </a>
                    </div>
                    <div class="row custom-data-border">
                        <div class="col-sm-6">
                            <div class="form-group p-3">
                                <label for="seri">Mã số Seri</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="seri"
                                    v-model="ma_so_seri"
                                    placeholder="Nhập mã số seri"
                                    disabled
                                />
                            </div>

                            <div class="form-group p-3">
                                <label for="dia_chi_giao_hang"
                                    >Địa chỉ giao hàng</label
                                >
                                <input
                                    type="text"
                                    class="form-control"
                                    id="dia_chi_giao_hang"
                                    v-model="dia_chi_giao_hang"
                                    disabled
                                />
                            </div>

                            <div class="form-group p-3">
                                <label for="so_luong">Số lượng</label>
                                <input
                                    type="number"
                                    class="form-control"
                                    id="so_luong"
                                    v-model="so_luong"
                                    disabled
                                />
                            </div>

                            <div class="form-group p-3">
                                <label for="so_luong_trong_kho"
                                    >Người vận chuyển</label
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
                                    placeholder="Lựa chọn người vận chuyển"
                                    autocomplete="off"
                                >
                                </Dropdown>
                            </div>
                        </div>

                        <div class="col-sm-6 p-3">
                            <div class="form-group p-3">
                                <label for="gia_ban">Giá bán</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="gia_ban"
                                    v-model="gia_ban"
                                    disabled
                                />
                            </div>

                            <div class="form-group p-3">
                                <label for="ten_khach_hang">Tên khách</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="ten_khach_hang"
                                    v-model="ten_khach_hang"
                                    disabled
                                />
                            </div>

                            <div class="form-group p-3">
                                <label for="so_dien_thoai">Số điện thoại</label>
                                <input
                                    type="number"
                                    class="form-control"
                                    id="so_dien_thoai"
                                    v-model="so_dien_thoai"
                                    disabled
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
export default {
    data() {
        return {
            dataResposed: null,
            ma_so_seri: null,
            dia_chi_giao_hang: 1,
            so_luong: null,
            gia_ban: 1,
            ten_khach_hang: null,
            so_dien_thoai: null,
            id_user: null,
            id_quan_ly_giao: null,
            options: [],
            errUser_dam_nhiem: null,
            trang_thai_don_hang: null,
        };
    },
    async created() {
        this.id_quan_ly_giao = this.$route.params.id;
        this.trang_thai_don_hang = this.$route.params.trangthai;
        await axios
            .get(`/api/get-data-order/${this.$route.params.id}`)
            .then((result) => {
                this.dataResposed = result.data.data;
                this.ma_so_seri = this.dataResposed.ma_so_seri;
                this.dia_chi_giao_hang = this.dataResposed.dia_chi_giao_hang;
                this.so_luong = this.dataResposed.so_luong;
                this.gia_ban = this.dataResposed.gia_ban;
                this.ten_khach_hang = this.dataResposed.ten_khach_hang;
                this.so_dien_thoai = this.dataResposed.so_dien_thoai;
            })
            .then((result) => {
                this.loading = false;
            })
            .catch((err) => {
                console.log("Error Catch");
            });

        await axios
            .get("/api/get-name-usr/giao-hang-tls")
            .then((result) => {
                // console.log(result.data.data);
                this.options = result.data.data;
            })
            .catch((err) => {
                console.log("Error Catch");
            });
    },
    methods: {
        async updateDataUserDeal() {
            if (this.id_user == "" || this.id_user == null) {
                this.errUser_dam_nhiem = "Vui lòng người đảm nhiệm";
                return;
            }
            if (this.trang_thai_don_hang == null) {
                await axios
                    .post("/api/update-data-order", {
                        id: this.id_quan_ly_giao,
                        user_giao_hang: this.id_user,
                    })
                    .then((result) => {
                        if (result.data.status_code == 200) {
                            alert("Chúc mừng bạn đã cập nhật thành công.");
                            this.$router.push({ path: "/order" });
                        } else {
                            console.log("Error: ");
                            alert("err");
                        }
                    })
                    .catch((err) => {
                        console.log("Error: " + err);
                        alert("?");
                    });
            } else {
                axios
                    .post("/api/update-data-order-bh", {
                        id: this.id_quan_ly_giao,
                        user_giao_hang: this.id_user,
                        trang_thai: 6,
                    })
                    .then((result) => {
                        if (result.data.status_code == 200) {
                            alert("Chúc mừng bạn đã cập nhật thành công.");
                            this.$router.push({ path: "/order" });
                        } else {
                            console.log("Error: ");
                            alert("err");
                        }
                    })
                    .catch((err) => {
                        console.log("Error: " + err);
                        alert("?");
                    });
            }
        },
        dataSelecteds(e) {
            this.id_user = e.id;
        },
    },
};
</script>
