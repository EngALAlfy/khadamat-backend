function actionsFormat(value, row) {
    var html = '<div style="width: 200px !important;">';
    html += '<a href="/admin/series-episodes/' + row.id + '/delete" class="btn btn-danger m-2"><i class="fa fa-trash"></i></a>';
    html += '<a href="/admin/series-episodes/' + row.id + '/edit" class="btn btn-warning m-2"><i class="fa fa-edit"></i></a>';

    html += '</div>';
    return html;
}


function videoFormat(value) {
    if(value == null){
        return '--';
    }

    return '<video width="200" height="200" controls>\n' +
        '  <source src="/uploads/videos/'+value+'" type="video/mp4">\n' +
        'Your browser does not support the video tag.\n' +
        '</video>'
}
