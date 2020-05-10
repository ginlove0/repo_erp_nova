Nova.booting((Vue, router, store) => {
  Vue.component('index-item-transfer-qty-base-model', require('./components/IndexField'))
  Vue.component('detail-item-transfer-qty-base-model', require('./components/DetailField'))
  Vue.component('form-item-transfer-qty-base-model', require('./components/FormField'))
})
