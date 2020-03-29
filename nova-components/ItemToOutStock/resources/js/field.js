Nova.booting((Vue, router, store) => {
  Vue.component('index-item-to-out-stock', require('./components/IndexField'))
  Vue.component('detail-item-to-out-stock', require('./components/DetailField'))
  Vue.component('form-item-to-out-stock', require('./components/FormField'))
})
