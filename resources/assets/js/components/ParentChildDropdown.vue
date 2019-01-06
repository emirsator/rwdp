<template>
    <div>
        <vue-element-loading :active="data.IsLoading" spinner="spinner" :is-full-screen="true"/>

        <div class="form-group">
            <label v-bind:name="parentfor" class="control-label">{{ parentlabel }}</label>
            <select class="form-control" v-on:change="refresh" v-model="data.selectedparent">
                <option v-for="item in parentitems" :key="item.id" v-bind:value="{id: item.id, name: item.name}">
                    {{ item.name }}
                </option>
            </select>
            <input type="hidden" v-bind:id="parentid" v-bind:name="parentname" 
                v-model="data.selectedparentid" />
        </div>

        <div class="form-group">
            <label v-bind:name="childfor" class="control-label">{{ childlabel }}</label>
            <select class="form-control" v-model="data.selectedchild" 
                v-on:change="childValueChanged">
                <option v-for="childitem in data.childitems" :key="childitem.id" 
                    v-bind:value="{id: childitem.id, name: childitem.name}">
                    {{ childitem.name }}
                </option>
            </select>
            <input type="hidden" v-bind:id="childid" v-bind:name="childname" 
                v-model="data.selectedchildid" />
        </div>
    </div>
</template>

<script>
    export default {
        props: ['parentfor', 'parentlabel', 'parentitems', 'parentid', 'parentname', 'parentdefaultitemid',
        'childfor', 'childlabel', 'childid', 'childitems', 'childname', 'childdefaultitemid', 'childurl'],
        data: function() {
            var vm = this;
            return {
                data: {
                    childitems: vm.childitems,
                    selectedchild: vm.generateDropdownItem(vm.childitems.filter(e => e.id === vm.childdefaultitemid)),
                    selectedchildid: vm.generateDropdownItem(vm.childitems.filter(e => e.id === vm.childdefaultitemid)).id,
                    selectedparent: vm.generateDropdownItem(vm.parentitems.filter(e => e.id === vm.parentdefaultitemid)),
                    selectedparentid: vm.generateDropdownItem(vm.parentitems.filter(e => e.id === vm.parentdefaultitemid)).id,
                    IsLoading: false
                }
            };
        },
        methods: {
            refresh: function () {
                var vm = this;

                if (vm.data.selectedparent == null){
                    return;
                }

                vm.data.selectedparentid = vm.data.selectedparent.id;

                vm.data.selectedchild = null;
                vm.data.selectedchildid = '';

                vm.data.IsLoading = true;

                axios.get(vm.childurl + '/' + vm.data.selectedparent.id)
                .then(function (response) {
                    vm.data.IsLoading = false;

                    vm.data.childitems = response.data;

                    if (vm.data.childitems.length > 0) {
                        vm.data.selectedchild = vm.generateDropdownItem(vm.data.childitems), // {id: vm.data.childitems[0].id, name: vm.data.childitems[0].name};
                        vm.data.selectedchildid = vm.data.selectedchild.id;
                        vm.$emit('childChanged', vm.data.selectedchild, vm.data.selectedparent);
                    }
                    vm.$forceUpdate();
                })
                .catch(function (error) {
                    vm.data.IsLoading = false;
                    alert(error.response.data);
                });
            },
            childValueChanged: function() {
                var vm = this;
                vm.data.selectedchildid = vm.data.selectedchild.id;
                vm.$emit('childChanged', vm.data.selectedchild, vm.data.selectedparent);
            },
            generateDropdownItem: function(items) {
                return (items && items.length > 0) ? {id: items[0].id, name: items[0].name} : {id: null, name: null};
            }
        }
    }
</script>
