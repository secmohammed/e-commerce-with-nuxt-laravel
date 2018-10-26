module.exports = {
  mode: 'universal',

  /*
  ** Headers of the page
  */
  head: {
    title: 'client',
    meta: [
      { charset: 'utf-8' },
      { name: 'viewport', content: 'width=device-width, initial-scale=1' },
      { hid: 'description', name: 'description', content: 'File market' }
    ],
    link: [
      { rel: 'icon', type: 'image/x-icon', href: '/favicon.ico' }
    ]
  },

  /*
  ** Customize the progress-bar color
  */
  loading: { color: '#fff' },

  /*
  ** Global CSS
  */
  css: [
  ],

  /*
  ** Plugins to load before mounting the App
  */
  plugins: [
  ],

  /*
  ** Nuxt.js modules
  */
  modules: [
    // Doc: https://github.com/nuxt-community/axios-module#usage
    '@nuxtjs/axios',
    // Doc:https://github.com/nuxt-community/modules/tree/master/packages/bulma
    '@nuxtjs/bulma',
    '@nuxtjs/auth',
    '@nuxtjs/toast'
  ],
  toast: {
    position: 'top-right',
    duration: 800,
  },
  plugins: [
    './plugins/mixins/user.js',
    './plugins/axios.js',{
      src: './plugins/vee-validate.js',
      ssr: true
    }
  ],
  /*
  ** Axios module configuration
  */
  axios: {
    baseURL: 'http://127.0.0.1:8000/api',
    redirectError: {
      401: '/auth/login',
      500: '/'
    }
  },
  auth: {
    redirect: {
      login: '/auth/login'
    },
    strategies: {
      local: {
        endpoints: {
          login: {
            url: '/auth/login',
            method: 'post',
            propertyName: 'meta.token'
          },
          user: {
            url: '/user',
            method: 'get',
            propertyName: 'data'
          },
          logout: {
            url: '/auth/logout',
            method: 'post',
            propertyName: 'data'
          }
        }
      }
    }
  },
  /*
  ** Build configuration
  */
  build: {
    postcss: {
      preset: {
        features: {
          customProperties: false
        }
      }
    },
    /*
    ** You can extend webpack config here
    */
    extend(config, ctx) {
      // Run ESLint on save
      if (ctx.isDev && ctx.isClient) {
        config.module.rules.push({
          enforce: 'pre',
          test: /\.(js|vue)$/,
          loader: 'eslint-loader',
          exclude: /(node_modules)/,
          options : {
            fix : true
          }
        })
      }
    }
  }
}
