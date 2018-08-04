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
    

    // Get data from database
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
            //$row['icon']  = 'sistema.png';
        }
        $row['a_attr'] =  array ( 
                              'id'   => $row['id'], 
                              'href' => $row['href'] 
                          );
        //unset($row['href']);
        $data_array[] = $row;
    }


    /**
     * function buildPathLevel
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
      } 
      
      // Altera o caminho completo de cada opção do menu.
      foreach($data_array as $key => $value ){
          $path = buildPathLevel( $data_array[$key]['id'] , $data_array, 'id');
          $data_array[$key]['a_attr']['href'] = $path;
      }      
      
      //echo "<pre>"; 
      //print_r( buildTree($data_array) ); exit;
    
      // Print tree json
      echo json_encode(buildTree($data_array) );
