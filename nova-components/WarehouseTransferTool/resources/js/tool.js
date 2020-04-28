Nova.booting((Vue, router, store) => {
    console.log('routerWhTransfer', router)
  router.addRoutes([
    {
      name: 'warehouse-transfer-tool',
      path: '/warehouse-transfer-tool',
      component: require('./components/Tool'),
    },
  ])
})
