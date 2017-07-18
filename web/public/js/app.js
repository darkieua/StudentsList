/**
 * Created by Darkie on 17.07.2017.
 */

var studentListModule = (function() {
    var jqueryMap = {
        studentRow: $('.student-row')
    };

    var initModule = function() {
        jqueryMap.studentRow.hover(
            function () {
                $(this).find('.edit-options').show();
            },
            function() {
                $(this).find('.edit-options').hide();
            }
        )
    };

    return {init: initModule}
})();

studentListModule.init();