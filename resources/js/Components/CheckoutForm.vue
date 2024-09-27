<template>


    <div class=" container text-lightGray mx-auto">
        <form>
            <div class=" grid grid-cols-2 py-9 px-4 gap-4">

                <div class=" lg:col-span-1  px-11 md:px-0 col-span-2">

                    <div class=" grid grid-cols-2 gap-4 relative">


                        <div class=" md:col-span-1 col-span-2">

                            <label for="first_name" class="label">Name</label>
                            <input type="text" id="first_name" class="product-text-input text-xs"
                                v-model.trim="checkoutForm.first_name">
                            <div v-if="v$.first_name.$errors">

                                <ValidationErrorMessage :errors="v$.first_name.$errors" />
                            </div>
                        </div>
                        <div class=" md:col-span-1 col-span-2">

                            <label for="last_name" class="label">Last Name</label>
                            <input type="text" id="last_name" class="product-text-input text-xs"
                                v-model.trim="checkoutForm.last_name">
                            <div v-if="v$.last_name.$errors">
                                <ValidationErrorMessage :errors="v$.last_name.$errors" />
                            </div>
                        </div>
                        <div class=" md:col-span-1 col-span-2">

                            <label for="email" class="label">Email</label>
                            <input type="text" id="email" class="product-text-input text-xs"
                                v-model.trim="checkoutForm.user_email">
                            <div v-if="v$.user_email.$errors">
                                <ValidationErrorMessage :errors="v$.user_email.$errors" />
                            </div>
                        </div>
                        <div class=" md:col-span-1 col-span-2">

                            <label for="mobile" class="label">Mobile</label>
                            <input type="text" id="mobile" class="product-text-input text-xs"
                                v-model.trim="checkoutForm.mobile">
                            <div v-if="v$.mobile.$errors">
                                <ValidationErrorMessage :errors="v$.mobile.$errors" />
                            </div>

                        </div>
                        <div class=" md:col-span-1 col-span-2">

                            <label for="address" class="label">Shipping Address</label>
                            <textarea cols="10" rows="3" id="address" class="product-text-input text-xs font-light"
                                v-model.trim="checkoutForm.shipping_address"></textarea>
                            <div v-if="v$.shipping_address.$errors">
                                <ValidationErrorMessage :errors="v$.shipping_address.$errors" />
                            </div>

                        </div>
                        <div class=" md:col-span-1 col-span-2">

                            <label for="payment_methods" class="label">Payment Method</label>
                            <select id="payment_methods" v-model.trim="checkoutForm.payment"
                                class=" text-xs product-text-input">
                                <option :value="paymen.id" v-for="paymen in payment_methods" :key="paymen.name">{{
                                    paymen.name }}</option>
                            </select>
                            <div v-if="v$.payment.$errors">
                                <ValidationErrorMessage :errors="v$.payment.$errors" />
                            </div>

                        </div>


                        <div class=" md:col-span-1 col-span-2">
                            <label class="label font-bold">المحافظة</label>
                            <select class="product-text-input text-xs font-light" v-model.trim="checkoutForm.government"
                                @change="getStatesAndShipping()">

                                <option v-for=" govern in governments" :key="govern" :value="govern">
                                    {{ govern.govern_name }}

                                </option>


                            </select>
                            <div v-if="v$.government.$errors">
                                <ValidationErrorMessage :errors="v$.government.$errors" />
                            </div>

                        </div>

                        <div class=" md:col-span-1 col-span-2">
                            <label class="label">المنطقة</label>
                            <select v-model.trim="checkoutForm.state"
                                class="product-text-input uppercase text-xs font-light">

                                <option v-for=" stat in states" :key="stat" :value="stat">
                                    {{ stat.state_name }}

                                </option>

                            </select>
                            <div v-if="v$.state.$errors">
                                <ValidationErrorMessage :errors="v$.state.$errors" />
                            </div>


                        </div>

                        <div class=" md:col-span-1 col-span-2">

                            <label for="billing_address" class="label">Billing Address</label>
                            <textarea id="billing_address" class="product-text-input text-xs" rows="3" cols="10"
                                v-model.trim="checkoutForm.billing_address"></textarea>

                        </div>

                        <div class=" md:col-span-1 col-span-2">

                            <label for="notes" class="label">Notes</label>
                            <textarea id="notes" class="product-text-input text-xs" v-model.trim="checkoutForm.notes"
                                cols="10" rows="3"></textarea>

                        </div>

                    </div>



                </div>

                <div class=" lg:col-span-1 col-span-2 relative  h-full  mt-4 px-5 pt-5 zigzag">
                    <Loading :display="displayLoading" />
                    <p class=" uppercase text-center text-lg text-Purple  font-bold py-3 ">your order</p>
                    <div id="form-container" class=" w-full   bg-white px-5 py-5 ">
                        <div class=" w-full flex justify-between items-center px-6 border-b-2 mb-6">
                            <p class=" uppercase text-center text-sm font-bold text-Purple  py-3 ">product</p>
                            <p class=" uppercase text-center text-sm font-bold text-Purple py-3 ">subtotal</p>

                        </div>

                        <div v-for="( item, index) in cartProducts" :key="item.product.id" class=" px-6  w-full ">

                            <div class=" border-b-2   pt-2">
                                <div class="flex  w-full justify-between items-center">
                                    <p class=" text-xs text-left font-medium">
                                        {{ item.product.product_name }} X {{ item.quantity }}
                                    </p>
                                    <p class=" text-sm text-right">{{ (item.size_price * item.quantity) }} EGP</p>


                                </div>

                                <p class=" text-xs text-left text-Purple uppercase font-bold">bag size:</p>
                                <p class=" text-xs text-left"> {{ item.size.name }}</p>


                                <div class=" mt-1  " v-if="item.options">
                                    <div>
                                        <a :href='"/" + item.product.slug + "/" + index + "/edit"'
                                            class=" italic underline underline-offset-4 font-bold text-Purple  text-xs uppercase ">edit
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
                                <div class="flex items-center text-Purple  justify-between">
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

                        <div class="flex items-center justify-between text-Purple px-6">
                            <p class=" text-sm text-left font-extrabold  uppercase">subtotal</p>
                            <p class=" text-sm text-right font-extrabold uppercase ">{{ totalCartPrice }} EGP</p>
                        </div>

                        <div class="flex items-center justify-between text-Purple px-6">
                            <p class=" text-sm text-left font-extrabold uppercase">shipping</p>
                            <div v-if="checkoutForm.shipping_rate != 'Free Shipping'">
                                <p v-if="checkoutForm.shipping_rate > 0"
                                    class=" text-sm text-right font-extrabold uppercase ">{{ checkoutForm.shipping_rate
                                    }}
                                    EGP</p>
                                <p v-else class=" text-sm text-right font-extrabold uppercase ">
                                    0:00EGP

                                </p>

                            </div>
                            <p v-if="checkoutForm.shipping_rate == 'Free Shipping'"
                                class=" text-sm text-right font-extrabold uppercase ">{{ checkoutForm.shipping_rate }}
                            </p>

                        </div>

                        <div class="flex items-center justify-between text-Purple px-6">
                            <p class=" text-sm text-left font-extrabold uppercase">total order</p>

                            <p class=" text-sm text-right font-extrabold uppercase">{{ order_price }}EGP</p>
                        </div>




                    </div>
                    <div class=" w-full flex justify-center items-center mt-6 ">

                        <div>
                            <SpinnerTag label="PLACE ORDER" class=" w-full block " @click="placeAnOrder" />

                        </div>


                    </div>

                </div>


            </div>
        </form>
    </div>

