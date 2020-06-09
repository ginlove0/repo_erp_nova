<template>
    <div>
        <table>
            <thead>
                <tr>
                    <th>Model</th>
                    <th>SN</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="model in displayData">
                    <td>{{model.Model}}</td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
export default {
    props: ['resourceName', 'field'],

    data() {
        return {
            displayData: []
        }
    },

    methods: {
        show() {

            const url = '/api/ipsupply/findDetail';
            Nova.request().get(url)
                .then((res) => {
                    console.log(res)
                    this.displayData = res.data;
                })
                .catch((err) => {
                    console.log('We can not found the route, please check show() in ModelQuickView');
                })
            this.displayData = [];
        }
    },

    mounted() {
        this.show();
    }
}
</script>
