<template>
    <div style="color: red; font-size: 0.7rem; padding-left: 3px; padding-top: 3px;" v-for="error in errors">
        {{ error.$message }}</div>
</template>

<script setup>

const props = defineProps({
    errors: Array
})

</script>

<style lang="scss" scoped></style>