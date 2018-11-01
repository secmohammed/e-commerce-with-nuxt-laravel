export const state = () => ({
    categories : []
})
export const getters = {
    categories(state){
        return state.categories
    }
}
export const mutations = {
    SET_CATEGORIES(state,categories){
        state.categories = categories
    }
}
export const actions = {
    async nuxtServerInit ({ commit, dispatch,rootGetters }){
        let response = await this.$axios.$get('categories')
        commit('SET_CATEGORIES',response.data)
        if (rootGetters['auth/authenticated']) {
            await dispatch('cart/getCart')
        }
    }
}