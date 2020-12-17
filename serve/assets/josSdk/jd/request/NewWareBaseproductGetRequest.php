<?php
class NewWareBaseproductGetRequest
{
	private $apiParas = array();
	
	public function getApiMethodName(){
	  return "jingdong.new.ware.baseproduct.get";
	}
	
	public function getApiParas(){
        if(empty($this->apiParas)){
	        return "{}";
	    }
		return json_encode($this->apiParas);
	}
	
	public function check(){
		
	}
	
    public function putOtherTextParam($key, $value){
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}

    private  $version;

    public function setVersion($version){
        $this->version = $version;
    }

    public function getVersion(){
        return $this->version;
    }
    private  $idss;

    public function setIdss($idss){
        $this->apiParas['idss'] = $idss;
    }
    public function getIdss(){
        return $this->apiParas['idss'];
    }
    private  $basefieldsset;

    public function setBasefieldsset($basefieldsset){
        $this->apiParas['basefieldsset'] = $basefieldsset;
    }
    public function getBasefieldsset(){
        return $this->apiParas['basefieldsset'];
    }
}

?>