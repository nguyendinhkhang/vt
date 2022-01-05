<template>
  <div class="col-sm-2 menu-left">
    <aside id="basicSidebar" class="pmd-sidebar pt-4" role="navigation">
        <ul class="nav flex-column pmd-sidebar-nav">
            
            <li class="nav-item">
                <router-link class="nav-link set-text" to="/home">
                    <span class="media-body">Quản lý kho hàng</span>
                </router-link>
            </li>

            <li class="nav-item">
                <router-link class="nav-link set-text" to="/order">
                    <span class="media-body">Quản lý đơn hàng</span>
                </router-link>
            </li>

            <li class="nav-item">
                <router-link class="nav-link set-text" to="/analysis">
                    <span class="media-body">Quản lý thống kê</span>
                </router-link>
            </li>

            <li class="nav-item">
                <router-link class="nav-link set-text" to="/user">
                    <span class="media-body">Quản lý người dùng</span>
                </router-link>
            </li>
        </ul>
    </aside>
  </div>
</template>

<style>
.menu-left {
  background-color: #f2f2f2;
  height: 100vh;
}
.set-text{
    font-size: 16px;
    color: #000;
}
</style>