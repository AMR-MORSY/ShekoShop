<template>


    <div class=" container mx-auto">
        <form>
            <div class=" grid grid-cols-2 py-9 px-4 gap-4">

                <div class=" lg:col-span-1 col-span-2">

                    <div class=" grid grid-cols-2 gap-4 relative">


                        <div class=" md:col-span-1 col-span-2">

                            <label for="first_name" class="label">Name</label>
                            <input type="text" id="first_name" class="product-text-input" v-model="first_name">
                            <div v-if="v$.name.$errors">
                             
                                     <ValidationErrorMessage :errors="v$.name.$errors"/>
                            </div>
                        </div>
                        <div class=" md:col-span-1 col-span-2">

                            <label for="last_name" class="label">Last Name</label>
                            <input type="text" id="last_name" class="product-text-input" v-model="last_name">

                            <ValidationErrorMessage :errors="v$.last_name.$errors"/>
                        </div>
                        <div class=" md:col-span-1 col-span-2">

                            <label for="email" class="label">Email</label>
                            <input type="text" id="email" class="product-text-input" v-model="user_email">
                            <ValidationErrorMessage :errors="v$.user_email.$errors"/>
                        </div>
                        <div class=" md:col-span-1 col-span-2">

                            <label for="mobile" class="label">Mobile</label>
                            <input type="text" id="mobile" class="product-text-input" v-model="mobile">
                            <ValidationErrorMessage :errors="v$.mobile.$errors"/>

                        </div>
                        <div class=" md:col-span-1 col-span-2">

                            <label for="address" class="label">Shipping Address</label>
                            <textarea cols="10" rows="3" id="address" class="product-text-input text-xs font-light"
                                v-model="shipping_address"></textarea>
                                <ValidationErrorMessage :errors="v$.shipping_address.$errors"/>

                        </div>
                        <div class=" md:col-span-1 col-span-2">

                            <label for="payment_methods" class="label">Payment Method</label>
                            <select id="payment_methods" v-model="payment" class="product-text-input">
                                <option :value="paymen.id" v-for="paymen in payment_methods" :key="paymen.name">{{
                                    paymen.name }}</option>
                            </select>

                        </div>


                        <div class=" md:col-span-1 col-span-2">
                            <label class="label text-sm font-bold">Government</label>
                            <select class="product-text-input text-xs font-light" v-model="government"
                                @change="getStatesAndShipping()">

                                <option v-for=" govern in governments" :key="govern" :value="govern">
                                    {{ govern.govern_name }}

                                </option>


                            </select>
                            <ValidationErrorMessage :errors="v$.government.$errors"/>


                        </div>
                     
                        <div class=" md:col-span-1 col-span-2">
                            <label class="label">States</label>
                            <select v-model="state" class="product-text-input uppercase text-xs font-light">

                                <option v-for=" stat in states" :key="stat" :value="stat.state_name">
                                    {{ stat.state_name }}

                                </option>

                            </select>

                        </div>

                        <div class=" md:col-span-1 col-span-2">

                            <label for="billing_address" class="label">Billing Address</label>
                            <input type="text" id="billing_address" class="product-text-input"
                                v-model="billing_address">

                        </div>

                        <div class=" md:col-span-1 col-span-2">

                            <label for="notes" class="label">Notes</label>
                            <textarea id="notes" class="product-text-input" v-model="notes" cols="10"
                                rows="3"></textarea>

                        </div>

                    </div>

                </div>

                <div class=" lg:col-span-1 col-span-2 relative  mt-4 px-5 pt-5 zigzag">
                    <Loading :display="displayLoading" />
                    <p class=" uppercase text-center text-lg font-extrabold py-3 ">your order</p>
                    <div id="form-container" class=" w-full h-96 bg-white px-5 py-5 overflow-y-scroll">
                        <div class=" w-full flex justify-between items-center px-6 border-b-2 mb-6">
                            <p class=" uppercase text-center text-sm font-extrabold  py-3 ">product</p>
                            <p class=" uppercase text-center text-sm font-extrabold py-3 ">subtotal</p>

                        </div>



                        <div v-for="( item, index) in cartProducts" :key="item.product.id" class=" px-6  w-full ">

                            <div class=" border-b-2   pt-2">
                                <div class="flex w-full justify-between items-center">
                                    <p class=" text-xs text-left font-medium">
                                        {{ item.product.product_name }} X {{ item.quantity }}
                                    </p>
                                    <p class=" text-sm text-right">{{ (item.size_price * item.quantity) }} EGP</p>


                                </div>

                                <p class=" text-sm text-left uppercase font-semibold">bag size:</p>
                                <p class=" text-xs text-left"> {{ item.size.name }}</p>


                                <div class=" mt-1  " v-if="item.options">
                                    <div>
                                        <a :href='"/" + item.product.slug + "/" + index + "/edit"'
                                            class=" italic underline underline-offset-4 font-extrabold text-xs uppercase ">edit
                                            options</a>
                                    </div>
                                    <p class=" text-xs text-left mr-1">Extra:</p>
                                    <div class=" flex w-full justify-between items-center">
                                        <div>
                                            <p class=" text-xs text-left" v-for="option in item.options" :key="option">
                                                {{ option.price }} EGP {{ option.name }}</p>

                                        </div>

                                        <p class=" text-sm text-center">{{ (item.extra_quantity_prices)
                                            }}EGP</p>

                                    </div>









                                </div>
                                <div class="flex items-center justify-between">
                                    <p class=" text-sm text-left font-extrabold uppercase">total</p>
                                    <p class=" text-sm text-right font-extrabold uppercase">{{
                                        (item.product_final_price) }} EGP</p>
                                </div>

                            </div>









                            <div class=" flex-column justify-center  items-center">

                                <p v-if="item.availability != 'ok'"
                                    class=" text-xs font-medium text-center text-red-700">
                                    {{ item.availability }}gm
                                    only in the stock</p>
                            </div>





                        </div>

                        <div class="flex items-center justify-between px-6">
                            <p class=" text-sm text-left font-extrabold uppercase">subtotal</p>
                            <p class=" text-sm text-right font-extrabold uppercase ">{{ totalCartPrice }} EGP</p>
                        </div>

                        <div class="flex items-center justify-between px-6">
                            <p class=" text-sm text-left font-extrabold uppercase">shipping</p>
                            <p class=" text-sm text-right font-extrabold uppercase ">{{ shipping_rate }} EGP</p>
                        </div>


                        <div class=" w-full flex justify-center items-center">

                            <div>
                                <SpinnerTag label="PLACE ORDER" class=" w-full block " @click="placeAnOrder" />

                            </div>


                        </div>


                    </div>

                </div>


            </div>
        </form>
    </div>

