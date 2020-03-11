import DeleteAction from "./components/DeleteAction";

Nova.booting((Vue, router, store) => {
    console.log('router11', router)
  Vue.component('checkout-item-resource-tool', require('./components/Tool'))
});
