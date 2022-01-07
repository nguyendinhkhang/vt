<template>
  <div class="col-sm-1 menu-left">
    <aside id="basicSidebar" class="pmd-sidebar pt-4" role="navigation">
      <ul class="nav flex-column pmd-sidebar-nav">
        <li class="nav-item nav-custom">
          <img
            src="https://sieuthicongngheviettel.vn/wp-content/uploads/2021/11/Logo-Viettel.png"
            width="100px"
            height="30px"
          />
        </li>
        <li class="nav-item nav-custom li-custom-top" v-if="this.role != 2">
          <router-link class="nav-link set-text" to="/home">
            <img
                src="https://i.ibb.co/QX2LxB5/kho-2.png"
                width="52px"
                height="52px"
            />
            <span class="media-body custom-text-nav-left">Kho hàng</span>
          </router-link>
        </li>

        <li class="nav-item nav-custom li-custom-top">
          <router-link class="nav-link set-text" to="/order">
            <img
                src="https://i.ibb.co/1ZwTHRB/don-hang-2.png"
                width="52px"
                height="52px"
            />
            <span class="media-body custom-text-nav-left">Đơn hàng</span>
          </router-link>
        </li>

        <li class="nav-item nav-custom li-custom-top">
          <router-link class="nav-link set-text" to="/analysis">
            <img
                src="https://i.ibb.co/KFn613L/thong-ke-2.png"
                width="52px"
                height="52px"
            />
            <span class="media-body custom-text-nav-left">Thống kê</span>
          </router-link>
        </li>

        <li class="nav-item nav-custom li-custom-top" v-if="this.role != 2">
          <router-link class="nav-link set-text" to="/user">
            <img
                    src="https://i.ibb.co/JCfw3LY/User.png"
                    width="52px"
                    height="52px"
                />
            <span class="media-body custom-text-nav-left"> Quản trị</span>
          </router-link>
        </li>
      </ul>
    </aside>
  </div>
</template>
<script>
export default {
    data() {
      return {
        name: null,
        role: null,
      };
    },
  created(){
      this.role= window.atob(localStorage.getItem("_token")).slice(0,1);
      console.log(this.role);
  }
}
</script>
<style>
.menu-left {
  background-color: #ffff;
  height: 35em;
  border-radius: 25px;
  margin-top: -3rem;
  margin-left: 10px;
  z-index: 1;
  box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;
}
.set-text {
  font-size: 16px;
  color: #000;
}
.nav-custom{
    margin: auto;
}
.li-custom-top{
    padding-top: 15px;
}
.custom-text-nav-left{
  font-size: 12.5px;
  color: #ea0a2a;
}
</style>