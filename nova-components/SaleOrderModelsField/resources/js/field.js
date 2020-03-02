Nova.booting((Vue, router, store) => {
  Vue.component('index-sale-order-models-field', require('./components/IndexField'))
  Vue.component('detail-sale-order-models-field', require('./components/DetailField'))
  Vue.component('form-sale-order-models-field', require('./components/FormField'))
})
