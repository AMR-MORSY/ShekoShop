<template>
    <div>
        <div>
            <select v-model="size" @change="modifyPriceWithSize()">
                <option :value="null">select bag size</option>
                <option :value="size.name" v-for="size in sizes" :key="size.id">{{ size.name }}</option>
            </select>
        </div>

        <div v-for="(extra, index) in extras" :key="extra.id">
            <input type="checkbox" v-model="extraOptions" :id="extra.name" :value="{'price':extra.price,'name':extra.name}">
            <span class=" mx-4">{{ extra.price }} EGP</span>
            <label :for="extra.name">{{ extra.name }}</label>


        </div>

        <div class=" flex  justify-between items-center">
            <div class=" flex items-center justify-center">
                <button
                    class=" w-10 h-10 flex items-center justify-center border border-1 rounded-l-full hover:bg-Purple hover:text-white cursor-pointer"
                    @click.prevent="decrement()">-</button>
                <div class=" w-10 h-10 flex items-center justify-center border border-1">{{ quantity }}</div>
                <button
                    class=" w-10 h-10 flex items-center justify-center border border-1 rounded-r-full hover:bg-Purple hover:text-white cursor-pointer"
                    @click.prevent="increment()">+</button>
            </div>


            <SpinnerButton type="button" :spine="spin" label="ADD TO CART" @click="addToCart()" />

            <!-- <SideCart :draw="drawn" @drawer-hidden="hideDrawer()" @drawer-shown="stopSpin()" /> -->
           

        </div>

        <div class=" mt-10" v-if="size">{{ price }} EGP</div>






    </div>
</template>

<script setup>
import { ref } from 'vue';
import SpinnerButton from './SpinnerButton.vue';

import useCartStore from '../stores/cart';
import { storeToRefs } from 'pinia';

const cartStore = useCartStore();

const { cartProducts } = storeToRefs(cartStore);
const props = defineProps({
    sizes: Array | undefined,
    extras: Array | undefined,
    product: Object | undefined
})

const spin = ref(false);
// const drawn = ref(false);

const price = ref(props.product.product_price);
const size = ref(null);
const extraOptions = ref([]);
const quantity = ref(1);

const modifyPriceWithSize = () => {

    if (size) {
        if (size.value == "250gm") {
            price.value = props.product.product_price 

        }
       else if (size.value == "500gm") {
            price.value = props.product.product_price * 2

        }
        else if (size.value == "1000gm") {
            price.value = props.product.product_price * 4;
        }
    }

}


const increment = () => {
    if (quantity.value != 10) {
        quantity.value++
      
    }
}

const decrement = () => {
    if (quantity.value != 1) {
        quantity.value--;
       
    }
}

const addToCart = () => {
    if (size.value == null) {
        return;
    }
    spin.value = true
    let cartProduct = {
        'product': props.product,
        'quantity': quantity.value,
        'size': size.value,
        'options': extraOptions.value,
        'price': price.value
    }
    let products = cartProducts.value;
    if (products) {
        products = JSON.parse(products);
        products.push(cartProduct);

    }
    else {
        products = [];
        products.push(cartProduct);
    }
    localStorage.setItem('cartProducts', JSON.stringify(products))
    cartStore.getCartProductsFromStorage();
    cartStore.showSideCart();
    spin.value = false;



    // drawn.value = true


}
</script>

<style lang="scss" scoped></style>