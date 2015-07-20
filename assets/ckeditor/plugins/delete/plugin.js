CKEDITOR.plugins.add('delete',
{
    init: function (editor) {

        var canRemove = editor.element.getAttribute('canRemove');

        if(canRemove == "yes") {

            var pluginName = 'delete';
            editor.ui.addButton('delete',
                {
                    label: 'Remove Objective',
                    command: 'deleteObjective',
                    icon: CKEDITOR.plugins.getPath('delete') + 'delete.png',
                    toolbar: 'manipulate'
                });

            var cmd = editor.addCommand('deleteObjective', {exec: deleteDialog});

        }

    }
});

function deleteDialog(editor) {
    if(confirm('This will permanently delete the Objective and Function. Do yo want to continue?')){

        var itemId = editor.element.getAttribute('data-id');
        var index = editor.element.getAttribute('item-index');
        var objRow = document.getElementById("objRow"+index);
        var functionRow = document.getElementById("functionRow"+index);

        var formData = {
            ajax: 1,
            entityId: itemId
        };

        $.ajax({
            url: '../../plan/removeObjective',
            data: formData,
            type: 'POST',
            success: function (response) {
                if(response == 'deleted'){
                    objRow.remove();
                    functionRow.remove();
                }
                //alert(response);
            }

        });

    }
}