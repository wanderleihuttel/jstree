    // Habilitar menu jstree toggle
    var open = false;
    function toggle(){
        if(open){
            $("#jstree_menu").jstree('close_all');
            open = false;
        }
        else{
            $("#jstree_menu").jstree('open_all');
            open = true;
        }
    } // end function toggle    

        
    $(document).ready(function(){

        $('#jstree_menu').jstree({
            'core' : {
                /*'themes': { 'name': 'proton',  'dots': true, 'icons': true, 'stripes': false, 'url': 'js/themes/proton/style.css', 'responsive': true },*/
                'themes': { 'name': 'proton',  'dots': true, 'icons': true, 'stripes': false, 'responsive': true },
                'data' : {
                    'url' : 'response.php',
                    'dataType' : 'json' // needed only if you do not supply JSON headers
                }
            }, // end core
            'search' : { 'show_only_matches': true, 'search_leaves_only' : false },
            'plugins':[ 'types', 'theme', 'cookie', 'html_data', 'state',  'search'],
            'types': {
                '1': {
                    'icon': "img/icon-tipo1.png"
                },
                '2': {
                    'icon': "img/icon-tipo2.png"
                }
            },

        })
        .on('activate_node.jstree', function(e,data){
            var hrefNode = data.node.a_attr.href; // a_attr href 
            var idNode   = data.node.a_attr.id;   // a_attr id

            e.preventDefault();
            if(hrefNode=="#"){
                return false;
            } //end if
            
            // carregar dialog 
            $('#dialog').html(hrefNode);
            /*
            var $dialog = $('#dialog').load(
                hrefNode, {'OperacaoID':'carregarform', 'SistemaID': idNode},
                function(responseText, statusText, xhr){
                    if(statusText == 'success'){ 
                        //do nothing 
                        alert(idNode);
                        $(document).attr("title", "Intranet Famacris - " + idNode);
                    }//fim if
                    else if(statusText == 'error'){
                        alert('Ocorreu um erro ao carregar a página!\n ' + xhr.status + ' - ' + xhr.statusText); 
                    }//fim else if
                }
            ); // fim dialog
            */
            
            return false;      
        }); //fim bind
          
        // Habilita abertura do nó quando clicado em qualquer parte do menu
        $('#jstree_menu').on('changed.jstree', function (e, data){
            var tree = $('#jstree_menu');
            tree.jstree('is_open', data.selected) ? $('#jstree_menu').jstree('close_node', data.selected) : $('#jstree_menu').jstree('open_node', data.selected);
        });
        
          
        // Habilita jstree search
        var check_jstree_search = false;
        $('#jstree_menu_search').keyup(function (){
            if(check_jstree_search) {
                clearTimeout(check_jstree_search); 
            }
            check_jstree_search = setTimeout(function (){
                var value_jstree_search = $('#jstree_menu_search').val();
                $('#jstree_menu').jstree(true).search(value_jstree_search);
            }, 250);
        });
        
        // Abrir todos nós
        $('#btn_jstree_open').on('click', function(){
            $('#jstree_menu').jstree('open_all');
            open = true;
        });

        // Fechar todos nós
        $('#btn_jstree_close').on('click', function(){
            $('#jstree_menu').jstree('close_all');
            open = false;
        });
        
    }); // end document.ready