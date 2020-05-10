Nova.booting((Vue, router, store) => {
  router.addRoutes([
    {
      name: 'make-out-stock-tool',
      path: '/make-out-stock-tool',
      component: require('./components/Tool'),
    },
  ])
})
