<template>
    <div>
        <div>
            <select v-model="size" @change="modifyPriceWithSize()">
                <option :value="null">select bag size</option>
                <option :value="size.id" v-for="size in sizes" :key="size.id">{{ size.name }}</option>
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


            <SpinnerButton type="button" :spine="spin" label="ADD TO CART" @click="addToCart()"/>
           
            <SideCart :draw="drawn" @drawer-hidden="hideDrawer()" @drawer-shown="stopSpin()"/>

        </div>

        <div class=" mt-10" v-if="size">{{ price}} EGP</div>
     





    </div>
</template>

<script setup>
import { ref } from 'vue';
import SpinnerButton from './SpinnerButton.vue';
import SideCart from './SideCart.vue';
const props = defineProps({
    sizes: Array | undefined,
    extras: Array | undefined,
    product:Object|undefined
})

const spin=ref(false);
const drawn=ref(false);

const price=ref(props.product.product_price);

const modifyPriceWithSize=()=>{
    console.log(size.value)
    if(size)
    {
        if(size.value==2)
        {
            price.value=props.product.product_price*2

        }
        else if(size.value==3)
        {
            price.value=props.product.product_price*3;
        }
    }

}

const stopSpin=()=>{
    spin.value=false;

}
const hideDrawer=()=>{
    drawn.value=false;
   
}
const size = ref(null);
const extraOptions = ref([]);
const quantity = ref(1);
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

const addToCart=()=>{
    if(size.value==null)
    {
        return ;
    }
    spin.value=true
    let cartProduct={
        'product':props.product,
        'quantity':quantity.value,
        'size':size.value,
        'options':extraOptions.value
    }

    console.log(cartProduct);

    drawn.value=true
 return ;
 
}
</script>

<style lang="scss" scoped></style>