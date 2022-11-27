function actionsFormat(value, row) {
    var html = '<div style="width: 300px !important;">';
    html += '<a href="/admin/items/' + row.id + '/delete" class="btn btn-danger m-2"><i class="fa fa-trash"></i></a>';
    html += '<a href="/admin/items/' + row.id + '/edit" class="btn btn-warning m-2"><i class="fa fa-edit"></i></a>';

    if(row.sponsored === 0){
        html += '<a href="/admin/items/' + row.id + '/sponsored" class="btn btn-info m-2"><i class="fa fa-coins"></i> sponsored </a>';
    }else{
        html += '<a href="/admin/items/' + row.id + '/stop-sponsored" class="btn btn-secondary m-2"><i class="fa fa-stop"></i> stop sponsored</a>';
    }

    html += '</div>';
    return html;
}

function categoryFormat(value) {
    return '<a href="/admin/categories/' + value.id + '" class="btn btn-outline-secondary">' + value.name + '</a>';
}

function subcategoryFormat(value) {
    return '<a href="/admin/subcategories/' + value.id + '" class="btn btn-outline-secondary">' + value.name + '</a>';
}

function subsubcategoryFormat(value) {
    return '<a href="/admin/subsubcategories/' + value.id + '" class="btn btn-outline-secondary">' + value.name + '</a>';
}

function imagesFormat(index, row) {
    var html = []
    html.push('<img src="/uploads/images/' + row.image1 + '" class="col-3 img-fluid" height="100" width="100">')
    html.push('<img src="/uploads/images/' + row.image2 + '" class="col-3 img-fluid" height="100" width="100">')
    html.push('<img src="/uploads/images/' + row.image3 + '" class="col-3 img-fluid" height="100" width="100">')
    html.push('<img src="/uploads/images/' + row.image4 + '" class="col-3 img-fluid" height="100" width="100">')
    return html.join('')
}
