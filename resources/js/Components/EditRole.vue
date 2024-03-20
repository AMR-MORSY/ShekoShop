<template>
    <div class="  flex flex-col items-center ">
        <div class=" w-full mx-auto rounded-lg  bg-white">
            <div class=" flex justify-around rounded-t-lg bg-blue-200">
                <div class=" w-10 flex-none p-3">Id</div>
                <div class=" w-32 flex-none p-3">Name</div>
                <div class=" w-48 flex-1 text-start p-3">Permissions</div>
                <div class=" w-48 flex-1 text-start p-3">Available Permissions</div>

            </div>
            <div class=" flex justify-around">
                <div class=" w-10 flex-none p-3">{{ role.id }}</div>
                <div class="  w-32 flex-none p-3">{{ role.name }}</div>
                <div class="permissionsZone w-48 flex-1 text-start p-3" @drop.prevent
                    @dragenter="permissionsDrop($event)" @dragover.prevent>
                    <div class=" grid grid-cols-3 gap-4" v-if="permissions.length > 0">

                        <Chip :label="permission.name" v-for="permission in permissions" :key="permission.id"
                            @dragstart="dragStart(permission.name, $event)" draggable="true"/>

                    </div>


                    <p v-if="finalPermissions.length == 0">No Permissions </p>






                </div>
                <div class="availableZone w-48 flex-1 text-start p-3" @drop.prevent @dragenter="availableDrop($event)"
                    @dragover.prevent>
                    <div class=" grid grid-cols-2 gap-1" v-if="availablepermissions.length > 0">

                        <Chip class=" dragable availablePerm text-center" draggable="true" :label="permission.name"
                            v-for="permission in availablepermissions" :key="permission.id"
                            @dragstart="dragStart(permission.name, $event)" />

                    </div>


                    <p v-else>No Permissions </p>






                </div>
            </div>
            <div class=" border-t-2 border-blue-300 p-2">
                <Button class=" w-24 p-3 flex justify-center" @click="update">

                    <i v-if="spinner" class="pi  block" :class="spinner ? 'pi-spin pi-cog' : ''"
                        style="font-size: 1rem"></i><span class=" block">Update</span> </Button>

            </div>

        </div>



    </div>

</template>

<script setup>
import { onMounted, ref } from 'vue';
import { fetchData } from '../fetchData';


const props = defineProps({
    role: Object | undefined,
    permissions: Array | undefined,
    availablepermissions: Array | undefined
})

const spinner=ref(false);
let dragged = null;
let permissionName = null
let finalPermissions = ref([]);
const dragStart = (name, event) => {

    dragged = event.target;
    permissionName = name;

}

const availableDrop = (event) => {

    if (event.target.classList.contains('availableZone')) {
        dragged.parentNode.removeChild(dragged);
        event.target.appendChild(dragged);
        if (finalPermissions.value.includes(permissionName)) {
            finalPermissions.value.splice(finalPermissions.value.indexOf(permissionName), 1)
        }

    }



}

const permissionsDrop = (event) => {


    if (event.target.classList.contains('permissionsZone')) {
        dragged.parentNode.removeChild(dragged);
        event.target.appendChild(dragged);

        if (!finalPermissions.value.includes(permissionName)) {
            finalPermissions.value.push(permissionName);
        }


    }

}

const update = () => {
    spinner.value = true;
        const { Api } = fetchData();
        Api.post(`/admin/roles/${props.role.id}`,{"permissions":finalPermissions.value}).then((response) => {
            spinner.value = false;
            console.log(response)
            window.location.href = response.data.redirect;
        })


}

onMounted(()=>{
    if(props.permissions.length>0)
    {
        props.permissions.forEach((element)=>{
            finalPermissions.value.push(element.name)

        })
      
    }
   
})

</script>
