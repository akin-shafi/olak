<?php require_once('../private/initialize.php');
$page_title = 'Bar';
$page = 'Menu'; 

	$PCAT = ProductCategory::find_by_undeleted(['order' => 'ASC']);
    $id = array_values($PCAT)[0]->id; 
    $category = $_POST['id'] ?? $id;
    $categories = Product::find_by_category($category);

 ?>
<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
	<title><?php echo $page_title. $page ?></title>
	<link rel="stylesheet" type="text/css" href="css/menu.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
</head>

<body>
	<section id="our_menu" class="pt-5 pb-5">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="page_title text-center mb-4">
						<div class="logo">
							<span class="font1">D'</span>Prime  
							<span class="font2">Wine Store & L</span>ounge</div>
						<h1>our menu</h1>
						<div class="single_line"></div>
					</div>
				</div>
			</div>
			<section class="bg" id="all_items">
							
			</section>
		</div>
	</section>
</body>
</html>
<script type="text/javascript" src="js/jQuery-2.1.4.min.js"></script>
<script type="text/javascript">
	fetch();
    function fetch() {
       $.ajax({
          url: 'inc/fetch_item.php',
          method: 'post',
          data: {
             fetch: 1,
             // id: 1,
          },
          success: function(data) {
             $('#all_items').html(data);
                        
          }
      });
    }

    $(document).on('click', '.menu_item', function(){
      var id = $(this).data('id');
      $.ajax({
          url: 'inc/fetch_item.php',
          method: 'post',
          data: {
             fetch: 1,
             id: id,
          },
          success: function(data) {
             $('#all_items').html(data);
                        
          }
      });
    });
</script>