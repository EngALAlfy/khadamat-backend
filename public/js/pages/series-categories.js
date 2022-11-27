function actionsFormat(value, row) {
    return '<a href="/admin/series-categories/'+row.id+'/delete" class="btn btn-danger"><i class="fa fa-trash"></i></a>' +
        '<a href="/admin/series-categories/'+row.id+'/edit" class="btn btn-warning"><i class="fa fa-edit"></i></a>';
}
