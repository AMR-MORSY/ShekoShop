<template>
    <div class=" overlay" :class="display? 'display':'display-none'" >

      
        <i class="pi pi-spin pi-cog block " id="text"  style="font-size: 1rem"></i>

    </div>
</template>

<script setup>

const props= defineProps({
    display:Boolean|undefined
})

</script>

<style lang="scss" scoped>
.display{
    display: block;
}
.display-none{
    display: none;
}
.overlay{
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    width: 100%;
    height: 100%;
    background-color: white;
    opacity: 0.6;
    z-index: 100;
   
}
#text{
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%,-50%);
    z-index: 120;
}

</style>