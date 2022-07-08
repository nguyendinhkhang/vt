import VueRouter from "vue-router";
import LoginCompoment from "../../resources/js/login/LoginCompoment";
import HomeComponent from "../../resources/js/home/HomeComponent";
import HomeEditComponent from "../../resources/js/home/HomeEditComponent";
import HomeCreateComponent from "../../resources/js/home/HomeCreateComponent";
import HomeExportComponent from "../../resources/js/home/HomeExportComponent";
import HomeDetailsOrderExportComponent from "../../resources/js/home/HomeDetailsOrderExportComponent";
import SaveComponent from "../../resources/js/save/SaveComponent";

import OrderComponent from "../../resources/js/order/OrderComponent";
import OrderSetUserDeadComponent from "../../resources/js/order/OrderSetUserDeadComponent";

import AnalysisComponent from "../../resources/js/analysis/AnalysisComponent";
import UserComponent from "../../resources/js/user/UserComponent";
import UserEditComponent from "../../resources/js/user/UserEditComponent";
import UserCreateComponent from "../../resources/js/user/UserCreateComponent";

import SupplierComponent from "../../resources/js/Supplier/SupplierComponent";
import SupplierDetailsComponent from "../../resources/js/Supplier/SupplierDetailsComponent";
import SupplierEditComponent from "../../resources/js/Supplier/SupplierEditComponent";
import SupplierCreateComponent from "../../resources/js/Supplier/SupplierCreateComponent";
import ManageSupplierComponent from "../../resources/js/Supplier/ManageSupplierComponent";
import SupplierDetails2Component from "../../resources/js/Supplier/SupplierDetails2Component";

import WarehouseComponent from "../../resources/js/warehouse/WarehouseComponent";
import WarehouseCreateComponent from "../../resources/js/warehouse/WarehouseCreateComponent";
import WarehouseEditComponent from "../../resources/js/warehouse/WarehouseEditComponent";
import WareHouseListWithReceiptComponent from "../../resources/js/warehouse/WareHouseListWithReceiptComponent";

import PrintWareHouseComponent from "../../resources/js/printFile/PrintWareHouseComponent";
import HistoryPurcharse from "../../resources/js/Supplier/HistoryPurcharse";
import ManagePurcharse from "../../resources/js/Supplier/ManagePurcharse";

const routes = [
    {
        path: "/",
        component: LoginCompoment,
        name: "LoginCompoment",
    },
    {
        path: "/supplier",
        component: SupplierComponent,
        name: "SupplierComponent",
    },
    {
        path: "/supplier/details/:name",
        component: SupplierDetailsComponent,
        name: "SupplierDetailsComponent",
    },
    {
        path: "/supplier/detail",
        component: SupplierDetails2Component,
        name: "SupplierDetails2Component",
    },
    {
        path: "/supplier/edit?id=:id",
        component: SupplierEditComponent,
        name: "SupplierEditComponent",
    },
    {
        path: "/supplier/create-supplier",
        component: SupplierCreateComponent,
        name: "SupplierCreateComponent",
    },
    {
        path: "/supplier/manage",
        component: ManageSupplierComponent,
        name: "ManageSupplierComponent",
    },
    {
        path: "/home",
        component: WarehouseComponent,
        name: "WarehouseComponent",
    },
    {
        path: "/home/warehouse?id=:id",
        component: HomeComponent,
        name: "HomeComponent",
    },
    {
        path: "/home/create-ware-house",
        component: WarehouseCreateComponent,
        name: "WarehouseCreateComponent",
    },
    {
        path: "/home/editData?id=:id",
        component: WarehouseEditComponent,
        name: "WarehouseEditComponent",
    },
    {
        path: "/order",
        component: OrderComponent,
        name: "OrderComponent",
    },
    {
        path: "/analysis",
        component: AnalysisComponent,
        name: "AnalysisComponent",
    },
    {
        path: "/user",
        component: UserComponent,
        name: "UserComponent",
    },
    {
        path: "/user/edit-user?id=:id",
        component: UserEditComponent,
        name: "UserEditComponent",
    },
    {
        path: "/user/create-user",
        component: UserCreateComponent,
        name: "UserCreateComponent",
    },
    {
        path: "/home/edit?id=:id&seri=:seri",
        component: HomeEditComponent,
        name: "HomeEditComponent",
    },
    {
        path: "/home/tao-kho-hang",
        component: HomeCreateComponent,
        name: "HomeCreateComponent",
    },
    {
        path: "/home/xuat-kho-hang?don=:id:tong:daxuat:gia",
        component: HomeExportComponent,
        name: "HomeExportComponent",
    },
    {
        path: "/home/giao-van-chuyen?don=:id",
        component: OrderSetUserDeadComponent,
        name: "OrderSetUserDeadComponent",
    },
    {
        path: "/home/giao-van-chuyen-bao-hanh?don=:id:trangthai",
        component: OrderSetUserDeadComponent,
        name: "OrderSetUserDeadShipBHComponent",
    },
    {
        path: "/home/chi-tiet-van-chuyen?don=:id",
        component: HomeDetailsOrderExportComponent,
        name: "HomeDetailsOrderExportComponent",
    },
    {
        path: "/kho-luu-tru",
        component: SaveComponent,
        name: "SaveComponent",
    },
    {
        path: "/print-data",
        component: PrintWareHouseComponent,
        name: "PrintWareHouseComponent",
    },
    {
        path: "/data-receipt",
        component: WareHouseListWithReceiptComponent,
        name: "WareHouseListWithReceiptComponent",
    },
    {
      path: "/history-purchase",
      component: HistoryPurcharse,
      name: "HistoryPurcharse",
    },
    {
      path: "/manage-purchase",
      component: ManagePurcharse,
      name: "ManagePurcharse",
    },
];

const router = new VueRouter({
    routes,
    mode: "history",
});

export default router;
