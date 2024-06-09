<template>

    <div id="drawer-bottom-example"
        class="fixed bottom-0 left-0 right-0 z-40 w-full p-4 overflow-y-auto transition-transform bg-white dark:bg-gray-800 transform-none transition-all duration-700 ease-in-out"
        tabindex="-1" aria-labelledby="drawer-bottom-label">
      
        <button type="button" @click.prevent="manipultateDrawer(false)"
            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 absolute top-2.5 end-2.5 inline-flex items-center justify-center dark:hover:bg-gray-600 dark:hover:text-white">
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
            </svg>
            <span class="sr-only">Close menu</span>
        </button>
        <p class="max-w-lg mb-6 text-sm text-gray-500 dark:text-gray-400">
            
            {{ notificationMessage }}
        </p>
      
    </div>


</template>

<script setup>
import { Drawer, initDrawers, initFlowbite } from 'flowbite';


import { onBeforeMount, watch,onMounted } from 'vue';
import useNotificationStore from '../stores/notificationStore';
import { storeToRefs } from 'pinia';
const notificationStore = useNotificationStore();

const { notificationVisible, notificationMessage } = storeToRefs(notificationStore);



onBeforeMount(() => {


    initFlowbite();


    initialzeDrawer()

    



})
onMounted(()=>{
    manipultateDrawer(false)
})


let $triggerEl = document.querySelector("#drawer-bottom-example");
// options with default values
const options = {

    placement: 'bottom',
    backdrop: true,
    bodyScrolling: false,
    edge: false,
    edgeOffset: '',
    backdropClasses:
        'bg-gray-900/50 dark:bg-gray-900/80 fixed inset-0 z-30',
    onHide: () => {

        notificationStore.hideNotification();

    },
    // onShow: () => {

    //     getCartItems();
    // },

};

// instance options object
const instanceOptions = {
    id: 'drawer-bottom-example',
    override: true
};
let drawer = new Drawer($triggerEl, options, instanceOptions);




const initialzeDrawer = () => {
    $triggerEl = document.querySelector("#drawer-bottom-example");
    drawer = new Drawer($triggerEl, options, instanceOptions);



}

const manipultateDrawer = (status) => {
    initialzeDrawer()


    if (status == true) {
        return drawer.show();
    }
    return drawer.hide()

}
watch(() => notificationVisible.value, (newValue, oldValue) => manipultateDrawer(newValue))
</script>

<style lang="scss" scoped></style>