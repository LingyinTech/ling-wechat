/**
 * Created by huanjin on 2018/6/27.
 */
;(function () {

    $('table.param-data tbody tr').on('click', function () {
        $(this).children('td').each(function (i,v) {
            var code = $(this).attr('data-code');
            console.log(code);
        })
    })

})();