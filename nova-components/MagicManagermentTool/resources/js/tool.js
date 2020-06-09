Nova.booting((Vue, router, store) => {
  router.addRoutes([
    {
      name: 'magic-managerment-tool',
      path: '/magic-managerment-tool',
      component: require('./components/Tool'),
    },
  ])
})
