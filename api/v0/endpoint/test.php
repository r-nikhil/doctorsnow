<?php



$app->get('/try/:id/yolo/:id1', function() use ($app, $connection)
{
  list ($id, $id1)= func_get_args();
  echo json_encode($id);

  echo json_encode($id1);

});


?>
