function actionsFormat(value, row) {
    return '<a href="/admin/subsubcategories/'+row.id+'/delete" class="btn btn-danger"><i class="fa fa-trash"></i></a>'+
        '<a href="/admin/subsubcategories/'+row.id+'/edit" class="btn btn-warning"><i class="fa fa-edit"></i></a>';
}

function categoryFormat(value) {
    return '<a href="/admin/categories/'+value?.id+'" class="btn btn-outline-secondary">'+value?.name+'</a>';
}

function subcategoryFormat(value) {
    return '<a href="/admin/subcategories/'+value?.id+'" class="btn btn-outline-secondary">'+value?.name+'</a>';
}
