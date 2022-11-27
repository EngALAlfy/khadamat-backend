function actionsFormat(value, row) {
    return '<a href="/admin/pages/' + row.id + '/delete" class="btn btn-danger"><i class="fa fa-trash"></i></a>';
}

function urlFormat(value, row) {
    return '<a href="/api/v1/pages/' + row.id + '" class="btn btn-outline-success"><i class="fa fa-eye"></i></a>';
}

$(function () {

    if(tinymce !== 'undefined'){
        tinymce.init({
            selector: '#content',
            min_height:500,

        });
    }

});
