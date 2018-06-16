<html>
<head>
    <title>JS Tree</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/themes/default/style.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/jstree.min.js"></script>
    <script>
        function createJSTree() {
            $('#Tree').jstree({
                "core": {
                    "data" : {
                        "url" : "http://till2077.com/code/jstree/server.php",
                        "data" : function (node) {
                            return { "id" : node.id };
                        }
                    },
                },
                "plugins": ["search", "checkbox"],
                "search": {
                    "ajax": {
                        "url": "http://till2077.com/code/jstree/server.php"
                    }
                }
            });

            /*$("#Tree").on("loaded.jstree", function() {
                $('#Tree').jstree(true).load_node([2,4]);
                $('#Tree').jstree(true).select_node([5]);
            });*/
        }

         $(document).ready(function () {
            var to = false;
            $('#search-box').keyup(function () {
                if(to) { clearTimeout(to); }
                to = setTimeout(function () {
                    var v = $('#search-box').val();
                    $('#Tree').jstree(true).search(v, false, true, '#');
                }, 250);
            });

            createJSTree();
        });
    </script>
</head>
<body>
    <input id="search-box" class="search-box" />
    <br />
    <div id="Tree"></div>
</body>
</html>





