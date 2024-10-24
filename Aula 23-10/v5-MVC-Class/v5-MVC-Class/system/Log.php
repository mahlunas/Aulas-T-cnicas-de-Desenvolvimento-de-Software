<?php

class Log{
    private $db;

    private $filePatch = 'log/log.db';

    static private $instance = FALSE;

    privae final __construct(){
        $this->db = new SQLite3($this->filePatch);
        $this->initializeDatabase();
    }

    static public function singleton ()
	{
		if (self::$instance !== FALSE)
			return self::$instance;

		$class = __CLASS__;

		self::$instance = new $class ();

		return self::$instance;
	}

    public function initializeDatabase(){
        $query = "CREATE TABLE IF NOT EXISTS logs(
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        context TEXT,
        timestamp DATETIME DEFAULT CURRENT_TIMESTAMP,
        message TEXT)
        ";

        $this->db->query ($query);
    }

    public function insertLog($context, $message){
        $query = "INSERT INTO logs(context, message) VALUES
        (:context, :message)";

        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':context', $context, SQLITE3_TEXT);
        $stmt->bindValue(':message', $message, SQLITE3_TEXT);
        $stmt->execute();
    }

    public function __destruct(){
        $this->db->close();
    }
}