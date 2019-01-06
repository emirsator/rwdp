<template>
    <select class="form-control" v-on:change="refresh" v-model="data.selected" v-bind:id="id" v-bind:name="name">
        <option v-for="item in items" :key="item.id" v-bind:value="item.id">
            {{ item.name }}
        </option>
    </select>
</template>

<script>
    export default {
        props: ['items', 'url', 'defaultitemid', 'id', 'name'],
        data: function() {
            var vm = this;
            return {
                data: {
                    selected: vm.defaultitemid
                }
            };
        },
        methods: {
            refresh: function () {
                var vm = this;
                if (vm.data.selected != "" && vm.data.selected != null) {
                    window.location.href = vm.url + '/' + vm.data.selected;
                }
            }
          }
    }
</script>
