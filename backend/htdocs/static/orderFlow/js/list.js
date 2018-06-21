/**
 * Created by huanjin on 2018/6/3.
 */

;(function () {

    $('.delete').on('click', function () {
        var that = this;
        var url = $(this).data('href');
        if (confirm('确认要删除？')) {
            layer.load(2, {time: 3 * 1000});
            $.get(url, function (data) {
                $(that).parents('tr').remove();
                layer.msg(data.msg);
            }, 'json');
        }
    });

    function search() {
        return true;
    }

    window.order.search = search;

})();