<?php 
	class ClienteDao extends BaseDao
	{
		public $ordem = "codigo";
		private $_nameTable = "clientes";

		private $codigo;
		private $nome;
		private $endereco;

		# converte as linhas em json
		private function rowsToJson($rows)
		{
			$json = json_encode($rows, JSON_PRETTY_PRINT); 
			return $json;
		}

		public function loadId($Id, $dataResult = False, $returnJson = False)
		{
			$rows = parent::$Db->executeQuery("SELECT codigo, nome , endereco FROM $this->_nameTable WHERE codigo = $Id");
			
			$this->setCodigo($rows[0]["codigo"]);
			$this->setNome($rows[0]["nome"]);
			$this->setEndereco($rows[0]["endereco"]);

			# se retorna os dados
			if ($dataResult) 
			{
				if ($returnJson) 
				{
					return $this->rowsToJson($rows);
					exit;
				} 	
				return $rows;
			}		
		}

		public function loadAll($dataResult = False, $returnJson = False)
		{
			$rows = parent::$Db->executeQuery("SELECT codigo, nome, endereco FROM $this->_nameTable order by $this->ordem");
			
			# se retorna os dados
			if ($dataResult) 
			{
				if ($returnJson) 
				{
					return $this->rowsToJson($rows);
					exit;
				} 	
				return $rows;
			}		
		}

		public function Delete() 
		{
			Parent::Delete();
			echo "Delete conta filha<hr>";
		}

	    /**
	     * @return mixed
	     */
	    public function getCodigo()
	    {
	        return $this->codigo;
	    }

	    /**
	     * @param mixed $codigo
	     *
	     * @return self
	     */
	    public function setCodigo($codigo)
	    {
	        $this->codigo = $codigo;

	        return $this;
	    }

	    /**
	     * @return mixed
	     */
	    public function getNome()
	    {
	        return $this->nome;
	    }

	    /**
	     * @param mixed $nome
	     *
	     * @return self
	     */
	    public function setNome($nome)
	    {
	        $this->nome = $nome;

	        return $this;
	    }

	    /**
	     * @return mixed
	     */
	    public function getEndereco()
	    {
	        return $this->endereco;
	    }

	    /**
	     * @param mixed $endereco
	     *
	     * @return self
	     */
	    public function setEndereco($endereco)
	    {
	        $this->endereco = $endereco;

	        return $this;
	    }
	}

?>


