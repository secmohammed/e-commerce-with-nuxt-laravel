import {
  mapGetters
} from 'vuex';
import Vue from 'vue'

const User = {
  install(Vue, options) {
    Vue.mixin({
      computed: {
        ...mapGetters({
          user: 'auth/user',
          authenticated: 'auth/authenticated',
        })
      }
    })
  }
}

Vue.use(User)