import { defineStore } from "pinia";
import { ref, computed } from "vue";
import { fetchData } from "../fetchData";


const useCartStore = defineStore("cart", () => {
  
    const { Api } = fetchData();
    const cartProducts = ref();
   
    

    const sideCartVisible = ref(false);

    const cartProductsCount = computed(() => {
        if (cartProducts.value) {
            return cartProducts.value.length;
        }
        return 0;
    });
    function getCartProductsFromDatabase()
    {
        console.log('database')
        Api.get("/getAuthUserCartProducts").then((response) => {
         
            cartProducts.value = response.data.products;
        });

    }

    function getCartProductsFromStorage() {
        console.log('storage')
        let products=localStorage.getItem("cartProducts");
        cartProducts.value = JSON.parse(products);
       
    }

    function showSideCart() {
        sideCartVisible.value = true;
    }
    function hideSideCart() {
        sideCartVisible.value = false;
    }

    return {
        cartProducts,
        cartProductsCount,
        getCartProductsFromStorage,
        getCartProductsFromDatabase,
        sideCartVisible,
        showSideCart,
        hideSideCart,
    };
});

export default useCartStore;
