<template>
    <div>
        <div id="OrgChartContainer"></div>
    </div>
</template>
<style>
#OrgChartContainer {
  overflow: auto;
  text-align: center;
}
</style>
<script>
    export default {
        props: ['elements'],
        data: function() {
            var vm = this;
            return {
                data: {
                    Elements: vm.elements
                }
            };
        },
        mounted: function () {
            var vm = this;
            
            //var datasource = vm.data.Elements;

            var oc = $('#OrgChartContainer').orgchart({
                'data' : vm.data.Elements,
                'nodeContent': 'title',
                'pan': true,
                'zoom': true
            });

            oc.$chartContainer.on('touchmove', function(event) {
                event.preventDefault();
            });
        }
    }
</script>
