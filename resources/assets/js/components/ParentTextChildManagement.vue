<template>
    <div>
        <vue-element-loading :active="data.IsLoading" spinner="spinner" :is-full-screen="true"/>
        
        <div class="form-group">
            <label class="control-label">{{ data.ChildLabel }}</label>
            <input type="text" class="form-control" v-model="data.ChildValue" />
        </div>

        <div class="col-xs-12 padding-0">
            <button class="btn btn-primary pull-right" @click="addChildToParent" v-text="data.AddChildItemText"></button>
        </div>

        <div class="table-responsive col-xs-12 padding-0 margin-top-20">
            <table class="table">
                <thead>
                    <tr class="pointer header-background color-white" @click="deselectRow">
                        <th class="col-xs-12" v-text="data.GridColumnHeader"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="item in data.ChildItems" :key="item.id" class="pointer" 
                        v-bind:class="{ 'bg-primary': item.selected }" @click="selectRow(item.id)">
                        <td class="col-xs-12">
                            {{ item.name }}
                        </td>
                    </tr>
                </tbody>
            </table>            
        </div>
        <span class="col-sm-12 col-md-9 padding-0" v-text="data.DescriptionText"></span>
        <div class="col-sm-12 col-md-3 padding-0">
            <button class="btn btn-danger pull-right" v-on:click="removeSelected" v-bind:disabled="data.SelectedChildId === ''"
            v-text="data.RemoveChildItemText"></button>
        </div>
    </div>
</template>
<script>
    export default {
        props: ['childlabel', 'addchilditemtext', 'removechilditemtext', 'gridcolumnheader', 
        'childitems', 'descriptiontext', 'datamodifyurl'],
        data: function (){
            var vm = this;
            return {
                data: {
                    IsLoading: false,
                    ChildLabel: vm.childlabel,
                    ChildValue: "",
                    AddChildItemText: vm.addchilditemtext,
                    RemoveChildItemText: vm.removechilditemtext,
                    GridColumnHeader: vm.gridcolumnheader,
                    ChildItems: vm.childitems,
                    DescriptionText: (vm.descriptiontext !== undefined && vm.descriptiontext !== '' 
                    ? vm.descriptiontext 
                    : "Click on row to select, and on header to deselect"),
                    SelectedChildId: '',
                    Url: vm.datamodifyurl
                }
            }
        },
        methods: {
            selectRow(id){
                var vm = this;

                vm.data.ChildItems.forEach(function (item, key) {
                    item.selected = false;
                    if (item.id === id) {
                        item.selected = true;
                        vm.data.SelectedChildId = id;
                    }
                });

                vm.$forceUpdate();
            },
            deselectRow(){
                var vm = this;

                vm.data.ChildItems.forEach(function (item, key) {
                    item.selected = false;
                });

                vm.data.SelectedChildId = '';

                vm.$forceUpdate();
            },
            addChildToParent(){
                var vm = this;

                if (vm.data.ChildValue == ''){
                    return;
                }

                var checksum = vm.data.ChildItems.filter(e => e.name === vm.data.ChildValue);

                if (checksum.length == 0) {
                    vm.data.IsLoading = true;

                    axios.post(vm.data.Url, {
                        parent_id: vm.parentid,
                        value: vm.data.ChildValue
                    })
                    .then(function (response) {
                        vm.data.ChildItems.push({
                            id: response.data.id,
                            name: vm.data.ChildValue
                        });

                        vm.data.ChildValue = '';

                        vm.data.IsLoading = false;
                    })
                    .catch(function (error) {
                        vm.data.IsLoading = false;
                        alert(error.response.data);
                    });
                }
            },
            removeSelected(){
                var vm = this;

                if (vm.data.SelectedChildId == ''){
                    return;
                }

                vm.data.IsLoading = true;

                axios.delete(vm.data.Url + '/' + vm.data.SelectedChildId)
                .then(function (response) {
                    vm.data.ChildItems = vm.data.ChildItems.filter(e => e.id !== vm.data.SelectedChildId);

                    vm.data.SelectedChildId = '';

                    vm.data.IsLoading = false;
                })
                .catch(function (error) {
                    vm.data.IsLoading = false;
                    alert(error.response.data);
                });
            },
        }
    }
</script>

