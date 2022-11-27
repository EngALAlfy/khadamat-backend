function actionsFormat(value, row) {
    var html = '<div style="width: 200px !important;">';
    html += '<a href="/admin/series/' + row.id + '/delete" class="btn btn-danger m-2"><i class="fa fa-trash"></i></a>';
    html += '<a href="/admin/series/' + row.id + '/edit" class="btn btn-warning m-2"><i class="fa fa-edit"></i></a>';
    html += '<a href="/admin/series-episodes/' + row.id + '" class="btn btn-info m-2"><i class="fa fa-video"></i></a>';

    html += '</div>';
    return html;
}

function categoryFormat(value) {
    return '<a href="/admin/series-categories/' + value.id + '" class="btn btn-outline-secondary">' + value.name + '</a>';
}

