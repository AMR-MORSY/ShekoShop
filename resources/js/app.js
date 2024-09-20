




// import './bootstrap';

import '../css/app.css';


import Lara from "./presets/lara";
import RolesTable from './Components/RolesTable.vue';
import PrimeVue from 'primevue/config';
import ToastService from 'primevue/toastservice';
import 'flowbite';
import { createApp } from 'vue';

import 'primeicons/primeicons.css'
import DialogService from 'primevue/dialogservice';

import { createPinia } from 'pinia'
import ImagesUploadigForm from "./Components/ImagesUploadingForm.vue";
import ImageContainer from './Components/ImageContainer.vue';
import ServerToast from './Components/ServerToast.vue';
import Button from 'primevue/button';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import ChipComponent from './Components/ChipComponent.vue';
import Chip from 'primevue/chip';
import EditRole from './Components/EditRole.vue';
import DynamicDialog from 'primevue/dynamicdialog';
import CartProducts from './Components/CartProducts.vue';
import SideCart from './Components/SideCart.vue';
import CartIcon from './Components/CartIcon.vue';
import CartProductsCount from './Components/CartProductsCount.vue';

import CartOutline from 'vue-material-design-icons/CartOutline.vue';
import SpinnerButton from './Components/SpinnerButton.vue';
import SpinnerTag from './Components/SpinnerTag.vue';
import Notification from './Components/Notification.vue';
import CheckoutForm from './Components/CheckoutForm.vue';
import ProductFrom from './Components/ProductForm.vue';
import Logging from './Components/Logging.vue';
import Loading from './Components/Loading.vue';

const app=createApp({});
const pinia = createPinia()



app.component("RolesTable",RolesTable)
.component('ServerToast',ServerToast)
.component('CheckoutForm',CheckoutForm)
.component('ProductForm',ProductFrom)
.component('Button',Button)
.component("DataTable",DataTable)
.component("Column",Column)
.component('ChipComponent',ChipComponent)
.component("Chip",Chip)
.component('EditRole',EditRole)
.component('ImageContainer',ImageContainer)
.component ('ImagesUploadingForm',ImagesUploadigForm)
.component('DynamicDialog',DynamicDialog)
.component('CartProducts',CartProducts)
.component('SideCart',SideCart)
.component('CartIcon',CartIcon)
.component('CartProductsCount',CartProductsCount)
.component ("CartOutline",CartOutline)
.component('SpinnerButton',SpinnerButton)
.component("SpinnerTag",SpinnerTag)
.component('Notification',Notification)
.component('Logging',Logging)
.component('Loading',Loading)
.use(PrimeVue,{
    unstyled:true,
    pt:Lara
})
.use(ToastService)
.use(DialogService)
.use(pinia)


.mount('#app');