</template>

<script setup>

import { onMounted, ref, onUpdated, computed, watch, reactive } from 'vue';
import Loading from "./Loading.vue";
import useCartStore from '../stores/cart';
import { storeToRefs } from 'pinia';
import { fetchData } from '../fetchData';
import { useVuelidate } from '@vuelidate/core'
import { required, helpers, maxLength, minLength, email } from '@vuelidate/validators';
import ValidationErrorMessage from './ValidationErrorMessage.vue';


import useNotificationStore from '../stores/notificationStore';


const notificationStore = useNotificationStore();
const { notificationMessage, notificationVisible } = storeToRefs(notificationStore)
const cartStore = useCartStore();
const { cartProducts, totalCartPrice, displayLoading } = storeToRefs(cartStore);
const { Api } = fetchData();




const mobileReg = helpers.regex(/^01[0125][0-9]{8}$/);

const props = defineProps({
    user: Object | undefined,
    payment_methods: Object,
    governments: Object
});
const states = ref();

const order_price = computed(() => {
    if (checkoutForm.shipping_rate == 'Free Shipping' || totalCartPrice.value > 1000 || checkoutForm.shipping_rate == '')
        return totalCartPrice.value
    else

        return checkoutForm.shipping_rate + totalCartPrice.value
})



onMounted(() => {

    cartStore.getItemsPrice()

    if (props.user) {
        checkoutForm.first_name = props.user.first_name;
        checkoutForm.last_name = props.user.last_name;
        checkoutForm.user_email = props.user.email;
        checkoutForm.mobile = props.user.mobile;
        checkoutForm.billing_address = props.user.billing_address;
        checkoutForm.shipping_address = props.user.shipping_address;

    }
    if (totalCartPrice.value >= 1000) {
        checkoutForm.shipping_rate = 'Free Shipping'
    }

})


