import login from './components/authViews/login.vue';
import register from './components/authViews/register.vue';
import home from './components/mainViews/home.vue';
import products from './components/mainViews/products/products';
import oneProduct from './components/mainViews/products/oneProduct.vue';
import MakeProfile from './components/authViews/MakeProfile.vue';
import productsCart from './components/mainViews/products/productsCart.vue';
import orders from './components/mainViews/products/orders.vue';
import forgotPassword from './components/authViews/forgotPassword.vue';
import resetPassword from './components/authViews/resetPassword.vue';
import resetMailSended from './components/authViews/resetMailSended.vue';
import emailVerificationMessage from './components/authViews/emailVerificationMessage.vue';
import emailVerification from './components/authViews/emailVerification.vue';
import dashboard from './components/mainViews/dashboard/dashboardApp.vue';

import facturation from './components/mainViews/products/facturationOrderBill.vue';
import denyOrderItemReceiveAppVue from './components/mainViews/products/denyOrderItemReceiveAppVue.vue';
import confirmOrderItemReceiveAppVue from './components/mainViews/products/confirmOrderItemReceiveAppVue.vue';


import { createWebHashHistory, createRouter } from 'vue-router'



const router = createRouter({
    history: createWebHashHistory(),
    routes: [
        {path : "/" , component : home },
        {path : "/login" , component : login },
        {path : "/register" , component : register },
        {path : "/products" , component : products },
        {path : "/oneProduct" , component : oneProduct  , name:"product-card"},
        {path : "/profile" , component : MakeProfile },
        {path : "/cart" , component : productsCart },
        {path : "/orders" , component : orders },
        {path : "/forgotPassword" , component : forgotPassword },
        {path : "/resetPassword" , component : resetPassword },
        {path : "/resetMailSended" , component : resetMailSended },
        {path : "/emailVerification" , component : emailVerificationMessage },
        {path : "/emailVerificationRequest" , component : emailVerification },
        {path : "/dashboard" , component : dashboard },
        {path : "/facturation" , component : facturation  , name:"orderBill"},
        {path : "/confirmOrderItemReceiveAppVue" , component : confirmOrderItemReceiveAppVue  , name:"confirmOrderItemReceiveAppVue"},
        {path : "/denyOrderItemReceiveAppVue" , component : denyOrderItemReceiveAppVue  , name:"denyOrderItemReceiveAppVue"},

    ],
    linkActiveClass: 'active'
  })

  export default router


