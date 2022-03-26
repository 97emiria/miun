
//Skapa tabellerna / namge vad som ska synas/användas
var columnDefs = [
    { field: 'subject', rowGroup: true },
    { field: 'code' },
    {
        field: 'name',
        editable: true
    },
    { field: 'progression' },
    { field: 'semester' }
];

//Skapar en kategori grupp
const autoGroupColumnDef = {
    headerName: "Subject",
    field: "subject",
    cellRenderer: 'agGroupCellRenderer',
    cellRendererParams: {
        checkbox: true
    }
}


//options (grid)
const gridOptions = {
    columnDefs: columnDefs,
    autoGroupColumnDef: autoGroupColumnDef,
    groupSelectsChildren: true,
    rowSelection: 'multiple'
};



//Just for button
const getSelectedRows = () => {
    const selectedNodes = gridOptions.api.getSelectedNodes()
    const selectedData = selectedNodes.map(node => node.data)
    const selectedDataStringPresentation = selectedData.map(node => `${node.name}, ${node.progression}`).join(', ')
    alert('Selected nodes: ' + selectedDataStringPresentation);
}


// Get the container to be used
// Create the grid passing in the div to use together with the columns & data we want to use
const eGridDiv = document.querySelector('#myGrid');
new agGrid.Grid(eGridDiv, gridOptions);




//Get data 
fetch('http://localhost:3000/courses/')
    .then(response => response.json())
    .then(data => {
        gridOptions.api.setRowData(data);
    });