watch(() => cartProducts.value, (newValue, oldValue) => cartStore.getItemsPrice())

const checkoutForm = reactive({
    first_name: '',
    last_name: '',
    shipping_address: '',
    billing_address: '',
    user_email: '',
    mobile: '',
    payment: '',
    government: null,
    state: '',
    notes: '',
    shipping_rate: 0,
    order_price: 0,
    cart_products: null

})

const getStatesAndShipping = () => {
    displayLoading.value = true;
    if (totalCartPrice.value < 1000) {
        checkoutForm.shipping_rate = checkoutForm.government.shipping_rate
        console.log(checkoutForm.government)


    }

    Api.get(`/checkout/${checkoutForm.government.id}`).then((response) => {
        states.value = response.data.states
        displayLoading.value = false;
    })


}

const rules = computed(() => ({
    first_name: {
        required: helpers.withMessage('Name required', required),
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
        maxLength: helpers.withMessage('3000 char. max', maxLength(3000)),


    },
    user_email: {
        required: helpers.withMessage('Email required', required),
        email: helpers.withMessage('Email required', email)

    },
    mobile: {
        required: helpers.withMessage('Mobile required', required),
        mobileReg: helpers.withMessage('Invalid mobile number', mobileReg)

    },
    government: {
        required: helpers.withMessage('ادخل المحافظة', required),
    },
    state: {
        required: helpers.withMessage('ادخل المنطقة', required),
    },
    payment: {
        required: helpers.withMessage('Pament methode required', required),

    }

}))




const v$ = useVuelidate(rules.value, checkoutForm);

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

        const isFormCorrect = await v$.value.$validate()

        if (!isFormCorrect) {
            displayLoading.value = false;
            notificationVisible.value = true;
            notificationMessage.value = 'Error!!! some input fields are missing/incorrect'
            return
        }
        displayLoading.value = true;
        checkoutForm.order_price = order_price.value
        checkoutForm.cart_products = cartProducts.value



        Api.post('order/store', checkoutForm).then((response) => {
            displayLoading.value = false
            console.log(response)

            if (response.data.message == 'success') {

                if (!localStorage.getItem('user')) {
                    localStorage.removeItem('cartProducts');
                    cartStore.getCartProductsFromStorage();

                }
                else {
                    localStorage.removeItem('cartProducts');
                    cartStore.getCartProductsFromDatabase();
                }
                notificationVisible.value = true;
                notificationMessage.value = 'Order placed successfully'
                window.location.reload();

            }

        })






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