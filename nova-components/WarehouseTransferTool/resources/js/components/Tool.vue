<template>
    <div>
        <heading class="mb-6">Warehouse transfer</heading>

                        <label>Serial Number</label>
                        <textarea
                            :style="styling"
                            type="text"
                            class="w-full form-control form-input form-input-bordered"
                            :class="errorClasses"
                            v-model="item"
                        ></textarea>


                        <label>Note</label>
                        <textarea

                            type="text"
                            class="w-full form-control form-input form-input-bordered"
                            :class="errorClasses"
                            v-model="note"
                        ></textarea>


                        <label>Wh Location</label>
        <br/>
                        <select :style="locationstyle"  v-model="whlocation">
                            <option  value="2">US</option>
                            <option  value="1">Sydney</option>
                        </select>
        <br/>
        <button
            @click="handleChange()"
            class="btn btn-primary"
        >
            Submit
        </button>

    </div>


</template>

<script>
    export default {
        props: ['resourceName', 'resourceId', 'field'],

        data(){
            return{
                item: [],
                note:'',
                whlocation: '',
                options: [],
            }

        },


        methods: {
            handleChange() {
                const replaced_hastag_note = this.note.replace(/#/g, "");
                const replaced_space_sn = this.item.replace(/\n/gi, " ");
                const replaced_comma_sn = replaced_space_sn.replace(/,/g, " ");
                const arr_sn = replaced_comma_sn.split(' ');
                const removed_duplicated_sn = _.uniq(arr_sn);
                removed_duplicated_sn.map((newitem) => {
                    if (newitem) {
                        const serialNumber = newitem.trim();
                        if (this.note && this.whlocation) {
                            this.create(serialNumber, replaced_hastag_note, this.whlocation);
                        } else {
                            return alert('Please fill up everything!')
                        }

                    }

                });

            },


            create($id, $note, $location) {



                axios.get('/nova-vendor/warehouse-transfer-tool/' + $id)
                    .then((res) => {
                        if(res.data){
                            this.item = this.item.replace(res.data.serialNumber, '');
                            this.note= '';
                            this.whlocation= '';
                            axios.get('/nova-vendor/warehouse-transfer-tool/findItemWithSN/' + res.data.serialNumber + '/' + $note + '/' + $location)
                                .then((res) => {

                                })
                                .catch((err) => {
                                    console.log(err)
                                })
                        }
                    })
                    .catch(err => alert('Error, Item ' + $id + ' not in DB'))

            },


        },

        mounted() {
            //
        },

        computed: {
            styling: function() {
                return {

                    height: '200px'
                }
            },

            notestyle: function() {
                return {
                    width: '300px',
                    height: '100px'
                }
            },

            locationstyle: function() {
                return {
                    width: '200px'
                }
            }
        }
    }
</script>

<style>
    /* Scoped Styles */
</style>
