<?php
    class Post {
        private $conn;
        private $table= 'materias';

        //Propiedades 
        public $id_materia;
        public $semestre;
        public $nombre_materia;
        public $horas_trabajo;
        public $especificacion;

        //Constructor 
        public function __construct($db){
            $this->conn = $db;
        }

        //Obtener materias 
        public function read(){
            //Crear query
            $query='SELECT id_materia, semestre, nombre_materia,horas_trabajo,especificacion
                FROM
                    ' . $this->table;

            //Preparar statement
            $stmt = $this->conn->prepare($query);

            //Ejecutar query 
            $stmt->execute();

            return $stmt;
        }

        // Update materias
        public function update() {
            // Create query
            $query = 'UPDATE ' . $this->table . '
                                SET semestre = :semestre, nombre_materia = :nombre_materia, horas_trabajo = :horas_trabajo, especificacion = :especificacion
                                WHERE id_materia = :id_materia';

            // Prepare statement
            $stmt = $this->conn->prepare($query);

            // Clean data
            $this->semestre = htmlspecialchars(strip_tags($this->semestre));
            $this->nombre_materia = htmlspecialchars(strip_tags($this->nombre_materia));
            $this->horas_trabajo = htmlspecialchars(strip_tags($this->horas_trabajo));
            $this->especificacion = htmlspecialchars(strip_tags($this->especificacion));
            $this->id_materia = htmlspecialchars(strip_tags($this->id_materia));

            // Bind data
            $stmt->bindParam(':semestre', $this->semestre);
            $stmt->bindParam(':nombre_materia', $this->nombre_materia);
            $stmt->bindParam(':horas_trabajo', $this->horas_trabajo);
            $stmt->bindParam(':especificacion', $this->especificacion);
            $stmt->bindParam(':id_materia', $this->id_materia);

            // Execute query
            if($stmt->execute()) {
            return true;
            }

            // Print error if something goes wrong
            printf("Error: %s.\n", $stmt->error);

            return false;
        }

        //Eliminar materias
        public function delete() {
            // Create query
            $query = 'DELETE FROM ' . $this->table . ' WHERE id_materia = :id_materia';
  
            // Prepare statement
            $stmt = $this->conn->prepare($query);
  
            // Clean data
            $this->id_materia = htmlspecialchars(strip_tags($this->id_materia));
  
            // Bind data
            $stmt->bindParam(':id_materia', $this->id_materia);
  
            // Execute query
            if($stmt->execute()) {
              return true;
            }
  
            // Print error if something goes wrong
            printf("Error: %s.\n", $stmt->error);
  
            return false;
      }
        
            
        
    }