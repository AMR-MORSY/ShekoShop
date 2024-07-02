<template>
    <div>
        <div>
            <select v-model="size" @change="modifyPriceWithSize()">
                <option :value="null">select bag size</option>
                <option :value="siz.name" v-for="siz in sizes" :key="siz.id" :selected="size == siz.name">{{ siz.name }}
                </option>
            </select>
        </div>

        <div v-for="(extra, index) in extras" :key="extra.id">
            <input type="checkbox" v-model="extraOptions" :id="extra.name" :value="extra.id">
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
            <div v-if="target == 'sideCart'">
                <SpinnerButton type="button" :spine="spin" label="UPDATE CART" @click="updateCart()" />
            </div>
            <div v-else-if="target == 'checkout'">
                <SpinnerButton type="button" :spine="spin" label="Go TO CHECKOUT" @click="addToCart()" />
            </div>
            <div v-else>
                <SpinnerButton type="button" :spine="spin" label="ADD TO CART" @click="addToCart()" />
            </div>


            <!-- <SpinnerButton type="button" :spine="spin" label="ADD TO CART" @click="addToCart()" /> -->

            <!-- <SideCart :draw="drawn" @drawer-hidden="hideDrawer()" @drawer-shown="stopSpin()" /> -->


        </div>

        <div class=" mt-10" v-if="size">{{ price }} EGP</div>






    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import SpinnerButton from './SpinnerButton.vue';
import { fetchData } from '../fetchData';

import useCartStore from '../stores/cart';
import useNotificationStore from '../stores/notificationStore';
import { storeToRefs } from 'pinia';

const cartStore = useCartStore();
const notificationStore = useNotificationStore();
const { Api } = fetchData();

const { cartProducts } = storeToRefs(cartStore);
const { notificationMessage, notificationVisible } = storeToRefs(notificationStore)
const props = defineProps({
    sizes: Array | undefined,
    extras: Array | undefined,
    product: Object | undefined,
    prodindex: Number | undefined, //////////props of two names like product index can not be written as camelCase so it must be prodindex
    target: String | undefined
})

const spin = ref(false);


const price = ref(props.product.product_price);
const size = ref(null);
const extraOptions = ref([]);
const quantity = ref(1);


onMounted(() => {
    getProductSizeAndQuantity();
})
const getProductSizeAndQuantity = () => {
    if (props.prodindex) {
        let products = cartProducts.value;
        products = JSON.parse(products);
        let selectedProduct = products[props.prodindex];
        quantity.value = selectedProduct.quantity;
        size.value = selectedProduct.size;
        price.value = selectedProduct.price;
        extraOptions.value = selectedProduct.options


    }

}

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

const checkProductAvailability = () => {
    spin.value = true;

    let cartProduct = {
        'id': props.product.id,
        'quantity': quantity.value,
        'size': size.value,

    }

    Api.post('/checkProductAvailability', cartProduct).then((response) => {
        spin.value = false;

        if (response.data == 'success')
            addProductToCart();
        else {
            notificationMessage.value = `the available stock is only ${response.data}gm`;
            notificationVisible.value = true;

        }


    })
}

const addProductToCart = () => {
    let cartProduct = {
        'product': props.product,
        'quantity': quantity.value,
        'size': size.value,
        'options': extraOptions.value,
        'price': price.value
    }

    Api.post('/addCartProduct', cartProduct).then((response) => {
        console.log(response)
    }).catch((error)=>{
        console.log(error)
    })
    // let products = cartProducts.value;

    // if (props.prodindex)///////// this prop will be defined if the action is updating cart product
    // {
    //     products = JSON.parse(products);
    //     let filteredArray = products.filter(function (value, arrIndex) {
    //         return props.prodindex != arrIndex;

    //     })

    //     products = filteredArray;
    //     products.push(cartProduct);



    // }
    // else {
    //     if (products) {
    //         products = JSON.parse(products);
    //         products.push(cartProduct);




    //     }
    //     else {
    //         products = [];
    //         products.push(cartProduct);
    //     }


    // }


    // localStorage.setItem('cartProducts', JSON.stringify(products))
    // cartStore.getCartProductsFromStorage();
    // if(props.prodindex)
    // {
    //     window.location.replace('/cart');
    // }
    // else{
    //     cartStore.showSideCart();

    // }

    spin.value = false;

}

const checkIfSizeSelected = () => {
    if (size.value == null) {
        notificationVisible.value = true;
        notificationMessage.value = 'please select bag size'
        return false;
    }

    return true;


}
const updateCart = () => {
    if (checkIfSizeSelected()) {

        checkProductAvailability();


    }



}
const addToCart = () => {

    if (checkIfSizeSelected()) {
        checkProductAvailability();

    }











}
</script>

<style lang="scss" scoped></style>