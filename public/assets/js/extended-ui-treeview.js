/**
 * Treeview (jquery)
 */

'use strict';

$(function() {
    $('#jstree-basic').jstree();

    $('#jstree-basic').on("select_node.jstree", function (e, data) {
        var node = data.node;
        var $li  = $("#" + node.id);
        var editUrl  = $li.data("edit-url");
        var dbId     = $li.data("db-id");
        var tree = $('#jstree-basic').jstree(true);
        var parentText = "لا يوجد أب";
        var parentDbId = "لا يوجد ID أب";
        var parentDbIdText ="";
        var numChildrenText = "";

        if(node.parent !== "#") {
            var parentNode = tree.get_node(node.parent);
            parentText = parentNode.text;
            var $parentLi = $("#" + parentNode.id);
            parentDbId = $parentLi.data("db-id");
            parentDbIdText = "<p><b>الأب (ID db):</b> " + parentDbId + "</p>";
        }

        if(node.parent === "#") {
            numChildrenText = "<p><b>عدد العناصر الفرعية:</b> " + node.children.length + "</p>";
        }

        $("#details").html(
          "<h4>التفاصيل </h4>" +
          "<p><b>ID:</b> " + node.id + "</p>" +
          "<p><b>ID db:</b> " + dbId + "</p>" +
          "<p><b>الاسم:</b> " + node.text + "</p>" +
          "<p><b>الأب (الاسم):</b> " + parentText + "</p>" +
          parentDbIdText +
          numChildrenText +
          "<p><a href='" + editUrl + "' class='btn btn-sm btn-primary'> تعديل</a></p>"
        );
    });
});

