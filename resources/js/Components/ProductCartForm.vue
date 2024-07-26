<template>

    <!-- This component is used in the hidden side cart, it showas the customer the available cart products in Database/localStorage so it always get mounted -->

    <div>


        <div v-if="totalCartPrice == 0">

            <p>CART IS EMPTY</p>

        </div>
        <div v-else id="form-container" class=" position-relative w-full h-full">
            <Loading :display="displayLoading" />

            <div v-for="( item, index) in cartProducts" :key="item.product.id"
                class=" relative border border-1 rounded-xl p-1 mb-3">
                <button v-if="target == 'cart'" type="button" @click.prevent="deleteCartItem(index)"
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
                    <p class=" text-xs text-center">{{ item.size.name }}</p>
                </div>
                <div class=" flex  items-center justify-center" v-if="item.options">
                    <p class=" text-xs text-center mr-1">Extra:</p>
                    <div class=" mt-4">
                        <p class=" text-xs text-center" v-for="option in item.options" :key="option">EGP {{
            option.price }} {{ option.name }}</p>

                    </div>




                </div>
                <div class=" flex-column justify-center  items-center">
                    <p class=" text-xs text-center">Price:{{ (item.price) }} EGP</p>
                    <p v-if="item.availability!='ok'" class=" text-xs font-medium text-center text-red-700">{{item.availability}}gm
                        only in the stock</p>
                </div>

                <div>
                    <a :href='"/" + item.product.slug + "/" + index + "/edit"'>edit</a>


                </div>






            </div>
            <p class=" text-base font-normal">Total Cart Price:{{ totalCartPrice }}EGP</p>

            <div class=" w-full flex justify-center items-center">
                <div v-if="target == 'cart'">
                    <SpinnerTag label="CHECKOUT" class=" w-full block " @click="goToCheckOut" />

                </div>
                <div v-else>
                    <SpinnerTag label="PROCEED" class=" w-full block " />

                </div>


            </div>

        </div>

    </div>




</template>

<script setup>

import { onMounted, ref, onUpdated, onBeforeMount, watch } from 'vue';
import Loading from "./Loading.vue";
import useCartStore from '../stores/cart';
import { storeToRefs } from 'pinia';
import { fetchData } from '../fetchData';

const cartStore = useCartStore();
const { cartProducts } = storeToRefs(cartStore);
const { Api } = fetchData();
const displayLoading = ref(false);

const props = defineProps({
    target: String | undefined
})

watch(() => cartProducts.value, (newValue, oldValue) => getItemsPrice())


const totalCartPrice = ref();

const goToCheckOut = () => {

    cartStore.hideSideCart();
    window.location.assign('/checkout');
}


const getItemsPrice = () => {////////////from database/localstorage based on user authentication

    console.log(props.target)

    if (cartProducts.value != null) {

        cartProducts.value.forEach((element) => {
            element.product_price = element.price * element.quantity
            if (element.options) {
                element.product_price = element.product_price + (element.options.reduce((n, { price }) => n + price, 0))


            }


        })


        totalCartPrice.value = cartProducts.value.reduce((n, { product_price }) => n + product_price, 0)

    }
    else {
        totalCartPrice.value = 0;
    }


    // if (props.target == "checkout") {/////////////here the parent is checkout page. we will check the availability of each cart item (in local storage/database)as maybe after long time the prodcut becomes unavailable

    displayLoading.value = true;
    let newItemsArray = [];
    console.log('hello')
    cartProducts.value.forEach((element) => {
        let newItem = {
            id: element.product.id,
            quantity: element.quantity,
            size: Number(element.size.name.substr(0, element.size.name.indexOf('g')))////removing the letters starts from g and convert the string to number
        }
        newItemsArray.push(newItem)
    })



    Api.post('/checkProductsAvailability', { products: newItemsArray }).then((response) => {

        console.log(response)
        cartProducts.value.forEach((element) => {

            response.data.forEach((obj) => {/////response.data is an array of objects, each object consist of {productid:value,availability:value}
                for (const [key, value] of Object.entries(obj)) {/// Object.entries makes each object's key:value pair as an array then gather them all in one array
                    if (element.product.id == key) {
                        if (value != 'ok') {
                            element.availability = value////adding availability:value element to cartItem showing the available quantity in case of the required quantity less the available
                        }
                        else{
                            element.availability='ok';
                        }
                    }
                }

            })


        })

        displayLoading.value = false;
    })
    // }

}









const deleteCartItem = (index) => {
    // displayLoading.value = true;
    if (localStorage.getItem('user')) {
        Api.delete(`/deleteCartProduct/${cartProducts.value[index].id}`).then((response) => {

            cartStore.getCartProductsFromDatabase();
            getItemsPrice();
            // displayLoading.value = false;

        })

    }
    else {

        cartProducts.value.splice(index, 1);
        localStorage.setItem('cartProducts', JSON.stringify(cartProducts.value))
        cartStore.getCartProductsFromStorage();
        getItemsPrice();
        // displayLoading.value = false;

    }






};


</script>

<style lang="scss" scoped>
#form-container {
    position: relative;
}
</style>