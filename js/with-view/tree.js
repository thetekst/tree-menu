var treeData = [{
    "id": 1,
    "parentId": null,
    "title": "1"
}, {
    "id": 2,
    "parentId": 1,
    "title": "1.1"
}, {
    "id": 3,
    "parentId": null,
    "title": "2"
}, {
    "id": 4,
    "parentId": 1,
    "title": "1.2"
}, {
    "id": 5,
    "parentId": 1,
    "title": "1.3"
}, {
    "id": 6,
    "parentId": 4,
    "title": "1.2.1"
}, {
    "id": 7,
    "parentId": 4,
    "title": "1.2.2"
}, {
    "id": 8,
    "parentId": 4,
    "title": "1.2.3"
}, {
    "id": 9,
    "parentId": null,
    "title": "3"
}, {
    "id": 10,
    "parentId": 9,
    "title": "3.1"
}, {
    "id": 11,
    "parentId": 10,
    "title": "3.1.1"
}, {
    "id": 12,
    "parentId": 11,
    "title": "3.1.1.1"
}, {
    "id": 13,
    "parentId": 11,
    "title": "3.1.1.2"
}, {
    "id": 14,
    "parentId": 11,
    "title": "3.1.1.3"
}, {
    "id": 15,
    "parentId": 13,
    "title": "3.1.1.2.1"
}];

function NodeItem(data) {
    this.data = data;

    var container = document.createElement("li"),
        title = container.appendChild(document.createElement("div"));

    title.innerHTML = this.data.title;

    this.element = container;
}

NodeItem.prototype = {
    // lazy children element creation - not all nodes have children
    getChildrenElement: function() {
        return this._childElement = this._childElement || this.element.appendChild(document.createElement("ul"));
    }
};

// convert all nodes to NodeItem instance
var nodeCollection = treeData.map(function(node) {
    return new NodeItem(node);
});

// for faster lookup, store all nodes by their id
var nodesById = {};
for (var i = 0; i < nodeCollection.length; i++) nodesById[nodeCollection[i].data.id] = nodeCollection[i];

var rootNodeItemsContainer = document.createElement("ul");
rootNodeItemsContainer.className = "menu";

// the magic happens here:
// every node finds its parent (by the id), and it's being adopted by the parent's children element
// that, actually, builds the tree, before it's in the document
// all root nodes are appended to a root container which is appended to an element on the document
for (var i = 0; i < nodeCollection.length; i++) {
    var node = nodeCollection[i];
    var parentElement = node.data.parentId ? nodesById[node.data.parentId].getChildrenElement() : rootNodeItemsContainer;
    parentElement.appendChild(node.element);
}

document.body.appendChild(rootNodeItemsContainer);