</template>

<script setup>

import { onMounted, ref, onUpdated, computed, watch } from 'vue';
import Loading from "./Loading.vue";
import useCartStore from '../stores/cart';
import { storeToRefs } from 'pinia';
import { fetchData } from '../fetchData';
import { useVuelidate } from '@vuelidate/core'
import { required, helpers, maxLength, minLength,email } from '@vuelidate/validators';
import ValidationErrorMessage from './ValidationErrorMessage.vue';


import useNotificationStore from '../stores/notificationStore';


const notificationStore = useNotificationStore();
const { notificationMessage, notificationVisible } = storeToRefs(notificationStore)
const cartStore = useCartStore();
const { cartProducts, totalCartPrice, displayLoading } = storeToRefs(cartStore);
const { Api } = fetchData();



const first_name = ref('');
const last_name = ref('');
const shipping_address = ref('');
const billing_address = ref('');
const user_email = ref('');
const mobile = ref('');
const payment = ref('cash on delivery');
const government = ref('Cairo');
const state = ref();
const notes = ref('');
const shipping_rate = ref();
const states = ref(null);

const mobileReg = helpers.regex(/^01[0125][0-9]{8}$/);

const props = defineProps({
    user: Object,

    payment_methods: Object,
    governments: Object
});

onMounted(() => {
    if (props.user) {

        first_name.value = props.user.first_name;
        last_name.value = props.user.last_name;
        email.value = props.user.email;
        mobile.value = props.user.mobile;
        billing_address.value = props.user.billing_address;
        shipping_address.value = props.user.shipping_address;

    }

})


watch(() => cartProducts.value, (newValue, oldValue) => cartStore.getItemsPrice())



const getStatesAndShipping = () => {
    displayLoading.value = true;
    shipping_rate.value = government.value.shipping_rate
    Api.get(`/checkout/${government.value.id}`).then((response) => {
        states.value = response.data.states
        displayLoading.value = false;
    })


}

const rules = computed(() => ({
    name: {
        required: helpers.withMessage('Name required', required),
        // nameReg: helpers.withMessage('char. may include(_-)', nameReg),
        maxLength: helpers.withMessage('30 char. max', maxLength(30)),
        minLength: helpers.withMessage('at least 3 char', minLength(3))

    },
    last_name: {
        required: helpers.withMessage('Last name required', required),
        maxLength: helpers.withMessage('30 char. max', maxLength(30)),
        minLength: helpers.withMessage('at least 3 char', minLength(3))


    },
    shipping_address: {
        required: helpers.withMessage('Shipping address required', required),
        maxLength: helpers.withMessage('30 char. max', maxLength(3000)),
        minLength: helpers.withMessage('at least 3 char', minLength(100))

    },
    user_email: {
        required: helpers.withMessage('Email required', required),
        email:helpers.withMessage('Email required', email)

    },
    mobile: {
        required: helpers.withMessage('Mobile required', required),
        mobileReg:helpers.withMessage('Invalid mobile number',mobileReg)

    },
    government:{
        required: helpers.withMessage('Government required', required),
    }

}))




const v$ = useVuelidate(rules.value, first_name.value);

const placeAnOrder = async () => {

    displayLoading.value = true;

    let unavailableProducts = cartProducts.value.filter((element) => {

        return element.availability != "ok";



    })

    if (unavailableProducts.length > 0) {
        notificationVisible.value = true;
        notificationMessage.value = 'SOME CART ITEMS ARE NOT AVAILABLE'
        displayLoading.value = false;
        return;

    }
    else {
        if (localStorage.getItem('user')) {////////////////place an order for authorized users

        }
        else {
            const isFormCorrect = await v$.value.$validate()
            if (!isFormCorrect) return
        }

    }

};




</script>

<style scoped>
.zigzag {
    position: relative;
    background-color: #F8F8F8;


}

.zigzag::after {
    content: '';
    position: absolute;
    width: 100%;
    top: -10px;
    left: 0;
    right: 0;
    height: 20px;
    background: radial-gradient(circle, white 10px, transparent 50%);
    background-size: 20px;


}

.zigzag::before {
    content: '';
    position: absolute;
    width: 100%;
    bottom: -10px;
    left: 0;
    right: 0;
    height: 20px;
    background: radial-gradient(circle, white 10px, transparent 50%);
    background-size: 20px;


}
</style>