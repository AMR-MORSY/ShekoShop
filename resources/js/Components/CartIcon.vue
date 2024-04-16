<template>
    <div>


        <cart-outline :size="16" @click.prevent="showSideCart" class=" cursor-pointer" />
        <!-- <SideCart :draw="drawn" @drawer-hidden="hideDrawer()" /> -->
    </div>
</template>

<script setup>
import SideCart from './SideCart.vue';
import { ref } from 'vue';
import useCartStore from '../stores/cart';
import { storeToRefs } from 'pinia';

const cartStore = useCartStore();


const drawn = ref(false);
const showSideCart = () => {
   
    cartStore.showSideCart()
}
const hideDrawer = () => {
    drawn.value = false;
}



</script>
