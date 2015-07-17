CKEDITOR.plugins.add('delete',
{
    init: function (editor) {
        var pluginName = 'delete';
        editor.ui.addButton('delete',
            {
                label: 'Remove Objective',
                command: 'deleteObjective',
                icon: CKEDITOR.plugins.getPath('delete') + 'delete.png',
                toolbar: 'manipulate'
            });

        var cmd = editor.addCommand('deleteObjective', { exec: showMyDialog });
    }
});

function showMyDialog(editor) {

    alert(editor.element.getAttribute('data-id'));

}