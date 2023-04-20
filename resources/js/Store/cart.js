import { defineStore } from "pinia";

export const useCartStore = defineStore("cart", {
    state: () => ({ cart: [] }),
    actions: {
        removeProductFromCart(slug) {
            this.cart.forEach((product, index) => {
                if (product.slug === slug) this.cart.splice(index, 1);
            });
        },
    },
    persist: true,
});
