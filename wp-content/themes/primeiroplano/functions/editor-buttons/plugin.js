(function() {
    tinymce.create('tinymce.plugins.SpaBtns', {
        init : function(editor, url) {


            /* CAIXA VERDE */
            editor.addButton('quebraLinha', {
                title : 'Quebra Linha',
                cmd : 'quebraLinha',
                classes : 'quebraLinha'
            });

            editor.addCommand('quebraLinha', function() {
                var output;
                output = '&nbsp;<div class="quebraLinha"></div>';
                tinymce.activeEditor.insertContent(output);
            });



            /* CAIXA MENOR AZUL */
            editor.addButton('boxMenorAzul', {
                title : 'Caixa Menor Azul',
                cmd : 'boxMenorAzul',
                classes : 'boxMenorAzul'
            });

            editor.addCommand('boxMenorAzul', function() {
                var output;
                output = '<div class="textboxMenor boxazulescuro">';
                output += '<h2>Título</h2>';
                output += '<p>Texto....</p>';
                output += '</div>';

                tinymce.activeEditor.insertContent(output);
            });




        },

    });
    // Register plugin
    tinymce.PluginManager.add( 'spa', tinymce.plugins.SpaBtns );
})();
