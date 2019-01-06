<template>
    <div>
        <vue-element-loading :active="data.IsLoading" spinner="spinner" :is-full-screen="true"/>
        <a class="btn btn-danger" v-on:click="removeItem" v-text="data.RemoveLabel"></a>
    </div>
</template>

<script>
    export default {
        props: ['removeurl', 'indexurl', 'removelabel', 'confirmdeletetext'],
        data: function() {
            var vm = this;
            return {
                data: {
                    IsLoading: false,
                    RemoveLabel: (vm.removelabel !== undefined && vm.removelabel !== '' ? vm.removelabel : 'Delete'),
                    ConfirmDeleteText: (vm.confirmdeletetext !== undefined && vm.confirmdeletetext !== '' ? 
                        vm.confirmdeletetext : 
                        'Are you sure you want to delete a record?')
                }
            };
        },
        methods: {
            removeItem: function () {
                var vm = this;

                var confirmDelete = confirm(vm.data.ConfirmDeleteText);
                if (confirmDelete === false) {
                    return;
                } 
                vm.data.IsLoading = true;

                axios.delete(vm.removeurl)
                .then(function (response) {
                    vm.data.IsLoading = false;

                    window.location.href = vm.indexurl;
                })
                .catch(function (error) {
                    vm.data.IsLoading = false;
                    alert(error.response.data);
                });
            }
          }
    }
</script>
