import { defineStore } from "pinia";
import { ref, computed } from "vue";
import { fetchData } from "../fetchData";
import useCookiesStore from "./cookies";

const useCartStore = defineStore("cart", () => {
    const cookiesStore=useCookiesStore();
    const { Api } = fetchData();
    const cartProducts = ref();

    const totalCartPrice = ref();

    const displayLoading=ref(false);

    const sideCartVisible = ref(false);

    const cartProductsCount = computed(() => {
        if (cartProducts.value) {
            return cartProducts.value.length;
        }
        return 0;
    });

    function getCartProductsFromDatabase() {
        if (localStorage.getItem("cartProducts")) {
            let products = localStorage.getItem("cartProducts");
            products = JSON.parse(products);
            Api.post("/addCartProducts", { products: products }).then(
                (response) => {
                    if (response.data.message == "success") {
                        localStorage.removeItem("cartProducts");
                        deleteProductsCookie()
                        Api.get("/getAuthUserCartProducts").then((response) => {
                           
                            cartProducts.value = response.data.products;
                        });
                    }
                }
            );
        } else {
            Api.get("/getAuthUserCartProducts").then((response) => {
                cartProducts.value = response.data.products;
               
            });
        }
    }

    function deleteProductsCookie()
    {
        let cookie_products=cookiesStore.getCookie('products')
          
        if(cookie_products)
        {
            
            cookiesStore.eraseCookie('products')
        }

    }

    function getCartProductsFromStorage() {
       
        if (localStorage.getItem("cartProducts")) {
            let products = localStorage.getItem("cartProducts");
            cartProducts.value = JSON.parse(products);
            cookiesStore.setCookie('products',true,1000 )
            
        } else {
            cartProducts.value = null;
            deleteProductsCookie()
          
        }
    }

    function showSideCart() {
        sideCartVisible.value = true;
    }
    function hideSideCart() {
        sideCartVisible.value = false;
    }

    const reformingCartProductsBasedOnAvailability = (products) => {
        cartProducts.value.forEach((element) => {
            products.forEach((obj) => {
                /////response.data is an array of objects, each object consist of {productid:value,availability:value}
                for (const [key, value] of Object.entries(obj)) {
                    /// Object.entries makes each object's key:value pair as an array then gather them all in one array
                    if (element.product.id == key) {
                        if (value != "ok") {
                            element.availability = value; ////adding availability:value element to cartItem showing the available quantity in case of the required quantity less the available
                        } else {
                            element.availability = "ok";
                        }
                    }
                }
            });
        });
         displayLoading.value = false;
    };

    const checkProductsAvailabilityStock = () => {
        let newItemsArray = [];
        cartProducts.value.forEach((element) => {
            let newItem = {
                id: element.product.id,
                quantity: element.quantity,
                size: Number(
                    element.size.name.substr(0, element.size.name.indexOf("g"))
                ), ////removing the letters starts from g and convert the string to number
            };
            newItemsArray.push(newItem);
        });

        Api.post("/checkProductsAvailability", {
            products: newItemsArray,
        }).then((response) => {
            let products = response.data;

            reformingCartProductsBasedOnAvailability(products);
        });
    };
    const getItemsPrice = () => {
        ////////////from database/localstorage based on user authentication will be called as long as cart products updated

       
        if (cartProducts.value != null) {
            displayLoading.value = true;
            totalCartPrice.value = cartProducts.value.reduce(
                (n, { product_final_price }) => n + product_final_price,
                0
            );

            checkProductsAvailabilityStock();
        } else {
            totalCartPrice.value = 0;
        }
    };

    const deleteCartItem = (index) => {
        if (localStorage.getItem("user")) {
            Api.delete(
                `/deleteCartProduct/${cartProducts.value[index].id}`
            ).then((response) => {
                getCartProductsFromDatabase();
                getItemsPrice();
            });
        } else {
            cartProducts.value.splice(index, 1);
            if(cartProducts.value.length>0)
            {
                localStorage.setItem(
                    "cartProducts",
                    JSON.stringify(cartProducts.value)
                );
                getCartProductsFromStorage();
                getItemsPrice();

            }
            else{
                totalCartPrice.value=0;
                localStorage.removeItem("cartProducts")
                getCartProductsFromStorage();
            }
          
        }
    };

    return {
        cartProducts,
        cartProductsCount,
        getCartProductsFromStorage,
        getCartProductsFromDatabase,
        sideCartVisible,
        showSideCart,
        hideSideCart,
        getItemsPrice,
        totalCartPrice,
        deleteCartItem,
        displayLoading
    };
});

export default useCartStore;
