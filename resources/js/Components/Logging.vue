<template>
    <div>

    </div>
</template>

<script setup>

import { onMounted } from 'vue';

const props=defineProps({
    user:String|undefined
})

const storeUser=()=>{
    if(props.user)
    {
        localStorage.setItem('user',props.user);
       

    }
    else{
        localStorage.removeItem('user')

    }
   

}
onMounted(()=>{
    storeUser()
})
</script>

<style lang="scss" scoped>

</style>