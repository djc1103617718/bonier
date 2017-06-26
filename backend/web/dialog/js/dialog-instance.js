function confirmDelete(url,data,title,content,method) {
    if (data) {
        data = eval('(' + data + ')');
    }
    if (!title) {
        title = '删除提醒!';
    }
    if (!content) {
        content = '删除以后将无法找回,你确定要删除吗?';
    }
    if (!method) {
        method = 'post';
    }

    var d = dialog({
        title: title,
        content: content,
        okValue: '是',
        ok: function () {//回调函数
            $.ajax
            ({
                url: url,
                dataType: "json",
                method:method,
                data: data,
                success: function (data) {
                }
            });
        },
        cancelValue: '否',
        cancel: function () {//回调函数

        }
    });

    d.show();
}

function link(url) {
    window.location.href = url;
}
