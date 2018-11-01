export const state = () => ({
    products : [],
    empty : true,
    subtotal : null,
    total : null,
    changed : false
})
export const getters = {
    products (state) {
        return state.products
    },
    count (state) {
        return state.products.length
    },
    empty (state) {
        return state.empty
    },
    total (state) {
        return state.total
    },
    subtotal (state) {
        return state.subtotal
    },
    changed (state) {
        return state.changed
    }
}
export const mutations = {
    SET_PRODUCTS(state, products){
        state.products = products
    },
    SET_EMPTY (state,empty) {
        state.empty = empty
    },
    SET_SUBTOTAL (state,subtotal) {
        state.subtotal = subtotal
    },
    SET_TOTAL (state,total) {
        state.total = total
    },
    SET_CHANGED (state, changed) {
        state.changed = changed
    }
}
export const actions = {
    async getCart({ commit }){
        let response = await this.$axios.$get('cart')
        commit('SET_PRODUCTS', response.data.products)
        commit('SET_EMPTY',response.meta.empty)
        commit('SET_TOTAL',response.meta.total)
        commit('SET_SUBTOTAL',response.meta.subtotal)
        commit('SET_CHANGED',response.meta.changed)
        return response
    },
    async destroy({ dispatch } , productId){
        let response = await this.$axios.$delete(`cart/${productId}`)
        dispatch('getCart')
    },
    async update({ dispatch } , {productId , quantity}){
        let response = await this.$axios.$put(`cart/${productId}`, {
            quantity
        })
        dispatch('getCart')
    },
    async store({ dispatch } , products){
        console.log(products)
        let response = await this.$axios.$post('cart', {
            products
        })
        dispatch('getCart')
    }
}