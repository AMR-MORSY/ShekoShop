<template>


    
        <div id="drawer-right-example"
            class="fixed top-0 right-0 z-40 h-screen p-4 overflow-y-auto transition-transform translate-x-full bg-white w-80 dark:bg-gray-800"
            tabindex="-1" aria-labelledby="drawer-right-label">
         
            <h5 id="drawer-right-label"
                class="inline-flex items-center mb-4 text-base font-semibold text-gray-500 dark:text-gray-400"><svg
                    class="w-4 h-4 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                    viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                </svg>Right drawer</h5>
            <button type="button" @click.prevent="manipultateDrawer(false)"
                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 absolute top-2.5 end-2.5 inline-flex items-center justify-center dark:hover:bg-gray-600 dark:hover:text-white">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
                <span class="sr-only">Close menu</span>
            </button>


            <CartProducts target="cart" />


        </div>

   
      
    
    

  





</template>

<script setup>
import { Drawer, initDrawers, initFlowbite } from 'flowbite';
import Loading from './Loading.vue';


import { onMounted, watchEffect, ref, reactive, onBeforeMount, watch } from 'vue';
import useCartStore from '../stores/cart';
import { storeToRefs } from 'pinia';
const cartStore = useCartStore();

const { sideCartVisible } = storeToRefs(cartStore);



onBeforeMount(() => {


    initFlowbite();


    initialzeDrawer()

   



})

const initialzeDrawer = () => {
    $triggerEl = document.querySelector("#drawer-right-example");
    drawer = new Drawer($triggerEl, options, instanceOptions);



}


let $triggerEl = document.querySelector("#drawer-right-example");
// options with default values
const options = {

    placement: 'right',
    backdrop: true,
    bodyScrolling: false,
    edge: false,
    edgeOffset: '',
    backdropClasses:
        'bg-gray-900/50 dark:bg-gray-900/80 fixed inset-0 z-30',
    onHide: () => {

        cartStore.hideSideCart();

    },
    onShow: () => {
        // cartStore.getCartProductsFromStorage()

        // getCartItems();
    },

};

// instance options object
const instanceOptions = {
    id: 'drawer-right-example',
    override: true
};
let drawer = new Drawer($triggerEl, options, instanceOptions);



const manipultateDrawer = (status) => {
    initialzeDrawer()


    if (status == true) {
        return drawer.show();
    }
    return drawer.hide()

}


watch(() => sideCartVisible.value, (newValue, oldValue) => manipultateDrawer(newValue))

</script>

<style lang="scss" scoped></style>