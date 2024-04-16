<template>


    <a type="button"
        class="  text-white cursor-pointer relative flex justify-center items-center  bg-Purple hover:bg-fuchsia-600 focus:outline-none  font-medium rounded-full text-sm px-5 py-2.5 text-center ">
        <i class="pi pi-spin pi-cog block absolute top-50 left-50" :class="spine ? 'opacity-100' : 'opacity-0'"
            style="font-size: 1rem"></i>

        <span :class="spine ? 'opacity-0' : 'opacity-100'">{{ label }}</span>
    </a>

</template>

<script setup>

const props = defineProps({
  
    label: String | undefined,
    spine: Boolean | false
})

</script>

<style lang="scss" scoped></style>