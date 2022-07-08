<template>
    <div id="app">
        <nav-component></nav-component>
        <div class="container-fluid">
            <div class="row">
                <menu-left></menu-left>

                <div class="col-sm-10 custom-table">
                    <div
                        class="row"
                        style="padding-bottom: 20px; padding-top: 20px"
                    >
                        <div class="col-sm-3">
                            <div class="pb-2 custom-location-btn">
                                <router-link
                                    class="btn w-50 btn-custom-center"
                                    to="/home/create-ware-house"
                                >
                                    Thêm kho
                                </router-link>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="pb-2 custom-location-btn">
                                <a
                                    class="btn w-50 btn-custom-center"
                                    @click="createPhieuNhap()"
                                    >Tạo phiếu nhập kho</a
                                >
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="pb-2 custom-location-btn">
                                <a
                                    class="btn w-50 btn-custom-center"
                                    @click="showModalPrint = true"
                                    >In phiếu nhập kho</a
                                >
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="pb-2 custom-location-btn">
                                <a
                                    class="btn w-50 btn-custom-center"
                                    @click="showModalManage = true"
                                    >Quản lý phiếu nhập</a
                                >
                            </div>
                        </div>
                    </div>

                    <div
                        class="row"
                        style="padding-bottom: 20px; padding-top: 20px"
                    >
                        <div
                            class="col-sm-4"
                            v-for="(data, index) in dataResposed"
                            :key="'data_kho_hang_' + index"
                            style="padding-bottom: 16px"
                        >
                            <div class="card" style="width: 18rem">
                                <img
                                    class="card-img-top"
                                    src="https://i.ibb.co/1MLHsmK/7097.jpg"
                                    alt="Card image cap"
                                    width="100"
                                    height="200"
                                />
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <h6>
                                                <router-link
                                                    class="custom-href"
                                                    :to="{
                                                        name: 'HomeComponent',
                                                        params: {
                                                            id: data.tls_id_kho,
                                                        },
                                                    }"
                                                    @click="
                                                        saveDataID(
                                                            data.tls_id_kho
                                                        )
                                                    "
                                                >
                                                    {{
                                                        data.tls_ten_kho
                                                    }}</router-link
                                                >
                                            </h6>
                                        </div>

                                        <div class="col-sm-8">
                                            <span
                                                v-for="(
                                                    dataNoti, index
                                                ) in dataPhieuNhapNotification"
                                                :key="'data_kho_' + index"
                                            >
                                                <a
                                                    v-if="
                                                        data.tls_id_kho ==
                                                        dataNoti.id_kho
                                                    "
                                                    style="font-size: 16px"
                                                    @click="
                                                        getDataPhieuNhap(
                                                            data.tls_id_kho
                                                        )
                                                    "
                                                >
                                                    {{ dataNoti.total }} phiếu
                                                    chờ xác nhận
                                                </a>
                                                <!-- <span
                                                    v-if="
                                                        data.tls_id_kho ==
                                                        dataNoti.id_kho
                                                    "
                                                    >1 phiếu chờ hoàn
                                                    thành</span
                                                > -->
                                            </span>

                                            <span
                                                v-for="(
                                                    dataNoti, index
                                                ) in dataPhieuNhapWailt"
                                                :key="'data_kho_w_' + index"
                                            >
                                                <a
                                                    v-if="
                                                        data.tls_id_kho ==
                                                        dataNoti.id_kho
                                                    "
                                                    style="font-size: 16px"
                                                    @click="
                                                        getDataPhieuNhapWailt(
                                                            data.tls_id_kho
                                                        )
                                                    "
                                                >
                                                    {{ dataNoti.total }} phiếu
                                                    đang nhập
                                                </a>
                                            </span>
                                        </div>
                                    </div>
                                    <!-- dataPhieuNhapWailt -->
                                    <router-link
                                        class="btn btn-primary"
                                        :to="{
                                            name: 'WarehouseEditComponent',
                                            params: {
                                                id: data.tls_id_kho,
                                            },
                                        }"
                                        >Chỉnh sửa</router-link
                                    >
                                </div>
                            </div>
                        </div>
                    </div>

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

                <div v-if="showModalSuccess">
                    <transition name="modal">
                        <div class="modal-mask">
                            <div class="modal-wrapper">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">
                                                Thông báo
                                            </h5>
                                            <button
                                                type="button"
                                                class="close"
                                                data-dismiss="modal"
                                                aria-label="Close"
                                            >
                                                <span
                                                    aria-hidden="true"
                                                    @click="
                                                        showModalSuccess = false
                                                    "
                                                    >&times;</span
                                                >
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Xóa dữ liệu thành công</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button
                                                type="button"
                                                class="btn btn-secondary"
                                                @click="
                                                    showModalSuccess = false
                                                "
                                            >
                                                Đóng
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </transition>
                </div>

                <div v-if="showModalImport">
                    <transition name="modal">
                        <div class="modal-mask">
                            <div class="modal-wrapper">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">
                                                Thông báo
                                            </h5>
                                            <button
                                                type="button"
                                                class="close"
                                                data-dismiss="modal"
                                                aria-label="Close"
                                            >
                                                <span
                                                    aria-hidden="true"
                                                    @click="
                                                        showModalImport = false
                                                    "
                                                    >&times;</span
                                                >
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>
                                                Bạn có muốn tạo phiếu nhập kho
                                                mới không?
                                            </p>
                                            <p style="margin-bottom: 0">
                                                Lựa chọn thời gian theo nhà cung
                                                cấp
                                            </p>
                                            <div
                                                style="
                                                    display: flex;
                                                    padding-bottom: 16px;
                                                "
                                            >
                                                <div class="w-50">
                                                    <p
                                                        style="
                                                            margin-bottom: 8px !important;
                                                        "
                                                    >
                                                        Tháng
                                                    </p>
                                                    <div
                                                        style="
                                                            margin-right: 8px;
                                                        "
                                                    >
                                                        <input
                                                            type="number"
                                                            min="1"
                                                            max="12"
                                                            step="1"
                                                            id="month"
                                                            class="form-control w-100"
                                                            v-model="month"
                                                        />
                                                    </div>
                                                </div>

                                                <div class="w-50">
                                                    <p
                                                        style="
                                                            margin-bottom: 8px !important;
                                                        "
                                                    >
                                                        Năm
                                                    </p>
                                                    <div
                                                        style="
                                                            margin-right: 8px;
                                                        "
                                                    >
                                                        <input
                                                            type="number"
                                                            min="2022"
                                                            max="2999"
                                                            step="1"
                                                            id="year"
                                                            class="form-control w-100"
                                                            v-model="year"
                                                        />
                                                    </div>
                                                </div>
                                            </div>
                                            <div style="padding-bottom: 8px">
                                                <input
                                                    type="radio"
                                                    id="createImportWareHouse"
                                                    value="createImportWareHouse"
                                                    v-model="picked"
                                                    @change="changeRadioBtn"
                                                    checked
                                                />
                                                <label
                                                    for=" createImportWareHouse"
                                                    >Tạo phiếu nhập kho
                                                    mới</label
                                                >
                                                <div
                                                    style="padding-bottom: 8px"
                                                >
                                                    <input
                                                        type="tex"
                                                        class="form-control"
                                                        id="ma_so"
                                                        v-model="ma_so_nhap_kho"
                                                        placeholder="Mã số nhập kho"
                                                        :disabled="
                                                            ma_so_nhap_kho_CS
                                                        "
                                                    />
                                                </div>
                                            </div>
                                            <div style="padding-bottom: 8px">
                                                <input
                                                    type="radio"
                                                    id="removeSave"
                                                    value="removeSave"
                                                    v-model="picked"
                                                    @change="changeRadioBtn"
                                                />
                                                <label for="removeSave"
                                                    >Sử dụng dữ liệu đã có
                                                    sẵn</label
                                                >
                                            </div>
                                            <div style="padding-bottom: 8px">
                                                <Dropdown
                                                    class="form-control dropdown-css w-100"
                                                    name="subject"
                                                    v-on:selected="
                                                        dataSelectedsPhieuNhap
                                                    "
                                                    :options="dataPhieuNhap"
                                                    :disabled="disabledRemove"
                                                    :value="{
                                                        id: dataPhieuNhap.id,
                                                        text: dataPhieuNhap.name,
                                                    }"
                                                    placeholder="Lựa chọn kho hàng"
                                                    autocomplete="off"
                                                >
                                                </Dropdown>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button
                                                type="button"
                                                class="btn btn-success"
                                                @click="addPhieuNhapKho()"
                                            >
                                                Thêm
                                            </button>
                                            <button
                                                type="button"
                                                class="btn btn-secondary"
                                                @click="showModalImport = false"
                                            >
                                                Không
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </transition>
                </div>

                <div v-if="showModalPrint">
                    <transition name="modal">
                        <div class="modal-mask">
                            <div class="modal-wrapper">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">
                                                Thông báo
                                            </h5>
                                            <button
                                                type="button"
                                                class="close"
                                                data-dismiss="modal"
                                                aria-label="Close"
                                            >
                                                <span
                                                    aria-hidden="true"
                                                    @click="
                                                        showModalPrint = false
                                                    "
                                                    >&times;</span
                                                >
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div style="padding-bottom: 8px">
                                                <label for="removeSave"
                                                    >Lựa chọn phiếu nhập</label
                                                >
                                            </div>
                                            <div style="padding-bottom: 8px">
                                                <Dropdown
                                                    class="form-control dropdown-css w-100"
                                                    name="subject"
                                                    v-on:selected="
                                                        dataSelectedsPhieuNhap
                                                    "
                                                    :options="dataPhieuNhap"
                                                    :value="{
                                                        id: dataPhieuNhap.id,
                                                        text: dataPhieuNhap.name,
                                                    }"
                                                    placeholder="Lựa chọn kho hàng"
                                                    autocomplete="off"
                                                >
                                                </Dropdown>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button
                                                type="button"
                                                class="btn btn-success"
                                                @click="printPhieuNhapKho()"
                                            >
                                                In
                                            </button>
                                            <button
                                                type="button"
                                                class="btn btn-secondary"
                                                @click="showModalPrint = false"
                                            >
                                                Đóng
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </transition>
                </div>

                <div v-if="showModalManage">
                    <transition name="modal">
                        <div class="modal-mask">
                            <div class="modal-wrapper">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">
                                                Thông báo
                                            </h5>
                                            <button
                                                type="button"
                                                class="close"
                                                data-dismiss="modal"
                                                aria-label="Close"
                                            >
                                                <span
                                                    aria-hidden="true"
                                                    @click="
                                                        showModalManage = false
                                                    "
                                                    >&times;</span
                                                >
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- pickedDateSelect -->
                                            <div style="padding-bottom: 8px">
                                                <input
                                                    type="radio"
                                                    id="selectDate"
                                                    value="selectDate"
                                                    v-model="pickedDateSelect"
                                                    @change="changeRadioBtnWare"
                                                    pickedDateSelect
                                                />
                                                <label for="selectDate"
                                                    >Tạo phiếu nhập kho
                                                    mới</label
                                                >
                                                <date-picker
                                                    class="custom-date-picker-2"
                                                    v-model="toFromPhieuNhap"
                                                    range
                                                    :lang="lang"
                                                    value-type="YYYY-MM-DD 00:00:00"
                                                    format="DD-MM-YYYY"
                                                ></date-picker>
                                            </div>

                                            <!-- pickedProvider -->
                                            <div style="padding-bottom: 8px">
                                                <input
                                                    type="radio"
                                                    id="selectProvider"
                                                    value="selectProvider"
                                                    v-model="pickedDateSelect"
                                                    @change="changeRadioBtnWare"
                                                    pickedDateSelect
                                                />
                                                <label for="selectProvider"
                                                    >Lựa chọn theo nhà cung
                                                    cấp</label
                                                >

                                                <Dropdown
                                                    v-if="
                                                        nhaCungCapOption != null
                                                    "
                                                    class="form-control dropdown-css w-100"
                                                    name="subject"
                                                    v-on:selected="
                                                        dataSelectedsNhaCungCap
                                                    "
                                                    :options="nhaCungCapOption"
                                                    :value="{
                                                        id: nhaCungCapOption.id,
                                                        text: nhaCungCapOption.name,
                                                    }"
                                                    placeholder="Lựa chọn nhà cung cấp"
                                                    autocomplete="off"
                                                >
                                                </Dropdown>
                                            </div>

                                            <!-- selectWareHousePicker -->
                                            <div style="padding-bottom: 8px">
                                                <input
                                                    type="radio"
                                                    id="selectWareHousePicker"
                                                    value="selectWareHousePicker"
                                                    v-model="pickedDateSelect"
                                                    @change="changeRadioBtnWare"
                                                    pickedWareHouse
                                                />
                                                <label
                                                    for="selectWareHousePicker"
                                                    >Lựa chọn theo kho</label
                                                >
                                                <Dropdown
                                                    v-if="khoHangOption != null"
                                                    class="form-control dropdown-css w-100"
                                                    name="subject"
                                                    v-on:selected="
                                                        dataSelectedsKhoHang
                                                    "
                                                    :options="khoHangOption"
                                                    :value="{
                                                        id: khoHangOption.id,
                                                        text: khoHangOption.name,
                                                    }"
                                                    placeholder="Lựa chọn kho hàng"
                                                    autocomplete="off"
                                                >
                                                </Dropdown>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button
                                                type="button"
                                                class="btn btn-success"
                                                @click="selectPhieuNhapKho()"
                                            >
                                                Chọn
                                            </button>
                                            <button
                                                type="button"
                                                class="btn btn-secondary"
                                                @click="showModalManage = false"
                                            >
                                                Đóng
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </transition>
                </div>

                <div v-if="showModalWareHouse">
                    <transition name="modal">
                        <div class="modal-mask">
                            <div class="modal-wrapper">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">
                                                Lựa chọn thông tin kho hàng
                                            </h5>
                                            <button
                                                type="button"
                                                class="close"
                                                data-dismiss="modal"
                                                aria-label="Close"
                                            >
                                                <span
                                                    aria-hidden="true"
                                                    @click="
                                                        showModalWareHouse = false
                                                    "
                                                    >&times;</span
                                                >
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div style="padding-bottom: 8px">
                                                <table
                                                    class="table table-borderless"
                                                >
                                                    <thead class="thead-dark">
                                                        <tr>
                                                            <th
                                                                scope="col text-center-custom"
                                                            >
                                                                ID
                                                            </th>
                                                            <th
                                                                scope="col text-center-custom"
                                                            >
                                                                Phiếu nhập
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr
                                                            v-for="(
                                                                data, index
                                                            ) in dataPhieuNhapFromApi"
                                                            :key="
                                                                'data_dataPhieuNhapFromApi_' +
                                                                index
                                                            "
                                                        >
                                                            <th scope="row">
                                                                {{ index + 1 }}
                                                            </th>
                                                            <td>
                                                                <a
                                                                    @click="
                                                                        showPhieuNhapKho(
                                                                            data
                                                                        )
                                                                    "
                                                                    >{{
                                                                        data.name
                                                                    }}</a
                                                                >
                                                            </td>
                                                            <!-- <td>
                                                                <a
                                                                    v-if="
                                                                        data.id
                                                                    "
                                                                    class="btn btn-secondary"
                                                                    @click="
                                                                        updateDataSupplier(
                                                                            data.id
                                                                        )
                                                                    "
                                                                    >Sửa</a
                                                                >
                                                                <a
                                                                    v-if="
                                                                        !data.id
                                                                    "
                                                                    class="btn btn-success"
                                                                    @click="
                                                                        saveDataSupplier(
                                                                            data
                                                                        )
                                                                    "
                                                                    >Lưu</a
                                                                >
                                                                <a
                                                                    class="btn btn-danger"
                                                                    @click="
                                                                        removeID =
                                                                            data.id
                                                                    "
                                                                    >Xoá</a
                                                                >
                                                            </td> -->
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <!-- <Dropdown
                                                    class="form-control dropdown-css w-100"
                                                    name="subject"
                                                    v-on:selected="
                                                        dataselectNamePhieuNhap
                                                    "
                                                    :options="
                                                        dataPhieuNhapFromApi
                                                    "
                                                    :value="{
                                                        id: dataPhieuNhapFromApi.id,
                                                        text: dataPhieuNhapFromApi.name,
                                                    }"
                                                    placeholder="Lựa chọn phiếu nhập"
                                                    autocomplete="off"
                                                >
                                                </Dropdown> -->
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <!-- <button
                                                type="button"
                                                class="btn btn-success"
                                                @click="showPhieuNhapKho()"
                                            >
                                                Hiển thị
                                            </button> -->
                                            <button
                                                type="button"
                                                class="btn btn-secondary"
                                                @click="
                                                    showModalWareHouse = false
                                                "
                                            >
                                                Đóng
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </transition>
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
            first_page: 1,
            last_page: null,
            change_page: 1,
            showModal: false,
            picked: "createImportWareHouse",
            ly_do: null,
            ma_so_nhap_kho: null,
            disabledRemove: true,
            ma_so_nhap_kho_CS: false,
            showModalSuccess: false,
            removeID: 0,
            dataGet: null,
            showModalImport: false,
            dataPhieuNhap: [],
            dataPhieuNhapSelected: null,
            showModalPrint: false,
            showModalManage: false,
            showModalWareHouse: false,
            dataIDPhieuNhapPrint: null,
            dataPhieuNhapNotification: null,
            dataPhieuNhapWailt: null,
            dataPhieuNhapFromApi: null,
            dataShowobjectData: [],
            objectData: {
                id_phieu_nhap_s: null,
                tls_id_kho: null,
                count: null,
            },
            toFromPhieuNhap: null,
            lang: "vi",
            selectedDateSelect: true,
            selectToProvider: false,
            selectWareHouse: false,
            pickedDateSelect: "selectDate",
            nhaCungCapOption: null,
            khoHangOption: null,
            nha_cung_cap: null,
            kho_hang: null,
            _id_phieu_nhap: null,
            month: 0,
            year: 0,
            monthData: [],
        };
    },
    async created() {
        if (localStorage.getItem("_token") == null) {
            window.location.href = "/";
        } else {
            var _token = window.atob(localStorage.getItem("_token"));
            this.role = window.atob(localStorage.getItem("_token")).slice(0, 1);

            console.log(_token);
            const today = new Date();
            this.month = today.getMonth() + 1;
            this.year = today.getFullYear();

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

            this.toFromPhieuNhap = [to, from];
            // console.log(this.role);
            if (this.role == 2) {
                this.$router.push({ path: "/order" });
            } else {
                await axios.get("sanctum/csrf-cookie");
                await axios
                    .get("/api/get-kho-hang")
                    .then((result) => {
                        this.dataResposed = result.data.data.data;
                        this.last_page = result.data.data.last_page;
                    })
                    .catch((err) => {
                        console.log(err.status);
                    });

                await axios
                    .get("/api/get-all-phieu-nhap")
                    .then((result) => {
                        this.dataPhieuNhap = result.data.data;

                        axios
                            .get("/api/data-status-off")
                            .then((result) => {
                                this.dataPhieuNhapNotification =
                                    result.data.data;
                                axios
                                    .get("/api/get-phieu-nhap-trang-thai-cho")
                                    .then((result) => {
                                        this.dataPhieuNhapWailt =
                                            result.data.data;
                                    })
                                    .catch((err) => {
                                        console.log("Error Catch" + err);
                                    });
                            })
                            .catch((err) => {
                                console.log("Error Catch" + err);
                            });
                    })
                    .catch((err) => {
                        console.log("Error Catch");
                    });
            }
        }
    },
    methods: {
        async changePage(page) {
            await axios
                .get("/api/get-data-ware-house?page=" + page)
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

        change_responsible() {
            this.change_user_responsible = false;
        },

        getDataXuat() {
            console.log("hi");
        },

        changeRadioBtn() {
            if (this.picked == "createImportWareHouse") {
                this.ma_so_nhap_kho_CS = false;
                this.disabledRemove = true;
            } else {
                this.ma_so_nhap_kho_CS = true;
                this.disabledRemove = false;
            }
        },

        async changeRadioBtnWare() {
            if (this.pickedDateSelect == "selectDate") {
                this.selectedDateSelect = true;
                this.selectToProvider = false;
                this.selectWareHouse = false;
            } else if (this.pickedDateSelect == "selectProvider") {
                this.selectedDateSelect = false;
                this.selectToProvider = true;
                this.selectWareHouse = false;

                if (this.nhaCungCapOption == null) {
                    await axios
                        .get("/api/get-all-nha-cung-cap")
                        .then((result) => {
                            this.nhaCungCapOption = result.data.data;
                        })
                        .catch((err) => {
                            console.log("Error Catch");
                        });
                }
            } else if (this.pickedDateSelect == "selectWareHousePicker") {
                this.selectedDateSelect = false;
                this.selectProvider = false;
                this.selectWareHouse = true;

                if (this.khoHangOption == null) {
                    await axios
                        .get("/api/get-ten-kho-hang")
                        .then((result) => {
                            this.khoHangOption = result.data.data;
                        })
                        .catch((err) => {
                            console.log("Error Catch");
                        });
                }
            }
        },

        dataSelectedsPhieuNhap(e) {
            this.dataPhieuNhapSelected = e.name;
        },

        dataSelectedsPhieuNhapPrint(e) {
            this.dataIDPhieuNhapPrint = e.id;
        },

        async addPhieuNhapKho() {
            this.showModalImport = false;
            var date = this.month + "-" + this.year;
            console.log(this.monthData);
            if (this.monthData.indexOf(date) > -1) {
                localStorage.setItem("datePhieuNhap", window.btoa(date));

                if (!this.ma_so_nhap_kho_CS) {
                    console.log(this.ma_so_nhap_kho);
                    await axios
                        .post("/api/insert-phieu-nhap", {
                            name_phieu_nhap: this.ma_so_nhap_kho,
                        })
                        .then((result) => {
                            if (result.data.status_code == 200) {
                                localStorage.setItem(
                                    "name_phieu_nhap",
                                    window.btoa(this.ma_so_nhap_kho)
                                );
                                this.$router.push({
                                    path: "/home/tao-kho-hang",
                                });
                            } else {
                                alert("Có lỗi trong quá trình xử lý dữ liệu");
                            }
                        })
                        .catch((err) => {
                            alert("Có lỗi trong quá trình xử lý dữ liệu - 2");
                        });
                } else {
                    localStorage.setItem(
                        "name_phieu_nhap",
                        window.btoa(this.dataPhieuNhapSelected)
                    );
                    this.$router.push({ path: "/home/tao-kho-hang" });
                }
            } else {
                alert(
                    "Vui lòng tạo dữ liệu nhà cung cấp theo tháng đã lựa chọn"
                );
            }
        },

        printPhieuNhapKho() {
            localStorage.setItem(
                "id_phieu_nhap",
                window.btoa(this.dataIDPhieuNhapPrint)
            );
            this.$router.push({ path: "/print-data" });
        },

        selectPhieuNhapKho() {
            if (this.selectedDateSelect == true) {
                var to = this.toFromPhieuNhap[0];
                var from = this.toFromPhieuNhap[1];
                console.log(to + " - " + from);
                localStorage.setItem("_to", window.btoa(to));
                localStorage.setItem("_from", window.btoa(from));
                localStorage.setItem("selectedDateSelect", window.btoa("true"));
                localStorage.setItem("selectToProvider", window.btoa("false"));
                localStorage.setItem("selectWareHouse", window.btoa("false"));
            } else if (this.selectToProvider == true) {
                localStorage.setItem(
                    "_nha_cung_cap",
                    window.btoa(this.nha_cung_cap)
                );
                localStorage.setItem(
                    "selectedDateSelect",
                    window.btoa("false")
                );
                localStorage.setItem("selectToProvider", window.btoa("true"));
                localStorage.setItem("selectWareHouse", window.btoa("false"));
            } else if (this.selectWareHouse == true) {
                localStorage.setItem("_kho_hang", window.btoa(this.kho_hang));
                localStorage.setItem(
                    "selectedDateSelect",
                    window.btoa("false")
                );
                localStorage.setItem("selectToProvider", window.btoa("false"));
                localStorage.setItem("selectWareHouse", window.btoa("true"));
            }
            this.$router.push({ path: "/supplier/manage" });
        },

        dataSelectedsNhaCungCap(e) {
            this.nha_cung_cap = e.name;
        },

        dataSelectedsKhoHang(e) {
            this.kho_hang = e.name;
        },

        async getDataPhieuNhap(e) {
            console.log(e);
            await axios
                .get(`/api/get-name-phieu-nhap/${e}`)
                .then((result) => {
                    this.dataPhieuNhapFromApi = result.data.data;
                    this.showModalWareHouse = true;
                })
                .catch((err) => {
                    console.log("Error Catch");
                });
        },

        async getDataPhieuNhapWailt(e) {
            console.log(e);
            await axios
                .get(`/api/get-name-phieu-nhap-wailt/${e}`)
                .then((result) => {
                    this.dataPhieuNhapFromApi = result.data.data;
                    this.showModalWareHouse = true;
                })
                .catch((err) => {
                    console.log("Error Catch");
                });
        },

        dataselectNamePhieuNhap(e) {
            this._id_phieu_nhap = e.id;
            console.log(this._id_phieu_nhap);
        },

        showPhieuNhapKho(e) {
            console.log(e);
            localStorage.setItem("name_phieu_nhap", window.btoa(e.name));
            localStorage.setItem("tls_id_kho", window.btoa(e.id_kho));
            localStorage.setItem("id_data_phieu_nhap", window.btoa(e.id));

            this.$router.push({ path: "/data-receipt" });
            // }
        },

        async createPhieuNhap() {
            this.showModalImport = true;
            const today = new Date();
            const date =
                today.getDate() +
                "" +
                (today.getMonth() + 1) +
                "" +
                today.getFullYear();
            var max = Math.random() * 999;
            this.ma_so_nhap_kho = "KG" + date + Math.floor(Math.random() * max);
            this.monthData = [];
            await axios
                .get("/api/get-all-month-phieu-nhap")
                .then((result) => {
                    var dataDate = "";
                    result.data.data.forEach((element) => {
                        dataDate = element.month.slice(
                            element.month.indexOf("-") + 1,
                            element.month.length
                        );
                        this.monthData.push(dataDate);
                    });
                })
                .catch((err) => {
                    console.log("Error Catch");
                });
        },

        saveDataID(e) {
            console.log(e);
        },
    },
};
</script>

<style>
.dropdown .dropdown-input[data-v-6149e08a] {
    min-width: 40px;
}
.dropdown-css {
    width: 85%;
    margin-left: inherit;
}
.custom-table {
    margin-left: 7vh;
}

table,
th,
td {
    box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;
    background-color: white;
    border-radius: 25px;
}
th,
td {
    background-color: #96d4d4;
}

.btn-custom-center {
    position: relative;
    background-color: white;
    color: #ea0a2a;
    box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;
    margin-left: 38.5%;
    z-index: 1;
    font-weight: bold;
}
.btn-custom-center:hover {
    color: #ea0a2a;
    z-index: 1;
}
.custom-location-btn {
    margin-top: -25px;
    z-index: 1;
}
.text-center-custom {
    text-align: center !important;
}

.modal-mask {
    position: fixed;
    z-index: 9998;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    display: table;
    transition: opacity 0.3s ease;
}

.modal-wrapper {
    display: table-cell;
    vertical-align: middle;
}

.custom-href {
    text-decoration: none !important;
    font-size: 16px;
    color: red;
}
.mx-datepicker-popup {
    z-index: 9999 !important;
}
</style>
