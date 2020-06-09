<template>
    <div>
        <heading class="mb-6">Model Quick View</heading>

        <div class="div-button">
            <button class="filter-button" @click="show1">ToDay</button>
            <button class="filter-button" @click="show">7 Days</button>
        </div>
        <div>
            <table class="w-full text-center table-view">
                <thead class="table-header">
                    <tr class="header-row">
                        <th class="column-in-header">Date</th>
                        <th class="column-in-header">Location</th>
                        <th class="column-in-header">Supplier</th>
                        <th class="column-in-header">Model</th>
                        <th class="column-in-header">Condition</th>
                        <th class="column-in-header">Qty</th>

                    </tr>

                </thead>

                <tbody class="table-body">
                    <tr v-for="model in displayData" class="body-row">
                        <td class="column-in-row-table">{{date(model.Date, 'hh:mm DD/MM')}}</td>
                        <td class="column-in-row-table">{{model.Location}}</td>
                        <td class="column-in-row-table">{{model.Supp}}</td>
                        <td class="column-in-row-table">{{model.Model}}</td>
                        <td class="column-in-row-table">{{model.Con}}</td>
                        <td class="column-in-row-table">{{model.QTY}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
    import PulseLoader from 'vue-spinner/src/PulseLoader.vue'
    import moment from 'moment'
export default {
    components:{PulseLoader},

    data() {
        return {
            displayData: []
        }
    },

    methods: {
        show() {
            axios.get('/nova-vendor/model-quick-view/findDetail')
                .then((res) => {

                    this.displayData = res.data;
                })
                .catch((err) => {
                    console.log('We can not found the route, please check show() in ModelQuickView');
                })
            this.displayData = [];
        },

        show1() {
            axios.get('/nova-vendor/model-quick-view/findDetailInADay')
                .then((res) => {
                    this.displayData = res.data;

                })
                .catch((err) => {
                    console.log('We can not found the route, please check show1() in ModelQuickView')
                })
            this.displayData = [];
        },

        date: function (value, format) {
            if (value) {
                return moment(String(value)).format(format || 'MM/DD/YY')
            }
        },
    },

    mounted() {
        //
        this.show1();
    },
}
</script>

<style>
/* Scoped Styles */
    .body-row {
        text-align: center;
        font-family: Nunito,system-ui,BlinkMacSystemFont,-apple-system,sans-serif;;
    }

    .div-button {
        align-content: center;
        float: right;
    }

    .filter-button {
        line-height: 1.499;
        position: relative;
        display: inline-block;
        font-weight: 400;
        white-space: nowrap;
        text-align: center;
        background-image: none;
        touch-action: manipulation;
        height: 32px;
        padding: 0 15px;
        font-size: 14px;
        border-radius: 4px;
        border: 1px solid #d9d9d9;
        margin-bottom: 10px;
    }

    .column-in-row-table {
        font-weight: 300;
        color: var(--90);
        border-top-width: 1px;
        border-bottom-width: 1px;
        border-color: var(--50);
        padding-left: .75rem;
        padding-right: .75rem;
        min-width: 56px;
        height: 3.8125rem;
        font-family: Nunito,system-ui,BlinkMacSystemFont,-apple-system,sans-serif;;
    }

    .column-in-header {
        background-color: var(--30);
        font-weight: 800;
        font-size: .75rem;
        color: var(--80);
        text-transform: uppercase;
        border-bottom-width: 2px;
        border-color: var(--50);
        padding: .75rem;
        letter-spacing: .05em;
    }
</style>
