
//Change status int to a string
const changeIntToString = params => {
    var fruit = params.value;

    if (params.value) {
        params.value = "Aktiv"
    } else {
        params.value = "Inaktiv"
    } 

    return params.value;
}

//Add trash can under handle
const changeIdToIcon = params => {
    var btn = document.createElement("button");

    var myImage = new Image(25, 25);
    myImage.src = 'images/iconRemove.png';

    btn.appendChild(myImage);


    btn.classList.add('columnBtn');
    btn.id = params.value;
    return btn;
}

//Skapa tabellerna / namge vad som ska synas/användas
var columnDefs = [
    {
        field: 'groupName',
        filter: true,
        editable: true,                                     //Possibility to change a column info 
        editable: true,                                     //Possibility to change a column info 

        rowGroup: true, 
        hide: true
    },
    {
        field: 'company',
        filter: true,

        resizable: true,                                    //Resize for column (field)                   
        checkbox: true,
        sortable: true,
        suppressSizeToFit: true,
        
        checkboxSelection: true,
     },


    {
        field: 'description',
        filter: false,
        resizable: true,                                    //Resize for column (field)                                     
        editable: false,                                     //Possibility to change a column info 
        //hide: true,
        width: 450,
    
    },
    {
        field: 'date',
        //rowGroup: true,
        filter: true,
        resizable: false,
        editable: false,                                     //Possibility to change a column info 
        width: 115,
        hide: true,

    },
    {
        field: 'country',
        //rowGroup: true,
        filter: true,
        resizable: false,
        editable: false,                                     //Possibility to change a column info 
        sortable: true,
        //floatingFilter: true
    },
    {
        field: 'status',
        //rowGroup: true,
        filter: true,
        resizable: false,
        editable: false,                                     //Possibility to change a column info 
        sortable: true,
        // width: 100,
        hide: true,

        valueFormatter: changeIntToString,
        filterParams: {
            valueFormatter: changeIntToString,
        },

    },
    {
        headerName: 'Handle',
        field: 'id',
        //rowGroup: true,
        resizable: false,
        editable: false,                                     //Possibility to change a column info 
        sortable: true,
        width: 100,
        //hide: true,
        cellRenderer: changeIdToIcon,


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

    pinned: 'left',
    sortable: true,
    editable: true,                                     //Possibility to change a column info 
    
    
    cellRenderer: changeIdToIcon,
}


//options (grid)
const gridOptions = {
    columnDefs: columnDefs,
    //autoGroupColumnDef: autoGroupColumnDef,
    groupSelectsChildren: true,
    rowSelection: 'multiple',

    //Create row conditions
    rowClassRules: {
        //If status is set to 0, company inactive
        "inactive": params => params.api.getValue("status", params.node) == 0
    },

    cacheQuickFilter: true,
    // turns OFF row hover, it's on by default
    //suppressRowHoverHighlight: true,
    // turns ON column hover, it's off by default
    //columnHoverHighlight: true,

    onRowClicked: event => console.log('A row was clicked'),

    //Left
    // sideBar: {
    //     toolPanels: [
    //         {
    //             id: 'filters',
    //             labelDefault: 'Filters',
    //             labelKey: 'filters',
    //             iconKey: 'filter',
    //             toolPanel: 'agFiltersToolPanel',
    //             toolPanelParams: {
    //                 suppressExpandAll: true,
    //                 suppressFilterSearch: true,
    //             },
    //         },

    //     ],
    //     defaultToolPanel: 'filters',
    // },

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


function onFilterTextBoxChanged() {
    gridOptions.api.setQuickFilter(
        document.getElementById('filter-text-box').value
    );
}


// function onPrintQuickFilterTexts() {
//     gridOptions.api.forEachNode(function (rowNode, index) {
//         console.log(
//             'Row ' +
//             index +
//             ' quick filter text is ' +
//             rowNode.quickFilterAggregateText
//         );
//     });
// }



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
fetch('data/testData.json')
    .then(response => response.json())
    .then(data => {

        // //See data
        // console.log(data)

        // //Get specific data
        // data.forEach(courses => {
        //     console.log(courses.status)
        // });

        //Send data to grid
        gridOptions.api.setRowData(data);
    });
