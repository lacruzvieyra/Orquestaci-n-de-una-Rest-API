<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: PUT');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Post.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $post = new Post($db);

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  // Set ID to update
  $post->id_materia = $data->id_materia;

  $post->semestre = $data->semestre;
  $post->nombre_materia = $data->nombre_materia;
  $post->horas_trabajo = $data->horas_trabajo;
  $post->especificacion = $data->especificacion;

  // Update post
  if($post->update()) {
    echo json_encode(
      array('message' => 'La materia fue actualizada')
    );
  } else {
    echo json_encode(
      array('message' => 'La materia no pudo ser actualizada')
    );
  }

