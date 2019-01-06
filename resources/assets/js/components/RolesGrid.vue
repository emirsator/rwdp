<template>
    <div>
        <div class="table-responsive col-xs-12 padding-0">
            <table class="table">
                <thead>
                    <tr class="pointer header-background font-white" @click="deselectRow">
                        <th class="col-xs-6">Name</th>
                        <th class="col-xs-6">Activated On</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="role in roles" :key="role.id" class="pointer" v-bind:class="{ 'bg-primary': role.selected }" @click="selectRow(role.id)">
                        <td class="col-xs-6">
                            {{ role.name }}
                        </td>
                        <td class="col-xs-6">
                            {{ role.created_at }}
                        </td>
                    </tr>
                </tbody>
            </table>            
        </div>
        <span class="col-sm-12 col-md-9 padding-0" v-text="DescriptionText"></span>
        <div class="col-sm-12 col-md-3 padding-0">
            <button class="btn btn-danger pull-right" v-on:click="removeSelected" v-bind:disabled="SelectedRoleId == 0">Remove</button>
        </div>
    </div>
</template>
<script>
    export default {
        props: ['roles', 'removeurl', 'descriptiontext'],
        data: function (){
            return {
                SelectedRoleId: 0,
                DescriptionText: (vm.descriptiontext !== undefined && vm.descriptiontext !== '' ?
                vm.descriptiontext : "Click on row to select, and on header to deselect")
            }
        },
        methods: {
            selectRow(id){
                var vm = this;

                vm.roles.forEach(function (role, key) {
                    role.selected = false;
                    if (role.id === id) {
                        role.selected = true;
                        vm.SelectedRoleId = id;
                    }
                });

                vm.$forceUpdate();
            },
            deselectRow(){
                var vm = this;

                vm.roles.forEach(function (role, key) {
                    role.selected = false;
                });

                vm.SelectedRoleId = 0;
            },
            removeSelected(){
                var vm = this;

                if (vm.SelectedRoleId <= 0){
                    return;
                }

                axios.delete(vm.removeurl, { data: { role_id: vm.SelectedRoleId } })
                .then(function (response) {
                    alert('Item removed');
                    location.reload();
                })
                .catch(function (error) {
                    alert(error.response.data);
                });
            },
        }
    }
</script>

