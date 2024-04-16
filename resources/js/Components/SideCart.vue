<template>
    <div>


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
            <div v-if="cartItems">

                <div v-for="( item, index) in cartItems" :key="item.product.id"
                    class=" relative border border-1 rounded-xl p-1 mb-3">
                    <button type="button" @click.prevent="deleteCartItem(index)"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 absolute top-2.5 end-2.5 inline-flex items-center justify-center dark:hover:bg-gray-600 dark:hover:text-white">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close menu</span>
                    </button>
                    <div class=" flex justify-center items-center pt-8">
                        <div class=" h-16 w-16">
                            <img :src="item.product.images[0].path" alt="" class=" w-full" />

                        </div>
                        <p class=" text-xs text-left font-medium mt-4">
                            {{ item.product.product_name }}
                        </p>
                    </div>
                    <div class=" flex items-center justify-center">
                        <p class=" text-xs text-center">{{ item.quantity }}</p>
                        <p class=" text-xs text-center">X</p>
                        <p class=" text-xs text-center">{{ item.size }}</p>
                    </div>
                    <div class=" flex  items-center justify-center" v-if="item.options.length > 0">
                        <p class=" text-xs text-center mr-1">Extra:</p>
                        <div class=" mt-4">
                            <p class=" text-xs text-center" v-for="option in item.options" :key="option">EGP {{
                option.price }} {{ option.name }}</p>

                        </div>


                    </div>
                    <div class=" flex justify-center items-center">
                        <p class=" text-xs text-center">Price:{{ (item.product_price) }} EGP</p>
                    </div>




                </div>
                <p class=" text-base font-normal">Total Cart Price:{{ totalCartPrice }}EGP</p>


            </div>
            <div class=" w-full flex justify-center items-center">
                <SpinnerTag  label="CHECKOUT" class=" w-full block " @click="goToCheckOut"/>

            </div>
        </div>



    </div>
</template>

<script setup>
import { Drawer, initDrawers, initFlowbite } from 'flowbite';


import { onMounted, watchEffect, ref, reactive, onBeforeMount, watch } from 'vue';
import useCartStore from '../stores/cart';
import { storeToRefs } from 'pinia';
const cartStore = useCartStore();

const { sideCartVisible } = storeToRefs(cartStore);



onBeforeMount(() => {


    initFlowbite();


    initialzeDrawer()

    getCartItems();



})

const initialzeDrawer = () => {
    $triggerEl = document.querySelector("#drawer-right-example");
    drawer = new Drawer($triggerEl, options, instanceOptions);



}

const getStorageItemsArray = () => {
    let storageItems = localStorage.getItem('cartProducts');
    storageItems = JSON.parse(storageItems);

    return storageItems;

}
 const goToCheckOut=()=>{
    console.log(cartItems.value)
 }

const cartItems = ref();
const totalCartPrice = ref();
const getCartItems = () => {

    cartItems.value = getStorageItemsArray();
    if (cartItems.value != null) {
        cartItems.value.forEach((element) => {
            element.product_price = element.price * element.quantity
            element.product_price = element.product_price + (element.options.reduce((n, { price }) => n + price, 0))


        })

        totalCartPrice.value = cartItems.value.reduce((n, { product_price }) => n + product_price, 0)

    }







}

// set the drawer menu element

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

        getCartItems();
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

const deleteCartItem = (index) => {
    let storageItems = [];
    storageItems = getStorageItemsArray();
    storageItems.splice(index, 1);
    localStorage.setItem('cartProducts', JSON.stringify(storageItems))
    cartStore.getCartProductsFromStorage();
    getCartItems();


};

watch(() => sideCartVisible.value, (newValue, oldValue) => manipultateDrawer(newValue))

</script>

<style lang="scss" scoped></style>