function MultiConverter() {}

MultiConverter.prototype = {
    builddata: function(data) {
        var source = [];
        var children = [];

        for (i = 0; i < data.length; i++) {
            var item = data[i];
            var label = item.title;
            var parent_id = item.parent_id;
            var id = item.id;

            if (children[parent_id]) {
                if (!children[parent_id].children) {
                    children[parent_id].children = [];
                }
                children[parent_id].children[children[parent_id].children.length] = item;
                children[id] = item;
            } else {
                children[id] = item;
                source[id] = children[id];
            }
        }
        return source;
    }
}