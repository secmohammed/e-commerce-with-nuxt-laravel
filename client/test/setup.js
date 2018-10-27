require('jsdom-global')()
global.expect = require('expect')
require('browser-env')()
const Vue = require('vue')


Vue.config.productionTip = false