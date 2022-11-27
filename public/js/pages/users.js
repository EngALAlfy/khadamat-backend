function actionsFormat(value, row) {
    var html = '<div style="width: 300px !important;">';

    html += '<a href="/admin/users/' + row.id + '/delete" class="btn btn-danger m-2"><i class="fa fa-trash"></i> delete </a>';

    if (row.banned === 1) {
        html += '<a href="/admin/users/' + row.id + '/unbanned" class="btn btn-info m-2"><i class="fa fa-user-check"></i> unbanned </a>';
    } else {
        html += '<a href="/admin/users/' + row.id + '/banned" class="btn btn-warning m-2"><i class="fa fa-user-lock"></i> banned </a>';
    }

    if (row.role === 'admin') {
        html += '<a href="/admin/users/' + row.id + '/remove-admin" class="btn btn-secondary m-2"><i class="fa fa-user-slash"></i> noadmin </a>';
    } else {
        html += '<a href="/admin/users/' + row.id + '/make-admin" class="btn btn-success m-2"><i class="fa fa-user-shield"></i> admin </a>';
    }

    html += '<a href="/admin/users/' + row.id + '/edit" class="btn btn-primary m-2"><i class="fa fa-user-edit"></i> edit </a>';

    html += '</div>';
    return html;
}

function userImageFormat(value) {
    return '<img width="100" height="100" class="img-fluid" onerror="this.src=\'/images/user.png\'" src="/uploads/images/'+value+'"'+'>';
}
