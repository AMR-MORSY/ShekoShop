<template>
    <div>

    </div>
</template>

<script setup>

import { onMounted } from 'vue';

 import useCartStore from '../stores/cart';

const cartStore = useCartStore();

const props = defineProps({
    user: String | undefined
})



const storeUser = () => {
    if (props.user) {
        localStorage.setItem('user', props.user);
       
        cartStore.getCartProductsFromDatabase();


    }
    else {
        if (localStorage.getItem('user')) {
            localStorage.removeItem("user");

        }

        
          cartStore.getCartProductsFromStorage();

    }


}
onMounted(() => {
    storeUser()
})
</script>

<style lang="scss" scoped></style>