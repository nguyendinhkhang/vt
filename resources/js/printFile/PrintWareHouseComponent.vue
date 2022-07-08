<template>
    <div style="background-color: white">
        <!-- SOURCE -->
        <div class="row" id="printMe" style="padding: 24px">
            <table
                class="table table-borderless"
                style="box-shadow: none; border-radius: 0"
            >
                <tbody>
                    <tr>
                        <td scope="col" style="width: 75%">
                            <h4>Công Ty Điện Máy Phương Dung</h4>
                            <h5>Địa chỉ TP. Buôn Ma Thuột, ĐắkLắk</h5>
                            <h5>Số điện thoại: 0923222333</h5>
                        </td>
                        <td scope="col" style="width: 35%">
                            <p style="text-align: center">
                                Ban hành theo thông tư số 133/2016/TT-BTC Ngày
                                26/08/2016 của bộ tài chính
                            </p>
                        </td>
                    </tr>
                </tbody>
            </table>

            <div class="col-sm-12" style="text-align: center">
                <h4>Phiếu nhập kho</h4>
                <p style="margin-bottom: 0px">Ngày 16 Tháng 03 năm 2022</p>
                <p>Số: BH0001</p>
            </div>

            <div class="col-sm-12">
                <p style="margin-bottom: 0px">
                    Họ tên người giao: Công ty cổ phần Cơ Điện Lạnh
                </p>

                <div class="row">
                    <div class="col-sm-6">
                        <p style="margin-bottom: 0px">
                            Theo .......... Ngày..........
                            của...................................
                        </p>
                    </div>
                    <div class="col-sm-6">
                        <p style="margin-bottom: 0px">
                            Địa
                            điểm:...........................................................
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-sm-12" style="padding-top: 8px">
                <table
                    class="table table-bordered"
                    style="box-shadow: none; border-radius: 0"
                >
                    <thead>
                        <tr>
                            <th scope="col">STT</th>
                            <th scope="col">Tên sản phẩm</th>
                            <th scope="col">Mã số</th>
                            <th scope="col">Đơn vị tính</th>
                            <th scope="col">Số lượng</th>
                            <th scope="col">Đơn giá</th>
                            <th scope="col">Thành tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                            v-for="(data, index) in dataResposed"
                            :key="'data_phieu_' + index"
                        >
                            <th scope="row">{{ index + 1 }}</th>
                            <td>{{ data.ten_san_pham }}</td>
                            <td>{{ data.ma_so_seri }}</td>
                            <td>{{ data.don_vi }}</td>
                            <td>{{ data.so_luong_trong_kho }}</td>
                            <td>{{ data.gia_nhap }}</td>
                            <td>
                                {{ data.so_luong_trong_kho * data.gia_nhap }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="col-sm-12" style="padding-top: 8px">
                <p>Tổng số tiền viết bằng chữ:</p>
                <p>Chứng từ gốc kèm theo</p>
            </div>

            <div class="col-sm-12" style="padding-top: 8px">
                <div class="row">
                    <div class="col-sm-3" style="text-align: center">
                        <p style="margin-bottom: 0px">Người lập phiếu</p>
                        <p style="margin-bottom: 0px">(Ký và ghi rõ họ tên)</p>
                    </div>
                    <div class="col-sm-3" style="text-align: center">
                        <p style="margin-bottom: 0px">Người giao hàng</p>
                        <p style="margin-bottom: 0px">(Ký và ghi rõ họ tên)</p>
                    </div>
                    <div class="col-sm-3" style="text-align: center">
                        <p style="margin-bottom: 0px">Thủ kho</p>
                        <p style="margin-bottom: 0px">(Ký và ghi rõ họ tên)</p>
                    </div>
                    <div class="col-sm-3" style="text-align: center">
                        <p style="margin-bottom: 0px">
                            Ngày.... Tháng.... Năm....
                        </p>
                        <p style="margin-bottom: 0px">Kế toán trưởng</p>
                        <p style="margin-bottom: 0px">(Ký và ghi rõ họ tên)</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- <div id="printMe">
            <h1 style="text-align: center">Print me!</h1>
        </div> -->
        <!-- OUTPUT -->
        <button @click="print" class="btn w-25 btn-custom-center">
            In Hóa đơn
        </button>
    </div>
</template>

<script>
export default {
    data() {
        return {
            output: null,
            id_phieu_nhap: null,
            dataResposed: null,
        };
    },
    async created() {
        this.id_phieu_nhap = window.atob(localStorage.getItem("id_phieu_nhap"));

        // console.log(this.role);
        if (this.role == 2) {
            this.$router.push({ path: "/order" });
        } else {
            // await axios
            //     .get(
            //         `/api/get-phieu-nhap-when-id-phieu-nhap/${this.id_phieu_nhap}`
            //     )
            //     .then((result) => {
            //         this.dataResposed = result.data.data;
            //         console.log(result.data);
            //     })
            //     .catch((err) => {
            //         console.log(err.status);
            //     });
        }
    },
    methods: {
        async print() {
            // Pass the element id here
            await this.$htmlToPaper("printMe");
        },
    },
};
</script>

<style type="text/css" media="print">
@media print {
    @page {
        size: landscape !important;
    }
}
</style>
