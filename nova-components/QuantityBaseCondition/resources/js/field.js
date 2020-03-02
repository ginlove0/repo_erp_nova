Nova.booting((Vue, router, store) => {
  Vue.component('index-quantity-base-condition', require('./components/IndexField'))
  Vue.component('detail-quantity-base-condition', require('./components/DetailField'))
  Vue.component('form-quantity-base-condition', require('./components/FormField'))
})
