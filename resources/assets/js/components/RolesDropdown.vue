<template>
    <select class="form-control" v-on:change="loadUsers" v-model="data.selected" v.bind:id="id">
        <option v-for="role in roles" :key="role.id" v-bind:value="role.id">
            {{ role.description }}
        </option>
    </select>
</template>

<script>
    export default {
        props: ['roles', 'url', 'defaultroleid', 'id'],
        data: function() {
            var vm = this;
            return {
                data: {
                    selected: vm.defaultroleid
                }
            };
        },
        methods: {
            loadUsers: function () {
                var vm = this;
                window.location.href = vm.url + '/' + vm.data.selected;
            }
          }
    }
</script>
