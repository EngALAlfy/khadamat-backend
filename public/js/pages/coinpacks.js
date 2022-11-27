function actionsFormat(value, row) {
    return '<a href="/admin/coinpacks/'+row.id+'/delete" class="btn btn-danger"><i class="fa fa-trash"></i></a>' +
        '<a href="/admin/coinpacks/'+row.id+'/edit" class="btn btn-warning"><i class="fa fa-edit"></i></a>';
}

