<template>
  <div id="app">
    <nav-component></nav-component>
    <div class="container-fluid">
        <div class="row">
            <menu-left></menu-left>

            <div class="col-sm-10 custom-table">
              <div class="pb-2 custom-location-btn">
                <a class="btn w-25 btn-custom-center" @click="selectDataChange"> Thống kê </a>
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
                    :value="{ id: optionsThongKe.id, text: optionsThongKe.name }"
                    :placeholder="firstData"
                    autocomplete="off"
                  >
                  </Dropdown>
                </div>
                </div> 

                <div class="col-sm-6">
                  <!-- Thống kê theo tháng, quý năm -->
                  <div class="form-group">
                  <label for="so_luong_trong_kho">Thống kê theo</label>
                  <Dropdown
                    class="form-control dropdown-css w-100"
                    name="subject"
                    v-on:selected="dataSelectedDate"
                    :options="optionsDate"
                    :value="{ id: optionsDate.id, text: optionsDate.name }"
                    autocomplete="off"
                    :placeholder="firstThongKe"
                  >
                  </Dropdown>

                </div> 
                </div>
              </div>

              <!-- Table -->
              <table class="table table-borderless">
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
            </div>
            
            <!-- <div class="col-sm-2">
              <a class="btn btn-success w-100" @click="selectDataChange"> Thống kê </a>
            </div> -->
        </div>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      dataResposed: null,
      firstData: 'Đơn hàng đã đi',
      firstThongKe: 'Ngày',
      id_thong_ke: 1,
      id_date: 1,
      trang_thai: null,
      date: null,
      compare: null,
      optionsThongKe: [
        {id: '1', name: 'Đơn hàng đã đi'},
        {id: '2', name: 'Đơn hàng đang giao'},
        {id: '3', name: 'Đơn hàng chưa giao'},
        {id: '4', name: 'Đơn hàng trả về'},
        {id: '5', name: 'Thống kê doanh thu'},
        {id: '6', name: 'Thống kê đoạn đường di chuyển'},
      ],
      optionsDate: [
        {id: '1', name: 'Ngày'},
        {id: '2', name: 'Tháng'},
        {id: '3', name: 'Quý'},
        {id: '4', name: 'Năm'},
      ],
    };
  },
  async created(){
    const today = new Date();
    this.date = today.getFullYear()+'-'+ ("0" + (today.getMonth() + 1)).slice(-2) +'-'+ ("0" + (today.getDate())).slice(-2);
    this.trang_thai = 3;
    this.compare = 0;
    console.log(this.trang_thai);
    console.log(this.date);
    console.log(this.compare);
    await axios
        .get(`/api/get-thong-ke-don-hang/${this.trang_thai}/${this.date}/${this.compare}`)
        .then((result) => {
          console.log(result.data.data);
          this.dataResposed = result.data.data;
        })
        .catch((err) => {
          console.log(err.status);
        });
  },
    methods: {
      async selectDataChange(){
        await axios
        .get(`/api/get-thong-ke-don-hang/${this.trang_thai}/${this.date}/${this.compare}`)
        .then((result) => {
          console.log(result.data.data);
          this.dataResposed = result.data.data;
        })
        .catch((err) => {
          console.log(err.status);
        });
      },
      dataSelectedThongKe(e) {
        if(e.id == 1){
          this.trang_thai = 3;
        }else if(e.id == 2){
          this.trang_thai = 2;
        }else if(e.id == 3){
          this.trang_thai = 1;
        }else if(e.id == 4){
          this.trang_thai = 4;
        }else if(e.id == 5){
          
        }else if(e.id == 6){
          
        }
      },
      dataSelectedDate(e) {
        if(e.id == 1){
          this.compare = 0;
        }else if(e.id == 2){
          this.compare = -31;
        }else if(e.id == 3){
          this.compare = -90;
        }else if(e.id == 4){
          this.compare = -365;
        }
      },
  },
};
</script>