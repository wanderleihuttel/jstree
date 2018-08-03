<?php
    require_once 'config.php';

    /**
     * function buildTree
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


    $sql = "SELECT  codigosistema AS id, 
                    codigosistemapai AS parent_id, 
                    concat(classificacaosistema, ' - ', descricaosistema) AS text, 
                    hrefsistema AS href,
                    tiposistema AS type
                    FROM sistema 
                    WHERE codigosistema in (SELECT codigosistema FROM acesso WHERE codigousuario = 7)
                    ORDER BY classificacaosistema";

    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    while( $row = $stmt->fetch() ) { 
        $row['text'] = utf8_encode( $row['text'] );
        if( $row['parent_id'] == 0 ) {
            //$row['icon']  = 'img/node-parent.png';
        }
        $row['a_attr'] =  array ( 
                                  'id'   => $row['id'], 
                                  'href' => $row['href'] 
                                );
        unset($row['href']);
        

        $data[] = $row;
    }

    /*
    $data_aux = $data;
    foreach($data as $key => $value ){
        $data[$key]['href'] = get_path_level_menu( $data[$key]['id'] , $data_aux, 'id', 'id');
    }
    */

    
    //echo "<pre>"; 
    //print_r( buildTree(($data)) ); exit;
    
    // Print tree json
    echo json_encode(buildTree(($data)) );
