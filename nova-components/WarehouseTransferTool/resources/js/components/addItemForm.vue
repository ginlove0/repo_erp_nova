<template>
    <div>
        <table>
            <thead>
                <tr>
                    <td>SN</td>
                    <td>Cisco Model</td>
                    <td>Alias Model</td>
                    <td>Condition</td>
                    <td>Cost</td>
                    <td>Note</td>
                    <td>Action</td>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(item, index) in dataCisco">

                </tr>
            </tbody>
        </table>

    </div>
</template>

<script>
    export default {
        name: 'AddItemForm',
        template: 'AddItemForm',
        props: {
            dataCisco: {
                type: Array,
                required: true,
                default: [],
                note: 'Contain data get from Cisco API'
            }
        }


    }
</script>
