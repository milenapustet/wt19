<?php
class DB {
	private $connection;

	public function __construct($name, $host = 'localhost', $user = 'root', $pass='') {
		try {
			$this->connection = new PDO ( "mysql:host=$host;dbname=$name;charset=utf8", $user, $pass );
			$this->connection->setAttribute ( PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC );
		} catch ( PDOException $exception ) {
			die ( $exception->getMessage () );
		}
	}

	public function __destruct() {
		$this->connection = null;
	}

	public function all() {
		$statement = $this->connection->query ( 'SELECT * FROM mockupdatatable ORDER BY nachname ASC' );
		return $statement->fetchAll ();  //gibt alle Einträge zurück
	}

	public function get($id) {
		$statement = $this->connection->prepare ( 'SELECT * FROM mockupdatatable WHERE id=:id' );
		$statement->bindParam ( ':id', $id, PDO::PARAM_INT ); //platzhalter, der gebunden an Variable; hier weise ich also  Wert zu
		$statement->execute ();
		return $statement->fetch ();  //gibt nur einen Eintrag zurück
	}

	public function add(array $daten) {         //positionsabhängige Parameter hier; könnten wir theroetisch auch über bindParam machen. Dann müsste man vier Variablen hinter add übergeben und dann 4 Mal bindParam aufrufen.
		$statement = $this->connection->prepare (  'INSERT INTO mockupdatatable 
                                                    (vorname, nachname, email, ipnr)   
                                                    VALUES (?, ?, ?, ?)' );  //wir übergeben nur 4 Parameter, dh in dem Array sind nur vier Werte; id wird später bei insert into erstellt.
                                 // Tabelle besteht aus 5 Spalten, weil noch zusätzl id, die wird aber automatisch erstellt&zugefügt
        return $statement->execute ( $daten );
	}

	public function edit(array $daten) {
	    //print_r($daten);
		$statement = $this->connection->prepare ( 'UPDATE mockupdatatable SET vorname=?, 
                                                            nachname=?, email=?, ipnr=? WHERE id=?' );
		return $statement->execute ( $daten ); //hier hat daten-array 5 paramteter, bei add nur 4
	}

	public function delete($id) {
		$statement = $this->connection->prepare ( 'DELETE FROM mockupdatatable WHERE id = :id' );
		$statement->bindParam(':id', $id, PDO::PARAM_INT);
		return $statement->execute();
	}
}
?>