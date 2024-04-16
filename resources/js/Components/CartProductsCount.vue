<template>
    <div>
{{ cartProductsCount }}
    </div>
</template>

<script setup>
import useCartStore from '../stores/cart';
import { storeToRefs } from 'pinia';

const cartStore=useCartStore();

const {cartProductsCount}=storeToRefs(cartStore);

</script>

<style lang="scss" scoped>

</style>