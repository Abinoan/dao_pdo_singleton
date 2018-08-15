<?php 
	class Database
	{
		private $connect;
		private static $host;
		private static $port;
		private static $dbName;
		private static $user;
		private static $pass;

		private function __construct()
		{
			try 
			{
				# DSN = Data Source	Name, String de Conexão com o Banco
				$dsnHost = self::$host;
				$dsnPort = self::$port;
				$dsnDb = self::$dbName;
				$dsn = "pgsql:host=$dsnHost options='--client_encoding=UTF8'; port=$dsnPort; dbname=$dsnDb";

				$this->connect = new PDO($dsn, self::$user, self::$pass);
 
  		    	# O PHP irá gerar exceçoes em caso de erros
   				$this->connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);				
				
			} catch (PDOExeption $e) {
            	# Então não carrega nada mais da página. 
            	# É possivel mostrar a mensagem com echo ou die ($e->getMessage() ) mas pode nao ser segurocom dados
            	die("Erro ao estabelecer a conexão com o Banco de Dados: " . $e->getMessage());	
			}
		}

		public function close(){
			 $this->connect = NULL;
		}

		function __destruct()
		{
		 	$this->close(); //$this->connect = NULL;
		}

		static public function getInstance($dbName="sincom5", $user="postgres", $pass="admin", $drive="pgsql", $host="localhost", $port=5432 )
		{
			static $instance = NULL;

			if (empty($instance)) 
			{
				self::$host = $host;
				self::$port = $port;
				self::$dbName = $dbName;
				self::$user = $user;
				self::$pass = $pass;

				try 
				{
					$instance= new Self();
				} catch (Exception $e) {
					# $e->getMessage() 
					Die("Erro ao estabelecer conexão com o banco de dados: " . $e->getMessage());
				}
			}

			return $instance;
		}

		private function setParams($statement, $parameters = array())
		{
			foreach ($parameters as $key => $value) {
				$this->setParam($statement, $key, $value);
			}
		}

		private function setParam($statement, $key, $value)
		{
			$statement->bindParam($key, $value);
		}


		public function executeQuery($strQuery, $returnData = True, $params = array(), $transaction = False)
		{
			if ($transaction) 
			{
				$this->connect->beginTransaction();
			}	

			$qry = $this->connect->prepare($strQuery);
			$this->SetParams($qry, $params);
			
			if($qry->execute() > 0) 
			{
				if ($transaction) 
				{
					$this->connect->commit();
				}	
			} else {
				$this->connect->roolbak();
			}

			if ($returnData) 
			{
				# retorna um array associativo
				return $qry->fetchAll(PDO::FETCH_ASSOC);
			}
		}
	}
?>
