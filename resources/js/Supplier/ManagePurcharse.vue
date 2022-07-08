<template>
    <div id="app">
        <nav-component></nav-component>
        <div class="container-fluid">
            <div class="row">
                <menu-left></menu-left>

                <div class="col-sm-10 custom-table">
                    <div class="row">
                    <h3 style="margin-top: 16px; text-align: center">
                        Quản lý mua hàng
                    </h3>
                        <table
                            class="table table-borderless"
                            style="margin-top: 16px"
                        >
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col text-center-custom">123</th>
                                    <th scope="col text-center-custom">123</th>
                                    <th scope="col text-center-custom">123</th>
                                    <th scope="col text-center-custom">123</th>
                                    <th scope="col text-center-custom">123</th>
                                    <th scope="col text-center-custom">123</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>123</td>
                                    <td>123</td>
                                    <td>123</td>
                                    <td>123</td>
                                    <td>123</td>
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
    </div>
</template>

<script>
import DatePicker from "vue2-datepicker";
import "vue2-datepicker/index.css";
import "vue2-datepicker/locale/vi";

export default {
    components: { DatePicker },
};
</script>
