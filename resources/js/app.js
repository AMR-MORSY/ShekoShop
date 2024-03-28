import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

import Lara from "./presets/lara";
import RolesTable from './Components/RolesTable.vue';
import PrimeVue from 'primevue/config';
import ToastService from 'primevue/toastservice';
import 'flowbite';
import { createApp } from 'vue';

import 'primeicons/primeicons.css'
import DialogService from 'primevue/dialogservice';


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
import ProductCartForm from './Components/ProductCartForm.vue';
import SideCart from './Components/SideCart.vue';
const app=createApp({});

app.component("RolesTable",RolesTable)
.component('ServerToast',ServerToast)
.component('Button',Button)
.component("DataTable",DataTable)
.component("Column",Column)
.component('ChipComponent',ChipComponent)
.component("Chip",Chip)
.component('EditRole',EditRole)
.component('ImageContainer',ImageContainer)
.component ('ImagesUploadingForm',ImagesUploadigForm)
.component('DynamicDialog',DynamicDialog)
.component('ProductCartForm',ProductCartForm)
.component('SideCart',SideCart)
.use(PrimeVue,{
    unstyled:true,
    pt:Lara
})
.use(ToastService)
.use(DialogService)
.mount('#app');

