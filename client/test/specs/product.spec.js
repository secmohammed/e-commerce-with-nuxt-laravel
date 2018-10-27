import { Nuxt, Builder } from 'nuxt'
import { resolve } from 'path'
import { mount } from '@vue/test-utils'
import Product from '../../components/products/Product.vue'
// We keep a reference to Nuxt so we can close
// the server at the end of the test

describe('Product Component', () => {
  // Now mount the component and you have the wrapper
    const wrapper = mount(Product)
    let nuxt = null
    beforeEach(() => {
        const rootDir = resolve(__dirname, '..')
        let config = {}
        try { config = require(resolve(rootDir, 'nuxt.config.js')) } catch (e) {}
        config.rootDir = rootDir // project folder
        config.dev = false // production build
        config.mode = 'universal' // Isomorphic application
        nuxt = new Nuxt(config)
        new Builder(nuxt).build()
        nuxt.listen(4000, 'localhost')
    })
    it('renders the correct markup', () => {
        expect(wrapper.html()).toContain('<img src="https://bulma.io/images/placeholders/1280x960.png" />')
    })
})
