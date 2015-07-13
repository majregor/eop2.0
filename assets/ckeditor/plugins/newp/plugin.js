CKEDITOR.plugins.add('newp',
{
    init: function (editor) {
        var pluginName = 'newp';
        editor.ui.addButton('newp',
            {
                label: 'Import from word document',
                command: 'OpenWindow',
                icon: CKEDITOR.plugins.getPath('newp') + 'lock-open.png',
                toolbar: 'import'
            });
        var cmd = editor.addCommand('OpenWindow', { exec: showMyDialog });
    }
});
function showMyDialog(e) {
    //window.open('/Default.aspx', 'MyWindow', 'width=800,height=700,scrollbars=no,scrolling=no,location=no,toolbar=no');
    var element = document.createElement("input");
    element.setAttribute('type', 'file');
    element.setAttribute('id', 'fle');
    document.body.appendChild(element);
    element.click();
}