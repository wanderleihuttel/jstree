<?php
    require_once 'config.php';

    /**
     * function buildTree  (Criar árvore com os elementos)
     * @param array $elements
     * @param array $options['parent_id_column_name', 'children_key_name', 'id_column_name']
     * @param int $parentId
     * @return array
     */
    function buildTree(array $elements, $options = [
        'parent_id_column_name' => 'parent_id',
        'children_key_name' => 'children',
        'id_column_name' => 'id'], $parentId = 0)
        {
        $branch = array();
        foreach ($elements as $element) {
            if ($element[$options['parent_id_column_name']] == $parentId) {
                $children = buildTree($elements, $options, $element[$options['id_column_name']]);
                if ($children) {
                    $element[$options['children_key_name']] = $children;
                }
                $branch[] = $element;
            }
        }
        return $branch;
    } // end buildTree



    /**
     * function buildPathLevel (Criar caminho dos menus com todos os níveis)
     * @param int $id
     * @param array $elements
     * @param string $column_id
     * @return array
     */
    function buildPathLevel($id, $array, $field_id){
        $array_path = array();
        $key=true;
        while($key){
            $key = array_search($id, array_column($array, $field_id));
            if( $array[$key]['href'] != ""){
                $array_path[] = $array[$key]['href'];
            }
            if($array[$key]['parent_id']==null){
                break;
            }
            $id =  $array[$key]['parent_id'];
        }
        krsort($array_path);
        $implode = implode("/", $array_path);
        return $implode;
    } // end buildPathLevel


    // Buscar dados do banco de dados
    $sql = "SELECT  id, parent_id, name AS text, href, type
            FROM jstree_menu
            -- WHERE id in (SELECT id FROM user_access WHERE user_id = 7)
            ORDER BY name";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    // Percorre o array modifica algumas informações e troca o ícone
    while( $row = $stmt->fetch() ) {
        $row['text'] = ( $row['text'] );
        if ( $row['id'] == 1){
            $row['icon']  = 'img/icon-controle-de-horas.png';
        } else if ( $row['id'] == 112){
            $row['icon']  = 'img/icon-contato.png';
        } else if ( $row['id'] == 71){
            $row['icon']  = 'img/icon-custos.png';
        } else if ( $row['id'] == 57){
            $row['icon']  = 'img/icon-controle-de-materiais.png';
        } else if ( $row['id'] == 34){
            $row['icon']  = 'img/icon-questor.png';
        } else if ( $row['id'] == 3){
            $row['icon']  = 'img/icon-gerenciador.png';
        } else if ( $row['id'] == 2){
            $row['icon']  = 'img/icon-controle-interno.png';
        }
        $row['a_attr'] =  array (
                              'id'   => $row['id'],
                              'href' => $row['href']
                          );
        $data_array[] = $row;
    } // end while


    // Altera o caminho completo de cada opção do menu.
    foreach($data_array as $key => $value ){
        $path = buildPathLevel( $data_array[$key]['id'] , $data_array, 'id');
        $data_array[$key]['a_attr']['href'] = $path;
    }

    // Debug array
    //echo "<pre>";
    //print_r( buildTree($data_array) ); exit;

    // Imprime array json
    echo json_encode(buildTree($data_array) );
