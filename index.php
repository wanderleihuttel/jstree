<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.3.5/jstree.min.js"></script>
    <link rel="stylesheet" type="text/css" href="js/themes/proton/style.css">
    <script type="text/javascript" src="js/script.js"></script>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <title>Exemplo de Menu jsTree com PHP e MySQL</title>
</head>
<body>
    <nav>
        <h2>Exemplo de Menu jsTree com PHP e MySQL</h2>
    </nav>
    <div class="container">
        <div class="tree">
          <div class="search">
              <input type="search" id="jstree_menu_search" placeholder="Procurar..." value=""/>
          </div>
          <div class="jstree_buttons">
              <button id='btn_jstree_open'>Expand</button>
              <button id='btn_jstree_close'>Collapse</button>
              <button id='btn_jstree_toggle' onclick="toggle();">Toggle</button>
          </div>
          <div id="jstree_menu"></div>
        </div>
    </div>
    <div class="container">
        <div id="dialog">Div Dialog Teste</div>
    </div>
</body>
</html>
