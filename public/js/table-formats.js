function imageFormat(value) {
    return '<img width="100" height="100" class="img-fluid" src="/uploads/images/'+value+'" alt="'+value+'"'+'>';
}

function widthFormat(value , row , index , field) {
    return '<p style="width: 200px!important;">'+value+'</p>';
}

function createdByFormat(value) {
    return value?.name;
}

function urlFormat(value) {
    return '<a href="' + value + '" class="btn btn-outline-secondary">' + value + '</a>';
}
