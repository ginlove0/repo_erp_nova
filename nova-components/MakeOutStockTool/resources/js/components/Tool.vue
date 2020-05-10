<template>
    <div>
        <heading class="mb-6">Make Item Out Stock</heading>

        <div>
            <label>Serial Number</label>
            <textarea
                :style="styling"
                type="text"
                class="w-full form-control form-input form-input-bordered"
                :class="errorClasses"
                v-model="items"
            ></textarea>
            <button
                @click="handleSubmit()"
                class="btn btn-primary"
            >
                Submit
            </button>
        </div>

        <div>
            <div>
                <table class="table w-full">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Alias Model</th>
                        <th>SN</th>
                        <th>Condition</th>
<!--                        <th>Supplier</th>-->
                        <th>Status</th>
                        <th>Wh Location</th>
                        <th>Note</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="item in datas">
                        <td class="text-center">{{item.models.name}}</td>
                        <td class="text-center">{{item.aliasModel}}</td>
                        <td class="text-center">{{item.serialNumber}}</td>
                        <td class="text-center">{{item.conditions.name}}</td>
<!--                        <td class="text-center">{{item.suppliers.name}}</td>-->
                        <td class="text-center">{{item.stockStatus}}</td>
                        <td class="text-center">{{item.whlocations.name}}</td>
                        <td class="text-center">{{item.note}}</td>
                    </tr>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            items: [],
            datas: []
        }
    },

    methods: {
        handleSubmit() {
            const replaced_space_sn = this.items.replace(/\n/gi, " ");
            const replaced_comma_sn = replaced_space_sn.replace(/,/g, " ");
            const arr_sn = replaced_comma_sn.split(' ');
            const removed_duplicated_sn = _.uniq(arr_sn);
            console.log(removed_duplicated_sn)
            removed_duplicated_sn.map((newitem) => {
                if (newitem) {
                    const serialNumber = newitem.trim();
                    let self = this;
                    axios.get('/nova-vendor/make-out-stock-tool/' + serialNumber)
                        .then((res) => {
                            if(res && res.data && res.data[0])
                            {
                                self.datas.push(res.data[0]);
                            }

                        })
                        .catch((err)=>{
                            console.log(err.message)

                        })
                }


            });
            // this.itemsNotInstock = [];
            this.datas = [];
        }
    },

    mounted() {
        //
    },

    computed: {
        styling: function() {
            return {

                height: '200px'
            }
        }
    }
}
</script>

<style>
/* Scoped Styles */
</style>
