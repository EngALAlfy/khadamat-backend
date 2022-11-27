function actionsFormat(value, row) {
    return '<a href="/admin/subcategories/'+row.id+'/delete" class="btn btn-danger"><i class="fa fa-trash"></i></a>'+
        '<a href="/admin/subcategories/'+row.id+'/edit" class="btn btn-warning"><i class="fa fa-edit"></i></a>';
}

function categoryFormat(value) {
    return '<a href="/admin/categories/'+value?.id+'" class="btn btn-outline-secondary">'+value?.name+'</a>';
}

