//Column definitions 

//Sortable and filter is features, rowGroup group them
var columnDefs = [
    { headerName: 'Make', field: 'make', sortable: true, filter: true, rowGroup: true },
    { headerName: 'Model', field: 'model', sortable: true, filter: true },
    { headerName: 'Price', field: 'price', sortable: true, filter: true }
];

//Stat. data
var rowData = [
    { make: 'Appel', model: 'Green', price: 55000 },
    { make: 'Pear', model: 'Green', price: 2300 },
    { make: 'Pinappel', model: 'Yellow', price: 7800 }, 
    { make: 'Appel', model: 'Green', price: 55000 },
    { make: 'Pear', model: 'Green', price: 2300 },
    { make: 'Pinappel', model: 'Yellow', price: 7800 }, 
    { make: 'Appel', model: 'Green', price: 55000 },
    { make: 'Pear', model: 'Green', price: 2300 },
    { make: 'Pinappel', model: 'Yellow', price: 7800 }, 
    { make: 'Appel', model: 'Green', price: 55000 },
    { make: 'Pear', model: 'Green', price: 2300 },
    { make: 'Pinappel', model: 'Yellow', price: 7800 }
];

const autoGroupColumnDef = {
    headerName: 'Model', 
    field: 'model',
    cellRenderer: 'agGroupCellRenderer',
    cellRendererParams: {
        checkbox: true
    }
}


//Grid options
const gridOptions = {
    columnDefs: columnDefs,
    autoGroupColumnDef: autoGroupColumnDef,
    rowData: rowData,
    rowSelection: 'multiple',

    //Group Children
    groupSelectsChildren: true
};

//Browser API to get reference to grid container
var eGridDiv = document.querySelector('#myGrid');

// ??
new agGrid.Grid(eGridDiv, gridOptions);

// //Dyn. Data?
// fetch('https://www.ag-grid.com/example-assets/small-row-data.json')
// .then(response => response.json())
// .then(data => {
//    gridOptions.api.setRowData(data);
// });

//Alert marked field/s
const getSelectedRows = () => {
    const selectedNodes = gridOptions.api.getSelectedNodes()
    const selectedData = selectedNodes.map(node => node.data)
    const selectedDataStringPresentation = selectedData.map(node => `${node.make} ${node.model}`).join(', ')
    alert(`Selected nodes: ${selectedDataStringPresentation}`);
}