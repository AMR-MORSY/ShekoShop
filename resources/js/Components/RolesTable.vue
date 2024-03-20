<template>
    <div>
        <DataTable :value="tableValue">
            <Column field="id" header="Id"></Column>

            <Column field="devision_name" header="Name" v-if="devisions"></Column>
            <Column field="category_name" header="Name" v-else-if="categories"></Column>
            <Column field="name" header="Name" v-else-if="roles"></Column>
            <Column field="name" header="Name" v-else-if="permissions"></Column>
            <Column header="Edit">
                <template #body="slotProps">

                    <Button class=" w-24 p-3 flex justify-between" @click="deleteValue(slotProps.data.id)">

                        <i class="pi pi-cog block" :class="slotProps.data.id == spinner ? 'pi-spin' : ''"
                            style="font-size: 1rem"></i><span class=" block">Delete</span> </Button>



                    <a type="button" v-if="roles" class=" ml-3" :href="`/admin/roles/${slotProps.data.id}`"><Button>View</Button></a>


                    <a type="button" v-if="devisions" class=" ml-3"
                        :href="`/admin/devisions/${slotProps.data.id}`"><Button>View</Button></a>


                    <a type="button" v-if="categories" class=" ml-3"
                        :href="`/admin/categories/${slotProps.data.id}`"><Button>View</Button></a>




                </template>
            </Column>





        </DataTable>
    </div>


</template>

<script setup>
import { onMounted, ref } from 'vue';
import { fetchData } from '../fetchData';
import Column from 'primevue/column';
const props = defineProps({
    roles: Array | undefined,
    permissions: Array | undefined,
    devisions: Array | undefined,
    categories: Array | undefined
})

const tableValue = ref();

const spinner = ref();

onMounted(() => {
    if (props.roles) {
        return tableValue.value = props.roles;
    }
    else if (props.permissions) {
        return tableValue.value = props.permissions;
    }
    else if (props.devisions) {

        return tableValue.value = props.devisions;

    }
    else if (props.categories) {
        return tableValue.value = props.categories;
    }

})

const makeHttpDeleteRequest = (id, url) => {

    spinner.value = id;
    const { Api } = fetchData();

    Api.delete(url).then((response) => {
        spinner.value = '';
        console.log(response)
        window.location.href = response.data.redirect;
    })

}
const deleteValue = (id) => {
    if (props.roles) {

        let url = `roles/${id}`;

        makeHttpDeleteRequest(id, url);


    }

    else if (props.devisions) {

        let url = `devisions/${id}`;

        makeHttpDeleteRequest(id, url);


    }
    else if (props.categories) {

        let url = `categories/${id}`;

        makeHttpDeleteRequest(id, url);


    }



}

</script>
