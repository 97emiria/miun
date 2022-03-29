
//Skapa tabellerna / namge vad som ska synas/användas
var columnDefs = [
    {
        field: 'groupName',
        rowGroup: true,
        filter: true,
        editable: true,                                     //Possibility to change a column info 
        hide: true,

    },
    {
        field: 'company',
        editable: false,                                     //Possibility to change a column info 
        filter: true,
        getQuickFilterText: params => {
            return params.value.name;
        },
        resizable: true,                                    //Resize for column (field)                   
        checkbox: true,
        sortable: true,
        suppressSizeToFit: true,

    },
    {
        field: 'description',
        filter: false,
        resizable: true,                                    //Resize for column (field)                                     
        editable: false,                                     //Possibility to change a column info 
        hide: true,
    },
    {
        field: 'date',
        //rowGroup: true,
        filter: true,
        resizable: false, 
        editable: false,                                     //Possibility to change a column info 

    },
    {
        field: 'country',
        //rowGroup: true,
        filter: true,
        resizable: false, 
        editable: false,                                     //Possibility to change a column info 
        sortable: true,

    },

    
];

// //Kategoriserar kolumer / denna funkar inte med filter
// this.columnDefs = [
//     {
//         headerName: 'School',
//         children: [
//             { field: 'code' },
//             { field: 'progression' },
//         ]
//     },
//     {
//         headerName: 'Other',
//         children: [
//             { field: 'subject' },
//             { field: 'name' },
//         ]
//     }
// ];

//Skapar en kategori grupp
const autoGroupColumnDef = {
    headerName: "Group name",
    field: " ",                                     //Add a unnecessary field name
    cellRenderer: 'agGroupCellRenderer',
    cellRendererParams: {
        checkbox: true
    },
    pinned: 'left',
    sortable: true,

}


//options (grid)
const gridOptions = {
    columnDefs: columnDefs,
    autoGroupColumnDef: autoGroupColumnDef,
    groupSelectsChildren: true,
    rowSelection: 'multiple',


     // turns OFF row hover, it's on by default
     //suppressRowHoverHighlight: true,
     // turns ON column hover, it's off by default
     columnHoverHighlight: true,



    //Left
    sideBar: {
        toolPanels: [
            {
                id: 'filters',
                labelDefault: 'Filters',
                labelKey: 'filters',
                iconKey: 'filter',
                toolPanel: 'agFiltersToolPanel',
                toolPanelParams: {
                    suppressExpandAll: true,
                    suppressFilterSearch: true,
                },
            },
        ],
        defaultToolPanel: 'filters',
    },

    //Bottom
    statusBar: {
        statusPanels: [
            {
                statusPanel: 'agTotalAndFilteredRowCountComponent',
                align: 'left',
            }
        ]
    },
};








//Just for button !! U do have how to get info from selectet row here 
const getSelectedRows = () => {
    const selectedNodes = gridOptions.api.getSelectedNodes()
    const selectedData = selectedNodes.map(node => node.data)
    const selectedDataStringPresentation = selectedData.map(node => `${node.company}, ${node.country}`).join(', ')
    alert('Selected nodes: ' + selectedDataStringPresentation);
}


// Get the container to be used
// Create the grid passing in the div to use together with the columns & data we want to use
const eGridDiv = document.querySelector('#myGrid');
new agGrid.Grid(eGridDiv, gridOptions);




//Get data 
fetch('http://localhost:3000/groups/')
    .then(response => response.json())
    .then(data => {
        gridOptions.api.setRowData(data);
    });
