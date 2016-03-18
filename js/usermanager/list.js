require([
    'dojo/dom',
    'dojo/on',
    'dojo/_base/event',
    'dojo/request',
    'dojo/dom-construct',
    'dojo/_base/config',
    'dojo/domReady!'
], function(dom, on, event, request, domConstruct, config) {

    // init variables
    var searchInputNode   = dom.byId('searchInput');
    var rowsContainerNode = dom.byId('rowsContainer');
    var updateRowsRequest;
    var searchTimeout;

    var updateRows = function() {
        if (updateRowsRequest) {
            updateRowsRequest.cancel();
        }
        domConstruct.empty(rowsContainerNode);
        updateRowsRequest = request.post(config.app.baseUri+'usermanager/listingRows', {
            data: {
                search: searchInputNode.value
            }
        }).then(function(data) {
            if (data)
                domConstruct.place(data, rowsContainerNode, 'only');
        });
    };

    // update rows on search
    on(searchInputNode, 'keyup', updateRows);

    // update rows on load
    updateRows();

});
