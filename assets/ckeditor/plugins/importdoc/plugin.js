CKEDITOR.plugins.add('importdoc',
{
    init: function (editor) {
        var pluginName = 'importdoc';
        editor.ui.addButton('importdoc',
            {
                label: 'Import from word document',
                command: 'OpenWindow',
                icon: CKEDITOR.plugins.getPath('importdoc') + 'word.png',
                toolbar: 'import'
            });
        var cmd = editor.addCommand('OpenWindow', { exec: showMyDialog });
    }
});
function showMyDialog(editor) {
    //window.open('/Default.aspx', 'MyWindow', 'width=800,height=700,scrollbars=no,scrolling=no,location=no,toolbar=no');
    var formElement = document.createElement("form");
    formElement.setAttribute("id", "myForm");
    formElement.setAttribute("action", "../../report/importdoc");
    formElement.setAttribute("method", "post");
    formElement.setAttribute("enctype", "multipart/form-data");


    var hiddenElement = document.createElement("input");
    hiddenElement.setAttribute('type', 'hidden');
    hiddenElement.setAttribute('id', 'ajax');
    hiddenElement.setAttribute('name', 'ajax');
    hiddenElement.setAttribute('value', '1');
    formElement.appendChild(hiddenElement);


    var element = document.createElement("input");
    element.setAttribute('type', 'file');
    element.setAttribute('id', 'userfile');
    element.setAttribute('name', 'userfile');
    element.setAttribute('value', 'userfile');
    //element.setAttribute('multiple', 'multiple');
    formElement.appendChild(element);


    document.body.appendChild(formElement);
    element.click();


    element.addEventListener('change', function(e){
        //var file = this.files[0];
        //editor.insertHtml(file.name);

        var options = {
            cache: false,
            complete: function(response){
                //alert(response.responseText);
                editor.insertHtml(response.responseText);
            },
            error: function(){
                alert('Import failed! Check your connection and try again.');
            }
        };

        $("#myForm").ajaxForm(options);

        $("#myForm").submit();


        formElement.removeChild(element);
        document.body.removeChild(formElement);
    });
}