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


import ImagesUploadingFormDialog from './Components/ImagesUploadingFormDialog.vue';
import ServerToast from './Components/ServerToast.vue';
import Button from 'primevue/button';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import ChipComponent from './Components/ChipComponent.vue';
import Chip from 'primevue/chip';
import EditRole from './Components/EditRole.vue';

const app=createApp({});

app.component("RolesTable",RolesTable)
.component('ServerToast',ServerToast)
.component('Button',Button)
.component("DataTable",DataTable)
.component("Column",Column)
.component('ChipComponent',ChipComponent)
.component("Chip",Chip)
.component('EditRole',EditRole)
.use(PrimeVue,{
    unstyled:true,
    pt:Lara
})
.use(ToastService)
.use(DialogService)
.mount('#app');

