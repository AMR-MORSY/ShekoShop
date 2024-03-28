<template>
    <div>

        <button :type="type" class="text-white relative flex justify-center items-center  bg-Purple hover:bg-fuchsia-600 focus:outline-none  font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2">
            <i  class="pi pi-spin pi-cog block absolute top-50 left-50" :class="spine?'opacity-100':'opacity-0' "  style="font-size: 1rem"></i>

            <span :class="spine?'opacity-0':'opacity-100' ">{{ label }}</span>
        </button>
    </div>
</template>

<script setup>

const props = defineProps({
    type: String | undefined,
    label: String | undefined,
    spine: Boolean | false
})

</script>

<style lang="scss" scoped></style>