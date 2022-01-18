<template>
    <div id="app">
        <nav-component></nav-component>
        <div class="container-fluid">
            <div class="row">
                <menu-left></menu-left>

                <div class="col-sm-10 custom-table">
                    <div class="pb-2 custom-location-btn">
                        <a
                            class="btn w-25 btn-custom-center"
                            @click="selectDataChange"
                        >
                            Thống kê
                        </a>
                    </div>

                    <div class="row pb-3">
                        <div class="col-sm-6">
                            <!-- Chức năng thống kê -->
                            <div class="form-group">
                                <label for="so_luong_trong_kho">Thống kê</label>
                                <Dropdown
                                    class="form-control dropdown-css w-100"
                                    name="subject"
                                    v-on:selected="dataSelectedThongKe"
                                    :options="optionsThongKe"
                                    :value="{
                                        id: optionsThongKe.id,
                                        text: optionsThongKe.name,
                                    }"
                                    :placeholder="firstData"
                                    autocomplete="off"
                                >
                                </Dropdown>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <!-- Thống kê theo tháng, quý năm -->
                            <div class="form-group">
                                <label for="so_luong_trong_kho"
                                    >Lựa chọn thống kê</label
                                >
                                <br />
                                <date-picker
                                    class="custom-date-picker"
                                    v-model="toFrom"
                                    range
                                    :lang="lang"
                                    value-type="YYYY-MM-DD 00:00:00"
                                    format="DD-MM-YYYY"
                                ></date-picker>
                            </div>
                        </div>
                    </div>
                    <h5
                        style="
                            text-align: center;
                            font-weight: bold;
                            padding: 8px;
                        "
                        v-if="this.compare == 2"
                    >
                        Thống kê doanh thu từ ngày:
                        <span style="color: #ea0a2a"
                            >{{ toFrom[0].replace("00:00:00", "") }} ~
                            {{ toFrom[1].replace("00:00:00", "") }}
                        </span>
                        là:
                        <span style="color: #ea0a2a"
                            >{{ formatPrice(tongDoanhThu) }}
                        </span>
                    </h5>
                    <!-- Table -->

                    <table
                        class="table table-borderless"
                        v-if="this.compare == 1"
                    >
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Địa chỉ giao hàng</th>
                                <th scope="col">Tên khách hàng</th>
                                <th scope="col">Số điện thoại</th>
                                <th scope="col">Ghi chú</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr
                                v-for="(data, index) in dataResposed"
                                :key="'data_' + index"
                            >
                                <th scope="row">{{ index + 1 }}</th>
                                <td>{{ data.dia_chi_giao_hang }}</td>
                                <td>{{ data.ten_khach_hang }}</td>
                                <td>{{ data.so_dien_thoai }}</td>
                                <td>{{ data.ghi_chu }}</td>
                            </tr>
                        </tbody>
                    </table>

                    <table
                        class="table table-borderless"
                        v-else-if="this.compare == 2"
                    >
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Seri</th>
                                <th scope="col">Tên sản phẩm</th>
                                <th scope="col">Kho hàng</th>
                                <th scope="col">Giá bán</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr
                                v-for="(data, index) in dataResposed"
                                :key="'data_' + index"
                            >
                                <th scope="row">{{ index + 1 }}</th>
                                <td>{{ data.ma_so_seri }}</td>
                                <td>{{ data.ten_san_pham }}</td>
                                <td>{{ data.kho_hang }}</td>
                                <td>{{ formatPrice(data.gia_ban) }}</td>
                            </tr>
                        </tbody>
                    </table>

                    <table
                        class="table table-borderless"
                        v-else-if="this.compare == 3"
                    >
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Địa chỉ giao hàng</th>
                                <th scope="col">Seri sản phẩm</th>
                                <th scope="col">Đoạn đường di chuyển</th>
                                <th scope="col">Thời gian dự tính</th>
                                <th scope="col">Người giao</th>
                            </tr>
                        </thead>

                        <!-- <tbody>
                            <tr
                                v-for="(data, index) in dataResposed"
                                :key="'data_' + index"
                            >
                                <th scope="row">{{ index + 1 }}</th>
                                <td>{{ data.ma_so_seri }}</td>
                                <td>{{ data.ten_san_pham }}</td>
                                <td>{{ data.kho_hang }}</td>
                                <td>{{ formatPrice(data.gia_ban) }}</td>
                            </tr>
                        </tbody> -->
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
            firstData: "Đơn hàng đã đi",
            firstThongKe: "Ngày",
            id_thong_ke: 1,
            id_date: 1,
            trang_thai: null,
            date: null,
            compare: 1,
            optionsThongKe: [
                { id: "1", name: "Đơn hàng đã đi" },
                { id: "2", name: "Đơn hàng đang giao" },
                { id: "3", name: "Đơn hàng chưa giao" },
                { id: "4", name: "Đơn hàng trả về" },
                { id: "5", name: "Thống kê doanh thu" },
                { id: "6", name: "Thống kê đoạn đường di chuyển" },
            ],
            first_page: 1,
            last_page: null,
            change_page: 1,
            // optionsDate: [
            //     { id: "1", name: "Ngày" },
            //     { id: "2", name: "Tháng" },
            //     { id: "3", name: "Quý" },
            //     { id: "4", name: "Năm" },
            // ],
            lang: "vi",
            toFrom: null,
            tongDoanhThu: 0,
        };
    },
    async created() {
        const today = new Date();
        var to =
            today.getFullYear() +
            "-" +
            ("0" + (today.getMonth() + 1)).slice(-2) +
            "-" +
            ("0" + (today.getDate() - 1).toString()).slice(-2) +
            " 00:00:00";
        var from =
            today.getFullYear() +
            "-" +
            ("0" + (today.getMonth() + 1)).slice(-2) +
            "-" +
            ("0" + (today.getDate() + 1).toString()).slice(-2) +
            " 00:00:00";

        this.trang_thai = 3;
        this.toFrom = [to, from];

        await axios
            .get(`/api/get-thong-ke-don-hang/${this.trang_thai}/${to}/${from}`)
            .then((result) => {
                this.dataResposed = result.data.data.data;
                this.last_page = result.data.data.last_page;
            })
            .catch((err) => {
                console.log(err.status);
            });
    },
    methods: {
        async selectDataChange() {
            console.log(this.trang_thai);
            if (this.trang_thai == 5) {
                //thong ke doanh thu
                this.compare = 2;
                var to = this.toFrom[0];
                var from = this.toFrom[1];
                await axios
                    .get(`/api/get-tong-doanh-thu/3/${to}/${from}`)
                    .then((result) => {
                        this.tongDoanhThu = result.data.data[0].gia_ban;
                        if (result.data.status_code === 200) {
                            axios
                                .get(
                                    `/api/get-thong-ke-doanh-thu/3/${to}/${from}`
                                )
                                .then((result) => {
                                    this.dataResposed = result.data.data.data;
                                    this.last_page = result.data.data.last_page;
                                })
                                .catch((err) => {
                                    console.log(err.status);
                                });
                        } else {
                            console.log(
                                "Không thể lấy tổng doanh thu, vui lòng liên hệ nhà phát triển"
                            );
                        }
                    })
                    .catch((err) => {
                        console.log(err.status);
                    });
            } else if (this.trang_thai == 6) {
                this.compare = 3;
                var to = this.toFrom[0];
                var from = this.toFrom[1];
                console.log(to + " - " + from);
                await axios
                    .get(`/api/get-data-storage-route-ship/${to}/${from}`)
                    .then((result) => {
                        console.log(result.data.data.data);
                        // this.dataResposed = result.data.data.data;
                        // this.last_page = result.data.data.last_page;
                    })
                    .catch((err) => {
                        console.log(err.status);
                    });
            } else {
                this.compare = 1;
                var to = this.toFrom[0];
                var from = this.toFrom[1];
                console.log(to + " - " + from);
                await axios
                    .get(
                        `/api/get-thong-ke-don-hang/${this.trang_thai}/${to}/${from}`
                    )
                    .then((result) => {
                        this.dataResposed = result.data.data.data;
                        this.last_page = result.data.data.last_page;
                    })
                    .catch((err) => {
                        console.log(err.status);
                    });
            }
        },
        formatPrice(value) {
            let val = (value / 1).toFixed(3).replace(".", ".");
            return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        },
        dataSelectedThongKe(e) {
            if (e.id == 1) {
                this.trang_thai = 3;
            } else if (e.id == 2) {
                this.trang_thai = 2;
            } else if (e.id == 3) {
                this.trang_thai = 1;
            } else if (e.id == 4) {
                this.trang_thai = 4;
            } else if (e.id == 5) {
                this.trang_thai = 5;
            } else if (e.id == 6) {
                this.trang_thai = 6;
            }
        },
        async changePage(page) {
            var to = this.toFrom[0];
            var from = this.toFrom[1];
            if (this.trang_thai == 5) {
                await axios
                    .get(
                        `/api/get-thong-ke-doanh-thu/3/${to}/${from}?page=${page}`
                    )
                    .then((result) => {
                        this.dataResposed = result.data.data.data;
                    })
                    .catch((err) => {
                        console.log(err.status);
                    });
            } else if (this.trang_thai == 6) {
            } else {
                await axios
                    .get(
                        `/api/get-thong-ke-don-hang/${this.trang_thai}/${to}/${from}?page=${page}`
                    )
                    .then((result) => {
                        this.dataResposed = result.data.data.data;
                    })
                    .catch((err) => {
                        console.log(err.status);
                    });
            }
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
    },
};
</script>

<style>
.custom-date-picker {
    width: 100%;
}
.custom-date-picker > div > .mx-input {
    height: 48px;
}

.mx-date-row > tbody > tr,
td {
    background-color: white !important;
    color: #263341 !important;
}
.mx-table-date .today {
    color: red !important;
}

.mx-table-date td,
.mx-table-date th {
    background-color: #ea0a2a;
    color: white;
}
.mx-table-date .cell.not-current-month {
    color: #ccc !important;
    background: none;
}
.mx-btn-current-year {
    color: #ea0a2a;
}
.mx-btn-current-month {
    color: #ea0a2a;
}
.mx-calendar-content .cell.active {
    color: #fff !important;
    background-color: #ea0a2a !important;
}
</style>
