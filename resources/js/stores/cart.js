import { defineStore } from "pinia";
import { ref, computed } from "vue";
import { fetchData } from "../fetchData";
const useCartStore = defineStore("cart", () => {
    let cartProducts = ref();
    let {Api}=fetchData();
    if (localStorage.getItem("user_id")) {
        Api.get('').then((response)=>{
            console.log(response)
        })


    } else {
        cartProducts = ref(localStorage.getItem("cartProducts"));
    }

    const sideCartVisible = ref(false);

    const cartProductsCount = computed(() => {
        if (cartProducts.value) {
            return JSON.parse(cartProducts.value).length;
        }
        return 0;
    });

    function getCartProductsFromStorage() {
        cartProducts.value = localStorage.getItem("cartProducts");
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
        sideCartVisible,
        showSideCart,
        hideSideCart,
    };
});

export default useCartStore;
