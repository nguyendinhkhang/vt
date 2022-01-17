<template>
    <div id="app">
        <nav-component></nav-component>
        <div class="container-fluid">
            <div class="row">
                <menu-left></menu-left>

                <div class="col-sm-10 custom-table pt-3">
                    <table class="table table-borderless">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Seri</th>
                                <th scope="col">Tên sản phẩm</th>
                                <th scope="col">Nhà cung cấp</th>
                                <th scope="col">Giá nhập</th>
                                <th scope="col">Lý do trả hàng</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr
                                v-for="(data, index) in dataResposed"
                                :key="'data_kho_' + index"
                            >
                                <th scope="row">{{ index + 1 }}</th>
                                <td>{{ data.storage_seri }}</td>
                                <td>{{ data.storage_ten_san_pham }}</td>
                                <td>{{ data.storage_nha_cung_cap }}</td>
                                <td>{{ data.storage_gia_nhap }}</td>
                                <td>{{ data.storage_ly_do_tra_hang }}</td>
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
            first_page: 1,
            last_page: null,
            change_page: 1,
        };
    },
    async created() {
        await axios
            .get("/api/get-data-storage-remove")
            .then((result) => {
                this.dataResposed = result.data.data.data;
                this.last_page = result.data.data.last_page;
            })
            .catch((err) => {
                console.log(err.status);
            });
    },
    methods: {
        async changePage(page) {
            await axios
                .get("/api/get-data-storage-remove?page=" + page)
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
    },
};
</script>

<style>
.set-input {
    width: 50px;
    height: 37px;
}
.page-link {
    height: 37px;
    color: red;
}
.page-link:hover {
    color: black;
}
.page-custom {
    height: 37px;
    margin-top: 0.5rem;
    margin-bottom: 0.5rem;
}
.page-item {
    padding-right: 8px;
}
.custom-text-order {
    width: 11vh;
}
</style>
