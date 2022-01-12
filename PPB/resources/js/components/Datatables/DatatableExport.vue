<template>

    <div>
        <div class="btn-group" role="group" aria-label="Export formats">
            <button type="button" class="btn btn-secondary" @click="exportDataFormat('xls')">XLS</button>
            <button type="button" class="btn btn-secondary" @click="exportDataFormat('json')">JSON</button>
        </div>

        <div id="data-container"></div>
    </div>

</template>

<script>
    export default {
        props: ['dataset'],

        methods: {

            getColumns(paramData) {
                var header = [];
                $.each(paramData[0], function (key, value) {
                    var obj = {}
                    obj["headertext"] = key;
                    obj["datatype"] = "string";
                    obj["datafield"] = key;
                    header.push(obj);
                });
                return header;
            },

            exportDataFormat: function (format) {

                var self = this;

                switch (format) {

                    case 'xls':
                        $("#data-container").excelexportjs({
                            containerid: 'data-container',
                            datatype: 'json',
                            dataset: self.dataset,
                            columns: self.getColumns(self.dataset)
                        });
                        break;

                    case 'json':
                        console.log(self.dataset);
                        break;

                }
            }

        }
    }
</script>