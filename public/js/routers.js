import VueRouter from "vue-router"
import LoginCompoment from '../../resources/js/login/LoginCompoment';
import HomeComponent from '../../resources/js/home/HomeComponent';
import HomeEditComponent from '../../resources/js/home/HomeEditComponent';
import HomeCreateComponent from '../../resources/js/home/HomeCreateComponent';
import HomeExportComponent from '../../resources/js/home/HomeExportComponent';

import OrderComponent from '../../resources/js/order/OrderComponent';
import OrderSetUserDeadComponent from '../../resources/js/order/OrderSetUserDeadComponent';

import AnalysisComponent from '../../resources/js/analysis/AnalysisComponent';
import UserComponent from '../../resources/js/user/UserComponent';


const routes = [
    {
        path: "/",
        component: LoginCompoment,
        name: "LoginCompoment"
    },
    {
        path: "/home",
        component: HomeComponent,
        name: "HomeComponent"
    },
    {
        path: "/order",
        component: OrderComponent,
        name: "OrderComponent"
    },
    {
        path: "/analysis",
        component: AnalysisComponent,
        name: "AnalysisComponent"
    },
    {
        path: "/user",
        component: UserComponent,
        name: "UserComponent"
    },
    {
        path: "/home/edit?id=:id&seri=:seri",
        component: HomeEditComponent,
        name: "HomeEditComponent"
    },
    {
        path: "/home/tao-kho-hang",
        component: HomeCreateComponent,
        name: "HomeCreateComponent"
    },
    {
        path: "/home/xuat-kho-hang?don=:id:tong:daxuat",
        component: HomeExportComponent,
        name: "HomeExportComponent"
    },
    {
        path: "/home/giao-van-chuyen?don=:id",
        component: OrderSetUserDeadComponent,
        name: "OrderSetUserDeadComponent"
    },
    
]

const router = new VueRouter({
    routes,
    mode: "history"
});

export default router;